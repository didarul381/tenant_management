<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Queries\TaskDataTable;
use App\Repositories\ProjectRepository;
use App\Repositories\TagRepository;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class TaskController.
 */
class TaskController extends AppBaseController
{
    /** @var TaskRepository */
    private $taskRepository;

    /** @var UserRepository */
    private $userRepository;

    /** @var ProjectRepository */
    private $projectRepository;

    public $users;

    public function __construct(
        UserRepository $userRepository,
        TaskRepository $taskRepo,
        ProjectRepository $projectRepo
    ) {
        $this->taskRepository = $taskRepo;
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepo;
        $projects = Project::toBase()->select('id')->get();
        $allUser = User::toBase()->select('name', 'id', 'is_active', 'email_verified_at')->get();
        $projectUsers = \DB::table('project_user')->get()->groupBy('project_id');

        $users = [];
        $projects->map(function ($record) use (&$users, $allUser, $projectUsers) {
            $userIds = [];
            if (! empty($projectUsers->get($record->id))) {
                $userIds = $projectUsers->get($record->id)->pluck('user_id')->toArray();
            }
            $u = $allUser->whereIn('id', $userIds)->where('is_active', '=', true)->whereNotNull('email_verified_at')->pluck('name', 'id')->toArray();
            if (count($u)) {
                $users[$record->id] = $u;
            }
        });

        $this->users = $users;
    }

    /**
     * Display a listing of the Task.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new TaskDataTable())->get($request->only([
                'name',
                'filter_project',
                'filter_status',
                'filter_user',
                'due_date_filter',
            ])))->editColumn('title', function (Task $task) {
                return $task->prefix_task_number.' '.$task->title;
            })->filterColumn('title', function (Builder $query, $search) {
                $query->where(function (Builder $query) use ($search) {
                    $query->where('title', 'like', "%$search%")
                        ->orWhereRaw(
                            "concat(ifnull(p.prefix,''),'-',ifnull(tasks.task_number,'')) LIKE ?",
                            ["%$search%"]
                        );
                });
            })
                ->make(true);
        }
        $taskData = $this->taskRepository->getTaskData();
        $taskData['userId'] = getLoggedInUserId();

        return view('tasks.index')->with($taskData);
    }

    /**
     * Store a newly created Task in storage.
     *
     * @param  CreateTaskRequest  $request
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function store(CreateTaskRequest $request)
    {

        $input = $request->all();
        if (! array_key_exists('assignees', $input)) {
            $input['assignees'] = '';
        }
        $this->taskRepository->store($this->fill($input));

        return $this->sendSuccess('Task created successfully.');
    }

    private function fill($input)
    {
        $input['status'] = (isset($input['status']) && ! empty($input['status'])) ? $input['status'] : Task::$status['STATUS_ACTIVE'];
        $input['description'] = is_null($input['description']) ? '' : $input['description'];

        return $input;
    }

    /**
     * @param  string  $slug
     * @return Application|Factory|RedirectResponse|View
     */
    public function show($slug)
    {
        if (count(explode('-', $slug)) != 2) {
            return redirect()->back();
        }

        $projectPrefix = explode('-', $slug)[0];
        $taskNumber = explode('-', $slug)[1];
        $projects = getLoggedInUser()->projects()->get();
        $data = [];
        foreach ($projects as $project) {
            $tasks = Task::ofProject($project->id)->whereHas('taskAssignee', function (Builder $q) {
                $q->where('user_id', getLoggedInUserId());
            })->pluck('task_number');
            foreach ($tasks as $taskNo) {
                $data[] = $project->prefix.'-'.$taskNo;
            }
        }
        if (! getLoggedInUser()->can('manage_projects')) {
            if (! in_array($slug, $data)) {
                return redirect()->back();
            }
        }
        $task = $this->taskRepository->show($projectPrefix, $taskNumber);
        if (empty($task)) {
            return redirect()->back();
        }

        $taskData = $this->taskRepository->getTaskData();
        $attachmentUrl = url(Task::PATH);

        return view('tasks.show', compact('task', 'attachmentUrl'))->with($taskData);
    }

