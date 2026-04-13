<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SoftDeleteUser;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProjectsInvoiceController;
use App\Http\Controllers\CommissionRuleController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LeadStageController;
use App\Http\Controllers\TimeEntryController;
use App\Http\Controllers\BulkUploadController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeadSourceController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\LeadFollowUpController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FacebookWebhookController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\TimeEntryCalenderController;
use App\Http\Controllers\AbsentController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\CallRecordController;
use App\Http\Controllers\JobStatusController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SalaryAcknowledgementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PolicyController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});
  Route::delete('projects-invoices/{invoice}', [ProjectsInvoiceController::class, 'destroy'])->name('project-invoices.destroy');
  Route::get('projects-invoices/{invoice}/print-view', [ProjectsInvoiceController::class, 'printView'])
    ->name('project-invoices.print-view');
/*
|--------------------------------------------------------------------------
| Auth Login Route
|--------------------------------------------------------------------------
*/
//Auth::routes();
\Illuminate\Support\Facades\Auth::routes(['verify' => true, 'register' => false]);
Route::get('login', [Auth\LoginController::class, 'showLoginForm'])->name('login');

Route::post('login', [Auth\LoginController::class, 'login']);

Route::get('activate', [AuthController::class, 'verifyAccount']);

Route::post('set-password', [AuthController::class, 'setPassword']);

Route::get('tracker-notification', [HomeController::class, 'trackerNotification'])->name('tracker.notification.command');

Route::middleware('auth', 'validate.user', 'xss', 'user.activated','admin_delete')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard-stats', [HomeController::class, 'dashboardStats'])->name('dashboard.stats');
    Route::get('/dashboard-total-hours', [HomeController::class, 'getTotalHours'])->name('dashboard-total-hours');
    Route::get('/users-work-report', [HomeController::class, 'workReport'])->name('users-work-report');
    Route::get('/developer-work-report', [HomeController::class, 'developerWorkReport'])->name('developers-work-report');
    Route::get('/users-open-tasks', [HomeController::class, 'userOpenTasks'])->name('users-open-tasks');
    Route::get('/users-project-status', [HomeController::class, 'userProjectStatus'])->name('users-project-status');
    Route::get('/client-invoices-status', [HomeController::class, 'clientInvoiceStatus'])->name('client-invoices-status');

    Route::post('logout', [Auth\LoginController::class, 'logout']);
    Route::middleware('permission:manage_activities')->group(function () {
        Route::resource('activity-types', ActivityTypeController::class);
    });

    Route::get('user-assign-projects', [ProjectController::class, 'userAssignProjects'])->name('user.projects');
    Route::get('user-assign-projects/{project}', [ProjectController::class, 'userAssignProjectsShow'])->name('user.projects.show');

    Route::middleware('permission:manage_clients')->group(function () {
        Route::resource('clients', ClientController::class);
        Route::post('clients/{client}/update', [ClientController::class, 'update'])->name('clients-update');
        Route::post('client/store', [ClientController::class, 'storeClients'])->name('client.store');
    });

    Route::middleware('permission:manage_users')->group(function () {
        Route::post('users/{user}/active-de-active', [UserController::class, 'activeDeActiveUser'])
            ->name('active-de-active-user');
        Route::resource('users', UserController::class)->parameters(['users' => 'user']);
        Route::post('users/{id}/restore', [UserController::class, 'restoreUser'])->name('user.restore');
        Route::delete('users/{user}/delete', [UserController::class, 'UserDelete'])->name('user.force-delete');
        Route::post('users/{user}/update', [UserController::class, 'update'])->name('users-update');
        Route::get('users/{user}/send-email', [UserController::class, 'resendEmailVerification'])->name('send-email');

        // Commission Rules
        // Route::resource('commission-rules', CommissionRuleController::class);
    });
    Route::middleware('permission:manage_commissions')->group(function () {
         Route::resource('commission-rules', CommissionRuleController::class);
    });

    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('users/profile-update', [UserController::class, 'profileUpdate'])->name('user-update-profile');
    Route::post('users/change-password', [UserController::class, 'changePassword'])->name('user-change-password');
    Route::post('update-language', [UserController::class, 'updateLanguage'])->name('update-language');
    Route::resource('notifications', NotificationController::class);

    Route::middleware('permission:manage_tags')->group(function () {
        Route::resource('tags', TagController::class);
    });

