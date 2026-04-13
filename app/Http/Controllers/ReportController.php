<?php

namespace App\Http\Controllers;

use Arr;
use Auth;
use Flash;
use Exception;
use Throwable;
use DataTables;
use App\Models\Task;
use App\Models\User;
use App\Models\Report;
use App\Models\Invoice;
use App\Models\Attendance;
use App\Models\BreakTime;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Queries\ReportDataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use App\Repositories\ClientRepository;
use App\Repositories\ReportRepository;
use Illuminate\Contracts\View\Factory;
use App\Repositories\ProjectRepository;
use App\Http\Requests\CreateReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Repositories\DepartmentRepository;

/**
 * Class ReportController.
 */
class ReportController extends AppBaseController
{
    /** @var ReportRepository */
    private $reportRepository;

    /** @var UserRepository */
    private $userRepo;

    /** @var TagRepository */
    private $tagRepo;

    /** @var ClientRepository */
    private $clientRepo;

    /** @var ProjectRepository */
    private $projectRepo;

    /** @var DepartmentRepository */
    private $departmentRepo;

    public function __construct(
        ReportRepository $reportRepo,
        UserRepository $userRepository,
        ProjectRepository $projectRepository,
        ClientRepository $clientRepository,
        TagRepository $tagRepository,
        DepartmentRepository $departmentRepository
    ) {
        $this->reportRepository = $reportRepo;
        $this->userRepo = $userRepository;
        $this->clientRepo = $clientRepository;
        $this->tagRepo = $tagRepository;
        $this->projectRepo = $projectRepository;
        $this->departmentRepo = $departmentRepository;
    }

    /**
     * Display a listing of the Reports.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new ReportDataTable())->get($request->only(['filter_created_by'])))->make(true);
        }

        $users = [];

        if (Auth::user()->hasPermissionTo('manage_reports')) {
            $users = User::whereOwnerId(null)->whereOwnerType(null)->whereIsActive(true)->where('email_verified_at', '!=', null)->orderBy('name')->pluck('name', 'id');
        }

        return view('reports.index', compact('users'));
    }

    /**
     * Show the form for creating a new Report.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data['tags'] = $this->tagRepo->getTagList();
        $data['users'] = $this->reportRepository->getUserList();
        $data['projects'] = $this->projectRepo->getProjectsList();
        $data['clients'] = $this->clientRepo->getClientList();
        $data['departments'] = $this->departmentRepo->getDepartmentList();

        return view('reports.create', $data);
    }

    /**
     * Store a newly created Report in storage.
     *
     * @param  CreateReportRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateReportRequest $request)
    {
        $input = $request->all();
        $input['owner_id'] = Auth::id();

        $report = $this->reportRepository->store($input);
        Flash::success('Report saved successfully.');

        return redirect(route('reports.show', $report->id));
    }

    /**
     * Display the specified Report.
     *
     * @param  Report  $report
     * @return Factory|View
     */
    public function show(Report $report)
    {
        $user = getLoggedInUser();
        if (! $user->hasPermissionTo('manage_reports') || ! $user->hasRole('Admin')) {
            if ($report->owner_id != $user->id) {
                return redirect()->back();
            }
        }

        $reports = $this->reportRepository->getReport($report);
        if ($report->report_type == Report::STATIC_REPORT) {
            if (! empty($report->report_data)) {
                $reports = json_decode($report->report_data, true);
            } else {
                $report->update([
                    'report_data' => json_encode($reports),
                ]);
            }
        }
        $invoiceId = $report->reportInvoice()->value('invoice_id');
        $invoiceStatus = Invoice::whereId($invoiceId)->value('status');
        $duration = array_sum(Arr::pluck($reports, 'duration'));
        $totalHours = $this->reportRepository->getDurationTime($duration);
        $data = [
            'report' => $report,
            'reports' => $reports,
            'totalHours' => $totalHours,
            'totalMinutes' => $duration,
        ];

        return view('reports.show', compact('invoiceId', 'invoiceStatus'))->with($data);
    }

    /**
     * Show the form for editing the specified Report.
     *
     * @param  Report  $report
     * @return RedirectResponse
     */
    public function edit(Report $report)
    {
        $user = getLoggedInUser();
        if (! $user->hasPermissionTo('manage_reports') || ! $user->hasRole('Admin')) {
            if ($report->owner_id != $user->id) {
                return redirect()->back();
            }
        }
        $id = $report->id;
        $data['report'] = $report;
        $data['projectIds'] = $this->reportRepository->getProjectIds($id);
        $data['tagIds'] = $this->reportRepository->getTagIds($id);
        $data['userIds'] = $this->reportRepository->getUserIds($id);
        $data['clientId'] = $this->reportRepository->getClientId($id);
        $data['departmentId'] = $this->reportRepository->getDepartmentId($id);
        $data['projects'] = $this->projectRepo->getProjectsByClients($data['clientId']);
        $data['users'] = $this->reportRepository->getUserList($data['projectIds']);
        $data['clients'] = $this->clientRepo->getClientsByDepartments($data['departmentId']);
        $data['tags'] = $this->tagRepo->getTagList();
        $data['departments'] = $this->departmentRepo->getDepartmentList();

        return view('reports.edit')->with($data);
    }

