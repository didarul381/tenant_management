<div id="addTaskModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.task.new_task') }}</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addTaskNewForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger display-none" id="projectTaskValidationErrorsBox"></div>
                <div class="row">
                    <input hidden name="project_id" id="taskProjectId">
                    <div class="form-group col-sm-6">
                        {{ Form::label('title', __('messages.task.title').':') }}<span class="required">*</span>
                        {{ Form::text('title', null, ['id'=>'title','class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('taskPriority', __('messages.task.priority').':') }}
                        {{ Form::select('priority',$priority, null, ['class' => 'form-control','id'=>'taskPriority','placeholder'=>'Select Priority']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 task-assignees">
                        {{ Form::label('assign_to', __('messages.task.assign_to').':') }}
                        {{ Form::select('assignees[]',[], null, ['class' => 'form-control','id'=>'taskAssignee', 'multiple' => true]) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('due_date',__('messages.task.due_date').':') }}
                        {{ Form::text('due_date', null, ['id'=>'taskDueDate','class' => 'form-control', 'autocomplete' => 'off']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('estimate_time', 'Estimate Time :') }}
                        <div class="input-group">
                            {{ Form::text('estimate_time_hours', null, ['id'=>'taskEstimateTimeHours','class' => 'form-control', 'autocomplete' => 'off']) }}
                            {{ Form::number('estimate_time_days', null, ['id' => 'taskEstimateTimeDays', 'class' => 'form-control estimateTime', 'autocomplete' => 'off','min' => 0,'max' => 30]) }}
                            {{ Form::number('estimate_time_minutes', null, ['id' => 'taskEstimateTimeMinutes', 'class' => 'form-control estimateMinutes', 'autocomplete' => 'off','min' => 0,'max' => 59]) }}
                            <div class="input-group-append">
                                <input type="hidden" name="estimate_time_type" value="2" id="taskTypes">
                                <button name="type" type="button" class="input-group-text btn btn-primary text-white"
                                        id="taskMinutes" value="2">{{"Minutes"}}</button>
                                <button name="type" type="button" class="input-group-text btn"
                                        id="taskDays">{{__('messages.task.in_days')}}</button>
                                <button name="type" type="button" class="input-group-text btn"
                                        id="taskHours">{{__('messages.task.in_hours')}}</button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group col-sm-6 task-tags">
                        {{ Form::label('tags', __('messages.task.tags').':') }}
                        {{ Form::select('tags[]',$tags, null, ['class' => 'form-control','id'=>'taskTagIds', 'multiple' => true]) }}
                    </div> --}}
                     @php
                        $user = Auth::user();
                        $isAdmin = $user && ($user->role === 'Admin');
                        $deptId = $user?->department_id;
                        
                        $tagQuery = \App\Models\Tag::query()->with('departments')->orderBy('name');
                        
                        if (!$isAdmin && !is_null($deptId)) {
                            // Non-admin with department: Show only their department tags + common tags
                            $tagQuery->where(function($q) use ($deptId) {
                                // Tags that belong to user's department
                                $q->whereHas('departments', function($d) use ($deptId) {
                                    $d->where('departments.id', $deptId);
                                })
                                // OR tags that have no department (common tags)
                                ->orWhereDoesntHave('departments');
                            });
                        }
                        // Admin and non-admin without department: Show all tags (no filtering)
                        
                        $tags = [];
                        foreach ($tagQuery->get() as $t) {
                            if ($t->departments && $t->departments->count() > 0) {
                                // If tag has departments, check user context
                                if ($isAdmin || is_null($deptId)) {
                                    // Admin or user without department: Show all department-tag combinations
                                    foreach ($t->departments as $dept) {
                                        $label = $dept->name . ' -> ' . $t->name;
                                        $tags[$t->id . '_' . $dept->id] = $label;
                                    }
                                } else {
                                    // User with department: Show only their department tags (already filtered by query)
                                    foreach ($t->departments as $dept) {
                                        $label = $t->name; // Just tag name for user's own department
                                        $tags[$t->id . '_' . $dept->id] = $label;
                                    }
                                }
                            } else {
                                // Common tags (no department)
                                if ($isAdmin || is_null($deptId)) {
                                    $label = 'Common - ' . $t->name; // Admin and users without department see "Common -" prefix
                                } else {
                                    $label = 'Common - ' . $t->name; // Users with department also see "Common -" prefix
                                }
                                $tags[$t->id . '_0'] = $label;
                            }
                        }
                    @endphp
                     <div class="form-group col-sm-6 task-tags">
                        {{ Form::label('tags', __('messages.task.tags').':') }}
                        {{ Form::select(
                            'tags[]',
                            $tags,
                            null,
                            ['class' => 'form-control', 'id' => 'taskTagIds', 'placeholder' => 'Select tags']
                        ) }}
                    </div>
                    
                     {{-- modified by rayhan start --}}
                     <!-- <div class="form-group col-sm-6 task-tags">
                        {{ Form::label('tags', __('messages.task.tags').':') }}
                        {{ Form::select(
                            'tags[]',
                            $tags,
                            null,
                            ['class' => 'form-control', 'id' => 'taskTagIds', 'placeholder' => 'Select tags']
                        ) }}
                    </div> -->
                    {{-- modified by rayhan end --}}
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-group col-sm-6 p-0">
                        {{ Form::label('attachments', __('messages.task.attachments').':') }}
                    </div>
                    <div>
                        <label href="#"
                               class="cursor-pointer font-size-12px btn btn-sm btn-primary mb-0 ml-2 choose-button"><i
                                    class="fas fa-plus font-size-12px"></i>&nbsp;{{__('messages.setting_menu.choose')}}
                            <input type="file" name="files[]" id="Add_attachment" class="d-none" multiple>
                        </label>
                        <button type="submit" class="btn btn-sm btn-primary ml-2 btn-upload"
                                data-loading-text="<span class='spinner-border spinner-border-sm'></span> Uploading...">
                            <i class="fas fa-upload font-size-12px"></i>&nbsp;{{__('messages.common.upload')}}</button>
                    </div>
                </div>
                <div class="previewImage row edit-task-attachment" id="previewImage">
                </div>
                <div class="x-content p-2 attachments-content" id="card-attachments-container">
                    <div class="text-center" id="notFoundYet"></div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.common.description').':') }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'taskDescription']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnTaskSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