//    Route::group(['middleware' => ['permission:manage_projects']], function () {
    Route::resource('projects', ProjectController::class);
    Route::post('projects/{project}/add-attachment',
        [ProjectController::class, 'addAttachment'])->name('projects.add-attachment');
    Route::post('projects/{media}/delete-attachment', [ProjectController::class, 'deleteAttachment'])
        ->name('project.delete-attachment');
    Route::get('projects/{project}/get-attachments',
        [ProjectController::class, 'getAttachment'])->name('projects.attachments');
    Route::get('projects/media/{id}', [ProjectController::class, 'downloadAttachment'])->name('download-attachment');
    Route::get('projects/{project}/clone-data', [ProjectController::class, 'getCloneData'])->name('projects.get-clone-data');
    Route::post('projects/clone', [ProjectController::class, 'clone'])->name('projects.clone');
    // project notifications
    Route::post('projects/{project}/notify', [UserNotificationController::class, 'sendProjectNotification'])->name('projects.notify');

    // project specific invoices (simple project invoice)
    Route::post('projects/{project}/invoices', [ProjectsInvoiceController::class, 'store'])->name('projects.invoices.store');
    Route::post('projects/{project}/invoices/print', [ProjectsInvoiceController::class, 'printedAll'])->name('projects.invoices.print');

    // project invoices CRUD + status
    Route::get('projects-invoices/{invoice}', [ProjectsInvoiceController::class, 'show'])->name('project-invoices.show');
    Route::put('projects-invoices/{invoice}', [ProjectsInvoiceController::class, 'update'])->name('project-invoices.update');
  
    Route::post('projects-invoices/{invoice}/status', [ProjectsInvoiceController::class, 'updateStatus'])->name('project-invoices.status');
    Route::post('projects-invoices/{invoice}/print', [ProjectsInvoiceController::class, 'printedSingle'])->name('project-invoices.print');