    /**
     * Show the form for editing the specified Task.
     *
     * @param  Task  $task
     * @return JsonResponse
     */
//     public function edit(Task $task)
//     {
      
//         $assigneeId = $task->taskAssignee->pluck('id')->toArray();
// //        if (! in_array(Auth::id(), $assigneeId, true)) {
// //            return $this->sendError('Seems, you are not allowed to access this record.');
// //        }
//         $task->tags;
//         $task->project;
//         $task->taskAssignee;
//         $task->attachments;
//         $task->createdUser;

//         // Build department-aware tag list with formatted labels used by edit modal
//         $user = Auth::user();
//         $isAdmin = $user && ($user->role === 'Admin');
//         $deptId = $user?->department_id;

//         $tagQuery = \App\Models\Tag::query()->with('departments')->orderBy('name');

//         if (!$isAdmin && !is_null($deptId)) {
//             // For non-admin with a department: include only their department tags + common tags
//             $tagQuery->where(function($q) use ($deptId) {
//                 $q->whereHas('departments', function($d) use ($deptId) {
//                     $d->where('departments.id', $deptId);
//                 })->orWhereDoesntHave('departments');
//             });
//         }

//         $tagsOptions = [];
//         foreach ($tagQuery->get() as $t) {
//             if ($t->departments && $t->departments->count() > 0) {
//                 // If tag has departments, always show "Department -> Tag" for consistency
//                 foreach ($t->departments as $dept) {
//                     $label = $dept->name . ' -> ' . $t->name;
//                     $tagsOptions[$t->id . '_' . $dept->id] = $label;
//                 }
//             } else {
//                 // Common tags (no department)
//                 $label = 'Common - ' . $t->name;
//                 $tagsOptions[$t->id . '_0'] = $label;
//             }
//         }

//         $data['tags'] = $tagsOptions;
//         $data['task'] = $task;
//         $task->description = htmlspecialchars_decode($task->description);

//         return $this->sendResponse($data, 'Task retrieved successfully.');
//     }

public function edit(Task $task)
{
    $assigneeId = $task->taskAssignee->pluck('id')->toArray();

    $task->tags;
    $task->project;
    $task->taskAssignee;
    $task->attachments;
    $task->createdUser;

    // Build department-aware tag list with formatted labels used by edit modal
    $user = Auth::user();
    $isAdmin = auth()->user()->role === 'Admin';
    $deptId = $user?->department_id;
    $userId = $user?->id;

    $tagQuery = \App\Models\Tag::query()->with('departments')->where('is_active', 1)->orderBy('name');

    // CHECK FOR SPECIAL USER ID 4 FIRST
    if ($userId == 4) {
        // SPECIAL CASE: User ID 4 can see tags from departments 4 and 5 + common tags
        $tagQuery->where(function($q) {
            $q->whereHas('departments', function($d) {
                $d->whereIn('departments.id', [4, 5]);
            })->orWhereDoesntHave('departments');
        });
        
        $tagsOptions = [];
        foreach ($tagQuery->get() as $t) {
            if ($t->departments && $t->departments->count() > 0) {
                // Only show departments 4 and 5 tags for user ID 4
                foreach ($t->departments as $dept) {
                    if (in_array($dept->id, [4, 5])) {
                        $label = $dept->name . ' -> ' . $t->name;
                        $tagsOptions[$t->id . '_' . $dept->id] = $label;
                    }
                }
            } else {
                // Common tags
                $label = 'Common - ' . $t->name;
                $tagsOptions[$t->id . '_0'] = $label;
            }
        }
    } else {
        // ORIGINAL LOGIC FOR ALL OTHER USERS
        if (!$isAdmin && !is_null($deptId)) {
            // For non-admin with a department: include only their department tags + common tags
            $tagQuery->where(function($q) use ($deptId) {
                $q->whereHas('departments', function($d) use ($deptId) {
                    $d->where('departments.id', $deptId);
                })->orWhereDoesntHave('departments');
            });
        }

        $tagsOptions = [];
        foreach ($tagQuery->get() as $t) {
            if ($t->departments && $t->departments->count() > 0) {
                // If tag has departments, always show "Department -> Tag" for consistency
                foreach ($t->departments as $dept) {
                    $label = $dept->name . ' -> ' . $t->name;
                    $tagsOptions[$t->id . '_' . $dept->id] = $label;
                }
            } else {
                // Common tags (no department)
                $label = 'Common - ' . $t->name;
                $tagsOptions[$t->id . '_0'] = $label;
            }
        }
    }

    $data['tags'] = $tagsOptions;
    $data['task'] = $task;
    $task->description = htmlspecialchars_decode($task->description);

    return $this->sendResponse($data, 'Task retrieved successfully.');
}

