<div id="EditModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.tag.edit_tag') }}</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger display-none" id="editValidationErrorsBox"></div>
                {{ Form::hidden('tag_id',null,['id'=>'tagId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('name', __('messages.tag.name').':') }}<span class="required">*</span>
                        {{ Form::text('name', null, ['id'=>'tagName','class' => 'form-control','required']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 project-departments">
                        {{ Form::label('department_ids', __('messages.project.departments').':') }}
                        {{ Form::select('department_ids[]', $departments, null, [
                            'id' => 'edit_department_ids',
                            'class' => 'form-control',
                            'multiple' => 'multiple',
                            'autocomplete' => 'off'
                        ]) }}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label class="d-block mb-2">{{ __('Status') }}:</label>
                        <div class="custom-control custom-switch custom-switch-text">
                            {{ Form::checkbox('is_active', 1, null, [
                                'id' => 'is_active_switch',
                                'class' => 'custom-control-input',
                            ]) }}
                            <label class="custom-control-label" for="is_active_switch">
                               
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