//    });
    // tasks routes
    Route::middleware('permission:manage_all_tasks')->group(function () {
        Route::resource('tasks', TaskController::class);
        Route::post('tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('task.update-status');
        Route::post('tasks/{task}/add-attachment',
            [TaskController::class, 'addAttachment'])->name('task.add-attachment');
        Route::post('tasks/{media}/delete-attachment', [TaskController::class, 'deleteAttachment'])
            ->name('task.delete-attachment');
        Route::get('tasks/{task}/get-attachments', [TaskController::class, 'getAttachment'])->name('task.attachments');
        Route::post('tasks/{task}/comments', [CommentController::class, 'addComment'])->name('task.comments');
        Route::post(
            'tasks/{task}/comments/{comment}/update',
            [CommentController::class, 'editComment']
        )->name('task.update-comment');
        Route::delete(
            'tasks/{task}/comments/{comment}',
            [CommentController::class, 'deleteComment']
        )->name('task.delete-comment');
        Route::get('task-details/{task}', [TaskController::class, 'getTaskDetails'])->name('task.get-details');
        Route::get('tasks/{task}/comments-count', [TaskController::class, 'getCommentsCount'])->name('task.comments-count');
        Route::get('tasks/{task}/users', [TaskController::class, 'getTaskUsers'])->name('task.users');
        Route::get('tasks/{task}/edit-assignees', [TaskController::class, 'editAssignee'])->name('task.edit-assignee');
        Route::get('tasks/{task}/kanban-edit', [TaskController::class, 'editKanbanTask'])->name('task.kanban-edit');
        Route::post('tasks/{task}/kanban-edit', [TaskController::class, 'updateKanbanTask'])->name('task.kanban-update');
        Route::get('kanban-task-details/{task}', [TaskController::class, 'getKanbanTaskDetails'])->name('kanban-task-details');
        Route::post('kanban-task-details/{task}/task-edit', [TaskController::class, 'updateKanbanTaskDetails'])->name('kanban-task-details-update');
        Route::post('kanban-task-details/{task}/add-attachment',
            [TaskController::class, 'addAttachmentTaskDetails'])->name('kanban-task.add-attachment');
        Route::get('users-by-project/{project?}', [TaskController::class, 'getUserByProject'])->name('users-by-project');
        Route::get('tasks/{user}/project-by-users', [TaskController::class, 'getProjectsByUser'])->name('project-by-users');
    });

    Route::middleware('permission:manage_status')->group(function () {
        Route::get('status', [StatusController::class, 'index'])->name('status.index');
        Route::get('order', [StatusController::class, 'orderNumber'])->name('status.orderNumber');
        Route::post('status', [StatusController::class, 'store'])->name('status.store');
        Route::get('status/{status}/edit', [StatusController::class, 'edit'])->name('status.edit');
        Route::put('status/{status}', [StatusController::class, 'update'])->name('status.update');
        Route::delete('status/{status}', [StatusController::class, 'destroy'])->name('status.destroy');
    });
    Route::middleware('permission:manage_job_status')->group(function () {
        Route::get('job-status', [JobStatusController::class, 'index'])->name('job-status.index');
        Route::post('job-status', [JobStatusController::class, 'store'])->name('job-status.store');
        Route::get('job-status/{status}/edit', [JobStatusController::class, 'edit'])->name('job-status.edit');
        Route::put('job-status/{status}', [JobStatusController::class, 'update'])->name('job-status.update');
        Route::delete('job-status/{status}', [JobStatusController::class, 'destroy'])->name('job-status.destroy');
    });
     Route::middleware('permission:manage_job_type')->group(function () {
        Route::get('job-type', [JobTypeController::class, 'index'])->name('job-type.index');
        Route::post('job-type', [JobTypeController::class, 'store'])->name('job-type.store');
        Route::get('job-type/{type}/edit', [JobTypeController::class, 'edit'])->name('job-type.edit');
        Route::put('job-type/{type}', [JobTypeController::class, 'update'])->name('job-type.update');
        Route::delete('job-type/{type}', [JobTypeController::class, 'destroy'])->name('job-type.destroy');
    });
    Route::resource('time-entries', TimeEntryController::class);
    Route::get('task-time-entry', [TimeEntryController::class, 'taskTimeEntryFilter'])->name('task-time-entry');
    Route::post('time-entries/{time_entry}/update', [TimeEntryController::class, 'update']);
    Route::get('time-entries/{time_entry}', [TimeEntryController::class, 'showTimeEntryNote']);
    Route::post('start-timer', [TimeEntryController::class, 'getStartTimer'])->name('start-timer');
    Route::get('copy-today-activity', [TimeEntryController::class, 'copyTodayActivity'])->name('copy-today-activity');

    Route::middleware('permission:manage_reports')->group(function () {
        Route::resource('reports', ReportController::class);
        Route::post('reports/preview', [ReportController::class, 'showPreview'])->name('reports.preview');
        Route::get('reports-users-of-projects', [ReportController::class, 'projectUsers'])->name('reports.users-of-projects');
        Route::get('task-reports', [ReportController::class, 'taskReport'])->name('task-report');
    });
    Route::get('users-of-projects', [ProjectController::class, 'users'])->name('users-of-projects');
    Route::get('projects-of-client', [ClientController::class, 'projects'])->name('projects-of-client');
    Route::get('clients-of-department', [DepartmentController::class, 'clients'])->name('clients-of-department');

    Route::get('my-tasks', [TaskController::class, 'myTasks'])->name('my-tasks');
  
    Route::get('user-last-task-work', [TimeEntryController::class, 'getUserLastTask'])->name('user-last-task-work');
    Route::get('projects/{project}/tasks', [TimeEntryController::class, 'getTasks'])->name('project-tasks');
    Route::put('tasks/{task}/update-task-status', [TaskController::class, 'updateTaskStatus'])->name('tasks.update-status');
    Route::put('tasks/{task}/update-task-status-2', [TaskController::class, 'updateTaskStatus2'])->name('tasks.update-status-2');
    Route::get('my-projects', [ProjectController::class, 'getMyProjects'])->name('my-projects');
    Route::get('get-user-lists', [UserController::class, 'getUserLists'])->name('get-user-lists');
    Route::get('tasks-kanban', [TaskController::class, 'getKanbanTasks'])->name('kanban.index');
    Route::get('login-user-projects', [ProjectController::class, 'getLoginUsersProjects'])->name('projects.login.user');
    Route::post('tracker/task', [TaskController::class, 'storeTrackerTask'])->name('tracker.task.store');
   
    Route::middleware('permission:archived_users')->group(function () {
         Route::get('archived-users', [SoftDeleteUser::class, 'index'])->name('archived-users');
    Route::delete('archived-users/{user}', [SoftDeleteUser::class, 'destroy'])->name('destroy-user');
    });

    Route::middleware('permission:manage_roles')->group(function () {
        Route::resource('roles', RoleController::class);
    });

    Route::middleware('permission:manage_department')->group(function () {
        Route::resource('departments', DepartmentController::class);
        Route::post('departments/{department}/update', [DepartmentController::class, 'update'])->name('departments-update');
    });

    Route::middleware('permission:manage_time_entries')->group(function () {
        Route::get('projects/{user}/users', [ProjectController::class, 'getProjectsByUser'])->name('users-project');
        Route::get('projects/{project}/project-users', [TimeEntryController::class, 'getUsers'])->name('project-users');
    });

    Route::middleware('permission:manage_calendar_view')->group(function () {
        Route::get('time-entries-calendar', [TimeEntryCalenderController::class, 'index'])->name('time-entries-calendar.index');
        Route::get('time-entries-calendar-list', [TimeEntryCalenderController::class, 'timeEntriesCalendarList'])
            ->name('time-entries-calendar-list');
    });

    Route::middleware('permission:manage_taxes')->group(function () {
        Route::get('taxes', [TaxController::class, 'index'])->name('taxes.index');
        Route::post('taxes', [TaxController::class, 'store'])->name('taxes.store');
        Route::get('taxes/{tax}/edit', [TaxController::class, 'edit'])->name('taxes.edit');
        Route::put('taxes/{tax}', [TaxController::class, 'update'])->name('taxes.update');
        Route::delete('taxes/{tax}', [TaxController::class, 'destroy'])->name('taxes.destroy');
    });

    Route::middleware('permission:manage_invoices')->group(function () {
        Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
        Route::put('invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
        Route::get('invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
        Route::delete('invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
        Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
        Route::get('invoices/{project}/tasks', [InvoiceController::class, 'getProjectTasks'])->name('get.project-tasks');
        Route::get('invoices/{id}/details', [InvoiceController::class, 'getTaskDetails'])->name('get.task-details');
        Route::get('invoices/{client}/projects', [InvoiceController::class, 'getClientProjects'])->name('get.client-projects');
        Route::get('invoice-download/{fkanban}', [InvoiceController::class, 'downloadInvoice']);
        Route::post('invoices/{invoice}/update-status', [InvoiceController::class, 'updateStatus'])->name('invoices-update-status');
        Route::get('generate-invoice/{report}', [InvoiceController::class, 'createInvoice'])->name('invoices.generate');
    });

    Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'convertToPdf'])->name('invoices.pdf');

    Route::middleware('permission:manage_expenses')->group(function () {
        Route::resource('expenses', ExpenseController::class);
        Route::get('expenses-project/{client}', [ExpenseController::class, 'getProjects'])->name('expenses.project');
        Route::post('expenses/{media}/delete-attachment',
            [ExpenseController::class, 'deleteAttachment'])->name('expense.delete-attachment');
        Route::get('expenses/{media}/download',
            [ExpenseController::class, 'downloadAttachment'])->name('expenses.download.attachment');
    });

    Route::middleware('permission:manage_settings')->group(function () {
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::post('invoice-settings', [SettingController::class, 'invoiceSettingUpdate'])->name('invoice-settings.settings');
        Route::post('google-recaptcha', [SettingController::class, 'googleRecaptchaUpdate'])->name('google-recaptcha.settings');
    });

    Route::get('tasks/media/{id}', [TaskController::class, 'downloadAttachment'])->name('download-attachment');

    Route::middleware('permission:manage_activity_log')->group(function () {
        Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs');
        Route::delete('activity-logs/{id}', [ActivityLogController::class, 'destroy'])->name('activity-delete');
    });
    Route::get('events', [EventsController::class, 'index'])->name('events.index');
    Route::post('events', [EventsController::class, 'store'])->name('events.store');
    Route::get('events/{event}/edit', [EventsController::class, 'edit'])->name('events.edit');
    Route::post('events/{event}/update', [EventsController::class, 'update'])->name('events.update');
    Route::post('events/{event}/drop-update', [EventsController::class, 'dropUpdate'])->name('events.drop.update');
    Route::get('events-data', [EventsController::class, 'getEventsData'])->name('events.data');
    Route::delete('events/{event}', [EventsController::class, 'destroy'])->name('events.delete');

    //Header Notification
    Route::get('/get-notifications', [UserNotificationController::class, 'index']);
    Route::post('/notification/{notification}/read',
        [UserNotificationController::class, 'readNotification'])->name('notifications.read');
    Route::post('/read-all-notification',
        [UserNotificationController::class, 'readAllNotification'])->name('notifications.read.all');


                // Lead Sources
    Route::middleware('permission:manage_lead_sources')->group(function () {
        Route::resource('lead-sources', LeadSourceController::class);
    });

    // Lead Stages
    Route::middleware('permission:manage_lead_stages')->group(function () {
        Route::resource('lead-stages', LeadStageController::class);
    });

   

 
    // Leave Requests
    Route::middleware('permission:manage_leave_requests')->group(function () {
        Route::resource('leave-requests', LeaveRequestController::class);
        Route::patch('leave-requests/{leaveRequest}/status', [LeaveRequestController::class, 'updateStatus'])->name('leave-requests.update-status');
        Route::delete('leave-requests/attachments/{attachment}', [LeaveRequestController::class, 'deleteAttachment'])->name('leave-requests.delete-attachment');
       
        Route::get('leave-requests/attachments/{attachment}/download', [LeaveRequestController::class, 'downloadAttachment'])->name('leave-requests.download-attachment');
      
    });

    // policy
     Route::middleware('permission:manage_policies')->group(function () {
        Route::get('policies', [PolicyController::class, 'index'])->name('policies');
    });

     // Absent
    Route::middleware('permission:manage_absents')->group(function () {
        Route::resource('absents', AbsentController::class);
         Route::patch('absents/{absent}/status', [AbsentController::class, 'updateStatus'])->name('absents.update-status');
    });

    // Sallary
     Route::middleware('permission:manage_salary')->group(function () {
        Route::get('salary/{year}/{month}', [SalaryController::class, 'show'])->name('salary.show');
        Route::get('salary/{salary}/view', [SalaryController::class, 'view'])->name('salary.view');
        Route::patch('salary/{salary}/change-status', [SalaryController::class, 'changeStatus'])->name('salary.change-status');
        Route::patch('salary/mark-all-paid/{year}/{month}', [SalaryController::class, 'markAllPaid'])->name('salary.mark-all-paid');
        Route::patch('salary/mark-all-due/{year}/{month}', [SalaryController::class, 'markAllDue'])->name('salary.mark-all-due');
        Route::delete('salary/delete-all/{year}/{month}', [SalaryController::class, 'deleteAll'])->name('salary.delete-all');
        Route::get('salary/print-native-bank/{year}/{month}', [SalaryController::class, 'printNativeBank'])->name('salary.print-native-bank');
        Route::get('salary/print-other-bank/{year}/{month}', [SalaryController::class, 'printOtherBank'])->name('salary.print-other-bank');
        Route::get('salary/print-hand-cash/{year}/{month}', [SalaryController::class, 'printHandCash'])->name('salary.print-hand-cash');
        Route::resource('salary', SalaryController::class)->except(['show']);
         Route::patch('salary/{salary}/status', [SalaryController::class, 'updateStatus'])->name('salary.update-status');
         Route::get('salary/{salary}/edit', [SalaryController::class, 'edit'])->name('salary.edit');
         Route::get('salary/{id}', [SalaryController::class, 'showDetails'])->name('salary.details');
         Route::put('salary/{id}', [SalaryController::class, 'update'])->name('salary.update');
    });

     // Sallary Acknowledgement
     Route::middleware('permission:manage_salary_acknowledgement')->group(function () {
        Route::get('salary-acknowledgement', [SalaryAcknowledgementController::class, 'index'])->name('salary-acknowledgement.index');
         Route::get('salary-acknowledgement/{id}', [SalaryAcknowledgementController::class, 'showDetails'])->name('salary-acknowledgement.details');
        Route::patch('salary-acknowledgement/{salary}/change-status', [SalaryAcknowledgementController::class, 'changeStatus'])->name('salary-acknowledgement.change-status');
    });


    // Extensions
    Route::middleware('permission:manage_extensions')->group(function () {
        Route::resource('extensions', ExtensionController::class);
    });

    // Call Records
    Route::middleware('permission:manage_call_records')->group(function () {
         Route::get('callrecords', [CallRecordController::class, 'index'])->name('callrecords.index');
         Route::get('callrecords/list', [CallRecordController::class, 'list'])->name('callrecords.list');
         Route::post('callrecords/import', [CallRecordController::class, 'import'])->name('callrecords.import');
         Route::get('callrecords/summary', [CallRecordController::class, 'summary'])->name('callrecords.summary');

    });




    // Leads
    Route::middleware('permission:manage_leads')->group(function () {
        Route::resource('leads', LeadController::class);
        Route::get('leads-kanban', [LeadController::class, 'getKanbanLeads'])->name('leads.kanban');
        // routes/web.php
        Route::put('leads/{lead}/update-stage', [LeadController::class, 'updateStage'])->name('leads.update-stage');
        Route::post('/leads/bulk-assign', [LeadController::class, 'bulkAssign'])->name('leads.bulkAssign');
        Route::post('/leads/{lead}/update-stage', [LeadController::class, 'updateStageFromListing'])
            ->name('leads.updateStage');


        // Lead Follow-Up routes
        Route::resource('lead-followups', LeadFollowUpController::class);
        // routes/web.php
        Route::get('leads/{lead}/follow-ups', [LeadController::class, 'followUps'])->name('leads.followUps');


    });

    // Attendance
    Route::middleware('permission:manage_attendence')->group(function () {
        Route::get('attendances', [AttendanceController::class, 'index'])->name('attendances.index');
      
    });

    // User Attendance (for all authenticated users)
    Route::get('my-attendance', [AttendanceController::class, 'myAttendance'])->name('attendances.my');
    Route::post('attendance/sign-in', [AttendanceController::class, 'signIn'])->name('attendance.sign-in');
    Route::post('attendance/sign-out', [AttendanceController::class, 'signOut'])->name('attendance.sign-out');
    Route::get('attendance/current-status', [AttendanceController::class, 'getCurrentStatus'])->name('attendance.current-status');
    Route::post('attendance/start-break', [AttendanceController::class, 'startBreak'])->name('attendance.start-break');
    Route::post('attendance/end-break', [AttendanceController::class, 'endBreak'])->name('attendance.end-break');

    // User Attendance Report (Admin only)
    Route::middleware('permission:manage_user_attendence')->group(function () {
        Route::get('user-attendance-report', [AttendanceController::class, 'report'])->name('attendances.user-report');
        Route::delete('attendances/{attendance}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');
        Route::put('attendances/{attendance}', [AttendanceController::class, 'update'])->name('attendances.update');
        Route::post('attendances/{attendance}/mark-excuse', [AttendanceController::class, 'markExcuse'])->name('attendances.mark-excuse');
       
    });

    // Bulk Upload
    Route::middleware('permission:manage_lead_bulk_upload')->group(function () {
        Route::get('bulk-upload', [BulkUploadController::class, 'index'])->name('bulk-upload.index');
        Route::post('bulk-upload/import', [BulkUploadController::class, 'import'])->name('bulk-upload.import');
        Route::get('bulk-upload/template', [BulkUploadController::class, 'downloadTemplate'])->name('bulk-upload.template');
    });
});