    /**
     * Update the specified Task in storage.
     *
     * @param  Task  $task
     * @param  Request  $request
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function update(Task $task, Request $request)
    {
        $input = $request->all();

        $task = $this->taskRepository->update($input, $task->id);

        return $this->sendResponse($task, 'Task updated successfully.');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function editKanbanTask($id)
    {
        $task = Task::toBase()->find($id);

        return $this->sendResponse($task, 'Task retrieved successfully.');
    }

    /**
     * @param  Task  $task
     * @param  Request  $request
     * @return JsonResponse
     */
    public function updateKanbanTask(Task $task, Request $request)
    {
        $input = $request->all();

        $task = $this->taskRepository->updateKanbanTask($input, $task->id);

        return $this->sendResponse($task, 'Task updated successfully.');
    }

    /**
     * Remove the specified Task from storage.
     *
     * @param  Task  $task
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Task $task)
    {
        if ($task->timeEntries()->count() > 0) {
            return $this->sendError('Task has one or more time entries.');
        }

        if (! getLoggedInUser()->can('manage_projects')) {
            $projects = getLoggedInUser()->projects()->get()->pluck('id')->toArray();
            $taskIds = Task::whereIn('project_id', $projects)->whereHas('taskAssignee', function (Builder $q) {
                $q->where('user_id', getLoggedInUserId());
            })->pluck('id')->toArray();

            if (! in_array($task->id, $taskIds)) {
                return $this->sendError('Seems, you are not allowed to access this record.');
            }
        }

        $task->update(['deleted_by' => getLoggedInUserId()]);
        $task->delete();
        $task->tags()->detach();
        $task->comments()->delete();
        $task->taskAssignee()->detach();

        return $this->sendSuccess('Task deleted successfully.');
    }

    /**
     * @param  Task  $task
     * @return JsonResponse
     */
    public function updateStatus(Task $task)
    {
      dd(1);
        $this->taskRepository->updateStatus($task->id);

        return $this->sendSuccess('Task status Update successfully.');
    }

   

