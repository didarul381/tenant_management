<div id="editFollowUpModal" class="modal fade" tabindex="-1" aria-labelledby="editFollowUpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFollowUpModalLabel">{{ __('messages.leads.edit_follow_up') }}</h5>
               <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editFollowUpForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>

                {{ Form::hidden('follow_up_id', null, ['id' => 'editFollowUpId']) }}
                

                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('assigned_to', __('messages.leads.assigned_to')) }}
                        {{ Form::select('assigned_to', $users, null, ['class'=>'form-control','id'=>'editAssignedTo']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('follow_up_at', __('messages.leads.follow_up_at')) }}
                        {{ Form::text('follow_up_at', null, ['class'=>'form-control','id'=>'editFollowUpAt','autocomplete'=>'off']) }}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('type', __('messages.leads.type')) }}
                        {{ Form::select('type', ['call'=>'Call','email'=>'E-mail','meeting'=>'Meeting','sms'=>'SMS','other'=>'Other'], null, ['class'=>'form-control','id'=>'editType']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('status', __('messages.leads.status')) }}
                        {{ Form::select('status', ['pending'=>'Pending','completed'=>'Completed','canceled'=>'Canceled','rescheduled'=>'Rescheduled'], null, ['class'=>'form-control','id'=>'editStatus']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('note', __('messages.leads.note')) }}
                    {{ Form::textarea('note', null, ['class'=>'form-control','id'=>'editNote']) }}
                </div>

                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditFollowUpSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>

            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
