<div class="row">
    <div class="col-12">
        <div class="row">
            @if($totalProjects != 0)
                <div class="col-sm-2">
                    <div class="custom-control custom-checkbox mb-2" id="client_checkbox">
                        <input type="checkbox" class="custom-control-input" id="myProjects"
                               data-id="{{getLoggedInUserId()}}">
                        <label class="custom-control-label"
                               for="myProjects">{{__('messages.project.my_projects')}}</label>
                    </div>
                </div>
                <div class="col-sm-10 d-flex justify-content-end flex-wrap">
                    <!-- <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12 mb-3">
                        {{ Form::select('drp_status', array_replace(\App\Models\Project::STATUS, ['paid' => 'Paid', 'due' => 'Due']), $projectStatus, ['id'=>'projectStatus', 'class'=>'form-control']) }}
                    </div> -->
                    <!-- <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12 mb-3">
                        {{
                            Form::select(
                                'drp_status',
                                array_replace(
                                    array_diff_key(
                                        \App\Models\Project::STATUS,
                                        [\App\Models\Project::STATUS_PAID => true]
                                    ),
                                    ['paid' => 'Paid', 'due' => 'Due']
                                ),
                                $projectStatus,
                                ['id'=>'projectStatus', 'class'=>'form-control']
                            )
                        }}
                    </div> -->
                     <!-- <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12 mb-3">
                        {{
                            Form::select(
                                'drp_status',
                                [
                                    0 => 'All',
                                    1 => 'Ongoing',
                                    'due' => 'Due',
                                    'paid' => 'Paid',
                                    3 => 'OnHold',
                                    2 => 'Finished',
                                    4 => 'Archived'
                                ],
                                $projectStatus,
                                ['id'=>'projectStatus', 'class'=>'form-control']
                            )
                        }}
                    </div> -->
                    <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12 mb-3">
                        {{
                            Form::select(
                                'drp_status',
                                $statusOptions,
                                $projectStatus,
                                ['id'=>'projectStatus', 'class'=>'form-control']
                            )
                        }}
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
                        <select wire:model="jobType" id="jobType" class="form-control">
                            <option value="all">All</option>
                             <!-- @foreach(App\Models\JobType::orderBy('name', 'asc')->get() as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach -->
                            @foreach(App\Models\JobType::orderByRaw('`order` = 0, `order` ASC')->orderBy('name', 'asc')->get() as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                             <option value="non">Others</option>
                        </select>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-md-2 col-sm-12 mb-3 pr-0">
                        <input wire:model.debounce.100ms="search" type="search" class="form-control"
                               placeholder="{{ __('messages.common.search') }}"
                               id="search">
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div wire:loading id="live-wire-screen-lock">
            <div class="live-wire-infy-loader">
                @include('loader')
            </div>
        </div>
    </div>
    @php
        $inStyle = 'style';
        $style = 'border-top: 3px solid';
        $bgColor = 'background-color';
    @endphp
    @forelse($projects as $project)
    @php
        $dueDateStatus = '';
        // find earliest due date among *incomplete* tasks only
        $incompleteMin = $project->tasks()->where('status', '!=', \App\Models\Task::STATUS_COMPLETED)->whereNull('deleted_at')->min('due_date');
        $dueDate = $incompleteMin ? \Carbon\Carbon::parse($incompleteMin) : null;
        if ($incompleteMin) {
            $dueDate = \Carbon\Carbon::parse($incompleteMin);
            $today = \Carbon\Carbon::today();
            if ($dueDate->isPast() && !$dueDate->isToday()) {
                $dueDateStatus = 'overdue';
            } elseif ($dueDate->isToday()) {
                $dueDateStatus = 'due-today';
            } elseif ($dueDate->greaterThan($today) && $dueDate->lte($today->copy()->addDays(2))) {
                $dueDateStatus = 'due-soon';
            }
        }
    @endphp
        <div class="col-12 col-md-6 col-lg-6 col-xl-4 extra-large">
            <div class="livewire-card card project-card shadow mb-5 rounded removeMarginX hover-card" style="{{ $dueDateStatus == 'overdue' ? 'background-color: #FFEBEE;' : ($dueDateStatus == 'due-today' ? 'background-color: #FFF59D;' : ($dueDateStatus == 'due-soon' ? 'background-color: #F3E5F5;' : '')) }}">
                <div class="col-md-12">
                     <div class="pt-3">
                        <a href="{{route('projects.show',$project->id)}}"><h5
                            class="{{ $loop->odd ? 'text-primary' : 'text-dark'}} card-report-name " style="font-size:18px">{{ html_entity_decode($project->name) }}</h5>
                     </a>
                     </div>
                    <div class="progress progress-bar-mini height-25 mt-2 project-progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0"
                             aria-valuemax="100" {{$inStyle}}="width:{{$project->projectProgress()}}% ; {{$bgColor}}
                    : {{ $project->color }}">
                </div>
                <p class="project-progress-width-text {{ ($project->projectProgress() > 55) ? 'text-white' : 'text-dark' }} {{ RGBToHSL(HTMLToRGB($project->color))->lightness > 125 ? 'text-dark' : 'text-white'}}">{{number_format($project->projectProgress(),2)}}
                    %</p>
            </div>
        </div>
        <div class="card-header d-flex justify-content-between align-items-center pt-0 pr-3 pb-0 pl-3">
            <!-- <div class="d-flex">
                (<small class="{{ $loop->odd ? 'text-primary' : 'text-dark'}}">{{ $project->prefix }}</small>)-
            </div> -->
             <div class="pt-2">
                <div>
                   <span class="badge {{\App\Models\Project::STATUS_BADGE[$project->status]}} text-uppercase projectStatus">{{ \App\Models\Project::STATUS[$project->status] }}</span>
                   @if(isset($dueDate))
                       <span class="badge text-uppercase" style="background-color: {{ $dueDateStatus == 'overdue' ? 'red' : ($dueDateStatus == 'due-today' ? '#F57F17' : ($dueDateStatus == 'due-soon' ? '#D500F9' : 'blue')) }}; color: white;">
                           Due: {{ $dueDate->format('M j, Y') }}
                       </span>
                   @endif
                   <span class="projectStatistics badge badge-warning" style="background-color: #00C853; color: white;">
                      @if(!empty($project->tasks))
                          <b>{{ $project->openTasks->count() }} </b>
                          <span> {{__('messages.task.pending')}} {{ __('messages.time_entry.task') }} </span>
                      @endif
                   </span>
                </div>
                <div class="">
                    @if(!empty($project->client->name))
                        <span class="mr-1">{{__('messages.report.client')}}:</span>
                        <span>{{ html_entity_decode($project->client->name)}}</span>
                    @endif
                </div>
            </div>
            <!-- <a class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                                                        class="notification-toggle action-dropdown d-none mr-1"><i
                            class="fas fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-list-content dropdown-list-icons">
                        <a href="#" class="dropdown-item dropdown-item-desc edit-btn"
                           data-id="{{ $project->id }}"><i
                                    class="fas fa-edit mr-2 card-edit-icon"></i> {{ __('messages.common.edit') }}
                        </a>
                        <a href="#" class="dropdown-item dropdown-item-desc delete-btn"
                           data-id="{{ $project->id }}"><i
                                    class="fas fa-trash mr-2 card-delete-icon"></i>{{ __('messages.common.delete') }}
                        </a>
                    </div>
                </div>
            </a> -->



        </div>
        <!-- <div class="card-body pt-0 pl-3 pb-1">
            <div>
                <span class="badge {{\App\Models\Project::STATUS_BADGE[$project->status]}} text-uppercase projectStatus">{{ \App\Models\Project::STATUS[$project->status] }}</span>
                <span class="projectStatistics badge badge-warning">
                    @if(!empty($project->tasks))
                        <b>{{ $project->openTasks->count() }} </b>
                        <span> {{__('messages.task.pending')}} {{ __('messages.time_entry.task').'(s)' }} </span>
                    @endif
                </span>
            </div>
            <div class="">
                @if(!empty($project->client->name))
                    <span class="mr-1">{{__('messages.report.client')}}:</span>
                    <span>{{ html_entity_decode($project->client->name)}}</span>
                @endif
            </div>
        </div> -->
        <div class="card-body d-flex justify-content-between align-items-center pt-0 pl-3 pb-0 pr-0">
            <div class="d-inline-block">
                @foreach($project->users->where('is_active','=',true) as $counter => $user)
                    @if($counter < 2)
                        <img class="projectUserAvatar p-0"
                             src="{{ $user->img_avatar }}"
                             title="{{ html_entity_decode($user->name) }}">
                    @elseif($counter == (count($project->users) - 1))
                        <span class="project_remaining_user mt-1"><b> + {{ (count($project->users) - 2) }}</b></span>
                    @endif
                @endforeach
                    <a href="javascript:void(0)" data-id="{{ $project->id }}" data-toggle="modal" data-target="#assignProjectUserModal" class="edit-project-assignees" title="{{ __('messages.common.edit').' '.__('messages.task.assignee') }}"><img class="assignee__avatar p-1" src="{{ asset('assets/img/add.svg') }}"></a>
                    <!-- Link Icon - Show only if domain_name is not empty -->
                    @if(!empty($project->domain_name))
                        <a href="{{ $project->domain_name }}" 
                        target="_blank" 
                        class="edit-project-assignees" 
                        title="Open Project: {{ $project->domain_name }}">
                      
                           <img class="assignee__avatar p-1" src="{{ asset('assets/img/link.png') }}">
                        </a>
                    @endif
                    <!-- Red Notification Icon - Show based on payment condition -->
                    @php
                        $showNotification = false;
                        
                        if ($project->price > 0) {
                            // Get total paid amount from approved invoices
                            $totalPaid = \App\Models\ProjectsInvoice::where('project_id', $project->id)
                                ->where('status', 'approved')
                                ->sum('paid');
                                
                            // Check if total paid is less than project price
                            if ($totalPaid < $project->price) {
                                $showNotification = true;
                            }
                        }
                    @endphp

                    @if($showNotification)
                        <a href="javascript:void(0)" 
                        class="edit-project-assignees payment-alert-icon" 
                        title="Payment Alert: Incomplete payment for this project">
                           <img class="assignee__avatar p-1" src="{{ asset('assets/img/exclamation.png') }}">
                        </a>
                    @endif


            </div>
            <a href="#" class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                                                        class="notification-toggle action-dropdown d-none mr-3"><i
                            class="fas fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-list-content dropdown-list-icons">
                        <a href="#" class="dropdown-item dropdown-item-desc edit-btn"
                           data-id="{{ $project->id }}"><i
                                    class="fas fa-edit mr-2 card-edit-icon"></i> {{ __('messages.common.edit') }}
                        </a>
                        <a href="#" class="dropdown-item dropdown-item-desc clone-btn"
                           data-id="{{ $project->id }}"><i style="color: orange;"
                                    class="fas fa-copy mr-2 card-clone-icon"></i> <span style=""> {{ __('Clone') }}</span>
                        </a>
                        <a href="#" class="dropdown-item dropdown-item-desc delete-btn"
                           data-id="{{ $project->id }}"><i
                                    class="fas fa-trash mr-2 card-delete-icon"></i>{{ __('messages.common.delete') }}
                        </a>
                    </div>
                </div>
            </a>
        </div>
</div>
</div>
@empty
    <div class="mt-0 mb-5 col-12 d-flex justify-content-center mb-5 rounded">
        <div class="p-2">
            @if(empty($search))
                <p class="text-dark">{{ __('messages.project.no_project_available') }}</p>
            @else
                <p class="text-dark">{{ __('messages.project.no_project_found') }}</p>
            @endif
        </div>
    </div>
@endforelse

<div class="mt-0 mb-5 col-12">
    <div class="row paginatorRow">
        <div class="col-lg-2 col-md-6 col-sm-12 pt-2">
            @if($totalProjects != 0)
                <span class="d-inline-flex">
                    {{ __('messages.common.showing') }}
                    <span class="font-weight-bold ml-1 mr-1">{{ $projects->firstItem() }}</span> -
                    <span class="font-weight-bold ml-1 mr-1">{{ $projects->lastItem() }}</span> {{ __('messages.common.of') }}
                    <span class="font-weight-bold ml-1">{{ $projects->total() }}</span>
                </span>
            @endif
        </div>
        <div class="col-lg-10 col-md-6 col-sm-12 d-flex justify-content-end">
            {{ $projects->links() }}
        </div>
    </div>
</div>
</div>

<!-- Clone Project Modal -->
<div class="modal fade" id="cloneProjectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Clone Project') }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="cloneForm">
                <div class="modal-body">
                    <input type="hidden" id="cloneProjectId" name="project_id">
                     <div class="row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="cloneProjectName">{{ __('Name') }} <span class="text-danger required">*</span></label>
                                <input type="text" class="form-control" id="cloneProjectName" name="name" required>
                            </div>

                            <div class="form-group col-sm-12 col-md-6">
                                <label for="cloneDomainName">{{ __('Domain Name') }}</label>
                                <input type="text" class="form-control" id="cloneDomainName" name="domain_name">
                            </div>
                            
                            <div class="form-group col-sm-12 col-md-12">
                                <label for="clonePrefix">{{ __('Project Prefix') }} <span class="text-danger required">*</span></label>
                                <input type="text" class="form-control" id="clonePrefix" name="prefix" required>
                                <small class="form-text text-muted">{{ __('Unique project identifier (auto-generated)') }}</small>
                            </div>
                     </div>
                      <div class="row">
                            <div class="form-group col-sm-6 project-users">
                                {{ Form::label('user_id', __('messages.project.users').':') }}<span class="required">*</span>
                                {{ Form::select('user_ids[]', $users, null, ['id' => 'CloneUserIds','class' => 'form-control', 'required', 'multiple']) }}
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="cloneClientId">{{ __('Client') }} <span class="text-danger required">*</span></label>
                                    @if(auth()->user()->can('manage_clients'))
                                        <div class="input-group flex-nowrap">
                                            <select class="form-control" id="cloneClientId" name="client_id" required>
                                                <option value="">{{ __('Select Client') }}</option>
                                                @foreach($clients ?? [] as $client)
                                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <a href='#' data-toggle='modal' data-target='#addClientModal' title='{{ __("messages.client.new_client") }}' ><i class='fa fa-plus'></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    <select class="form-control" id="cloneClientId" name="client_id" required>
                                        <option value="">{{ __('Select Client') }}</option>
                                        @foreach($clients ?? [] as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                            </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-sm-2 col-md-6">
                            {{ Form::label('price', __('messages.project.budget').':') }}<span class="required">*</span>
                            {{ Form::text('price', null, ['id'=>'clonePrice','class' => 'form-control price-input mobile-project-budget','required','maxlength' => '15','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                        </div>
                        <div class="form-group col-sm-4 col-md-6">
                                {{ Form::label('price', __('messages.project.budget_type').':') }}<span
                                        class="required">*</span>
                                <span class="project-tooltip-hover">
                                        <sup><i class="fas fa-question-circle"></i></sup>
                                        <div class="project-tooltip-popup">
                                        Hourly: Amount for task in the invoice will be counted as per hourly rate. eg.02:00 H * 20 rate/Hr<br> 
                                        Fix Rate: Invoice total amount will be taken as per fixed rate. no hourly calculation of tasks.
                                        </div>
                                </span>
                                {{ Form::select('budget_type', $budgetTypes, null, ['id'=>'cloneBudgetType','class' => 'form-control', 'placeholder' => 'Select Budget Type', 'required']) }}
                        </div>
                        <div class="form-group col-sm-4 col-md-6">
                            {{ Form::label('currency', __('messages.setting_menu.currency').':') }}<span
                                    class="required">*</span>
                            <select id="cloneCurrency" data-show-content="true" class="form-control" name="currency"
                                    required>
                                <option value="">Select Currency</option>
                                <option value="3">$ USD</option>
                                <option value="7" selected>৳ BDT</option>
                              
                            </select>
                        </div>
                        <div class="form-group col-sm-2 col-md-4">
                            {{ Form::label('status', __('messages.invoice.status').':') }}<span class="required">*</span>
                            <select id="cloneStatus" name="status" class="form-control" required>
                                <option value="">{{ __('Select Status') }}</option>
                                <option value="1">{{ __('Ongoing') }}</option>
                                <option value="2">{{ __('Finished') }}</option>
                                <option value="3">{{ __('OnHold') }}</option>
                                <option value="4">{{ __('Archived') }}</option>
                                <option value="5">{{ __('Paid') }}</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-2 col-md-2">
                            {{ Form::label('color', __('messages.common.color').':') }}
                            <div class="color-wrapper"></div>
                            {{ Form::text('color', '', ['id' => 'cloneColor', 'hidden', 'class' => 'form-control color']) }}
                        </div>
                    </div>
                     <div class="row">
                        <div class="form-group d-flex flex-column col-sm-12">
                            {{ Form::label('description', __('messages.common.description').':') }}
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'cloneDescription']) }}
                        </div>
                    </div>
                    <div class="row">
                   
                        <div class="form-group col-6">
                            {{ Form::label('job_type', 'Job Type:') }}
                            {{ Form::select('job_type', ['' => 'Select Job Type'] + ($jobTypes ?? []), null, ['id' => 'cloneJobType', 'class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary" id="saveClone">{{ __('Clone Project') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
