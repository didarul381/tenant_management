@extends('layouts.app')

@section('title')
    {{ __('messages.salary.salary_details') }}
@endsection
@section('css')
    <style>
        /* make the salary detail modal rows tighter */
        .salary-view-container .table-sm td,
        .salary-view-container .table-sm th {
            padding: .3rem .5rem;
        }
    </style>
@endsection
@section('content')
<section class="section">
     <div class="section-header">
        <h1 class="page__heading">{{ __('messages.salary.salary_acknowledgement') }}</h1>
    </div>
    <div class="section-body">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body table-responsive">
                        <!-- Summary Cards -->
                        <!-- <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6>{{ __('Total Payable') }}</h6>
                                        <h6 class="text-primary">{{ round($totalPayable) }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6>{{ __('Total Paid') }}</h6>
                                        <h6 class="text-success">{{ round($totalPaid) }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6>{{ __('messages.salary.due') }}</h6>
                                        <h6 class="text-danger">{{ round($totalDue) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- Employee Salary Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('messages.salary.month_year') }}</th>
                                        <th>{{ __('messages.salary.basic_salary') }}</th>
                                        <th>{{ __('messages.salary.extra') }}</th>
                                        <th>{{ __('messages.salary.over_time') }}</th>
                                        <th>{{ __('messages.salary.commission') }}</th>
                                        <th>{{ __('messages.salary.penalty') }}</th>
                                        <th>{{ __('messages.salary.payable') }}</th>
                                        <th>{{ __('messages.salary.due') }}</th>
                                         <th>{{ __('messages.salary.paid') }}</th>
                                        <th>{{ __('messages.salary.status') }}</th>
                                        <th>{{ __('messages.common.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($salaries->count() > 0)
                                    @foreach($salaries as $salary)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @php
                                                 $month = $salary->month;
                                                    $months = [
                                                        1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                                                        5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                                                        9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                                                    ];
                                                    
                                                    
                                                    $salary_month = $months[$month] ?? '';
                                                @endphp
                                            {{ $salary_month }}/{{ $salary->year }}
                                            </td>
                                            <td>{{ round($salary->basic_salary) }}</td>
                                            <td>{{ round(($salary->house_rent ?? 0) + ($salary->ta_da ?? 0) + ($salary->medical_allowance ?? 0) + ($salary->eid_bonus ?? 0)) }}</td>
                                            <td>{{ round($salary->over_time ?? 0) }}</td>
                                            <td>{{ round($salary->commission ?? 0) }}</td>
                                            <td>{{ round(($salary->leave_penalty?? 0) + ($salary->absent_penalty?? 0) + ($salary->other_penalty?? 0)) }}</td>
                                            <td>{{ round($salary->payable) }}</td>
                                            <td>{{ round($salary->due) }}</td>
                                            <td>{{ round($salary->paid) }}</td>
                                            <td>
                                                <span class="badge badge-{{ $salary->status === 'paid' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($salary->status ?? 'N/A') }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-info view-salary" data-id="{{ $salary->id }}">
                                                            View
                                                        </button>
                                                       
                                                    </div>
                                                    @if($salary->status === 'due')
                                                    <div class="btn-group ml-1" role="group">
                                                        <button type="button" class="btn btn-sm btn-primary change-status" data-id="{{ $salary->id }}">
                                                           Received
                                                        </button>
                                                        
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                     @else
                                        <tr>
                                            <td colspan="12" class="text-center py-1">
                                                <div class="no-data-container">
                                                    <p class="text-primary">No Salary Records Found</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-end">
                            {{ $salaries->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

   <!-- View Salary Modal -->
    <div class="modal fade" id="viewSalaryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('messages.salary.salary_details') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

   
    <!-- Change Status Make Received Modal -->
    <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('messages.salary.change_status') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">This Action Cannot Be Undone! It Mean You Have Received Salary</p>
                    <p>Are You Sure You Want To Mark The Salary As Received?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmReceivedStatus">Yes</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

<script>
$(document).ready(function() {

// Edit Salary Modal
let currentSalaryId;


   // View Salary Modal
$(document).on('click', '.view-salary', function() {
    let viewId = $(this).data('id');
    console.log('View Salary ID:', viewId);

    // Show loading state
    $('#viewSalaryModal .modal-body').html(`
        <div class="text-center p-5">
            <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
            <p class="mt-3">Loading salary details...</p>
        </div>
    `);

    // Show modal
    $('#viewSalaryModal').modal('show');

    // Fetch salary data via AJAX
    $.ajax({
        url: '{{ url("salary-acknowledgement") }}/' + viewId,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                displaySalaryDetails(response.data);
            } else {
                $('#viewSalaryModal .modal-body').html('<div class="alert alert-danger m-3">Failed to load salary details</div>');
            }
        },
        error: function(xhr) {
            console.error('Error:', xhr);
            $('#viewSalaryModal .modal-body').html('<div class="alert alert-danger m-3">Error loading salary details</div>');
        }
    });
});

// Function to display salary details in view mode
function displaySalaryDetails(data) {
    // Calculate totals
    let basic = parseFloat(data.basic_salary) || 0;
    let houseRent = parseFloat(data.house_rent) || 0;
    let taDa = parseFloat(data.ta_da) || 0;
    let medical = parseFloat(data.medical_allowance) || 0;
    let overtime = parseFloat(data.over_time) || 0;
    let leavePenalty = parseFloat(data.leave_penalty) || 0;
    let absentPenalty = parseFloat(data.absent_penalty) || 0;
    let otherPenalty = parseFloat(data.other_penalty) || 0;
    let tax = parseFloat(data.tax) || 0;
    let commission = parseFloat(data.commission) || 0;
    let eid_bonus = parseFloat(data.eid_bonus) || 0;

    let totalEarnings = basic + houseRent + taDa + medical + overtime + commission + eid_bonus;
    let totalDeductions = leavePenalty + absentPenalty + otherPenalty + tax;
    let netPayable = totalEarnings - totalDeductions;

    // Status badge color
    let statusBadge = '';
    if (data.status === 'paid') {
        statusBadge = 'success';
    } else {
        statusBadge = 'warning';
    }

    let html = `
        <div class="salary-view-container">
            <!-- Employee Info Header -->
            <div class="alert alert-success">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Year:</strong> ${data.year}
                    </div>
                    <div class="col-md-4">
                        <strong>Month:</strong> ${formatMonth(data.month)}
                    </div>
                    <div class="col-md-4">
                        <strong>Employee:</strong> ${data.user?.name || 'N/A'}
                    </div>

                </div>
            </div>

            <!-- Salary Details Table -->
            <div class="table-responsive">
                <!-- use Bootstrap's compact table class and additional padding overrides -->
                <table class="table table-bordered table-striped table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 70%">Description</th>
                            <th style="width: 30%" class="text-right">Amount (৳)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Net Salary</td>
                            <td class="text-right">${formatNumber(basic)}</td>
                        </tr>
                        <tr>
                            <td>House Rent</td>
                            <td class="text-right">${formatNumber(houseRent)}</td>
                        </tr>
                        <tr>
                            <td>TA/DA</td>
                            <td class="text-right">${formatNumber(taDa)}</td>
                        </tr>
                        <tr>
                            <td>Medical Allowance</td>
                            <td class="text-right">${formatNumber(medical)}</td>
                        </tr>
                        <tr>
                            <td>Over Time</td>
                            <td class="text-right">${formatNumber(overtime)}</td>
                        </tr>
                         <tr>
                            <td>Commission</td>
                            <td class="text-right">${formatNumber(commission)}</td>
                        </tr>
                         ${eid_bonus > 0 ? `
                       <tr>
                            <td>Eid Bonus</td>
                            <td class="text-right">${formatNumber(eid_bonus)}</td>
                        </tr>
                        ` : ''}

                        ${leavePenalty > 0 ? `
                        <tr>
                            <td class="text-danger">Leave Penalty</td>
                            <td class="text-right">- ${formatNumber(leavePenalty)}</td>
                        </tr>
                        ` : ''}

                        ${absentPenalty > 0 ? `
                        <tr>
                            <td class="text-danger">Absent Penalty</td>
                            <td class="text-right">- ${formatNumber(absentPenalty)}</td>
                        </tr>
                        ` : ''}

                        ${otherPenalty > 0 ? `
                        <tr>
                            <td class="text-danger">Other Penalty</td>
                            <td class="text-right">- ${formatNumber(otherPenalty)}</td>
                        </tr>
                        ` : ''}

                        ${tax > 0 ? `
                        <tr>
                            <td class="text-danger">Tax</td>
                            <td class="text-right">- ${formatNumber(tax)}</td>
                        </tr>
                        ` : ''}

                        ${(leavePenalty > 0 || absentPenalty > 0 || otherPenalty > 0 || tax > 0) ? '' : `
                        <tr>
                            <td colspan="2" class="text-center text-muted">No deductions</td>
                        </tr>
                        `}



                        <tr class="table-success mb-4">
                            <td><strong>Net Payable</strong></td>
                            <td class="text-right"><strong>${formatNumber(netPayable)}</strong></td>
                        </tr>

                         ${data.other_penalty_note ? `
                        <tr class="table-secondary">
                            <td colspan="2">
                                <strong>Penalty Note:</strong> ${data.other_penalty_note}
                            </td>
                        </tr>
                        ` : ''}

                        ${data.notes ? `
                        <tr class="table-info">
                            <td colspan="2">
                                <strong>Notes:</strong> ${data.notes}
                            </td>
                        </tr>
                        ` : ''}
                    </tbody>
                </table>
            </div>

            <!-- Payment Info (if paid) -->
            ${data.status === 'paid' && data.paid_at ? `
            <div class="alert alert-success mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Paid Amount:</strong> ${formatNumber(data.paid)}
                    </div>
                    <div class="col-md-6">
                        <strong>Paid On:</strong> ${formatDate(data.paid_at)}
                    </div>
                </div>
            </div>
            ` : ''}


        </div>
    `;

    $('#viewSalaryModal .modal-body').html(html);
}

// Helper function to format numbers
function formatNumber(num) {
    return Math.round(parseFloat(num || 0)).toLocaleString();
}

// Helper function to format date
function formatDate(dateString) {
    if (!dateString) return 'N/A';
    let date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Helper function for uppercase first letter
function ucfirst(str) {
    if (!str) return 'N/A';
    return str.charAt(0).toUpperCase() + str.slice(1);
}
    

    // Change Status Modal
    $('.change-status').on('click', function() {
        currentSalaryId = $(this).data('id');
        $('#changeStatusModal').modal('show');
    });

    // Confirm Change Status
    $('#confirmReceivedStatus').on('click', function() {
        if (currentSalaryId) {
            $.ajax({
                url: '/salary-acknowledgement/' + currentSalaryId + '/change-status',
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#changeStatusModal').modal('hide');
                        displaySuccessMessage(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        displayErrorMessage(response.message);
                    }
                },
                error: function() {
                    displayErrorMessage('Error changing status');
                }
            });
        }
    });
    
    // Helper function to format month number to month name
    function formatMonth(monthNumber) {
        const months = {
            1: 'January', 2: 'February', 3: 'March', 4: 'April',
            5: 'May', 6: 'June', 7: 'July', 8: 'August',
            9: 'September', 10: 'October', 11: 'November', 12: 'December'
        };
        return months[monthNumber] || monthNumber;
    }
    
});
</script>
@endsection
