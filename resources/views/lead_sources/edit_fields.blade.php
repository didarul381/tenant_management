<div class="alert alert-danger display-none" id="validationErrorsBox"></div>

<div class="row">
    <div class="form-group col-sm-12">
        {{ Form::label('name', __('messages.lead_sources.name').':') }}<span class="required">*</span>
        {{ Form::text('name', isset($leadSource->name) ? $leadSource->name : null, [
            'class' => 'form-control',
            'id' => 'name',
            'required',
            'placeholder' => __('messages.lead_sources.name')
        ]) }}
    </div>

    <div class="form-group col-sm-12">
        {{ Form::label('description', __('messages.lead_sources.description').':') }}
        {{ Form::textarea('description', isset($leadSource->description) ? $leadSource->description : null, [
            'class' => 'form-control',
            'id' => 'description',
            'rows' => 3,
            'placeholder' => __('messages.lead_sources.description')
        ]) }}
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12 mt-2">
        {{ Form::button(__('messages.common.save'), [
            'type' => 'submit',
            'class' => 'btn btn-primary save-btn',
            'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."
        ]) }}
        <a href="{{ route('lead-sources.index') }}" class="btn btn-light ml-1">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
