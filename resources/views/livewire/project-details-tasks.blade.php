<div class="row">
    @if($totalTasks != 0)
        <div class="col-12 d-flex justify-content-between pr-0">
            <div class="pr-0 pl-2 pt-2 pb-2 mb-3 ml-auto">
                <input wire:model.debounce.100ms="search" type="search" class="form-control"
                       placeholder="{{ __('messages.common.search') }}"
                       id="search">
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <div wire:loading id="live-wire-screen-lock">
            <div class="live-wire-infy-loader">
                @include('loader')
            </div>
        </div>
    </div>
    <div class="col-12 px-sm-0">
        <div class="accordion task-list" id="accordionExampleChildOne">
            @forelse($projectTasks as $index => $task)
                <div class="card mb-0 task-item {{ $loop->odd ? "task-index-odd-column" : "task-index-even-column"}} ">
                    <div class="card-header border-bottom justify-content-between"
                         id="heading{{ $index }}">
                        <div>
                            <label class="check">
                                @if($task->status == 1)
                                    <input type="checkbox" class="complete-task-checkbox" checked
                                           name="yes" data-check="{{ $task->id }}">
                                           
                                @else
                                    <input type="checkbox" class="complete-task-checkbox" name="no"
                                           data-check="{{ $task->id }}">

                                @endif
                                <div class="box"></div>
                            </label>
                            <input type="text" class="task-input display-none"
                                   data-id="{{ $task->id }}">
                            <p class="task-name mb-0 ml-2">{{ html_entity_decode($task->title) }} </p>
                            <div class="task-name-container mb-0 ml-4">
                               
                            </div>
                                            <span class="d-lg-inline-block d-none taskDetails    cursor-pointer"
                                                data-toggle="modal" data-target="#taskDetailsModal"
                                                data-id="{{$task->id}}">
                                                <small class="font-weight-bold">
                                                    Added:
                                                    @if(Carbon\Carbon::parse($task->created_at)->isToday())
                                                        {{ __('messages.task.today') }}

                                                    @elseif(Carbon\Carbon::parse($task->created_at)->isTomorrow())
                                                        {{ __('messages.task.tomorrow') }}

                                                    @else
                                                        @if(Carbon\Carbon::now()->year == Carbon\Carbon::parse($task->created_at)->year)
                                                            {{ Carbon\Carbon::parse($task->created_at)->translatedFormat('jS M') }}
                                                        @else
                                                            {{ Carbon\Carbon::parse($task->created_at)->translatedFormat('jS M, Y') }}
                                                        @endif
                                                    @endif
                                                </small>
                                 
                                            </span>
                                            <span class="d-lg-inline-block d-none">||
                                                <div class="d-inline-block">
                                                    @if(isset($task->status))
                                                        <a href="#" class="change-task-status" data-id="{{$task->id}}" data-status="{{ $task->status }}"
                                                            title="Change Status">
                                                                @if($task->status == 0)
                                                                    <img src="{{ asset('assets/img/pending.png') }}" alt="Pending" style="height: 22px; width: 22px;">
                                                                @else
                                                                    <img src="{{ asset('assets/img/in-progress.png') }}" alt="In Progress" style="height: 22px; width: 22px;">
                                                                @endif
                                                        </a>
                                                        <span class="badge {{\App\Models\Task::STATUS_BADGE[$task->status]}}  mr-2">
                                                            {{ $task->status == 0 ? 'Pending' : 'In Progress' }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </span>
                                            <span class="d-lg-inline-block d-none">
                                                <div class="d-inline-block">  ||
                                                     @php
                                                    // build display string in format like "6:15 H", "30 min", or "1:00 H"
                                                    $display = '';
                                                    $raw = (string) $task->estimate_time;
                                                    if (empty($raw)) {
                                                        $display = '0 min';
                                                    } else {
                                                        switch ($task->estimate_time_type) {
                                                            case 1: // days -> hours
                                                                $days = (int) preg_replace('/\D+/', '', $raw);
                                                                $hours = $days * 24;
                                                                $display = $hours . ':00 H';
                                                                break;
                                                            case 2: // minutes
                                                                $mins = (int) preg_replace('/\D+/', '', $raw);
                                                                $display = $mins . ' min';
                                                                break;
                                                            default:
                                                                if (strpos($raw, ':') !== false) {
                                                                    [$h, $m] = explode(':', $raw) + [1 => '0'];
                                                                    $display = intval($h) . ':' . str_pad(intval($m), 2, '0', STR_PAD_LEFT) . ' H';
                                                                } else {
                                                                    preg_match('/(\d+)\s*hour/', $raw, $hm);
                                                                    preg_match('/(\d+)\s*minute/', $raw, $mm);
                                                                    $h = isset($hm[1]) ? $hm[1] : 0;
                                                                    $m = isset($mm[1]) ? $mm[1] : 0;
                                                                    $display = $h . ':' . str_pad($m, 2, '0', STR_PAD_LEFT) . ' H';
                                                                }
                                                        }
                                                    }
                                                @endphp
                                                <small class="task-duration text-primary"
                                                    title="{{ ($task->taskHours != '0') ? $task->taskHours : '0 Minutes' }}">
                                                    {{ $display }}
                                                </small>
                                                </div>
                                            </span>
                                            <span class="d-lg-inline-block d-none">||
                                                <div class="d-inline-block">
                                                    @foreach($task->taskAssignee as $counter => $assignee)
                                                        @if($counter < 5)
                                                            <img class="assignee__avatar"
                                                                 src="{{ $assignee->img_avatar }}"
                                                                 title="{{ html_entity_decode($assignee->name) }}">
                                                        @elseif($counter == (count($task->taskAssignee) - 1))
                                                            <span class="task_remaining_assignee"><span
                                                                        style="font-size: 12px;">+{{ (count($task->taskAssignee) - 5) }}</span></span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </span>
                        </div>
                        <div class="right-side-content">

                            {{-- @if (in_array(Auth::id(), $task->taskAssignee->pluck('id')->toArray(), true) || Auth::user()->role_names == \App\Models\User::ADMIN || Auth::user()->role_names == \App\Models\User::DEVELOPER)
                                <span class="float-right ml-2">
                                    <a href="#" class="mx-2 edit-task-btn" data-id="{{$task->id}}"
                                       title="{{__('messages.common.edit')}}">
                                        <i class="fa fa-edit card-edit-icon"></i>
                                    </a>
                                    {{-- Delete Task start --}}
                                    {{-- <a href="#" class="mx-2 delete-task-btn" data-id="{{$task->id}}"
                                        title="{{__('messages.common.delete')}}">
                                        <i class="fa fa-trash card-edit-icon text-danger"></i>
                                    </a> --}}
                                     {{-- Delete Task End --}}
                                {{-- </span> --}}
                            {{-- @endif --}}

                                <span class="float-right ml-2">
                                     @if(!empty($task->priority))
                                      <span class="badge {{\App\Models\Task::PRIORITY_BADGE[$task->priority]}}  mr-2">{{!empty(strtoupper($task->priority)) ? html_entity_decode($task->priority) : ''}}</span>
                                     @endif
                                     <a href="#" class="mx-2 task-details" data-id="{{$task->id}}"
                                        title="{{__('messages.common.details')}}"> 
                                             <i class="fas fa-eye" style="font-size: 18px;"></i>
                                     </a>
                                      
                                    <a href="#" class="mx-2 edit-task-btn" data-id="{{$task->id}}"
                                       title="{{__('messages.common.edit')}}">
                                        <i class="fa fa-edit card-edit-icon"></i>
                                    </a>
                                    {{-- Delete Task start: visible only to Admin or task creator --}}
                                    @if(auth()->check() && (auth()->user()->role === 'Admin' || auth()->id() === $task->created_by))
                                        <a href="#" class="mx-2 delete-task-btn" data-id="{{$task->id}}"
                                           title="{{__('messages.common.delete')}}">
                                            <i class="fa fa-trash card-edit-icon text-danger"></i>
                                        </a>
                                    @endif
                                    {{-- Delete Task End --}}
                                </span>

                           
                            @if(!empty($task->due_date))
                                <span class="float-right task-date-mb due-date-wrapper {{ Carbon\Carbon::now()->startOfDay() > Carbon\Carbon::parse($task->due_date)  ? 'text-danger' : '' }}">
                                    <small class="text-muted mr-1">Due:</small>
                                             <input type="text" data-id="{{ $task->id }}"
                                                    class="form-control float-right editDueDate"
                                                    value="{{ Carbon\Carbon::parse($task->due_date)->format('jS M, Y') }}"
                                                    autocomplete="off">
                                               @if(Carbon\Carbon::parse($task->due_date) == Carbon\Carbon::now()->startOfDay())
                                        {{__('messages.task.today')}}
                                    @elseif(Carbon\Carbon::parse($task->due_date)->isTomorrow())
                                        {{__('messages.task.tomorrow')}}
                                    @else
                                        @if(Carbon\Carbon::now()->format('Y') ==  Carbon\Carbon::parse($task->due_date)->format(' Y') )
                                            {{ Carbon\Carbon::parse($task->due_date)->translatedFormat('jS M') }}
                                        @else
                                            {{ Carbon\Carbon::parse($task->due_date)->translatedFormat('jS M, Y') }}
                                        @endif
                                    @endif
                                        </span>
                            @else
                            @endif
                            <div class="d-sm-inline-block d-lg-none">
                                <a href="#" data-toggle="dropdown"
                                   class="more-info badge badge-info mr-3 p-2">
                                    {{__('messages.common.more')}}
                                </a>
                                <div class="dropdown-menu more-info-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item">
                                        <div class="d-block d-flex align-items-center w-100">
                                            @foreach($task->taskAssignee as $counter => $assignee)
                                                @if($counter < 7)
                                                    <img class="assignee__avatar"
                                                         src="{{ $assignee->img_avatar }}"
                                                         title="{{ $assignee->name }}">
                                                @elseif($counter == (count($task->taskAssignee)) - 1)
                                                    <span class="tasks_remaining_user"><small>+{{ (count($task->taskAssignee) - 7) }} </small></span>
                                                @endif
                                            @endforeach
                                            <span data-id="{{ $task->id }}"
                                                  class="edit-task-assignees">
                                                                    <img class="assignee__avatar p-1"
                                                                         src="{{ asset('assets/img/add.svg') }}"></span>
                                        </div>
                                    </a>
                                    <a href="" class="dropdown-item">
                                                        <span class="task-duration text-muted" data-toggle="tooltip"
                                                              data-placement="bottom"
                                                              title="{{ $task->taskHours }}">{{ $task->taskDuration }}</span>
                                    </a>
                                    <a href="" class="dropdown-item">
                                        <span class="task-duration text-muted">{{ __('messages.task.project_name') }} {{ !empty($task->project) ? html_entity_decode($task->project->name) : '' }}</span>
                                    </a>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    
                </div>
            @empty
                <div class="mt-0 mb-5 col-12 d-flex justify-content-center  mb-5 rounded">
                    @if(empty($search))
                        <div class="row">
                            <div class="empty-state col-sm-12" data-height="400">
                                <div class="empty-state-icon d-flex justify-content-center align-items-center">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>{{__('messages.project.no_task_found_of_project')}}</h2>
                            </div>
                        </div>
                    @else
                        <p class="text-dark">{{ __('messages.task.no_task_found') }}</p>
                    @endif
                </div>
            @endforelse
            <div class="mt-4 mb-2 col-12">
                <div class="row paginatorRow">
                    <div class="col-lg-2 col-md-6 col-sm-12 pt-2">
                        @if($totalTasks != 0)
                            <span class="d-inline-flex">
                    {{ __('messages.common.showing') }}
                            <span class="font-weight-bold ml-1 mr-1">{{ $projectTasks->firstItem() }}</span> -
                            <span class="font-weight-bold ml-1 mr-1">{{ $projectTasks->lastItem() }}</span> {{ __('messages.common.of') }}
                            <span class="font-weight-bold ml-1">{{ $projectTasks->total() }}</span>
                        </span>
                        @endif
                    </div>
                    <div class="col-lg-10 col-md-6 col-sm-12 d-flex justify-content-end">
                        {{ $projectTasks->links() }}
                    </div>
                </div>
            </div>
            @if(isset($latestCompletedTasks) && $latestCompletedTasks->count())
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="mb-3">Latest completed tasks</h5>
                        <div class="accordion task-list" id="accordionCompletedTasks">
                            @foreach($latestCompletedTasks as $index => $task)
                                <div class="card mb-0 task-item {{ $loop->odd ? 'task-index-odd-column' : 'task-index-even-column'}} ">
                                    <div class="card-header border-bottom justify-content-between" id="completed{{ $index }}">
                                        <div>
                                            <i class="fa fa-check text-success mr-2"></i>
                                            <p class="task-name mb-0 d-inline">{{ html_entity_decode($task->title) }}</p>
                                                <div class="task-name-container mb-0 ml-4">
                                
                                                </div>
                                            <span class="d-lg-inline-block d-none"> 
                                                <small class="font-weight-bold">
                                                    Added:
                                                    @if(Carbon\Carbon::parse($task->created_at)->isToday())
                                                        {{ __('messages.task.today') }}

                                                    @elseif(Carbon\Carbon::parse($task->created_at)->isTomorrow())
                                                        {{ __('messages.task.tomorrow') }}

                                                    @else
                                                        @if(Carbon\Carbon::now()->year == Carbon\Carbon::parse($task->created_at)->year)
                                                            {{ Carbon\Carbon::parse($task->created_at)->translatedFormat('jS M') }}
                                                        @else
                                                            {{ Carbon\Carbon::parse($task->created_at)->translatedFormat('jS M, Y') }}
                                                        @endif
                                                    @endif
                                                </small>
                                                ||
                                                @php
                                                    $display = '';
                                                    $raw = (string) $task->estimate_time;
                                                    if (empty($raw)) {
                                                        $display = '0 min';
                                                    } else {
                                                        switch ($task->estimate_time_type) {
                                                            case 1:
                                                                $days = (int) preg_replace('/\D+/', '', $raw);
                                                                $hours = $days * 24;
                                                                $display = $hours . ':00 H';
                                                                break;
                                                            case 2:
                                                                $mins = (int) preg_replace('/\D+/', '', $raw);
                                                                $display = $mins . ' min';
                                                                break;
                                                            default:
                                                                if (strpos($raw, ':') !== false) {
                                                                    [$h, $m] = explode(':', $raw) + [1 => '0'];
                                                                    $display = intval($h) . ':' . str_pad(intval($m), 2, '0', STR_PAD_LEFT) . ' H';
                                                                } else {
                                                                    preg_match('/(\d+)\s*hour/', $raw, $hm);
                                                                    preg_match('/(\d+)\s*minute/', $raw, $mm);
                                                                    $h = isset($hm[1]) ? $hm[1] : 0;
                                                                    $m = isset($mm[1]) ? $mm[1] : 0;
                                                                    $display = $h . ':' . str_pad($m, 2, '0', STR_PAD_LEFT) . ' H';
                                                                }
                                                        }
                                                    }
                                                @endphp
                                                <small class="task-duration text-primary">
                                                    {{ $display }}
                                                </small>
                                            </span>
                                            <span class="d-lg-inline-block d-none"> ||
                                                <div class="d-inline-block">
                                                    @foreach($task->taskAssignee as $counter => $assignee)
                                                        @if($counter < 5)
                                                            <img class="assignee__avatar" src="{{ $assignee->img_avatar }}" title="{{ html_entity_decode($assignee->name) }}">
                                                        @elseif($counter == (count($task->taskAssignee) - 1))
                                                            <span class="task_remaining_assignee"><span style="font-size: 12px;">+{{ (count($task->taskAssignee) - 5) }}</span></span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </span>
                                        </div>
                                        <div class="right-side-content">
                                            <a href="#" class="mx-2 task-details" data-id="{{$task->id}}"
                                        title="{{__('messages.common.details')}}"> 
                                            <i class="fas fa-eye" style="font-size: 18px;"></i>
                                        </a>
                                    
                                            @if(!empty($task->priority))
                                                <span class="badge {{\App\Models\Task::PRIORITY_BADGE[$task->priority]}}  mr-2">{{ !empty(strtoupper($task->priority)) ? html_entity_decode($task->priority) : '' }}</span>
                                            @endif
                                           
                                             @if(!empty($task->completed_on))
                                                <span class="float-right task-date-mb due-date-wrapper {{ Carbon\Carbon::now()->startOfDay() > Carbon\Carbon::parse($task->completed_on)  ? 'text-success' : 'text-success' }}">
                                                            <small class="text-muted mr-1">Completed:</small>
                                                            <input type="text" data-id="{{ $task->id }}"
                                                                    class="form-control float-right editDueDate"
                                                                    value="{{ Carbon\Carbon::parse($task->completed_on)->format('jS M, Y') }}"
                                                                    autocomplete="off">
                                                            @if(Carbon\Carbon::parse($task->completed_on) == Carbon\Carbon::now()->startOfDay())
                                                        {{__('messages.task.today')}}
                                                    @elseif(Carbon\Carbon::parse($task->completed_on)->isTomorrow())
                                                        {{__('messages.task.tomorrow')}}
                                                    @else
                                                        @if(Carbon\Carbon::now()->format('Y') ==  Carbon\Carbon::parse($task->completed_on)->format(' Y') )
                                                            {{ Carbon\Carbon::parse($task->completed_on)->translatedFormat('jS M') }}
                                                        @else
                                                            {{ Carbon\Carbon::parse($task->completed_on)->translatedFormat('jS M, Y') }}
                                                        @endif
                                                    @endif
                                                </span>
                                        
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


