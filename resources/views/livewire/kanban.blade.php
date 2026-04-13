<div class="row col-12 d-flex flex-nowrap pb-3 tasks-kanban-wrp">
    @foreach($taskStatus as $index => $status)
        @php
            // Ensure status is always an object
            $status = is_array($status) ? (object) $status : $status;
        @endphp
        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
            <div class="card board pb-4">
                <div class="card-header bg-light border-0">
                    <h4 class="text-primary">{{ html_entity_decode($status->name) }}</h4>
                </div>
                <div class="card-body p-2 bg-light">
                    <div class="infy-loader overlay-screen-lock" style="display: none">
                        @include('loader')
                    </div>
                    <div class="board-{{ $index }}" data-board-status="{{ $status->status }}">
                        @foreach($allTasks[$status->status] ?? [] as $task)
                            @php
                                // Convert task to object if array
                                $task = is_array($task) ? (object) $task : $task;
                                // Relations as collections
                                $task->taskAssignee = collect($task->taskAssignee ?? []);
                                $task->comments     = collect($task->comments ?? []);
                                $task->media        = collect($task->media ?? []);
                            @endphp
                            <div class="card mb-3 task-card" data-id="{{ $task->id }}" data-status="{{ $task->status }}">
                                <div class="card-body p-3 no-touch">
                                    <a href="#" class="mb-0 task-details text-primary" data-id="{{ $task->id }}">
                                        {{ html_entity_decode($task->title) }}
                                    </a>
                                    <div class="task-footer d-flex align-items-center justify-content-between row mt-2">
                                        <div class="avatar-container col-xs-12 ml-2 d-flex">
                                            @foreach($task->taskAssignee->take(4) as $assignee)
                                                @php $assignee = is_array($assignee) ? (object)$assignee : $assignee; @endphp
                                                <figure class="avatar mr-2 avatar-sm" data-toggle="tooltip" title="{{ $assignee->name ?? '' }}">
                                                    <img src="{{ $assignee->img_avatar ?? '' }}">
                                                </figure>
                                            @endforeach
                                            @if($task->taskAssignee->count() > 4)
                                                <div class="avatar more-avatar">+{{ $task->taskAssignee->count() - 4 }}</div>
                                            @endif
                                        </div>
                                        <div class="pr-2 col-xs-12 ml-1">
                                            <div class="d-flex justify-content-end align-items-center">
                                                @php
                                                    // Check if this is a completed status
                                                    $statusRecord = \App\Models\Status::where('status', $status->status)->first();
                                                    $isCompletedStatus = $statusRecord && strcasecmp($statusRecord->name, 'completed') == 0;
                                                    
                                                    // Determine which date to show
                                                    $dateToShow = $isCompletedStatus ? $task->completed_on : $task->due_date;
                                                    $dateLabel = $isCompletedStatus ? 'Finish' : 'Due';
                                                @endphp
                                                
                                                @if($dateToShow)
                                                    <div class="due-date {{ $isCompletedStatus ? 'text-success' : (\Carbon\Carbon::now()->startOfDay() > \Carbon\Carbon::parse($dateToShow) ? 'text-danger' : '') }}">
                                                        @if(\Carbon\Carbon::parse($dateToShow)->isToday())
                                                            {{ $dateLabel }}: Today
                                                        @elseif(\Carbon\Carbon::parse($dateToShow)->isTomorrow())
                                                            {{ $dateLabel }}: Tomorrow
                                                        @else
                                                            {{ $dateLabel }}: {{ \Carbon\Carbon::parse($dateToShow)->format('jS M, Y') }}
                                                        @endif
                                                    </div>
                                                @endif
                                                <div class="attachments ml-2">
                                                    <i class="fas fa-paperclip"></i> {{ $task->media->count() }}
                                                </div>
                                                <div class="comments ml-3">
                                                    <i class="far fa-comment-alt"></i> {{ $task->comments->count() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if($hasMore[$status->status] ?? false)
                            <div class="text-center mt-2 mb-4 pb-4">
                                <button wire:click="loadMore('{{ $status->status }}')" class="btn btn-sm btn-primary">
                                    Show More
                                </button>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>