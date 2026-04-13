@extends('layouts.app')
@section('title')
    {{ __('messages.salary.salary') }}
@endsection
@section('css')
   
@endsection

@section('content')
<section class="section">
     <div class="section-header leave-header-section">
        <h1 class="page__heading">{{ __('messages.salary.salary') }}</h1>
        <div class="filter-container section-header-breadcrumb row justify-content-md-end">

            {{-- Filter Dropdown --}}
            <div class="pl-sm-3 py-1">
                
            </div>

            {{-- Action Button --}}
           
            <div class="pl-sm-3 pr-sm-3 pl-2 pr-2 py-1 leave-action">
                
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#generateSalaryModal">
                    <i class="fas fa-plus"></i> {{ __('messages.salary.generate_salary') }}
                </button>
               
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
                        <table class="table table-striped table-hover" id="salaryTable">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.salary.sl') }}</th>
                                    <th>{{ __('messages.salary.year') }}</th>
                                    <th>{{ __('messages.salary.month') }}</th>
                                    <th>{{ __('messages.salary.payable') }}</th>
                                    <th>{{ __('messages.salary.paid') }}</th>
                                    <th>{{ __('messages.salary.due') }}</th>
                                    <th>{{ __('messages.common.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
    

    <!-- Generate Salary Modal -->
    <div class="modal fade" id="generateSalaryModal" tabindex="-1" role="dialog" aria-labelledby="generateSalaryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="generateSalaryModalLabel">{{ __('messages.salary.generate_salary') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="generateSalaryForm">
                        @csrf
                        <div class="row">
                           @php
                            $prevMonth = date('n') == 1 ? 12 : date('n') - 1;
                            $currentYear = date('Y');
                            $prevYear = date('n') == 1 ? $currentYear - 1 : $currentYear;
                            @endphp

                            <div class="form-group col-md-6">
                                {{ Form::label('year', __('messages.salary.year')) }}
                                <span class="required">*</span>
                                {{ Form::select('year', array_combine(range($currentYear, 2020), range($currentYear, 2020)), $prevYear, [
                                    'id' => 'year',
                                    'class' => 'form-control',
                                    'required'
                                ]) }}
                            </div>

                            <div class="form-group col-md-6">
                                {{ Form::label('month', __('messages.salary.month')) }}
                                <span class="required">*</span>
                                {{ Form::select('month', [
                                    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                                    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                                    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                                ], $prevMonth, [
                                    'id' => 'month',
                                    'class' => 'form-control',
                                    'required'
                                ]) }}
                            </div>

                             <div class="form-group col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="includeLateUnknownPenalty" name="include_late_unknown_penalty" value="1">
                                    <label class="custom-control-label" for="includeLateUnknownPenalty">Include Late/Unknown Penalty</label>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="includeEidBonus" name="include_eid_bonus" value="1">
                                    <label class="custom-control-label" for="includeEidBonus">Include EID Bonus (50% of Net Salary)</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="generateSalaryBtn">{{ __('messages.salary.generate') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
        $(document).ready(function() {
            var salaryTable = $('#salaryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('salary.index') }}',
                    type: 'GET',
                    data: function(data) {
                        data._token = '{{ csrf_token() }}';
                    }
                },
                columns: [
                     { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'year', name: 'year' },
                    { data: 'month', name: 'month' },
                    { data: 'total_payable', name: 'total_payable', render: function(data) { return Math.round(data); } },
                    { data: 'total_paid', name: 'total_paid', render: function(data) { return Math.round(data); } },
                    { data: 'total_due', name: 'total_due', render: function(data) { return Math.round(data); } },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                order: [[1, 'desc'], [2, 'desc']]
            });

            $('#generateSalaryBtn').on('click', function() {
                $('#generateSalaryForm').submit();
            });

            $('#generateSalaryForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serializeArray();
                
                $.ajax({
                    url: '{{ route('salary.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function(result) {
                        if (result.success) {
                            $('#generateSalaryModal').modal('hide');
                            salaryTable.ajax.reload();
                            displaySuccessMessage(result.message);
                        } else {
                            displayErrorMessage(result.message);
                        }
                    },
                    error: function(result) {
                         if (result.responseJSON && result.responseJSON.message) {
                            var message = result.responseJSON.message;
                            displayErrorMessage(message);
                        }
                        manageAjaxErrors(result);
                    }
                });
            });
        });
    </script>
@endsection

