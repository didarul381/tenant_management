@extends('layouts.app')
@section('title')
    {{ __('Staff Attendence') }}
@endsection
@section('css')
   
@endsection


@section('content')
<section class="section">
<div class="section-header leave-header-section">
     <h1 class="page__heading">{{ __('Staff Attendence Report') }}</h1>
     <div class="filter-container section-header-breadcrumb row justify-content-md-end">
            {{-- Filter Dropdown --}}
            <div class="row py-1">

                 <div class="col-md-3">
                     <label><b>{{ __('User') }}</b></label>
                     <select id="userFilter" class="form-control">
                         <option value="">{{ __('All Users') }}</option>
                         @foreach($users ?? collect([]) as $user)
                             <option value="{{ $user->id }}" {{ (request('user_id') == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 
                 <div class="col-md-3">
                     <label><b>{{ __('Status') }}</b></label>
                     <select id="statusFilter" class="form-control">
                         <option value="">{{ __('All Status') }}</option>
                         <option value="in_time" {{ (request('status') == 'in_time') ? 'selected' : '' }}>{{ __('In Time') }}</option>
                         <option value="late" {{ (request('status') == 'late') ? 'selected' : '' }}>{{ __('Late') }}</option>
                         <option value="unknown" {{ (request('status') == 'unknown') ? 'selected' : '' }}>{{ __('Unknown') }}</option>
                     </select>
                 </div>
                 
                 <div class="col-md-4">
                     <label><b>{{ __('Date Range') }}</b></label>
                     <input type="text" id="filter_date_range" class="form-control" placeholder="{{ __('Select Date Range') }}">
                 </div>
               
                 <div class="col-md-2">
                     <label>&nbsp;</label>
                     <button type="button" id="filterBtn" class="btn btn-primary btn-block">{{ __('Filter') }}</button>
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
                        <!-- Attendance Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Day') }}</th>
                                        <th>{{ __('Check In') }}</th>
                                        <th>{{ __('Check Out') }}</th>
                                        <th>{{ __('Duration') }}</th>
                                        <th>{{ __('Break') }}</th>
                                        <th>{{ __('Office Time') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Note') }}</th>
                                        @if(auth()->user()->hasRole('Admin'))
                                            <th class="text-center" style="min-width: 160px;">{{ __('Action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="attendanceTableBody">
                                    @forelse($attendances ?? [] as $index => $attendance)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $attendance->user->name ?? 'N/A' }}</td>
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
                                                @if(isset($attendance->is_missing_user) && $attendance->is_missing_user)
                                                    <span class="badge badge-danger">{{ __('No Attendance') }}</span>
                                                @elseif($attendance->status == 'in_time')
                                                    <span class="badge badge-success">{{ __('In Time') }}</span>
                                                @elseif($attendance->status == 'late')
                                                    <span class="badge badge-danger">{{ __('Late') }}</span>
                                                @elseif($attendance->status == 'excuse')
                                                    <span class="badge badge-info">{{ __('Excuse') }}</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ __('Unknown') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($attendance->note == 'Office Time and Duration Matched')
                                                    <span class="badge badge-success">Office Time and Duration Matched</span>
                                                @elseif($attendance->note == 'Office Time and Duration Not Matched')
                                                    <span class="badge badge-danger">Office Time and Duration MisMatch</span>
                                                   @elseif($attendance->note == 'Forgot To Give Check out')
                                                    <span class="badge badge-danger">Forgot To Give Check out</span>
                                                @elseif($attendance->note == 'Duration Met but Timing Mismatch')
                                                    <span class="badge badge-info">Duration Met but Timing Mismatch</span>

                                                @else
                                                    <span class="">{{ $attendance->note ?? '-' }}</span>
                                                @endif
                                            </td>
                                            @if(auth()->user()->hasRole('Admin'))
                                                <td>
                                                    @if(isset($attendance->is_missing_user) && $attendance->is_missing_user)
                                
                                                    @else
                                                        <button class="btn btn-sm btn-info edit-btn"
                                                            data-id="{{ $attendance->id }}"
                                                            data-note="{{ $attendance->note ?? '' }}"
                                                            data-check-in-time="{{ $attendance->signing_in_date_time ? $attendance->signing_in_date_time->copy()->addHours(6)->format('Y-m-d\TH:i:s') : '' }}"
                                                            data-check-out-time="{{ $attendance->signing_out_date_time ? $attendance->signing_out_date_time->copy()->addHours(6)->format('Y-m-d\TH:i:s') : '' }}"
                                                            data-duration="{{ $attendance->duration ? floor($attendance->duration / 60) . 'h ' . ($attendance->duration % 60) . 'm' : '' }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        
                                                        @if($attendance->status != 'excuse' && $attendance->status != 'in_time')
                                                            <button type="button" class="btn btn-sm btn-warning excuse-btn ml-1" 
                                                                        data-id="{{ $attendance->id }}" 
                                                                        data-user-name="{{ $attendance->user->name ?? 'N/A' }}"
                                                                        data-date="{{ $attendance->signing_in_date_time ? $attendance->signing_in_date_time->format('M d, Y') : 'N/A' }}"
                                                                        title="Mark as Excuse">
                                                                        <i class="fas fa-exclamation-triangle"></i> 
                                                                    </button>
                                                        @endif
                                                        
                                                        <button type="button" class="btn btn-sm btn-danger delete-attendence ml-1" data-id="{{ $attendance->id }}">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            @if(auth()->user()->hasRole('Admin'))
                                                <td colspan="12" class="text-center">{{ __('No attendance records found') }}</td>
                                            @else
                                                <td colspan="11" class="text-center">{{ __('No attendance records found') }}</td>
                                            @endif
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
<!-- Edit Attendence Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Edit Attendance') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                        <input type="hidden" id="attendanceId" name="attendance_id">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="signing_in_date_time">{{ __('Check In Time') }}</label>
                                    <input type="datetime-local" class="form-control" id="signing_in_date_time" name="signing_in_date_time">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="signing_out_date_time">{{ __('Check Out Time') }}</label>
                                    <input type="datetime-local" class="form-control" id="signing_out_date_time" name="signing_out_date_time">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="note">{{ __('Note') }}</label>
                            <textarea class="form-control" id="note" name="note" rows="3" maxlength="200"></textarea>
                            <small class="form-text text-muted">{{ __('Maximum 200 characters') }}</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="duration">{{ __('Duration') }} <small class="text-muted">({{ __('Read Only - Auto Calculated') }})</small></label>
                            <input type="text" class="form-control" id="duration" name="duration" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="saveEdit">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Delete Attendence Modal -->
    <div class="modal fade" id="deleteAttendenceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Attendence Delete') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this attendence record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Yes</button>
                </div>
            </div>
        </div>
    </div>
<!-- Excuse Attendance Modal -->
    <div class="modal fade" id="excuseModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Mark Attendance as Excuse') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to mark this attendance as <strong>Excuse</strong>?</p>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>User:</strong> <span id="excuseUserName"></span><br>
                        <strong>Date:</strong> <span id="excuseDate"></span>
                    </div>
                    <p class="text-muted">This action will change the attendance status to "Excuse" and cannot be undone easily.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" id="confirmExcuse">
                        <i class="fas fa-exclamation-triangle"></i> Mark as Excuse
                    </button>
                </div>
            </div>
        </div>
    </div>
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
    });

    // Set initial value to show "Today"
    $('#filter_date_range').val('Today');

    // Filter functionality
    $('#filterBtn').click(function() {
        filterAttendance();
    });

    // Function to filter attendance via AJAX
    function filterAttendance() {
        var userId = $('#userFilter').val();
        var status = $('#statusFilter').val();
        var startDate = $('#filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate = $('#filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
        
        $.ajax({
            url: '{{ route("attendances.user-report") }}',
            type: 'GET',
            data: {
                user_id: userId,
                status: status,
                start_date: startDate,
                end_date: endDate,
                ajax: 1
            },
            beforeSend: function() {
                // Show loading spinner
                @if(auth()->user()->hasRole('Admin'))
                    $('#attendanceTableBody').html('<tr><td colspan="12" class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</td></tr>');
                @else
                    $('#attendanceTableBody').html('<tr><td colspan="11" class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</td></tr>');
                @endif
            },
            success: function(response) {
                // Update table body with new data
                $('#attendanceTableBody').html(response.html);
                
                // Update pagination
                if (response.pagination) {
                    $('.pagination-container').html(response.pagination);
                }
                
                // Re-bind delete button events after AJAX update
                $('.delete-attendence').off('click').on('click', function() {
                    currentAttendenceId = $(this).data('id');
                    $('#deleteAttendenceModal').modal('show');
                });
            },
            error: function(xhr) {
                $('#attendanceTableBody').html('<tr><td colspan="11" class="text-center text-danger">Error loading data</td></tr>');
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
        var userId = $('#userFilter').val();
        var status = $('#statusFilter').val();
        var startDate = $('#filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate = $('#filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
        
        $.ajax({
            url: '{{ route("attendances.user-report") }}',
            type: 'GET',
            data: {
                user_id: userId,
                status: status,
                start_date: startDate,
                end_date: endDate,
                page: page,
                ajax: 1
            },
            beforeSend: function() {
                $('#attendanceTableBody').html('<tr><td colspan="11" class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</td></tr>');
            },
            success: function(response) {
                $('#attendanceTableBody').html(response.html);
                if (response.pagination) {
                    $('.pagination-container').html(response.pagination);
                }
                
                // Re-bind delete button events after AJAX update
                $('.delete-attendence').off('click').on('click', function() {
                    currentAttendenceId = $(this).data('id');
                    $('#deleteAttendenceModal').modal('show');
                });
                
                // Re-bind excuse button events after AJAX update
                $('.excuse-btn').off('click').on('click', function() {
                    currentExcuseId = $(this).data('id');
                    const userName = $(this).data('user-name');
                    const date = $(this).data('date');
                    
                    $('#excuseUserName').text(userName);
                    $('#excuseDate').text(date);
                    $('#excuseModal').modal('show');
                });
            },
            error: function(xhr) {
                $('#attendanceTableBody').html('<tr><td colspan="11" class="text-center text-danger">Error loading data</td></tr>');
            }
        });
    });

    // Edit functionality
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var note = $(this).data('note');
        var checkInTime = $(this).data('check-in-time');
        var checkOutTime = $(this).data('check-out-time');
        var duration = $(this).data('duration');
        
        $('#attendanceId').val(id);
        $('#note').val(note);
        $('#signing_in_date_time').val(checkInTime);
        $('#signing_out_date_time').val(checkOutTime);
        $('#duration').val(duration);
        $('#editModal').modal('show');
    });

    // Save edit
    $('#saveEdit').click(function() {
        var id = $('#attendanceId').val();
        var note = $('#note').val();
        var checkInTime = $('#signing_in_date_time').val();
        var checkOutTime = $('#signing_out_date_time').val();
        
        // Validation
        if (note.length > 200) {
            displayErrorMessage('Note cannot exceed 200 characters');
            return;
        }
        
        if (checkOutTime && checkInTime && new Date(checkOutTime) <= new Date(checkInTime)) {
            displayErrorMessage('Check out time cannot be earlier than check in time');
            return;
        }
        
        $.ajax({
            url: '/attendances/' + id,
            method: 'PUT',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                note: note,
                signing_in_date_time: checkInTime,
                signing_out_date_time: checkOutTime
            },
            success: function(response) {
                $('#editModal').modal('hide');
                displaySuccessMessage(response.message);
                setTimeout(function() {
                    location.reload();
                }, 1500);
            },
            error: function(xhr) {
                var message = xhr.responseJSON ? xhr.responseJSON.message : 'Error updating record';
                displayErrorMessage(message);
            }
        });
    });

   
    // Delete Modal
    $('.delete-attendence').on('click', function() {
        currentAttendenceId = $(this).data('id');
        $('#deleteAttendenceModal').modal('show');
    });
      // Confirm Delete
    $('#confirmDelete').on('click', function() {
        if (currentAttendenceId) {
            $.ajax({
                url: '/attendances/' + currentAttendenceId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#deleteAttendenceModal').modal('hide');
                        displaySuccessMessage(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        displayErrorMessage(response.message);
                    }
                },
                error: function() {

                    displayErrorMessage('Cannot Delete Attendence.');
                }
            });
        }
    });
    
    // Excuse Modal
    let currentExcuseId = null;
    $(document).on('click', '.excuse-btn', function() {
        currentExcuseId = $(this).data('id');
        const userName = $(this).data('user-name');
        const date = $(this).data('date');
        
        $('#excuseUserName').text(userName);
        $('#excuseDate').text(date);
        $('#excuseModal').modal('show');
    });
    
    // Confirm Excuse
    $('#confirmExcuse').on('click', function() {
        if (currentExcuseId) {
            $.ajax({
                url: '/attendances/' + currentExcuseId + '/mark-excuse',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#excuseModal').modal('hide');
                        displaySuccessMessage(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        displayErrorMessage(response.message);
                    }
                },
                error: function() {
                    displayErrorMessage('Cannot mark attendance as excuse.');
                }
            });
        }
    });
    
});
</script>
@endsection
