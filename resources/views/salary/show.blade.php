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
        <h1 class="page__heading">{{ __('messages.salary.salary_details') }}</h1>
        <div class="filter-container section-header-breadcrumb justify-content-end">

            <a href="{{ route('salary.index') }}" class="btn btn-light">
                {{ __('messages.common.back') }}
            </a>

            <button type="button" class="btn btn-success ml-1 mark-all-paid" data-toggle="modal" data-target="#markAllPaidModal">
                <i class="fas fa-check"></i> Mark All Paid
            </button>

            <button type="button" class="btn btn-warning ml-1 mark-all-due" data-toggle="modal" data-target="#markAllDueModal">
                <i class="fas fa-clock"></i> Mark All Due
            </button>

            <button type="button" class="btn btn-danger ml-1 delete-all" data-toggle="modal" data-target="#deleteAllModal">
                <i class="fas fa-trash"></i> Delete All
            </button>

            <div class="btn-group ml-1" role="group">
                <button id="printDropdown" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-print"></i> Print
                </button>
                <div class="dropdown-menu" aria-labelledby="printDropdown">
                    <a class="dropdown-item" href="{{ route('salary.print-native-bank', [$year, $month_not_formated]) }}" target="_blank">
                        <i class="fas fa-university"></i> Native Bank
                    </a>
                    <a class="dropdown-item" href="{{ route('salary.print-other-bank', [$year, $month_not_formated]) }}" target="_blank">
                        <i class="fas fa-building"></i> Other Bank
                    </a>
                    <a class="dropdown-item" href="{{ route('salary.print-hand-cash', [$year, $month_not_formated]) }}" target="_blank">
                        <i class="fas fa-money-bill"></i> Hand Cash
                    </a>
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
                        <!-- Summary Cards -->
                        <div class="row mb-4">
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
                            <div class="col-md-2">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6>{{ __('Year') }}</h6>
                                        <h6 class="text-primary">
                                        {{ $year }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6>{{ __('Month') }}</h6>
                                        <h6 class="text-success">
                                        {{ $month }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Employee Salary Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.salary.employee') }}</th>
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
                                                <td>{{ $salary->user->name ?? 'N/A' }}</td>
                                                <td>{{ $month }}/{{ $year }}</td>
                                                <td>{{ round($salary->basic_salary) }}</td>
                                                <td>{{ round(($salary->house_rent ?? 0) + ($salary->ta_da ?? 0) + ($salary->medical_allowance ?? 0) + ($salary->eid_bonus ?? 0)) }}</td>
                                                <td>{{ round($salary->over_time ?? 0) }}</td>
                                                <td>{{ round($salary->commission ?? 0) }}</td>
                                                <td>{{ round(($salary->leave_penalty?? 0) + ($salary->absent_penalty?? 0) + ($salary->attendece_penalty?? 0) + ($salary->other_penalty?? 0)) }}</td>
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
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-primary edit-salary ml-1" data-id="{{ $salary->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </div>
                                                        <div class="btn-group ml-1" role="group">
                                                            <button type="button" class="btn btn-sm btn-primary change-status" data-id="{{ $salary->id }}">
                                                                <i class="fas fa-exchange-alt"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger delete-salary ml-1" data-id="{{ $salary->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="12" class="text-center py-1">
                                                <div class="no-data-container">
                                                    <p class="text-primary">No Salary Records Found For {{ $month }} {{ $year }}.</p>
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

    <!-- Edit Salary Modal -->
    <div class="modal fade" id="editSalaryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('messages.salary.edit_salary') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Change Status Confirmation Modal -->
    <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('messages.salary.change_status') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to change the salary status?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmChangeStatus">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteSalaryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('messages.salary.delete') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this salary record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- mark all paid modal -->
    <div class="modal fade" id="markAllPaidModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mark All as Paid</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to mark all salaries for {{ $monthYear }} as paid?</p>
                    <p class="text-warning">This will update all due salaries to paid status and set due amount to 0.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="confirmMarkAllPaid">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mark All Due Modal -->
    <div class="modal fade" id="markAllDueModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mark All as Due</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to mark all salaries for {{ $monthYear }} as due?</p>
                    <p class="text-warning">This will update all paid salaries to due status and set paid amount to 0.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" id="confirmMarkAllDue">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete All Modal -->
    <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete All Salaries</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete all salaries for {{ $monthYear }}?</p>
                    <p class="text-danger">This action cannot be undone!</p>
                    <p class="text-warning">Note: You cannot delete salaries that are already marked as paid.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteAll">Confirm</button>
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

$(document).on('click', '.edit-salary', function() {
    currentSalaryId = $(this).data('id');
    console.log('Salary ID:', currentSalaryId);

    // Show loading state
    $('#editSalaryModal .modal-body').html(`
        <div class="text-center p-5">
            <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
            <p class="mt-3">Loading salary data...</p>
        </div>
    `);

    // Show modal
    $('#editSalaryModal').modal('show');

    // Fetch salary data via AJAX
    $.ajax({
        url: '{{ url("salary") }}/' + currentSalaryId,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                populateSalaryForm(response.data);
            } else {
                $('#editSalaryModal .modal-body').html('<div class="alert alert-danger m-3">Failed to load salary data</div>');
            }
        },
        error: function(xhr) {
            console.error('Error:', xhr);
            $('#editSalaryModal .modal-body').html('<div class="alert alert-danger m-3">Error loading salary data</div>');
        }
    });
});

// Function to populate form with data
function populateSalaryForm(data) {
    let formHtml = `
        <form id="editSalaryForm">
            @csrf
            <input type="hidden" name="_method" value="PUT">



            <div class="row">
                <div class="form-group col-md-4">
                    <label>Net Salary <span class="text-danger">*</span></label>
                    <input type="number" name="basic_salary" class="form-control"
                           value="${Math.round(data.basic_salary || 0)}" step="1" min="0" readonly disabled>
                    <small class="text-muted">Not editable</small>
                </div>
                <div class="form-group col-md-4">
                    <label>House Rent</label>
                    <input type="number" name="house_rent" class="form-control"
                           value="${Math.round(data.house_rent || 0)}" step="1" min="0">
                </div>
                <div class="form-group col-md-4">
                    <label>TA/DA</label>
                    <input type="number" name="ta_da" class="form-control"
                           value="${Math.round(data.ta_da || 0)}" step="1" min="0">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label>Medical Allowance</label>
                    <input type="number" name="medical_allowance" class="form-control"
                           value="${Math.round(data.medical_allowance || 0)}" step="1" min="0">
                </div>
                <div class="form-group col-md-4">
                    <label>Over Time</label>
                    <input type="number" name="over_time" class="form-control"
                           value="${Math.round(data.over_time || 0)}" step="1" min="0">
                </div>
                <div class="form-group col-md-4">
                    <label>Commission</label>
                    <input type="number" name="commission" class="form-control"
                           value="${Math.round(data.commission || 0)}" step="1" min="0">
                </div>
                <div class="form-group col-md-4">
                    <label>Eid Bonus</label>
                    <input type="number" name="eid_bonus" class="form-control"
                           value="${Math.round(data.eid_bonus || 0)}" step="1" min="0">
                </div>
                <div class="form-group col-md-4">
                    <label>Leave Penalty</label>
                    <input type="number" name="leave_penalty" class="form-control"
                           value="${Math.round(data.leave_penalty || 0)}" step="1" min="0">
                </div>
                 <div class="form-group col-md-4">
                    <label>Absent Penalty</label>
                    <input type="number" name="absent_penalty" class="form-control"
                           value="${Math.round(data.absent_penalty || 0)}" step="1" min="0">
                </div>
            </div>

            <div class="row">
               
                <div class="form-group col-md-4">
                    <label>Attendence Penalty</label>
                    <input type="number" name="attendece_penalty" class="form-control"
                           value="${Math.round(data.attendece_penalty || 0)}" step="1" min="0">
                </div>
                <div class="form-group col-md-4">
                    <label>Other Penalty</label>
                    <input type="number" name="other_penalty" class="form-control"
                           value="${Math.round(data.other_penalty || 0)}" step="1" min="0">
                </div>
                <div class="form-group col-md-4">
                    <label>Tax</label>
                    <input type="number" name="tax" class="form-control"
                           value="${Math.round(data.tax || 0)}" step="1" min="0">
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-12">
                    <label>Other Penalty Note (Max 250 characters)</label>
                    <textarea
                        name="other_penalty_note"
                        class="form-control"
                        rows="6"
                        maxlength="250"
                        placeholder=""
                    >${data.other_penalty_note || ''}</textarea>

                </div>
            </div>



            <hr>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Salary
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </form>
    `;

    $('#editSalaryModal .modal-body').html(formHtml);
}

// Handle form submission
$(document).on('submit', '#editSalaryForm', function(e) {
    e.preventDefault();

    let formData = $(this).serialize();

    // Show loading on button
    let submitBtn = $(this).find('button[type="submit"]');
    let originalText = submitBtn.html();
    submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Updating...').prop('disabled', true);

    $.ajax({
        url: '{{ url("salary") }}/' + currentSalaryId,
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                $('#editSalaryModal').modal('hide');
                 displaySuccessMessage(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1500);


                // Reload the table
                if (typeof salaryDetailsTable !== 'undefined') {
                    salaryDetailsTable.ajax.reload();
                } else {
                    location.reload();
                }
            } else {
                toastr.error(response.message || 'Update failed');
                submitBtn.html(originalText).prop('disabled', false);
            }
        },
        error: function(xhr) {
            let message = xhr.responseJSON?.message || 'Error updating salary';
            toastr.error(message);
            submitBtn.html(originalText).prop('disabled', false);
        }
    });
});

   // View Salary Modal
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
        url: '{{ url("salary") }}/' + viewId,
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
    let attendencePenalty = parseFloat(data.attendece_penalty) || 0;
    let otherPenalty = parseFloat(data.other_penalty) || 0;
    let tax = parseFloat(data.tax) || 0;
    let commission = parseFloat(data.commission) || 0;
    let eid_bonus = parseFloat(data.eid_bonus) || 0;

    let totalEarnings = basic + houseRent + taDa + medical + overtime + commission + eid_bonus;
    let totalDeductions = leavePenalty + absentPenalty + attendencePenalty + otherPenalty + tax;
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
                    <div class="col-md-6">
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

                         ${attendencePenalty > 0 ? `
                        <tr>
                            <td class="text-danger">Attendance Penalty</td>
                            <td class="text-right">- ${formatNumber(attendencePenalty)}</td>
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

                        ${(leavePenalty > 0 || absentPenalty > 0 || attendencePenalty > 0 || otherPenalty > 0 || tax > 0) ? '' : `
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
    // return parseFloat(num || 0).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
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
    // $('.view-salary').on('click', function() {
    //     currentSalaryId = $(this).data('id');
    //     $('#viewSalaryModal').modal('show');
    // });
    // Edit Salary Modal
    // $('.edit-salary').on('click', function() {
    //     currentSalaryId = $(this).data('id');
    //     console.log(currentSalaryId);
    //     $('#editSalaryModal').modal('show');
    // });

    // Change Status Modal
    $('.change-status').on('click', function() {
        currentSalaryId = $(this).data('id');
        $('#changeStatusModal').modal('show');
    });

    // Confirm Change Status
    $('#confirmChangeStatus').on('click', function() {
        if (currentSalaryId) {
            $.ajax({
                url: '/salary/' + currentSalaryId + '/change-status',
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

    // Delete Modal
    $('.delete-salary').on('click', function() {
        currentSalaryId = $(this).data('id');
        $('#deleteSalaryModal').modal('show');
    });

    // Confirm Delete
    $('#confirmDelete').on('click', function() {
        if (currentSalaryId) {
            $.ajax({
                url: '/salary/' + currentSalaryId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#deleteSalaryModal').modal('hide');
                        displaySuccessMessage(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        displayErrorMessage(response.message);
                    }
                },
                error: function() {

                    displayErrorMessage('Cannot Delete Paid Salary.');
                }
            });
        }
    });
  $('.mark-all-paid').on('click', function() {
    var currentYear = {{ $year }};
    var currentMonth = {{ $month_not_formated }};
    // console.log(currentYear);
    // console.log(currentMonth);
        $('#markAllPaidModal').modal('show');
    });

    $('.mark-all-due').on('click', function() {
        $('#markAllDueModal').modal('show');
    });

    $('.delete-all').on('click', function() {
        $('#deleteAllModal').modal('show');
    });
     // Mark All Paid
    $('#confirmMarkAllPaid').on('click', function() {
         var currentYear = {{ $year }};
        var currentMonth = {{ $month_not_formated }};
        $.ajax({
            url: '/salary/mark-all-paid/' + currentYear + '/' + currentMonth,
            type: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#markAllPaidModal').modal('hide');
                    displaySuccessMessage(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    displayErrorMessage(response.message);
                }
            },
            error: function() {
                displayErrorMessage('Error marking all as paid');
            }
        });
    });

    // Mark All Due
    $('#confirmMarkAllDue').on('click', function() {
        var currentYear = {{ $year }};
        var currentMonth = {{ $month_not_formated }};
        $.ajax({
            url: '/salary/mark-all-due/' + currentYear + '/' + currentMonth,
            type: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#markAllDueModal').modal('hide');
                    displaySuccessMessage(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    displayErrorMessage(response.message);
                }
            },
            error: function() {
                displayErrorMessage('Error marking all as due');
            }
        });
    });

    // Delete All
    $('#confirmDeleteAll').on('click', function() {
        var currentYear = {{ $year }};
        var currentMonth = {{ $month_not_formated }};
        $.ajax({
            url: '/salary/delete-all/' + currentYear + '/' + currentMonth,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#deleteAllModal').modal('hide');
                    displaySuccessMessage(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    displayErrorMessage(response.message);
                }
            },
            error: function() {
                displayErrorMessage('Cannot delete salaries. Some salaries are already marked as paid');
            }
        });
    });
});
</script>
@endsection
