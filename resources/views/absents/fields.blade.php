<div class="row">
    <!-- User Field -->
    <div class="form-group col-sm-6">
      {{ Form::label('user_id', __('messages.absents.user').':') }}<span class="required">*</span>
      {{ Form::select(
          'user_id', 
          $users,
          old('user_id', $absent->user_id ?? ''), // fallback to '' if id not set
          ['class' => 'form-control', 'id' => 'user_id', 'required', 'placeholder' => __('messages.common.select')]
      ) }}
   </div>

    <!-- Partial Absent Checkbox -->
    <div class="form-group col-sm-6 mt-4">
        <div class="form-check">
            {{ Form::checkbox(
                'partial_leave', 
                1, 
                old('partial_leave', $absent->partial_leave ?? false), 
                ['class' => 'form-check-input', 'id' => 'partial_leave']
            ) }}
            {{ Form::label('partial_leave', __('messages.absents.partial_leave'), ['class' => 'form-check-label']) }}
        </div>
    </div>

    <!-- From Date -->
    <div class="form-group col-sm-3">
        {{ Form::label('from_date', __('messages.absents.from_date').':') }}<span class="required">*</span>
        {{ Form::date(
            'from_date',
            old('from_date', $absent->from_date ?? null),
            [
                'class' => 'form-control',
                'id' => 'from_date',
                'required'
            ]
        ) }}
    </div>

    <!-- To Date -->
    <div class="form-group col-sm-3">
        {{ Form::label('to_date', __('messages.absents.to_date').':') }}<span class="required">*</span>
        {{ Form::date('to_date', old('to_date', $absent->to_date ?? null), ['class' => 'form-control', 'id' => 'to_date', 'required']) }}
    </div>

    <!-- From Time -->
    <div class="form-group col-sm-2 {{ !empty($absent->partial_leave) && $absent->partial_leave ? '' : 'd-none' }}" id="from_time_div">
        {{ Form::label('from_time', __('messages.absents.from_time').':') }}
        {{ Form::time(
            'from_time', 
            old('from_time', isset($absent->from_time) ? \Carbon\Carbon::parse($absent->from_time)->format('H:i') : null), 
            ['class' => 'form-control', 'id' => 'from_time']
        ) }}
    </div>

    <!-- To Time -->
    <div class="form-group col-sm-2 {{ !empty($absent->partial_leave) && $absent->partial_leave ? '' : 'd-none' }}" id="to_time_div">
        {{ Form::label('to_time', __('messages.absents.to_time').':') }}
        {{ Form::time(
            'to_time', 
            old('to_time', isset($absent->to_time) ? \Carbon\Carbon::parse($absent->to_time)->format('H:i') : null), 
            ['class' => 'form-control', 'id' => 'to_time']
        ) }}
    </div>

    <!-- Total Days -->
    <div class="form-group col-sm-2">
        {{ Form::label('total_days', __('messages.absents.total_days').':') }}
        {{ Form::number('total_days', old('total_days', $absent->total_days ?? null), ['class' => 'form-control', 'id' => 'total_days', 'readonly']) }}
    </div>

    <!-- Reason -->
    <div class="form-group col-sm-12">
        {{ Form::label('reason', __('messages.absents.reason').':') }}
        {{ Form::textarea('reason', old('reason', $absent->reason ?? null), ['class' => 'form-control', 'id' => 'reason', 'rows' => 3, 'required']) }}
    </div>

    <!-- Status (Admin only) -->
    @if(auth()->user()->hasRole('Admin'))
    <div class="form-group col-sm-6">
        {{ Form::label('status', __('messages.absents.status').':') }}
        {{ Form::select('status', $statuses, old('status', $absent->status ?? 'approved'), ['class' => 'form-control', 'id' => 'status', 'required']) }}
    </div>
    @endif

    <!-- Submit Buttons -->
    <div class="form-group col-sm-12 mt-2">
        {{ Form::button(__('messages.common.save'), ['type' => 'submit', 'class' => 'btn btn-primary save-btn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('absents.index') }}" class="btn btn-light ml-1">{{ __('messages.common.cancel') }}</a>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    function togglePartialFields() {
        if ($('#partial_leave').is(':checked')) {
            $('#from_time_div, #to_time_div').removeClass('d-none');
        } else {
            $('#from_time_div, #to_time_div').addClass('d-none');
            $('#from_time, #to_time').val('');
        }
        calculateTotalDays();
    }

    function calculateTotalDays() {
        let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        let totalDays = 0;

        if (fromDate && toDate) {
            const from = new Date(fromDate);
            const to = new Date(toDate);
            totalDays = Math.ceil((to - from) / (1000 * 60 * 60 * 24)) + 1;

            if ($('#partial_leave').is(':checked')) {
                totalDays = 0.5;
            }
        }

        $('#total_days').val(totalDays);
    }

    // Initialize fields on page load
    togglePartialFields();

    // Event listeners
    $('#partial_leave').change(togglePartialFields);
    $('#from_date, #to_date').change(calculateTotalDays);
});
</script>
@endpush