    /**
     * @param  Task  $task
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getTaskDetails(Task $task, Request $request)
    {
        if (!getLoggedInUser()->can('manage_projects') && !getLoggedInUser()->hasRole('Client')) {
            $projects = getLoggedInUser()->projects()->get()->pluck('id')->toArray();
            $taskIds = Task::whereIn('project_id', $projects)->whereHas('taskAssignee', function (Builder $q) {
                $q->where('user_id', getLoggedInUserId());
            })->pluck('id')->toArray();

            if (!in_array($task->id, $taskIds)) {
                return $this->sendError('Seems, you are not allowed to access this record.');
            }
        }
        $taskDetails = $this->taskRepository->getTaskDetails($task->id, $request->all());

        return $this->sendResponse($taskDetails, 'Task retrieved successfully.');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function myTasks(Request $request)
    {
        $input = $request->only('project_id');

        $timerDetails = $this->taskRepository->myTasks($input);

        return $this->sendResponse($timerDetails, 'My tasks retrieved successfully.');
    }

    /**
     * @param  Media  $media
     * @return JsonResponse
     */
    public function deleteAttachment(Media $media, Request $request)
    {
        if (! empty($request->task_id) && ! getLoggedInUser()->can('manage_projects')) {
            $projects = getLoggedInUser()->projects()->get()->pluck('id')->toArray();

            $task = Task::where('id', $request->task_id)->whereIn('project_id', $projects)->whereHas('taskAssignee', function (Builder $q) {
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
     * @param  Task  $task
     * @param  Request  $request
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function addAttachment(Task $task, Request $request)
    {
        $input = $request->all();

        try {
            $result = $this->taskRepository->uploadFile($task, $input['file']);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }

        return $this->sendResponse($result, 'File has been uploaded successfully.');
    }

    /**
     * @param  Task  $task
     * @return JsonResponse
     */
    public function getAttachment(Task $task)
    {
        $result = $this->taskRepository->getAttachments($task->id);

        return $this->sendResponse($result, 'Task retrieved successfully.');
    }

    /**
     * @param  Task  $task
     * @return JsonResponse
     */
    public function getCommentsCount(Task $task)
    {
        return $this->sendResponse($task->comments()->count(), 'Comments count retrieved successfully.');
    }

    /**
     * @param  Task  $task
     * @return array
     */
    public function getTaskUsers(Task $task)
    {
        return $task->taskAssignee->pluck('name', 'id')->toArray();
    }

    /**
     * @param  Task  $task
     * @return JsonResponse
     */
    public function editAssignee(Task $task)
    {
        $projectId = $task->project->id;

        $data['task_assignee'] = $task->taskAssignee->pluck('id')->toArray();

        $data['task'] = $task;
        $data['users'] = isset($this->users[$projectId]) ? $this->users[$projectId] : [];

        return $this->sendResponse($data, 'Task retrieved successfully.');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function downloadAttachment(Request $request, $id)
    {
        if (! empty($request->task_id) && ! getLoggedInUser()->can('manage_projects')) {
            $projects = getLoggedInUser()->projects()->get()->pluck('id')->toArray();
            $task = Task::where('id', $request->task_id)->whereIn('project_id', $projects)->whereHas('taskAssignee', function (Builder $q) {
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
     * @param  Task  $task
     * @param  Request  $request
     */
    public function updateTaskStatus(Task $task, Request $request)
    {
        
        $input = $request->all();
        $newStatus = $input['status'] ?? null;
        
        // Get the status record to determine the status type
        $statusRecord = \App\Models\Status::where('status', $newStatus)->first();
        $isCompletedStatus = $statusRecord && strcasecmp($statusRecord->name, 'completed') == 0;
        $isInProgressStatus = $statusRecord && strcasecmp($statusRecord->name, 'in-progress') == 0;
        
        // If moving to completed status, validate required fields
        if ($isCompletedStatus) {
            // Check if task has due_date
            if (!$task->due_date) {
                return $this->sendError('Task must have a due date to be marked as completed.');
            }
            
            // Check if task has estimate_time
            if (!$task->estimate_time) {
                return $this->sendError('Task must have an estimated time to be marked as completed.');
            }
            
            // Check if task has any assignees
            if ($task->taskAssignee->isEmpty()) {
                return $this->sendError('Task must be assigned to at least one employee to be marked as completed.');
            }
        }
        
        // If moving to in-progress status, validate due_date and estimate_time
        if ($isInProgressStatus) {
            // Check if task has due_date
            if (!$task->due_date) {
                return $this->sendError('Task must have a due date to be marked as in-progress.');
            }
            
            // Check if task has estimate_time
            if (!$task->estimate_time) {
                return $this->sendError('Task must have an estimated time to be marked as in-progress.');
            }
        }
        
        // Update the task status
        $taskDetails = $this->taskRepository->updateTaskStatus($task->id, $input);
        
        return $this->sendResponse($taskDetails, 'Task status updated successfully.');
    }

    public function updateTaskStatus2(Task $task, Request $request)
    {
     
      if ($task->due_date == null){
         return $this->sendError('Task Due Date Required To Update Task Status.');
      }else if(!$task->estimate_time){
          return $this->sendError('Task must have an estimated time To Update Status');
      }else{
         $input = $request->all();
        
        // Update task status
        $task->update(['status' => $input['status']]);
        
        return $this->sendSuccess('Task status updated successfully.');

      }
      
    }
        
    public function updateTaskStatus3(Task $task, Request $request)
    {
   
     if ($task->due_date == null){
         return $this->sendError('Task Due Date Required To Update Task Status.');
      }elseif ($task->estimate_time == null) {
            
             return $this->sendError('Need to Assaign Time To Complete Tasks');
             
         }
         elseif ($task->created_by == null) {
            
             return $this->sendError('Need to Assaign User To Complete Task');
             
         }
         else{
              $taskDetails = $this->taskRepository->updateTaskStatus($task->id, $request->all());
         }

      
    }

    /**
     * @return Application|Factory|View
     */
    public function getKanbanTasks()
    {
        $data = $this->taskRepository->getTaskData();

        return view('kanban.index', $data);
    }

    /**
     * @param  Task  $task
     * @return JsonResponse
     */
    public function getKanbanTaskDetails(Task $task)
    {
        $data['taskDetails'] = $this->taskRepository->getKanbanTaskDetails($task->id);
        $data['attachments'] = $this->taskRepository->getAttachments($task->id);

        $projectId = $task->project->id;

        $data['task_assignee'] = $task->taskAssignee->pluck('id')->toArray();
        $data['user'] = isset($this->users[$projectId]) ? $this->users[$projectId] : [];
        $user_Ids = array_diff(array_keys($data['user']), $data['task_assignee']);
        $data['users'] = User::whereIn('id', $user_Ids)->where('is_active', '=', true)->pluck('name', 'id');
        $statusArr = Task::$statusArr;
        asort($statusArr);
        unset($statusArr[Task::$status['STATUS_ALL']]);
        $data['taskStatus'] = $statusArr;
        $data['priority'] = Task::PRIORITY;

        return $this->sendResponse($data, 'Task retrieved successfully.');
    }

    /**
     * @param  Task  $task
     * @param  Request  $request
     * @return JsonResponse
     */
    public function updateKanbanTaskDetails(Task $task, Request $request)
    {
        $input = $request->all();
        $data['task'] = $this->taskRepository->updateKanbanTaskDetails($input, $task->id);

        $projectId = $task->project->id;
        $task_assignee = $task->taskAssignee->pluck('id')->toArray();
        $user = isset($this->users[$projectId]) ? $this->users[$projectId] : [];
        $user_Ids = array_diff(array_keys($user), $task_assignee);
        $data['users'] = User::toBase()->whereIn('id', $user_Ids)->where('is_active', '=', true)->pluck('name', 'id');

        return $this->sendResponse($data, 'successfully updated');
    }

    /**
     * @param  Task  $task
     * @param  Request  $request
     * @return JsonResponse
     */
    public function addAttachmentTaskDetails(Task $task, Request $request)
    {
        $input = $request->all();
        try {
            $result = $this->taskRepository->uploadAttachments($task, $input);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }

        return $this->sendResponse($result, 'File has been uploaded successfully.');
    }

    /**
     * @param  Project  $project
     * @return JsonResponse
     */
    public function getUserByProject(Project $project = null)
    {
        if ($project) {
        $users = $project->users->where('is_active', true)->sortBy('name', SORT_STRING | SORT_FLAG_CASE)->pluck('id',
            'name')->toArray();
        } else {
            $users = User::where('is_active', true)
            ->whereHas('projects') // only users assigned to projects
            ->get()
            ->sortBy('name', SORT_STRING | SORT_FLAG_CASE)
            ->pluck('id', 'name')
            ->toArray();
        }

        return $this->sendResponse($users, 'Users retrieved successfully');
    }

    /**
     * @param  User  $user
     * @return JsonResponse
     */
    public function getProjectsByUser(User $user)
    {
        if ($user->can('manage_projects')) {
            $projectList = $this->projectRepository->getLoginUserAssignProjectsArr();
        } else {
            $projectList = $user->projects()->where('status', '!=',
                Project::STATUS_FINISHED)->orderBy('name')->get()->pluck('name', 'id')->toArray();
        }

        return $this->sendResponse($projectList, 'Projects Retrieved successfully.');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function storeTrackerTask(CreateTaskRequest $request): JsonResponse
    {
        $input = $request->all();

        $input['assignees'] = '';
        $input['description'] = null;
        $input['estimate_time_hours'] = null;
        $input['estimate_time_days'] = null;
        $input['estimate_time_minutes'] = null;
        $input['due_date'] = null;

        $this->taskRepository->store($input);

        return $this->sendSuccess('Task created successfully.');
    }
}
