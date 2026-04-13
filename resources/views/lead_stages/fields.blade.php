<!-- Validation Errors -->
<div class="alert alert-danger display-none" id="validationErrorsBox"></div>

<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {{ Form::label('name', __('messages.lead_stages.name').':') }}<span class="required">*</span>
        {{ Form::text('name', null, ['class' => 'form-control', 'required', 'id'=>'name']) }}
    </div>

    <!-- Description Field -->
    <div class="form-group col-sm-6">
        {{ Form::label('description', __('messages.lead_stages.description').':') }}
        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'id'=>'description']) }}
    </div>

    <!-- Sort Order Field -->
    <div class="form-group col-sm-6">
        {{ Form::label('sort_order', __('messages.lead_stages.sort_order').':') }}
        {{ Form::number('sort_order', null, ['class' => 'form-control', 'id'=>'sort_order', 'min' => 0]) }}
    </div>

    <!-- Color Field -->
        @php
           $colors = [
                'primary' => 'primary',
                'secondary' => 'secondary',
                'success' => 'success',
                'danger' => 'danger',
                'warning' => 'warning',
                'info' => 'info',
                'dark' => 'dark',
            ];

        @endphp
       
  
    <div class="form-group col-sm-6">
        {{ Form::label('color', __('messages.lead_stages.color').':') }}
        {{ Form::select(
            'color', 
            $colors, 
            isset($leadStage) ? $leadStage->color : null, 
            ['class' => 'form-control', 'id' => 'color', 'placeholder' => 'select color'])
        }}
    </div>

    




    <!-- Submit Buttons -->
    <div class="form-group col-sm-12 mt-2">
        {{ Form::button(__('messages.common.save'), [
            'type' => 'submit',
            'class' => 'btn btn-primary save-btn',
            'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."
        ]) }}
        <a href="{{ route('lead-stages.index') }}" class="btn btn-light ml-1">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
