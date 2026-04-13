{{-- <table class="table table-responsive-sm table-striped table-bordered" id="leave_requests_table">
    <thead>
        <tr>
            <th>{{ __('messages.leave_request.employee') }}</th>
            <th>{{ __('messages.leave_request.partial_leave') }}</th>
            <th>{{ __('messages.leave_request.from_date') }}</th>
            <th>{{ __('messages.leave_request.to_date') }}</th>
            <th>{{ __('messages.leave_request.total_days') }}</th>
            <th>{{ __('messages.leave_request.from_time') }}</th>
            <th>{{ __('messages.leave_request.to_time') }}</th>
            <th>{{ __('messages.leave_request.reason') }}</th>
            <th>{{ __('messages.leave_request.status') }}</th>
            <th>{{ __('messages.common.created_on') }}</th>
            <th>{{ __('messages.common.last_updated') }}</th>
            <th style="width:100px;">{{ __('messages.common.action') }}</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table> --}}
<style>
    #leave_requests_table {
        font-size: 13px;
    }
    #leave_requests_table thead th {
        font-size: 13px;
    }
    #leave_requests_table tbody td {
        font-size: 13px;
    }
    .reason-btn-bold.btn-link {
        font-size: 10px !important;
        padding: 0 4px;
    }
</style>
<table class="table table-responsive-sm table-striped table-bordered" id="leave_requests_table">
    <thead>
        <tr>
            <th>{{ __('messages.leave_request.employee') }}</th>
           <th style="width:160px;">{{ __('messages.leave_request.leave_day') }}</th>
            <th>{{ __('messages.leave_request.total_days') }}</th>
            <th>{{ __('messages.leave_request.reason') }}</th>
            <th>{{ __('messages.leave_request.status') }}</th>
            <th style="width:85px;">{{ __('messages.common.created_on') }}</th>
            <th style="width:100px;">{{ __('messages.common.action') }}</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
