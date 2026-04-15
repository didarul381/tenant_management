


{{--@if(! getLoggedInUser()->hasRole('Admin'))--}}
{{--    <li class="side-menus {{ Request::is('user-assign-projects*') ? 'active' : '' }}">--}}
{{--        <a class="nav-link" href="{{ route('user.projects') }}">--}}
{{--            <i class="fas fa-folder" aria-hidden="true"></i><span>{{__('messages.project.my_projects')}}</span>--}}
{{--        </a>--}}
{{--    </li>--}}
{{--@endif--}}

{{--@can('manage_projects')--}}

    

<!-- <li class="side-menus {{ Request::is('projects*') || Request::is('user-assign-projects*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('projects.index') }}">
        <i class="fas fa-folder-open" aria-hidden="true"></i><span>{{ __('messages.projects') }}</span>
    </a>
</li> -->
{{--@endcan--}}
<li class="side-menus nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-tasks"></i>
            <span>{{ __('Jobs & Tasks') }}</span></a>
        <ul class="dropdown-menu side-menus">
            <li class="side-menus {{ Request::is('projects*') || Request::is('user-assign-projects*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('projects.index') }}">
                    <i class="fas fa-folder-open" aria-hidden="true"></i><span>{{ __('messages.projects') }}</span>
                </a>
            </li>
         
            <li class="side-menus {{ Request::is('tasks*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kanban.index') }}">
                    <i class="fas fa-tasks " aria-hidden="true"></i><span>{{ __('messages.tasks') }}</span>
                </a>
            </li>
           
            @can('manage_task_reports')
                <li class="side-menus {{ Request::is('/task-reports*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('task-report') }}">
                        <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                        <span>{{ __('Task Reports') }}</span>
                    </a>
                </li>
            @endcan
            @can('manage_job_status')
                <li class="side-menus {{ Request::is('job-status*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('job-status.index') }}">
                        <i class="fas fa-circle" aria-hidden="true"></i><span>{{ __('Job Status') }}</span>
                    </a>
                </li>
            @endcan
             @can('manage_job_type')
                <li class="side-menus {{ Request::is('job-type*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('job-type.index') }}">
                        <i class="fas fa-briefcase " aria-hidden="true"></i><span>{{ __('Job Type') }}</span>
                    </a>
                </li>
            @endcan
            @can('manage_status')
                <li class="side-menus {{ Request::is('status*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('status.index') }}">
                        <i class="fas fa-columns " aria-hidden="true"></i><span>{{ __('Task Status') }}</span>
                    </a>
                </li>
            @endcan
        </ul>
</li>

{{-- @can('manage_all_tasks') --}}
<!-- @if(auth()->user()->hasRole('Admin'))
    <li class="side-menus nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-tasks"></i>
            <span>{{ __('messages.tasks') }}</span></a>
        <ul class="dropdown-menu side-menus">
            <li class="side-menus {{ Request::is('tasks*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kanban.index') }}">
                    <i class="fas fa-tasks " aria-hidden="true"></i><span>{{ __('messages.tasks') }}</span>
                </a>
            </li>
            @can('manage_status')
                <li class="side-menus {{ Request::is('status*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('status.index') }}">
                        <i class="fas fa-columns " aria-hidden="true"></i><span>{{ __('Task Status') }}</span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endif -->
{{-- @endcan --}}
@canany(['manage_leads','manage_lead_sources','manage_lead_stages','manage_lead_bulk_upload'])
    <li class="side-menus nav-item dropdown">
        <a href="#" class="nav-link has-dropdown">

            <i class="fas fa-address-card"></i>
            <span>{{ __('CRM') }}</span>
        </a>
        <ul class="dropdown-menu side-menus">

            @can('manage_leads')
                <li class="side-menus {{ Request::is('leads*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('leads.index') }}">
                        <i class="fas fa-address-book" aria-hidden="true"></i>
                        <span>{{ __('messages.lead') }}</span>
                    </a>
                </li>
            @endcan

            @can('manage_lead_sources')
                <li class="side-menus {{ Request::is('lead-sources*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('lead-sources.index') }}">
                        <i class="fas fa-database" aria-hidden="true"></i>
                        <span>{{ __('messages.lead_source') }}</span>
                    </a>
                </li>
            @endcan

            @can('manage_lead_stages')
                <li class="side-menus {{ Request::is('lead-stages*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('lead-stages.index') }}">
                        <i class="fas fa-layer-group" aria-hidden="true"></i>
                        <span>{{ __('messages.lead_stage') }}</span>
                    </a>
                </li>
            @endcan

            @can('manage_call_records')
               <li class="side-menus {{ Request::is('callrecords*') ? 'active' : '' }}">
                   <a class="nav-link" href="{{ route('callrecords.index') }}">
                       <i class="fas fa-phone" aria-hidden="true"></i><span>{{ __('Call Records') }}</span>
                   </a>
               </li>
            @endcan

            @can('manage_lead_bulk_upload')
                <li class="side-menus {{ Request::is('bulk-upload*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('bulk-upload.index') }}">
                        <i class="fas fa-upload" aria-hidden="true"></i>
                        <span>{{ __('messages.bulk_upload') }}</span>
                    </a>
                </li>
            @endcan

        </ul>
    </li>
