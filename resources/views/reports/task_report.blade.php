@extends('layouts.app')
@section('title')
    {{ __('Task Report') }}
@endsection

@section('page_css')
    <style>
        .chart-wrapper {
        position: relative;
        width: 100% !important;
        max-width: 280px;   /* control width */
        margin: 0 auto;
    }

    .chart-wrapper canvas {
        width: 100% !important;
        height: auto !important;
    }

    .custom-height {
        max-height: 450px;
        overflow-y: auto;
    }

    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style/css/tasks.css') }}">
@endsection

@section('css')
    @livewireStyles
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1 class="d-flex align-items-center mb-0">
            {{ __('Task Report') }}
            <span id="taskUserCountBadge" class="badge badge-primary ml-2" style="display:none;">
                0
            </span>
        </h1>
       <div class="filter-container section-header-breadcrumb d-block d-md-flex">

            <div class="mr-3 align-items-center" style="min-width: 250px;">
                <label><b>{{ __('Employee') }}</b></label>
                {{ Form::select('drp_user', $users, null, ['id'=>'filter_user', 'class'=>'form-control min-width-200', 'placeholder' => __('All')]) }}
            </div>
             <div class="mr-3 align-items-center" style="min-width: 250px;">
               <label><b>{{ __('Date Range') }}</b></label>
                <input type="text" id="filter_date_range" class="form-control min-width-250" placeholder="{{ __('Select Date Range') }}">
             </div>

              <a class="mt-4 mr-1 btn btn-primary" id="resetFilters">{{ __('Reset') }}</a>
              <div class="dropdown d-inline-block">
                <button class="mt-4 btn btn-primary dropdown-toggle" type="button" id="cardActionsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('Collapse All') }}
                </button>
                <div class="dropdown-menu" aria-labelledby="cardActionsDropdown">
                    <a class="dropdown-item active" href="#" id="collapseAll">{{ __('Collapse All') }}</a>
                     <a class="dropdown-item" href="#" id="expandAll">{{ __('Expand All') }}</a>
                </div>
            </div>
            {{-- <div class="pl-sm-3 py-1">
                <div class="dropdown">
                    <a class="dropdown-toggle btn btn-primary" href="#" data-toggle="dropdown"
                       title="{{ __('Filter') }}" id="filter_toggle">
                       <i class="fas fa-filter"></i>
                    </a>
                    <div class="dropdown-menu dropdown-large dropdown-menu-right p-3">
                        <div class="row mb-2">
                            <div class="form-group col-sm-6">
                                <a class="btn btn-primary" id="resetFilters">{{ __('Reset') }}</a>
                            </div>
                            <div class="form-group col-sm-6 text-right">
                                <button type="button" class="close outline-none">×</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ __('Employee') }}</b></label>
                                {{ Form::select('drp_user', $users, null, ['id'=>'filter_user', 'class'=>'form-control min-width-150', 'placeholder' => __('All')]) }}
                            </div>

                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ __('Date Range') }}</b></label>
                                <input type="text" id="filter_date_range" class="form-control" placeholder="{{ __('Select Date Range') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            {{-- Task cards will be dynamically rendered here by JS --}}
            <div class="col-12 text-center">
                <p>{{ __('Loading tasks...') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page_js')
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
@endsection

@section('scripts')
<script src="{{ asset('vendor/livewire/livewire.js') }}"></script>
@include('livewire.livewire-turbo')
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
<script src="{{ mix('assets/js/report/task_report.js') }}"></script>
@endsection
