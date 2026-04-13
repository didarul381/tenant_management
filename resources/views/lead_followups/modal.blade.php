<div id="followUpModal" class="modal fade" tabindex="-1" aria-labelledby="followUpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.leads.new_follow_up') }}</h5>
               <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>

            {{ Form::open(['id'=>'addFollowUpForm']) }}
            <div class="modal-body">
                
                 {{ Form::hidden('lead_id', null, ['id' => 'leadId']) }}

               
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('assigned_to', __('messages.leads.assigned_to')) }}
                        {{ Form::select('assigned_to', $users, null, ['class'=>'form-control','id'=>'assignedTo']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('follow_up_at', __('messages.leads.follow_up_at')) }}
                        {{ Form::text('follow_up_at', null, ['class'=>'form-control','id'=>'followUpAt','autocomplete'=>'off']) }}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('type', __('messages.leads.type')) }}
                        {{ Form::select('type', ['call'=>'Call','email'=>'E-mail','meeting'=>'Meeting','sms'=>'SMS','other'=>'Other'], null, ['class'=>'form-control']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('status', __('messages.leads.status')) }}
                        {{ Form::select('status', ['pending'=>'Pending','completed'=>'Completed','canceled'=>'Canceled','rescheduled'=>'Rescheduled'], null, ['class'=>'form-control']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('note', __('messages.leads.note')) }}
                    {{ Form::textarea('note', null, ['class'=>'form-control']) }}
                </div>
            </div>

            <div class="modal-footer">
                {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnFollowUpSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                 <button type="button" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}

        </div>
    </div>
</div>

<!-- Drawer -->
<div id="followUpDrawer" data-bs-scroll="true" class="drawer pb-4">
  <div class="drawer-content pb-4">
    <div class="drawer-header">
      <h5>{{ __('messages.leads.new_follow_up') }}</h5>
      <button type="button" class="close" id="closeDrawer">&times;</button>
    </div>

    <div class="drawer-body">

        <div id="drawerUserInfo" class="lead-info mb-3 p-3 border rounded bg-light"></div>
      

      {{ Form::open(['id'=>'addFollowUpFormDrawer']) }}
        {{ Form::hidden('lead_id', null, ['id' => 'leadIdDrawer']) }}

        <div class="alert alert-danger d-none" id="validationErrorsBox"></div>

        <div class="row">
          <div class="form-group col-sm-6">
            {{ Form::label('assigned_to', __('messages.leads.assigned_to')) }}
            {{ Form::select('assigned_to', $users, null, ['class'=>'form-control','id'=>'assignedTo']) }}
          </div>
          <div class="form-group col-sm-6">
            {{ Form::label('follow_up_at', __('messages.leads.follow_up_at')) }}
            {{ Form::text('follow_up_at', null, ['class'=>'form-control','id'=>'followUpAt','autocomplete'=>'off']) }}
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6">
            {{ Form::label('type', __('messages.leads.type')) }}
            {{ Form::select('type', ['call'=>'Call','email'=>'E-mail','meeting'=>'Meeting','sms'=>'SMS','other'=>'Other'], null, ['class'=>'form-control']) }}
          </div>
          <div class="form-group col-sm-6">
            {{ Form::label('status', __('messages.leads.status')) }}
            {{ Form::select('status', ['pending'=>'Pending','completed'=>'Completed','canceled'=>'Canceled','rescheduled'=>'Rescheduled'], null, ['class'=>'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('note', __('messages.leads.note')) }}
          {{ Form::textarea('note', null, ['class'=>'form-control']) }}
        </div>

        <div class="my-3">
          {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnFollowUpSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
          <button type="button" class="btn btn-light ml-1" id="closeDrawerBtn">{{ __('messages.common.cancel') }}</button>
        </div>
      {{ Form::close() }}
    </div>
    <div id="drawerFollowUps" class="mb-4"></div>
  </div>
</div>

