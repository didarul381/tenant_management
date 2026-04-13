<div id="addTypeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="typeHeader">{{ __('messages.job-type.new_type') }}</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addNewTypeForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger display-none" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('name', __('messages.job-type.name').':') }}<span class="required">*</span>
                        {{ Form::text('name', null, ['id'=>'name', 'class' => 'form-control', 'required']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('order', __('messages.job-type.order').':') }}
                        {{ Form::text('order',null, ['id'=>'order', 'class' => 'form-control']) }}
                    </div>
                </div>
                 <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.job-type.description').':') }}
                        {{ Form::text('description',null, ['id'=>'description', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>