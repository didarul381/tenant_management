@extends('layouts.app')
@section('title', 'Call Records')
@section('page_css')
<style>
   
   @media (min-width: 1440px) {
   .dropdown-large {
   min-width: 800px !important;
   }
   }
   #htmlTableInput {
    height: 200px;
    overflow: auto;
}
.c-fs16{
   font-size: 16px !important;
}
</style>
<link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
@endsection
@section('content')
<section class="section">
   <div class="section-header d-flex justify-content-between align-items-center">
      <!-- Left side: Title -->
      <h1 class="page-heading mb-0">Call Records</h1>
      <!-- Right side: Filters + Import -->
      <div class="d-flex align-items-center">
         {{-- Filter Dropdown --}}
         <div class="pl-3">
            <div class="dropdown">
               <a class="btn btn-primary dropdown-toggle" href="#" data-toggle="dropdown" title="{{ __('messages.common.filter') }}" id="filter_toggle">
               <i class="fas fa-filter"></i>
               </a>
               <div class="dropdown-menu dropdown-large dropdown-menu-right p-3">
                  <div class="row mb-2">
                     <div class="col d-flex justify-content-start">
                        <a class="btn btn-primary" id="resetFilters">{{ __('messages.reset') }}</a>
                     </div>
                     <div class="col d-flex justify-content-end">
                        <button type="button" class="close outline-none" aria-label="Close">×</button>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-lg-4">
                        <label><b>Employee Name</b></label>
                        <select id="filter_employee_name" class="form-control">
                           <option value="">All</option>
                           @foreach($employees as $id => $name)
                           <option value="{{ $name }}">{{ $name }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group col-lg-4">
                        <label><b>Status</b></label>
                        <select id="filter_status" class="form-control">
                           <option value="">All</option>
                           <option value="ANSWERED">ANSWERED</option>
                           <option value="BUSY">BUSY</option>
                           <option value="NO ANSWER">NO ANSWER</option>
                        </select>
                     </div>
                     <div class="form-group col-lg-4">
                        <label><b>Call Date</b></label>
                        <input type="text" id="filter_call_date" class="form-control" placeholder="Call Date">
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="form-group col-lg-4">
                        <label><b>Created At</b></label>
                        <input type="text" id="filter_created_at" class="form-control" placeholder="Created Date">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         {{-- Import Button --}}
         <div class="pl-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#importModal">
            <i class="fa fa-upload"></i> Import Records
            </button>
         </div>
      </div>
   </div>
   <div class="section-body">
      <div class="card">
         <div class="card-body">
            <div class="row mb-4">
               <div class="col-lg-2 col-md-6">
                   <div class="card bg-primary text-white">
                       <div class="card-body">
                           <h5  class="c-fs16">Total Answered</h5>
                           <h2 id="card_answered">{{ $summary['ANSWERED'] ?? 0 }}</h2>
                       </div>
                   </div>
               </div>
               <div class="col-lg-2 col-md-6">
                   <div class="card bg-warning text-white">
                       <div class="card-body">
                           <h5  class="c-fs16">Total Busy</h5>
                           <h2 id="card_busy">{{ $summary['BUSY'] ?? 0 }}</h2>
                       </div>
                   </div>
               </div>
               <div class="col-lg-2 col-md-6">
                   <div class="card bg-danger text-white">
                       <div class="card-body">
                           <h5  class="c-fs16">Total No Answer</h5>
                           <h2 id="card_no_answer">{{ $summary['NO ANSWER'] ?? 0 }}</h2>
                       </div>
                   </div>
               </div>
               <div class="col-lg-2 col-md-6">
                   <div class="card bg-dark text-white">
                       <div class="card-body">
                           <h5  class="c-fs16">Total Congestion</h5>
                           <h2 id="card_no_congestion">{{ $summary['CONGESTION'] ?? 0 }}</h2>
                       </div>
                   </div>
               </div>
               <div class="col-lg-2 col-md-6">
                   <div class="card bg-success text-white">
                       <div class="card-body">
                           <h5  class="c-fs16">Total</h5>
                            <h2 id="card_totalcall">{{ $totalCalls ?? 0 }}</h2>
                       </div>
                   </div>
               </div>
               <div class="col-lg-2 col-md-6">
                   <div class="card bg-info text-white">
                       <div class="card-body">
                           <h5 class="c-fs16">Unique Numbers</h5>
                           <h2 id="card_unique">{{ $uniqueNumbers }}</h2>
                       </div>
                   </div>
               </div>
            </div>


            <!-- Call Records Table -->
            <table id="callrecords-table" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Employee Name</th>
                     <th>Company Name</th>
                     <th>Display Name</th>
                     <th>Call Date</th>
                     <th>Source</th>
                     <th>Destination</th>
                     <th>Duration</th>
                     <th>Type</th>
                     <th>Status</th>
                     <th>Recordings</th>
                     <th>Created At</th>
                     <!-- New column -->
                  </tr>
               </thead>
               <tbody></tbody>
            </table>
         </div>
      </div>
   </div>
</section>
<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Import Call Records</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <textarea id="htmlTableInput" class="form-control" rows="50" placeholder="Paste your HTML table here"></textarea>
         </div>
         <div class="modal-footer">
            <button type="button" id="importSubmit" class="btn btn-success">Submit</button>
         </div>
      </div>
   </div>
</div>
@endsection
@section('page_js')
<!-- <script src="{{ asset('assets/js/summernote.min.js') }}"></script> -->
<script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
@endsection
@section('scripts')
<script>
    var callRecordsImportUrl = "{{ route('callrecords.import') }}";
    var csrfToken = "{{ csrf_token() }}";
    let callRecordsListUrl = "{{ route('callrecords.list') }}";
    let callRecordsSummaryUrl = "{{ route('callrecords.summary') }}";
</script>
<!-- <script src="{{ mix('assets/js/custom-datatable.js') }}"></script> -->
<script src="{{ mix('assets/js/callrecords/callrecords.js') }}"></script>
@endsection