@endcanany

<!-- @canany(['manage_leave_requests', 'manage_absents'])
    <li class="side-menus nav-item dropdown">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-file-alt"></i>
           <span>{{ __('messages.leave_management') }}</span>
        </a>
        <ul class="dropdown-menu side-menus">
            @can('manage_leave_requests')
                <li class="side-menus {{ Route::currentRouteNamed('leave-requests*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('leave-requests.index') }}">
                        <i class="fas fa-file-alt" aria-hidden="true"></i>
                        <span>{{ __('messages.leave_request.leave_requests') }}</span>
                    </a>
                </li>
            @endcan
           
            <li class="side-menus {{ Route::currentRouteNamed('policies*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('policies') }}">
                    <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                    <span>{{ __('Policy') }}</span>
                </a>
            </li>
        </ul>
    </li>
@endcanany -->

<!-- @canany(['manage_reports', 'manage_task_reports'])
    <li class="side-menus nav-item dropdown">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-file"></i>
            <span>{{ __('messages.reports') }}</span>
        </a>
        <ul class="dropdown-menu side-menus">
            @can('manage_task_reports')
                <li class="side-menus {{ Request::is('/task-reports*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('task-report') }}">
                        <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                        <span>{{ __('Task') }}</span>
                    </a>
                </li>
            @endcan
            @can('manage_reports')
                <li class="side-menus {{ Request::is('report*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('reports') }}">
                        <i class="fas fa-file" aria-hidden="true"></i>
                        <span>{{ __('messages.reports') }}</span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany -->

<!-- @can('manage_department')
    <li class="side-menus {{ Request::is('departments*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('departments.index') }}">
            <i class=" fas fa-building"></i><span>{{ __('messages.departments') }}</span>
        </a>
    </li>
@endcan

@can('manage_clients')
    <li class="side-menus {{ Request::is('clients*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('clients.index') }}">
            <i class="fas fa-user-tie" aria-hidden="true"></i><span>{{ __('messages.clients') }}</span>
        </a>
    </li>
@endcan -->

