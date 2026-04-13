<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Department;
use App\Models\Project;
use App\Models\ProjectActivity;
use App\Models\ProjectsInvoice;
use App\Models\Task;
use App\Models\User;
use App\Queries\ProjectDataTable;
use App\Repositories\ClientRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class ProjectController.
 */
class ProjectController extends AppBaseController
{
    /** @var ProjectRepository */
    private $projectRepository;

    /** @var UserRepository */
    private $userRepository;

    /**
     * ProjectController constructor.
     *
     * @param  ProjectRepository  $projectRepo
     * @param  UserRepository  $userRepository
     */
    public function __construct(
        ProjectRepository $projectRepo,
        UserRepository $userRepository
    ) {
        $this->projectRepository = $projectRepo;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the Project.
     *
     * @param  Request  $request
     * @param  ClientRepository  $clientRepository
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     *
     * @throws Exception
     */
    public function index(Request $request, ClientRepository $clientRepository)
    {
       
        if ($request->ajax()) {
            return Datatables::of(
                (new ProjectDataTable())->get(
                    $request->only('filter_client')
                )
            )->make(true);
        }

        $clients = $clientRepository->getClientList();
        $users = $this->userRepository->getUserList();
        $currencies = Project::CURRENCY;
        $budgetTypes = Project::BUDGET_TYPE;
        $projectStatus = Arr::except(Project::STATUS, Project::STATUS_All);
        $departments = Department::toBase()->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
       //jobTypes = \App\Models\JobType::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
         $jobTypes = \App\Models\JobType::orderByRaw('`order` = 0')
        ->orderBy('order', 'asc')
        ->orderBy('created_at', 'desc')
        ->pluck('name', 'id')
        ->toArray();
        
        if (Auth::user()->hasPermissionTo('manage_projects')) {
            return view('projects.index', compact('clients', 'users', 'departments', 'currencies', 'budgetTypes', 'projectStatus', 'jobTypes'));
        }

        return view('my_projects.index', compact('users'));
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param  CreateProjectRequest  $request
     * @return JsonResponse
     */
    public function store(CreateProjectRequest $request)
    {
        
        $input = $request->all();

        $this->projectRepository->store($input);

        return $this->sendSuccess('Project created successfully.');
    }

    /**
     * @param  Project  $project
     * @param  ClientRepository  $clientRepository
     * @return Application|Factory|View
     */
    public function show(Project $project, ClientRepository $clientRepository)
    {
        $clients = $clientRepository->getClientList();
        $users = $this->userRepository->getUserList();
        $loginUser = Auth::user()->id;
        $currencies = Project::CURRENCY;
        $budgetTypes = Project::BUDGET_TYPE;
        $projectStatus = Arr::except(Project::STATUS, Project::STATUS_All);
        $openTasks = $project->openTasks->count();
        $project = Project::with('createdUser', 'users.media', 'type')->findOrFail($project->id);
        $data = $this->projectRepository->getProjectsDetails($project);
        $taskRepo = app(TaskRepository::class);
        $taskData = $taskRepo->getTaskData();
        $activities = ProjectActivity::with('createdBy')->where('subject_id', '=',
            $project->id)->where('subject_type', '=', Project::class)->orderByDesc('created_at')->get();
        $departments = Department::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $jobTypes = \App\Models\JobType::orderBy('name', 'asc')->pluck('name', 'id')->toArray();

        return view('projects.show',
            compact('project', 'clients', 'users', 'currencies', 'budgetTypes', 'projectStatus', 'openTasks',
                'activities',
                'data', 'departments','loginUser','jobTypes'))->with($taskData);
    }

    /**
     * Show the form for editing the specified Project.
     *
     * @param  Project  $project
     * @return JsonResponse|RedirectResponse
     */
    public function edit(Project $project)
    {
        $users = $project->users->pluck('id')->toArray();
        if (empty($project->currency)) {
            $project->currency = '7'; // default BDT
        }
        $allUsers = $this->userRepository->getUserList();

        return $this->sendResponse(['project' => $project, 'users' => $users, 'allUsers' => $allUsers], 'Project retrieved successfully.');
    }

    /**
     * Update the specified Client in storage.
     *
     * @param  Project  $project
     * @param  UpdateProjectRequest  $request
     * @return JsonResponse|RedirectResponse
     */
    public function update(Project $project, UpdateProjectRequest $request)
    {
       
        $input = $request->all();
        $input['price'] = (! empty($input['price']) ? removeCommaFromNumbers($input['price']) : null);

        // Prevent setting project price below the sum of approved project invoices
        $approvedInvoicesTotal = ProjectsInvoice::where('project_id', $project->id)
            ->where('status', ProjectsInvoice::STATUS_APPROVED)
            ->sum('paid');

        if (! is_null($input['price']) && (int) $input['price'] < (int) $approvedInvoicesTotal) {
            return $this->sendError('Project price cannot be less than approved invoices total.');
        }
        if ($input['status'] == Project::STATUS_FINISHED) {
            if ($project->tasks()->where('status', '=', Task::$status['STATUS_ACTIVE'])->count() > 0) {
                return $this->sendError('This project has pending tasks.');
            }
           
        }
        if ((int) $input['status'] === Project::STATUS_PAID) {
            // Ensure fully paid before marking as Finished (Paid)
            if ((int) $approvedInvoicesTotal < (int) $input['price']) {
                return $this->sendError('Cannot mark as Paid. Approved Invoice Payments Are Less Than The  Project Price.');
            }
           
        }

        $this->projectRepository->update($input, $project->id);

        return $this->sendSuccess('Project updated successfully.');
    }

    /**
     * Remove the specified Project from storage.
     *
     * @param  Project  $project
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Project $project)
    {
        $this->projectRepository->delete($project->id);

        return $this->sendSuccess('Project deleted successfully.');
    }

    /**
     * @return JsonResponse
     */
    public function getMyProjects()
    {
        $projects = $this->projectRepository->getMyProjects();

        return $this->sendResponse($projects, 'Project Retrieved successfully.');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function users(Request $request)
    {
        $projectIds = $request->get('projectIds', null);

        $projectIdsArr = (! is_null($projectIds)) ? explode(',', $projectIds) : [];
        $users = $this->userRepository->getUserList($projectIdsArr);

        return $this->sendResponse($users, 'Users Retrieved successfully.');
    }

    /**
     * @param  User  $user
     * @return JsonResponse
     */
    public function getProjectsByUser(User $user)
    {
        $projectList = $this->projectRepository->getProjectsByUserId($user->id);

        return $this->sendResponse($projectList, 'Projects Retrieved successfully.');
    }

    /**
     * @return Application|Factory|View
     */
    public function userAssignProjects()
    {
        $users = $this->userRepository->getUserList();

        return view('my_projects.index', compact('users'));
    }

    /**
     * @param  Project  $project
     * @return Application|Factory|RedirectResponse|View
     */
    public function userAssignProjectsShow(Project $project)
    {
        $projectIds = getLoggedInUser()->projects->pluck('id')->toArray();
        if (! in_array($project->id, $projectIds)) {
            return redirect()->back();
        }
        $project = Project::with('users.media')->findOrFail($project->id);
        $data = $this->projectRepository->getAssignProjectDetail($project);
        $taskRepo = app(TaskRepository::class);
        $taskData = $taskRepo->getTaskData();

        return view('my_projects.show', compact('project', 'data'))->with($taskData);
    }

    /**
     * @return JsonResponse
     */
    public function getLoginUsersProjects(): JsonResponse
    {
        $projects = getLoggedInUser()->projects()->where('status', '!=',
            Project::STATUS_FINISHED)->orderBy('name')->get()->pluck('id', 'name')->toArray();

        if (getLoggedInUser()->can('manage_projects')) {
            $projects = Project::where('status', '!=', Project::STATUS_FINISHED)->orderBy('name')->pluck('id',
                'name')->toArray();
        }

        return $this->sendResponse($projects, 'Projects Retrieved successfully.');
    }

    /**
     * @param Project $project
     * @param Request $request
     * @return JsonResponse
     */
    public function addAttachment(Project $project, Request $request)
    {
        $input = $request->all();

        if (isset($project->media) && $project->media->count() >= 25) {

            return $this->sendError('You can not upload more than 25 files', 422);
        }

        try {
            $result = $this->projectRepository->uploadFile($project, $input['file']);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }

        return $this->sendResponse($result, 'File has been uploaded successfully.');

    }

    /**
     * @param Project $project
     * @return JsonResponse
     */
    public function getAttachment(Project $project)
    {
        $result = $this->projectRepository->getAttachments($project->id);

        return $this->sendResponse($result, 'Attachment retrieved successfully.');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function downloadAttachment(Request $request, $id)
    {
        if (!empty($request->task_id) && !getLoggedInUser()->can('manage_projects')) {
//            $projects = getLoggedInUser()->projects()->get()->pluck('id')->toArray();
            $task = Project::where('id', $request->project_id, function (Builder $q) {
                $q->where('user_id', getLoggedInUserId());
            })->whereHas('media', function (Builder $q) use ($id) {
                $q->where('id', $id);
            })->first();

            if (empty($task)) {
                \Flash::error('Seems, you are not allowed to access this record.');

                return redirect()->back();
            }
        }

        $media = Media::findOrFail($id);

        return $media;
    }


    /**
     * @param Media $media
     * @return JsonResponse
     */
    public function deleteAttachment(Media $media, Request $request)
    {
        if (!empty($request->project_id) && !getLoggedInUser()->can('manage_projects')) {
            $projects = getLoggedInUser()->projects()->get()->pluck('id')->toArray();

            $task = Project::where('id', $request->project_id, function (Builder $q) {
                $q->where('user_id', getLoggedInUserId());
            })->whereHas('media', function (Builder $q) use ($media) {
                $q->where('id', $media->id);
            })->first();

            if (empty($task)) {
                return $this->sendError('Seems, you are not allowed to access this record.');
            }
        }

        $media->delete();

        return $this->sendSuccess('File has been deleted successfully.');
    }

    /**
     * Get project data for cloning.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function getCloneData($id)
    {
        $project = Project::with('client')->find($id);
        
        if (empty($project)) {
            return $this->sendError('Project not found.');
        }

        return $this->sendResponse($project, 'Project data retrieved successfully.');
    }

    /**
     * Clone a project.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function clone(Request $request)
    {
        $input = $request->all();
        
        // Validate required fields
        $validator = \Validator::make($input, [
            'name' => 'required|string|max:255',
            'prefix' => 'required|string|max:8|unique:projects,prefix',
            'client_id' => 'nullable|exists:clients,id',
            'domain_name' => 'nullable|string|max:255',
            'status' => 'required|in:0,1,2,3,4',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:1',
            'budget_type' => 'required|in:0,1',
            'currency' => 'nullable|string|max:3',
            'color' => 'nullable|string|max:7',
            'job_type' => 'nullable|exists:job_types,id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        try {
            // Get original project for reference
            $originalProject = Project::find($input['project_id']);
            if (empty($originalProject)) {
                return $this->sendError('Original project not found.');
            }

            // Generate unique prefix for cloned project
            $basePrefix = $originalProject->prefix ?? substr(strtoupper($input['name']), 0, 6);
            $uniquePrefix = $this->generateUniquePrefix($basePrefix);

            // Create new project with cloned data
            $projectData = [
                'name' => $input['name'],
                'client_id' => !empty($input['client_id']) ? $input['client_id'] : null,
                'description' => !empty($input['description']) ? $input['description'] : '', // Never null, use empty string
                'domain_name' => !empty($input['domain_name']) ? $input['domain_name'] : null,
                'status' => $input['status'], // Default to Ongoing
                'created_by' => Auth::id(),
                'prefix' => $uniquePrefix, // Use unique prefix
                'price' => !empty($input['price']) ? $input['price'] : null, // Handle budget field
                'currency' => !empty($input['currency']) ? $input['currency'] : null, // Handle currency field
                'color' => !empty($input['color']) ? $input['color'] : ($originalProject->color ?? null),
                'budget_type' => !empty($input['budget_type']) ? $input['budget_type'] : ($originalProject->budget_type ?? null),
                'job_type' => !empty($input['job_type']) ? $input['job_type'] : ($originalProject->job_type ?? null),
                'is_digital_marketing' => $originalProject->is_digital_marketing ?? false,
                'is_ecommerce_saas' => $originalProject->is_ecommerce_saas ?? false,
                'is_custom_software' => $originalProject->is_custom_software ?? false,
                'is_in_house_development' => $originalProject->is_in_house_development ?? false,
            ];

            $newProject = Project::create($projectData);

            return $this->sendSuccess('Project cloned successfully.');
            
        } catch (Exception $e) {
            return $this->sendError('Error cloning project: ' . $e->getMessage());
        }
    }

    /**
     * Generate a unique prefix for cloned projects.
     *
     * @param  string  $basePrefix
     * @return string
     */
    private function generateUniquePrefix($basePrefix)
    {
        // Ensure prefix is uppercase and max 8 characters
        $basePrefix = strtoupper(substr($basePrefix, 0, 6));
        
        // Check if base prefix is available
        if (!Project::where('prefix', $basePrefix)->exists()) {
            return $basePrefix;
        }
        
        // If not available, append a number
        $counter = 1;
        do {
            $newPrefix = substr($basePrefix, 0, 5) . $counter;
            if (!Project::where('prefix', $newPrefix)->exists()) {
                return $newPrefix;
            }
            $counter++;
        } while ($counter <= 99);
        
        // If all combinations are taken, generate random prefix
        do {
            $randomPrefix = strtoupper(substr(md5(uniqid()), 0, 6));
        } while (Project::where('prefix', $randomPrefix)->exists());
        
        return $randomPrefix;
    }
}
