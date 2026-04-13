@extends('layouts.app')
@section('title')
    {{ __('Attendence') }}
@endsection
@section('css')
   
@endsection

@section('content')
<section class="section">
 <div class="section-header leave-header-section">
     <h1 class="page__heading">{{ __('Attendence') }}</h1>
     <div class="filter-container section-header-breadcrumb row justify-content-md-end">
            {{-- Filter Dropdown --}}
            <div class="row py-1">
                  
                <div class="col-md-12">
                    <label><b>{{ __('Date Range') }}</b></label>
                    <input type="text" id="filter_date_range" class="form-control" placeholder="{{ __('Select Date Range') }}">
                </div>
            </div>

        </div>
 </div>

  <div class="section-body">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                       <div class="table-responsive">
                          <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Day') }}</th>
                                        <th>{{ __('Check In') }}</th>
                                        <th>{{ __('Check Out') }}</th>
                                        <th>{{ __('Duration') }}</th>
                                        <th>{{ __('Break') }}</th>
                                         <th>{{ __('Office Time') }}</th>
                                        <th>{{ __('Status') }}</th>
                                         <th>{{ __('Note') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="attendanceTableBody">
                                    @forelse($attendances ?? [] as $index => $attendance)
                                        <tr>
                                            <td>{{ $attendances->firstItem() + $index }}</td>
                                            <td>{{ $attendance->signing_in_date_time ? $attendance->signing_in_date_time->format('M d, Y') : '-' }}</td>
                                          
                                            <td>{{ $attendance->signing_in_date_time ? $attendance->signing_in_date_time->copy()->addHours(6)->format('h:i A') : '-' }}</td>
                                            <td>{{ $attendance->signing_out_date_time ? $attendance->signing_out_date_time->copy()->addHours(6)->format('h:i A') : '-' }}</td>
                                            <td>
                                                @if($attendance->duration)
                                                    {{ floor($attendance->duration / 60) }}h {{ $attendance->duration % 60 }}m
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($attendance->total_break_seconds) && $attendance->total_break_seconds > 0)
                                                    @if($attendance->total_break_seconds < 60)
                                                        {{ $attendance->total_break_seconds }}s
                                                    @else
                                                        {{ floor($attendance->total_break_seconds / 60) }}m {{ $attendance->total_break_seconds % 60 }}s
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                {{ $attendance->office_time ?? '-' }}
                                            </td>
                                            <td>
                                                @if($attendance->status == 'in_time')
                                                    <span class="badge badge-success">{{ __('In Time') }}</span>
                                                @elseif($attendance->status == 'late')
                                                    <span class="badge badge-danger">{{ __('Late') }}</span>
                                                @else
                                                    <span class="badge badge-warning">{{ __('Unknown') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($attendance->note == 'Office Time and Duration Matched')
                                                    <span class="badge badge-success">Office Time and Duration Matched</span>
                                                @elseif($attendance->note == 'Office Time and Duration Not Matched')
                                                    <span class="badge badge-danger">Office Time and Duration MisMatch</span>
                                                @else
                                                    <span class="badge badge-warning">{{ $attendance->note ?? '-' }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">{{ __('No attendance records found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                           </table>
                        </div>
                        <!-- Pagination -->
                        @if(isset($attendances) && $attendances->hasPages())
                            <div class="d-flex justify-content-center pagination-container">
                                {{ $attendances->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize date range picker with predefined ranges
    $('#filter_date_range').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'This Year': [moment().startOf('year'), moment().endOf('year')]
        },
        startDate: moment(),
        endDate: moment(),
        locale: {
            format: 'YYYY-MM-DD'
        },
        autoUpdateInput: false // Prevent automatic update of input
    }, function(start, end, label) {
        // Set the input value to the label instead of date range
        $('#filter_date_range').val(label);
        
        // When date range is selected, filter via AJAX
        filterAttendance(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });

    // Set initial value to show "Today"
    $('#filter_date_range').val('Today');

    // Function to filter attendance via AJAX
    function filterAttendance(startDate, endDate) {
        $.ajax({
            url: '{{ route("attendances.index") }}',
            type: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate,
                ajax: 1
            },
            beforeSend: function() {
                // Show loading spinner
                $('#attendanceTableBody').html('<tr><td colspan="9" class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</td></tr>');
            },
            success: function(response) {
                // Update table body with new data
                $('#attendanceTableBody').html(response.html);
                
                // Update pagination
                if (response.pagination) {
                    $('.pagination-container').html(response.pagination);
                }
            },
            error: function(xhr) {
                $('#attendanceTableBody').html('<tr><td colspan="9" class="text-center text-danger">Error loading data</td></tr>');
            }
        });
    }

    // Handle pagination clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        // Extract page number and other parameters
        var pageUrl = new URL(url);
        var page = pageUrl.searchParams.get('page');
        var startDate = $('#filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate = $('#filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
        
        $.ajax({
            url: '{{ route("attendances.index") }}',
            type: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate,
                page: page,
                ajax: 1
            },
            beforeSend: function() {
                $('#attendanceTableBody').html('<tr><td colspan="9" class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</td></tr>');
            },
            success: function(response) {
                $('#attendanceTableBody').html(response.html);
                if (response.pagination) {
                    $('.pagination-container').html(response.pagination);
                }
            },
            error: function(xhr) {
                $('#attendanceTableBody').html('<tr><td colspan="9" class="text-center text-danger">Error loading data</td></tr>');
            }
        });
    });
});
</script>
@endsection