@canany(['manage_users','manage_roles','manage_leave_requests','manage_absents','archived_users','manage_policies'])
    <li class="side-menus nav-item dropdown">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-user-graduate"></i>
            <span>{{ __('HRM') }}</span>
        </a>
        <ul class="dropdown-menu side-menus">
            @php
            $isadmin = auth()->user()->hasRole('Admin');
            @endphp
           @if($isadmin)
           @can('manage_users')
                <li class="side-menus {{ Request::is('users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fas fa-users " aria-hidden="true"></i><span>{{ __('messages.users') }}</span>
                    </a>
                </li>
            @endcan
             
            
            @can('manage_roles')
                <li class="side-menus {{ Request::is('roles*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('roles') }}">
                        <i class="fas fa-user-lock" aria-hidden="true"></i><span>{{ __('Roles & Permissions') }}</span>
                    </a>
                </li>
            @endcan
           
          @endif
         
             @can('manage_leave_requests')
                <li class="side-menus {{ Route::currentRouteNamed('leave-requests*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('leave-requests.index') }}">
                        <i class="fas fa-file-alt" aria-hidden="true"></i>
                        <span>{{ __('messages.leave_request.leave_requests') }}</span>
                    </a>
                </li>
            @endcan
            
             
             
           
             @can('manage_absents')
              <li class="side-menus {{  Route::currentRouteNamed('absents*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('absents.index') }}">
                      <i class="fas fa-user-times" aria-hidden="true"></i>
                      <span>{{ __('messages.absents.absents') }}</span>
                  </a>
              </li>
             @endcan

            @can('manage_policies')
                <li class="side-menus {{ Route::currentRouteNamed('policies*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('policies') }}">
                        <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                        <span>{{ __('Policy') }}</span>
                    </a>
                </li>
             @endcan
            @can('archived_users')
            <li class="side-menus {{ Request::is('archived-users*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('archived-users') }}">
                    <i class="fas fa-users-slash" aria-hidden="true"></i><span>{{ __('messages.archived_users') }}</span>
                </a>
            </li>
            @endcan
           
        </ul>
    </li>
@endcan

@canany(['','manage_salary','manage_commissions','manage_salary_acknowledgement'])
    <li class="side-menus nav-item dropdown">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>{{ __('Payroll') }}</span>
        </a>
        <ul class="dropdown-menu side-menus">
            @php
            $isadmin = auth()->user()->hasRole('Admin');
            @endphp
           @if($isadmin)
           
             @can('manage_salary')
                <li class="side-menus {{ Request::is('salary*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('salary') }}">
                        <i class="fas fa-money-bill-wave" aria-hidden="true"></i>
                        <span>{{ __('messages.salary.salary') }}</span>
                    </a>
                </li>
            @endcan
             @endif
             @can('manage_salary_acknowledgement')
                <li class="side-menus {{ Request::is('salary-acknowledgement*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('salary-acknowledgement') }}">
                        <i class="fas fa-handshake" aria-hidden="true"></i>
                        <span>{{ __('Salary Acknowledge') }}</span>
                    </a>
                </li>
            @endcan
           
             @can('manage_commissions')
                <li class="side-menus {{ Request::is('commission-rules*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('commission-rules.index') }}">
                        <i class="fas fa-hand-holding-usd" aria-hidden="true"></i><span>Commissions Rule</span>
                    </a>
                </li>
            @endcan
        
         
        </ul>
    </li>
@endcan

@canany(['manage_attendence','manage_user_attendence'])
    <li class="side-menus nav-item dropdown">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-user-graduate"></i>
            <span>{{ __('Attendence') }}</span>
        </a>
        <ul class="dropdown-menu side-menus">
             
             @can('manage_attendence')
              <li class="side-menus {{  Route::currentRouteNamed('attendances.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('attendances.index') }}">
                      <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                      <span>{{ __('My Attendence') }}</span>
                  </a>
              </li>
             @endcan
             
              @can('manage_user_attendence')
              <li class="side-menus {{  Route::currentRouteNamed('attendances.user-report') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('attendances.user-report') }}">
                      <i class="fas fa-chart-line" aria-hidden="true"></i>
                      <span>{{ __('Staff Attendence') }}</span>
                  </a>
              </li>
             @endcan
           
        </ul>
    </li>
@endcan



<!-- @if(auth()->user()->role === 'Admin') -->
 <!-- @can('manage_commissions')
    <li class="side-menus {{ Request::is('commission-rules*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('commission-rules.index') }}">
            <i class="fas fa-hand-holding-usd" aria-hidden="true"></i><span>Commissions Rule</span>
        </a>
    </li>
@endcan -->
<!-- @endif -->

<!-- @can('manage_roles')
    <li class="side-menus {{ Request::is('roles*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('roles') }}">
            <i class="fas fa-user " aria-hidden="true"></i><span>{{ __('messages.roles') }}</span>
        </a>
    </li>
