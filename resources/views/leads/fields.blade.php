<!-- Validation Errors -->
<div class="alert alert-danger display-none" id="validationErrorsBox"></div>

{{-- Personal Details --}}
<h5 class="mb-3">{{ __('messages.leads.personal_details') }}</h5>
<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('first_name', __('messages.leads.first_name').':') }}<span class="required">*</span>
        {{ Form::text('first_name', null, ['class' => 'form-control', 'required', 'id'=>'first_name']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('last_name', __('messages.leads.last_name').':') }}
        {{ Form::text('last_name', null, ['class' => 'form-control', 'id'=>'last_name']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('email', __('messages.leads.email').':') }}
        {{ Form::email('email', null, ['class' => 'form-control', 'id'=>'email']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('phone', __('messages.leads.phone').':') }}
        {{ Form::text('phone', null, ['class' => 'form-control', 'id'=>'phone']) }}
    </div>
</div>

{{-- Professional Details --}}
<h5 class="mb-3 mt-4">{{ __('messages.leads.professional_details') }}</h5>
<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('job_title', __('messages.leads.job_title').':') }}
        {{ Form::text('job_title', null, ['class' => 'form-control', 'id'=>'job_title']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('company', __('messages.leads.company').':') }}
        {{ Form::text('company', null, ['class' => 'form-control', 'id'=>'company']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('industry', __('messages.leads.industry').':') }}
        {{ Form::text('industry', null, ['class' => 'form-control', 'id'=>'industry']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('website', __('messages.common.website').':') }}
        {{ Form::text('website', null, ['class' => 'form-control', 'id'=>'website']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('source_id', __('messages.leads.source').':') }}
        {{ Form::select('source_id', $sources, null, ['class' => 'form-control', 'id'=>'source_id', 'placeholder'=>__('messages.common.select')]) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('stage_id', __('messages.leads.stage').':') }}
        {{ Form::select('stage_id', $stages, null, ['class' => 'form-control', 'id'=>'stage_id', 'placeholder'=>__('messages.common.select')]) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('assigned_to', __('messages.leads.assigned_to').':') }}
        {{ Form::select('assigned_to', $users, null, ['class' => 'form-control', 'id'=>'assigned_to', 'placeholder'=>__('messages.common.select')]) }}
    </div>
</div>

{{-- Social Links --}}
<h5 class="mb-3 mt-4">{{ __('messages.leads.social_links') }}</h5>
<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('linkedin', __('messages.leads.linkedin').':') }}
        {{ Form::text('linkedin', null, ['class' => 'form-control', 'id'=>'linkedin']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('facebook', __('messages.leads.facebook').':') }}
        {{ Form::text('facebook', null, ['class' => 'form-control', 'id'=>'facebook']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('instagram', __('messages.leads.instagram').':') }}
        {{ Form::text('instagram', null, ['class' => 'form-control', 'id'=>'instagram']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('pinterest', __('messages.leads.pinterest').':') }}
        {{ Form::text('pinterest', null, ['class' => 'form-control', 'id'=>'pinterest']) }}
    </div>
</div>

{{-- Address --}}
<h5 class="mb-3 mt-4">{{ __('messages.leads.address') }}</h5>
<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('city', __('messages.leads.city').':') }}
        {{ Form::text('city', null, ['class' => 'form-control', 'id'=>'city']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('state', __('messages.leads.state').':') }}
        {{ Form::text('state', null, ['class' => 'form-control', 'id'=>'state']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('zip', __('messages.leads.zip').':') }}
        {{ Form::text('zip', null, ['class' => 'form-control', 'id'=>'zip']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('country', __('messages.leads.country').':') }}
        {{ Form::text('country', null, ['class' => 'form-control', 'id'=>'country']) }}
    </div>
</div>

{{-- Description --}}
<div class="row mt-3">
    <div class="form-group col-sm-12">
        {{ Form::label('description', __('messages.leads.description').':') }}
        {{ Form::textarea('description', null, ['class' => 'form-control', 'id'=>'description', 'rows' => 5]) }}
    </div>
</div>

{{-- Submit Buttons --}}
<div class="form-group col-sm-12 mt-3">
    {{ Form::button(__('messages.common.save'), [
        'type' => 'submit',
        'class' => 'btn btn-primary save-btn',
        'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."
    ]) }}
    <a href="{{ route('leads.index') }}" class="btn btn-light ml-1">{{ __('messages.common.cancel') }}</a>
</div>