    /**
     * Update the specified Report in storage.
     *
     * @param  Report  $report
     * @param  UpdateReportRequest  $request
     * @return RedirectResponse|Redirector
     *
     * @throws Exception
     */
    public function update(Report $report, UpdateReportRequest $request)
    {
        $input = $request->all();

        $this->reportRepository->update($input, $report->id);
        Flash::success('Report updated successfully.');

        return redirect(route('reports.show', $report));
    }

    /**
     * Remove the specified Report from storage.
     *
     * @param  Report  $report
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse|Redirector
     *
     * @throws Exception
     */
    public function destroy(Report $report, Request $request)
    {
        $user = getLoggedInUser();
        if (! $user->hasPermissionTo('manage_reports') || ! $user->hasRole('Admin')) {
            if ($report->owner_id != $user->id) {
                return $this->sendError('Seems, you are not allowed to access this record.');
            }
        }

        $invoiceExist = $report->reportInvoice()->exists();
        if ($invoiceExist) {
            return $this->sendError('Report can\'t be deleted.');
        }

        $this->reportRepository->delete($report->id);

        if ($request->ajax()) {
            return $this->sendSuccess('Report deleted successfully.');
        }

        return redirect(route('reports.index'));
    }

    /**
     * @param  CreateReportRequest  $request
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function showPreview(CreateReportRequest $request)
    {
        $input = $request->all();
        $input['owner_id'] = Auth::id();
        $report = new Report($input);
        $reports = $this->reportRepository->getReport($report, $input);

        $duration = array_sum(Arr::pluck($reports, 'duration'));
        $totalHours = $this->reportRepository->getDurationTime($duration);
        $data = [
            'report' => $report,
            'reports' => $reports,
            'totalHours' => $totalHours,
            'totalMinutes' => $duration,
        ];

        $view = view('reports.preview', $data)->render();

        return $this->sendResponse($view, 'Preview retrieved successfully.');
    }

    public function projectUsers(Request $request)
    {
        $projectIds = $request->get('projectIds', null);

        $projectIds = (! is_null($projectIds)) ? explode(',', $projectIds) : [];
        $users = $this->reportRepository->getUserList($projectIds);

        return $this->sendResponse($users, 'Users Retrieved successfully.');
    }

    public function taskReport(Request $request)
{
  
    $users = User::pluck('name', 'id');

    if ($request->ajax()) {
        $userId = $request->get('user_id');
        $dateRange = $request->get('date_range');

        $tasksQuery = Task::with(['taskAssignee', 'project', 'tags'])->where('status', 1);

        if ($userId) {
            $tasksQuery->whereHas('taskAssignee', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });
        }

        // if ($dateRange) {
        //     [$start, $end] = explode(' - ', $dateRange);
        //     $tasksQuery->whereBetween('due_date', [$start, $end]);
        // }

        if ($dateRange) {
            [$start, $end] = explode(' - ', $dateRange);
            $tasksQuery->whereBetween('completed_on', [$start, $end]);
        }

        $tasks = $tasksQuery->get();
       

        $tasksByUser = [];
        $totalsByUser = [];
        $tagsByUser = [];

        foreach ($tasks as $task) {
            foreach ($task->taskAssignee as $assignee) {
                // Convert estimate to hours as float
                $estimateTimeStr = $task->estimate_time;
                $estimateHours = 0;
                if (strpos($estimateTimeStr, ':') !== false) {
                    [$h, $m] = explode(':', $estimateTimeStr);
                    $estimateHours = (float)$h + ((float)$m / 60);
                } else {
                    $estimateHours = (float)$estimateTimeStr;
                }
                if ($task->estimate_time_type == 1) $estimateHours *= 24; // days to hours (consistent with frontend)
                elseif ($task->estimate_time_type == 2) $estimateHours /= 60; // minutes to hours

                // Keep task list unchanged
                $tasksByUser[$assignee->id][] = [
                    'title' => $task->title,
                    'estimate_time' => $task->estimate_time,
                    'estimate_time_type' => $task->estimate_time_type,
                    'project_name' => $task->project ? $task->project->name : 'N/A',
                    'tags' => $task->tags->pluck('name')->toArray(),
                    'due_date' => $task->due_date,
                    'status' => $task->status,
                    'priority' => $task->priority,
                    'description' => $task->description,
                ];

                // Total hours per user
                $totalsByUser[$assignee->id] = ($totalsByUser[$assignee->id] ?? 0) + $estimateHours;

                 // Total hours per project per user
                 $projectsByUser[$assignee->id][$task->project->name ?? 'N/A'] =
                  ($projectsByUser[$assignee->id][$task->project->name ?? 'N/A'] ?? 0) + $estimateHours;

                // Tag totals in hours (float)
                foreach ($task->tags as $tag) {
                    $tagsByUser[$assignee->id][$tag->name] = ($tagsByUser[$assignee->id][$tag->name] ?? 0) + $estimateHours;
                }
            }
        }

               /*
        ======================
        Attendance Query
        ======================
        */

