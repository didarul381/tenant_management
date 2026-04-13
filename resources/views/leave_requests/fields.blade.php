<div class="row">
    <!-- User Field -->
    <div class="form-group col-sm-6">
        {{ Form::label('user_id', __('leave_requests.user').':') }}<span class="required">*</span>
        @php
            $userSelectAttributes = ['class' => 'form-control', 'id' => 'user_id'];
            $defaultUser = old('user_id', $leaveRequest->user_id ?? auth()->id());
            if (!auth()->user()->hasRole('Admin')) {
                $userSelectAttributes['disabled'] = true;
                $defaultUser = auth()->id();
            }
        @endphp
        {{ Form::select(
            'user_id',
            $users,
            $defaultUser,
            $userSelectAttributes
        ) }}
        @if(!auth()->user()->hasRole('Admin'))
            {{ Form::hidden('user_id', $defaultUser) }}
        @endif
    </div>

    <!-- Partial Leave Checkbox -->
    <div class="form-group col-sm-6 mt-4">
        <div class="form-check">
            {{ Form::checkbox(
                'partial_leave',
                1,
                old('partial_leave', $leaveRequest->partial_leave ?? false),
                ['class' => 'form-check-input', 'id' => 'partial_leave']
            ) }}
            {{ Form::label('partial_leave', __('leave_requests.partial_leave'), ['class' => 'form-check-label']) }}
        </div>
    </div>

    <!-- From Date -->
    <div class="form-group col-sm-3">
        {{ Form::label('from_date', __('leave_requests.from_date').':') }}<span class="required">*</span>
        @php
            $fromDateAttributes = [
                'class' => 'form-control',
                'id' => 'from_date',
                'required'
            ];
            if (!auth()->user()->hasRole('Admin')) {
               $fromDateAttributes['min'] = \Carbon\Carbon::now()->format('Y-m-d');
            }
        @endphp
        {{ Form::date(
            'from_date',
            old('from_date', $leaveRequest->from_date ?? null),
            $fromDateAttributes
        ) }}
    </div>

    <!-- To Date -->
    <div class="form-group col-sm-3">
        {{ Form::label('to_date', __('leave_requests.to_date').':') }}<span class="required">*</span>
        {{ Form::date('to_date', old('to_date', $leaveRequest->to_date ?? null), ['class' => 'form-control', 'id' => 'to_date', 'required']) }}
    </div>

    <!-- From Time -->
    <div class="form-group col-sm-2 {{ !empty($leaveRequest->partial_leave) && $leaveRequest->partial_leave ? '' : 'd-none' }}" id="from_time_div">
        {{ Form::label('from_time', __('leave_requests.from_time').':') }}
        {{ Form::time(
            'from_time',
            old('from_time', isset($leaveRequest->from_time) ? \Carbon\Carbon::parse($leaveRequest->from_time)->format('H:i') : null),
            ['class' => 'form-control', 'id' => 'from_time']
        ) }}
    </div>

    <!-- To Time -->
    <div class="form-group col-sm-2 {{ !empty($leaveRequest->partial_leave) && $leaveRequest->partial_leave ? '' : 'd-none' }}" id="to_time_div">
        {{ Form::label('to_time', __('leave_requests.to_time').':') }}
        {{ Form::time(
            'to_time',
            old('to_time', isset($leaveRequest->to_time) ? \Carbon\Carbon::parse($leaveRequest->to_time)->format('H:i') : null),
            ['class' => 'form-control', 'id' => 'to_time']
        ) }}
    </div>


    <!-- Total Days -->
    <div class="form-group col-sm-2">
        {{ Form::label('total_days', __('leave_requests.total_days').':') }}
        {{ Form::number('total_days', old('total_days', $leaveRequest->total_days ?? null), ['class' => 'form-control', 'id' => 'total_days', 'readonly']) }}
    </div>

    <!-- Reason -->
    <div class="form-group col-sm-12">
        {{ Form::label('reason', __('leave_requests.reason').':') }}
        {{ Form::textarea('reason', old('reason', $leaveRequest->reason ?? null), ['class' => 'form-control', 'id' => 'reason', 'rows' => 3, 'required']) }}
    </div>

    <!-- Status -->
    @if(auth()->user()->hasRole('Admin'))
    <div class="form-group col-sm-6">
        {{ Form::label('status', __('leave_requests.status').':') }}
        {{ Form::select('status', $statuses, old('status', $leaveRequest->status ?? null), ['class' => 'form-control', 'id' => 'status', 'required']) }}
    </div>
    @endif

    <!-- Attachments -->
    <div class="form-group col-sm-12">
        <div class="d-flex justify-content-between">
            <div class="form-group p-0">
                {{ Form::label('attachments', __('leave_requests.attachments').':') }}
                
            </div>
            <div>
                <button type="button" class="cursor-pointer font-size-12px btn btn-sm btn-primary mb-0 ml-2 choose-button">
                    <i class="fas fa-plus font-size-12px"></i>&nbsp;{{__('messages.setting_menu.choose')}}
                </button>
                <input type="file" name="files[]" id="Add_attachment" class="d-none" multiple accept="image/*">
            </div>
        </div>
        <div class="previewImage row edit-task-attachment" id="previewImage">
        </div>
        <div class="x-content p-2 attachments-content" id="card-attachments-container">
            <!-- Show existing attachments on edit page -->
            @if(isset($leaveRequest) && $leaveRequest->attachments && $leaveRequest->attachments->count() > 0)
                <div class="mb-3">
                    <h6>{{ __('leave_requests.existing_attachments') }}:</h6>
                    <div class="row">
                        @foreach($leaveRequest->attachments as $attachment)
                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                <div class="card">
                                    <img src="{{ $attachment->file_url }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $attachment->file }}">
                                    <div class="card-body p-2">
                                        <p class="card-text small text-truncate mb-1">{{ $attachment->file }}</p>
                                        <div class="btn-group w-100" role="group">
                                            <a href="{{ $attachment->file_url }}" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> {{ __('messages.common.view') }}
                                            </a>
                                            <a href="{{ route('leave-requests.download-attachment', $attachment->id) }}" download="{{ $attachment->file }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i> {{ __('messages.common.download') }}
                                            </a>
                                            @if(auth()->user()->hasRole('Admin') || (auth()->id() == $leaveRequest->user_id && $leaveRequest->status == 'pending'))
                                                <button type="button" class="btn btn-sm btn-danger delete-attachment" data-id="{{ $attachment->id }}">
                                                    <i class="fas fa-trash"></i> {{ __('messages.common.delete') }}
                                                </button>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="text-center" id="notFoundYet"></div>
        </div>
        <div class="row">
    </div>
    </div>

    <!-- Submit Buttons -->
    <div class="form-group col-sm-12 mt-2">
        {{ Form::button(__('messages.common.save'), ['type' => 'submit', 'class' => 'btn btn-primary save-btn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('leave-requests.index') }}" class="btn btn-light ml-1">{{ __('messages.common.cancel') }}</a>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    function togglePartialFields() {

        if ($('#partial_leave').is(':checked')) {
            // Show time fields
            $('#from_time_div, #to_time_div').removeClass('d-none');
        } else {
            // Hide time fields and reset values
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

            // Partial leave counts as half day
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

