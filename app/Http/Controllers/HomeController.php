<?php

namespace App\Http\Controllers;

use App\Models\TimeEntry;
use App\Models\Project;
use App\Models\ProjectsInvoice;
use App\Models\User;
use App\Repositories\DashboardRepository;
use App\Repositories\UserRepository;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

/**
 * Class HomeController.
 */
class HomeController extends AppBaseController
{
    /** @var DashboardRepository */
    private $dashboardRepo;

    /** @var UserRepository */
    private $userRepository;

    /**
     * HomeController constructor.
     *
     * @param  DashboardRepository  $dashboardRepository
     * @param  UserRepository  $userRepository
     */
    public function __construct(DashboardRepository $dashboardRepository, UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->dashboardRepo = $dashboardRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->userRepository->getUserList();
        $earliestProjectDate = Project::query()->min('created_at');
       //  dd($earliestProjectDate);
        return view('dashboard.index', compact('users', 'earliestProjectDate'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function dashboardStats(Request $request): JsonResponse
    {
        $earliestProjectDate = Project::query()->min('created_at');
        $start = Carbon::parse($request->get('start_date', Carbon::now()->startOfMonth()))->startOfDay();
        $end = Carbon::parse($request->get('end_date', Carbon::now()->endOfMonth()))->endOfDay();

        $projectsBase = Project::query()->whereNull('deleted_at')
            ->whereBetween('created_at', [$start, $end]);


       // $totalOnboarded = (clone $projectsBase)->count();
        $totalOnboarded = Project::withTrashed()->whereBetween('created_at', [$start, $end])->count();



        $totalOngoing = (clone $projectsBase)
            ->where('status', Project::STATUS_ONGOING)
            ->count();

        $paidProjects = (clone $projectsBase)
            ->whereRaw("(SELECT COALESCE(SUM(pi.paid), 0) FROM projects_invoice pi WHERE pi.project_id = projects.id AND pi.status = 'approved') >= COALESCE(projects.price, 0)")
            ->count();

        $dueProjects = (clone $projectsBase)
            ->whereRaw('COALESCE(projects.price, 0) > 0')
            ->whereRaw("(SELECT COALESCE(SUM(pi.paid), 0) FROM projects_invoice pi WHERE pi.project_id = projects.id AND pi.status = 'approved') < COALESCE(projects.price, 0)")
            ->count();

        $paidAmount = ProjectsInvoice::query()
            ->where('status', ProjectsInvoice::STATUS_APPROVED)
            ->whereBetween('created_at', [$start, $end])
            ->sum('paid');

        $activeProjects = Project::query()->whereNull('deleted_at')
            ->whereBetween('created_at', [$start, $end]);

        $totalPriceActive = (clone $activeProjects)->sum(DB::raw('COALESCE(price,0)'));
        $totalPaidActive = ProjectsInvoice::query()
            ->where('status', ProjectsInvoice::STATUS_APPROVED)
            ->whereBetween('created_at', [$start, $end])
            ->whereIn('project_id', (clone $activeProjects)->select('id'))
            ->sum(DB::raw('COALESCE(paid,0)'));
        $dueAmount = max(0, $totalPriceActive - $totalPaidActive);

        $totalEmployees = User::query()
            ->whereBetween('created_at', [$start, $end])
            ->count();
        $totalActiveEmployees = User::query()
            ->whereNull('deleted_at')
            ->whereBetween('created_at', [$start, $end])
            ->count();
        $totalInactiveEmployees = User::query()
            ->whereNotNull('deleted_at')
            ->whereBetween('deleted_at', [$start, $end])
            ->count();

        $totalInactiveJobs = Project::onlyTrashed()
            ->whereBetween('deleted_at', [$start, $end])
            ->count();

        return $this->sendResponse([
            'total_onboarded' => $totalOnboarded,
            'total_inactive_jobs' => $totalInactiveJobs,
            'total_ongoing' => $totalOngoing,
            'total_paid_jobs' => $paidProjects,
            'total_due_jobs' => $dueProjects,
            'total_paid_amount' => (int) $paidAmount,
            'total_due_amount' => (int) $dueAmount,
            'total_employees' => $totalEmployees,
            'total_active_employees' => $totalActiveEmployees,
            'total_inactive_employees' => $totalInactiveEmployees,
            'earliestProjectDate'=> $earliestProjectDate,
        ], 'Dashboard stats retrieved successfully.');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function workReport(Request $request)
    {
        if (! authUserHasPermission('manage_users')) {
            $request->request->set('user_id', Auth::id());
        }
        $data = $this->dashboardRepo->getWorkReport($request->all());

        return $this->sendResponse($data, 'Custom Report retrieved successfully.');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function developerWorkReport(Request $request)
    {
        $data = $this->dashboardRepo->getDeveloperWorkReport($request->all());

        return $this->sendResponse($data, 'Daily Work Report retrieved successfully.');
    }

    /**
     * @return JsonResponse
     */
    public function userOpenTasks()
    {
        $data = $this->dashboardRepo->getUserOpenTasks();

        return $this->sendResponse($data, 'Open Task retrieved successfully.');
    }

    /**
     * @return JsonResponse
     */
    public function userProjectStatus()
    {
        $data = $this->dashboardRepo->getUsersProjectStatus();

        return $this->sendResponse($data, 'Project Status retrieved successfully.');
    }

    /**
     * @return JsonResponse
     */
    public function clientInvoiceStatus()
    {
        $data = $this->dashboardRepo->getClientInvoicesStatus();

        return $this->sendResponse($data, 'Invoice Status retrieved successfully.');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getTotalHours(Request $request)
    {
        $input = $request->all();
        $userId = ! empty($input['user_id']) ? $input['user_id'] : getLoggedInUserId();
        $startDate = Carbon::parse($input['start_date'])->format('Y-m-d H:i:s');
        $endDate = Carbon::parse($input['end_date'])->format('Y-m-d H:i:s');
        $timeEntry = TimeEntry::with('task.project')
            ->ofUser($userId)
            ->whereBetween('start_time', [$startDate, $endDate])
            ->get();
        $totalHrs = [];
        foreach ($timeEntry as $entry) {
            array_push($totalHrs, $entry->duration);
        }
        $minutes = array_sum($totalHrs);
        $hours = $this->getDurationTime($minutes);

        return $this->sendResponse($hours, 'success');
    }

    /**
     * @param  int  $minutes
     * @return string
     */
    public function getDurationTime($minutes)
    {
        if ($minutes == 0) {
            return '0 hr';
        }

        if ($minutes < 60) {
            return $minutes.' min';
        }

        $hour = floor($minutes / 60);
        $min = (int) ($minutes - $hour * 60);
        if ($min === 0) {
            return $hour.' hr';
        }

        return $hour.' hr '.$min.' min';
    }

    /**
     * @return JsonResponse
     */
    public function trackerNotification()
    {
        Artisan::call('infyom:tracker-notification', ['userName' => Auth::user()->name]);

        return $this->sendSuccess('Your Notification Send Successfully');
    }
}
