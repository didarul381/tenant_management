@extends('layouts.app')

@section('title')
    {{ __('messages.leave_request.leave_requests') }}
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style/css/tasks.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="section-header leave-header-section">
        <h1 class="page__heading">{{ __('messages.leave_request.leave_requests') }}</h1>
        <div style="display: flex; gap: 20px; padding-top:14px; margin:auto;" class="">
            @if(auth()->user()->hasRole('Admin'))
                <p>
                    <strong>Requested:</strong>
                    <a href="#" data-toggle="modal" data-target="#leaveStatsModal">{{ $stats['total'] }}</a>,
                    <strong>Approved:</strong> {{ $stats['approved'] }} Day,
                    <strong>Swapped:</strong> {{ $stats['swapped'] }} Day
                    <span style="margin-left:8px;"><a href="#" data-toggle="modal" data-target="#leaveStatsModal">Summary</a></span>
                </p>
            @else
                <p>
                    <strong>Requested:</strong> {{ $stats['total'] }},
                    <strong>Approved:</strong> {{ $stats['approved'] }} Day,
                    <strong>Remaining:</strong> {{ $stats['remaining'] }} Day
                    <span style="margin-left:8px;"><a href="#" data-toggle="modal" data-target="#leaveStatsModal">Summary</a></span>
                </p>
            @endif
        </div>


        <div class="filter-container section-header-breadcrumb row justify-content-md-end">

            {{-- Filter Dropdown --}}
            <div class="pl-sm-3 py-1">
                <div class="dropdown">
                    <a class="dropdown-toggle btn btn-primary" href="#" data-toggle="dropdown"
                       title="{{ __('messages.common.filter') }}" id="filter_toggle">
                       <i class="fas fa-filter"></i>
                    </a>
                    <div class="dropdown-menu dropdown-large dropdown-menu-right">
                        <div class="row mb-2">
                            <div class="form-group col-sm-6 d-flex justify-content-start">
                                <a class="btn btn-primary" id="resetFilters">{{ __('messages.leave_request.reset') }}</a>
                            </div>
                            <div class="form-group col-sm-6 d-flex justify-content-end">
                                <button type="button" aria-label="Close" class="close outline-none">×</button>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Employee --}}
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ __('messages.leave_request.employee') }}</b></label>
                                  {{ Form::select('drp_user', $users, auth()->user()->hasRole('Admin') ? null : auth()->id(), ['id'=>'filter_user', 'class'=>'form-control min-width-150', 'placeholder' => auth()->user()->hasRole('Admin') ? __('messages.common.all') : false]) }}
                            </div>

                            {{-- Status --}}
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ __('messages.leave_request.status') }}</b></label>
                                {{ Form::select('drp_status', $statuses, null, ['id'=>'filter_status', 'class'=>'form-control min-width-150', 'placeholder' => __('messages.common.all')]) }}
                            </div>

                            {{-- Partial Leave --}}
                            {{-- <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ __('messages.leave_request.partial_leave') }}</b></label>
                                {{ Form::select('drp_partial', ['yes' => __('messages.common.yes'), 'no' => __('messages.common.no')], null, ['id'=>'filter_partial', 'class'=>'form-control min-width-150', 'placeholder' => __('messages.common.all')]) }}
                            </div> --}}
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ "Date"}}</b></label>
                                <input type="text" id="filter_date_range" class="form-control" placeholder="{{ __('messages.leave_request.date_range') }}">
                            </div>
                        </div>

                        {{-- Date Range Filter --}}


                    </div>
                </div>
            </div>

            {{-- Action Dropdown --}}
            <div class="pl-sm-3 pr-sm-3 pl-2 pr-2 py-1 leave-action">
                <a class="btn btn-primary " href="{{ route('leave-requests.create') }}">
                            <i class="fas fa-plus"></i> {{ __('messages.leave_request.new_leave_request') }}
                        </a>
            </div>

        </div>
    </div>

    <div class="section-body">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('leave_requests.table') {{-- DataTable partial --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page_js')
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
@endsection

@section('scripts')
    <script src="{{ mix('assets/js/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
    <script src="{{ mix('assets/js/leave_requests/leave_requests.js') }}"></script>
@endsection

<!-- Leave Stats Modal -->
<div class="modal fade" id="leaveStatsModal" tabindex="-1" role="dialog" aria-labelledby="leaveStatsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leaveStatsModalLabel">Leave Statistics</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal content will be loaded here -->
                @if(auth()->user()->hasRole('Admin'))
                    @php $years = [2026]; @endphp
                    @foreach($years as $year)
                        <h4>{{ $year }}</h4>
                        @php
                            $yearStats = \App\Models\LeaveRequest::selectRaw('user_id,
                                COUNT(*) as total_requests,
                                SUM(CASE WHEN status = "approved" THEN total_days ELSE 0 END) as approved_days,
                                SUM(CASE WHEN status = "rejected" THEN total_days ELSE 0 END) as rejected_days,
                                SUM(CASE WHEN status = "swap" THEN total_days ELSE 0 END) as swap_days,
                                COUNT(CASE WHEN partial_leave = 1 THEN 1 END) as partial_count,
                                SUM(CASE WHEN partial_leave = 1 AND status = "approved" THEN TIMESTAMPDIFF(MINUTE, from_time, to_time) ELSE 0 END) as approved_partial_minutes')
                                ->whereYear('from_date', $year)
                                ->groupBy('user_id')
                                ->with('user')
                                ->get();
                        @endphp
                        @if($yearStats->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Employee</th>
                                            <th>Total Requested</th>
                                            <th>Approved Days</th>
                                            <th>Rejected Days</th>
                                            <th>Swap Days</th>
                                            <th>Remaining Days</th>
                                            <th>Partial Requests</th>
                                            <th>Approved Partial Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($yearStats as $stat)
                                            <tr>
                                                <td>{{ $stat->user->name ?? 'N/A' }}</td>
                                                <td>{{ $stat->total_requests }}</td>
                                                <td>{{ $stat->approved_days }}</td>
                                                <td>{{ $stat->rejected_days }}</td>
                                                <td>{{ $stat->swap_days }}</td>
                                                <td>{{ 12 - $stat->approved_days }}</td>
                                                <td>{{ $stat->partial_count }}</td>
                                                <td>{{ floor($stat->approved_partial_minutes / 60) }}h {{ $stat->approved_partial_minutes % 60 }}m</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">No leave requests for this year.</p>
                        @endif
                    @endforeach
                @else
                    @php $years = [2026]; @endphp
                    @foreach($years as $year)
                        <h4>{{ $year }}</h4>
                        @php
                            $yearStats = \App\Models\LeaveRequest::selectRaw('
                                COUNT(*) as total_requests,
                                SUM(CASE WHEN status = "approved" THEN total_days ELSE 0 END) as approved_days,
                                SUM(CASE WHEN status = "rejected" THEN total_days ELSE 0 END) as rejected_days,
                                SUM(CASE WHEN status = "swap" THEN total_days ELSE 0 END) as swap_days,
                                COUNT(CASE WHEN partial_leave = 1 THEN 1 END) as partial_count,
                                SUM(CASE WHEN partial_leave = 1 AND status = "approved" THEN TIMESTAMPDIFF(MINUTE, from_time, to_time) ELSE 0 END) as approved_partial_minutes')
                                ->where('user_id', auth()->id())
                                ->whereYear('from_date', $year)
                                ->first();
                        @endphp

                        @if($yearStats && $yearStats->total_requests > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Total Requested</th>
                                        <th>Approved Days</th>
                                        <th>Rejected Days</th>
                                        <th>Swap Days</th>
                                        <th>Remaining Days</th>
                                        <th>Partial Requests</th>
                                        <th>Approved Partial Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $yearStats->total_requests }}</td>
                                        <td>{{ $yearStats->approved_days }}</td>
                                        <td>{{ $yearStats->rejected_days }}</td>
                                        <td>{{ $yearStats->swap_days }}</td>
                                        <td>{{ 12 - $yearStats->approved_days }}</td>
                                        <td>{{ $yearStats->partial_count }}</td>
                                        <td>{{ floor($yearStats->approved_partial_minutes / 60) }}h {{ $yearStats->approved_partial_minutes % 60 }}m</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p class="text-muted">No leave requests for this year.</p>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