        $attendancesQuery = Attendance::query();

        if (!empty($userId)) {
            $attendancesQuery->where('user_id', $userId);
        }

        if (!empty($dateRange)) {

            [$start, $end] = explode(' - ', $dateRange);

            $start = \Carbon\Carbon::parse($start)->startOfDay();
            $end = \Carbon\Carbon::parse($end)->endOfDay();

            $attendancesQuery->whereBetween(
                'signing_in_date_time',
                [$start, $end]
            );
        }

        $attendances = $attendancesQuery->whereNull('deleted_at')->get();

        $attendanceByUser = [];
        $presentMinutesByUser = [];
        
        foreach ($attendances as $attendance) {
        
            $durationMinutes = $attendance->duration ?? 0;
        
            $attendanceByUser[$attendance->user_id][] = [
        
                'signing_in_time' => $attendance->signing_in_date_time
                    ? \Carbon\Carbon::parse($attendance->signing_in_date_time)->format('h:i A')
                    : 'N/A',
        
                'signing_out_time' => $attendance->signing_out_date_time
                    ? \Carbon\Carbon::parse($attendance->signing_out_date_time)->format('h:i A')
                    : 'N/A',
        
                'duration' => floor($durationMinutes / 60) . ' Hour ' .
                              ($durationMinutes % 60) . ' Min',
        
                'status' => $attendance->status
            ];
        
            // ✅ Just add duration (no status check)
            $presentMinutesByUser[$attendance->user_id] =
                ($presentMinutesByUser[$attendance->user_id] ?? 0) + $durationMinutes;
        }

        $presentFormatted = [];

        foreach ($presentMinutesByUser as $userId => $minutes) {
        
            $hours = floor($minutes / 60);
            $mins = $minutes % 60;
        
            $presentFormatted[$userId] =
                ($hours ? $hours . ' Hour ' : '') .
                ($mins ? $mins . ' Min' : '0 Min');
        }

        /*
        ======================
        Break Query
        ======================
        */

        $breaksQuery = BreakTime::query();

        if (!empty($userId)) {
            $breaksQuery->where('user_id', $userId);
        }

        if (!empty($dateRange)) {
            [$start, $end] = explode(' - ', $dateRange);
            $start = \Carbon\Carbon::parse($start)->startOfDay();
            $end = \Carbon\Carbon::parse($end)->endOfDay();

            $breaksQuery->whereBetween('break_start_time', [$start, $end]);
        }

        $breaks = $breaksQuery->get();

        $breakSecondsByUser = [];
        
        foreach ($breaks as $break) {
            $breakSecondsByUser[$break->user_id] = ($breakSecondsByUser[$break->user_id] ?? 0) + ($break->duration ?? 0);
        }

        $breakFormatted = [];

        foreach ($breakSecondsByUser as $userId => $seconds) {
            if ($seconds < 60) {
                $breakFormatted[$userId] = $seconds . ' Sec';
            } else {
                $minutes = floor($seconds / 60);
                $remainingSeconds = $seconds % 60;
                $result = '';
                if ($minutes) $result .= $minutes . ' Min' . ($minutes > 1 ? 's ' : ' ');
                if ($remainingSeconds) $result .= $remainingSeconds . ' Sec';
                $breakFormatted[$userId] = trim($result) ?: '0 Sec';
            }
        }

        // Format totals as Hours + Minutes
        $formatHoursMinutes = function ($hoursFloat) {
            $hours = floor($hoursFloat);
            $minutes = round(($hoursFloat - $hours) * 60);
            $result = '';
            if ($hours) $result .= $hours . ' Hour' . ($hours > 1 ? 's ' : ' ');
            if ($minutes) $result .= $minutes . ' Min';
            return trim($result) ?: '0 Min';
        };

        $totalsByUserFormatted = [];
        foreach ($totalsByUser as $userId => $totalHours) {
            $totalsByUserFormatted[$userId] = $formatHoursMinutes($totalHours);
        }

        $tagsByUserFormatted = [];
        foreach ($tagsByUser as $userId => $tags) {
            foreach ($tags as $tagName => $hours) {
                $tagsByUserFormatted[$userId][$tagName] = $formatHoursMinutes($hours);
            }
        }

        $today = now()->format('Y-m-d');
        $yesterday = now()->subDay()->format('Y-m-d');
        $showtagColumn = !in_array($dateRange, [
            "$today - $today",
            "$yesterday - $yesterday"
        ]);


        // return $tasksByUser;
        return response()->json([
            'success' => true,
            'tasksByUser' => $tasksByUser,
            'projectsByUser' => $projectsByUser, // <-- new
            'users' => $users,
            'totalsByUser' => $totalsByUserFormatted,
            'attendanceByUser' => $attendanceByUser, 
            'tagsByUser' => $tagsByUserFormatted,
            'dateRange' => $dateRange,
            'showtagColumn' => $showtagColumn,
            'presentMinutesByUser'=>$presentFormatted,
            'breakSecondsByUser'=>$breakFormatted,
        ]);
    }

     
    return view('reports.task_report', compact('users'));
}



}