Route::middleware('auth', 'xss', 'user.activated',
    'validate.user','admin_delete')->prefix('client')->group(function () {
    //dashboard
    Route::get('dashboard', [Client\DashboardController::class, 'index'])->name('dashboard');

    Route::get('{id}/edit-profile', [Client\ClientController::class, 'edit'])->name('client-edit-profile');
    Route::post('profile-update', [Client\ClientController::class, 'profileUpdate'])->name('update-profile');
    Route::post('change-password', [Client\ClientController::class, 'changePassword'])->name('change-password');
    Route::get('project-status', [Client\DashboardController::class, 'projectStatus'])->name('project-status');
    Route::get('client-invoices', [Client\DashboardController::class, 'getClientInvoices'])->name('client-invoices');

    Route::get('invoices', [Client\InvoiceController::class, 'index'])->name('client.invoices.index');
    Route::get('invoices/{invoice}', [Client\InvoiceController::class, 'show'])->name('client.invoices.show');
    Route::post('invoices/{invoice}/change-status', [Client\InvoiceController::class, 'changeStatus'])->name('invoices.change-status');
    Route::get('invoices/{invoice}/edit', [Client\InvoiceController::class, 'edit'])->name('client.invoices.edit');

    Route::get('projects', [Client\ProjectController::class, 'index'])->name('client.projects.index');
    Route::get('projects/{project}', [Client\ProjectController::class, 'show'])->name('client.projects.show');

    Route::get('get-notifications', [Client\DashboardController::class, 'getNotifications'])->name('client.notifications.index');
    Route::post('notification/{notification}/read',
        [Client\DashboardController::class, 'readNotification'])->name('client.notifications.read');
    Route::post('read-all-notification',
        [Client\DashboardController::class, 'readAllNotification'])->name('client.notifications.read.all');

});

// Test route for attendance job (remove in production)
Route::get('/test-attendance-job', function() {
    \App\Jobs\AttendanceJob::dispatch();
    return 'Attendance job has been dispatched! Check your logs for details.';
})->name('test.attendance.job');



Route::post('/webhook/facebook', [FacebookWebhookController::class, 'handle']);
Route::get('/webhook/facebook', [FacebookWebhookController::class, 'verify']);


Route::fallback(function () {
    abort(\Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
});