@endcan -->
@canany(['manage_invoices','manage_expenses'])
    <li class="side-menus nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-wallet"></i>
            <span>{{__('messages.common.sales')}}</span></a>
        <ul class="dropdown-menu side-menus">
            @can('manage_invoices')
                <li class="side-menus {{ Request::is('invoice*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('invoices') }}">
                        <i class="fas fa-file-invoice " aria-hidden="true"></i><span>{{ __('messages.invoices') }}</span>
                    </a>
                </li>
            @endcan
            @can('manage_expenses')
                <li class="side-menus {{ Request::is('expenses*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('expenses.index') }}">
                        <i class="fas fa-rupee-sign" aria-hidden="true"></i><span>{{__('messages.expenses')}}</span></a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
@canany(['manage_activities','manage_tags','manage_clients','manage_department','manage_taxes','manage_settings'])
    <li class="side-menus nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog " aria-hidden="true"></i>
            <span>{{ __('messages.settings') }}</span></a>
        <ul class="dropdown-menu side-menus">
           

            @can('manage_clients')
                <li class="side-menus {{ Request::is('clients*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('clients.index') }}">
                        <i class="fas fa-user-tie" aria-hidden="true"></i><span>{{ __('messages.clients') }}</span>
                    </a>
                </li>
            @endcan
             @can('manage_department')
                <li class="side-menus {{ Request::is('departments*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('departments.index') }}">
                        <i class=" fas fa-building"></i><span>{{ __('messages.departments') }}</span>
                    </a>
                </li>
            @endcan
            
            @can('manage_tags')
                <li class="side-menus {{ Request::is('tags*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('tags.index') }}">
                        <i class="fas fa-tags " aria-hidden="true"></i><span>{{ __('messages.tags') }}</span>
                    </a>
                </li>
            @endcan
             @can('manage_taxes')
                <li class="side-menus {{ Request::is('taxes*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('taxes.index') }}">
                        <i class="fas fa-percent " aria-hidden="true"></i><span>{{ __('messages.taxes') }}</span>
                    </a>
                </li>
            @endcan
            @can('manage_activities')
                <li class="side-menus {{ Request::is('activity-types*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('activity-types.index') }}">
                        <i class="fas fa-clipboard-list "
                           aria-hidden="true"></i><span>{{ __('messages.activity_types') }}</span>
                    </a>
                </li>
            @endcan
           
            @can('manage_settings')
                    <li class="side-menus {{ Request::is('settings*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('settings.edit') }}">
                            <i class="fas fa-user-cog "
                               aria-hidden="true"></i><span>{{ __('messages.settings') }}</span>
                        </a>
                    </li>
                @endcan
        </ul>
    </li>
@endcan

@can('manage_activity_log')
    <li class="side-menus {{ Request::is('activity-logs*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('activity-logs') }}">
            <i class="fas fa-clipboard-check "
               aria-hidden="true"></i><span>{{ __('messages.activity_log.activity_logs') }}</span>
        </a>
    </li>
@endcan
@can('manage_calendar_view')
    <li class="side-menus {{ Request::is('time-entries-calendar*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('time-entries-calendar') }}">
            <i class="fas fa-calendar-alt" aria-hidden="true"></i><span>{{ __('messages.calendar') }}</span>
        </a>
    </li>
@endcan
<li class="side-menus {{ Request::is('events*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('events.index') }}">
        <i class="fas fa-calendar-day"
           aria-hidden="true"></i><span>{{__('messages.events')}}</span>
    </a>
</li>
@can('manage_extensions')
    <li class="side-menus {{ Request::is('extensions*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('extensions.index') }}">
            <i class="fas fa-plug" aria-hidden="true"></i><span>{{ __('Extensions') }}</span>
        </a>
    </li>
@endcan
@can('manage_properties')
    <li class="side-menus {{ Route::currentRouteNamed('properties*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('properties.index') }}">
            <i class="fas fa-building" aria-hidden="true"></i>
            <span>{{ __('properties.properties') }}</span>
        </a>
    </li>
@endcan
<!-- @can('archived_users')
<li class="side-menus {{ Request::is('archived-users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('archived-users') }}">
        <i class="fas fa-users-slash" aria-hidden="true"></i><span>{{ __('messages.archived_users') }}</span>
    </a>
</li>
@endcan -->

