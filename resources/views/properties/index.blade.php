@extends('layouts.app')

@section('title')
    {{ __('properties.properties') }}
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style/css/tasks.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="section-header property-header-section">
        <h1 class="page__heading">{{ __('properties.properties') }}</h1>
        
        {{-- Property Statistics Summary --}}
        <div style="display: flex; gap: 20px; padding-top:14px; margin:auto;" class="">
            <p>
                <strong>Total Properties:</strong> 
                <a href="#" data-toggle="modal" data-target="#propertyStatsModal">{{ $stats['total'] ?? 0 }}</a>,
                <strong>Active/Occupied:</strong> {{ $stats['active'] ?? 0 }},
                <strong>Vacant:</strong> {{ $stats['vacant'] ?? 0 }}
                <span style="margin-left:8px;"><a href="#" data-toggle="modal" data-target="#propertyStatsModal">Summary</a></span>
            </p>
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
                                <a class="btn btn-primary" id="resetFilters">{{ __('messages.common.reset') }}</a>
                            </div>
                            <div class="form-group col-sm-6 d-flex justify-content-end">
                                <button type="button" aria-label="Close" class="close outline-none">×</button>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Filter by Owner/Manager --}}
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ __('properties.owner') }}</b></label>
                                {{ Form::select('drp_user', $users, auth()->user()->hasRole('Admin') ? null : auth()->id(), ['id'=>'filter_user', 'class'=>'form-control min-width-150', 'placeholder' => __('messages.common.all')]) }}
                            </div>

                            {{-- Filter by Status --}}
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ __('properties.status') }}</b></label>
                                {{ Form::select('drp_status', $statuses, null, ['id'=>'filter_status', 'class'=>'form-control min-width-150', 'placeholder' => __('messages.common.all')]) }}
                            </div>

                            {{-- Date Range Filter (e.g., Created On or Available From) --}}
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ __('properties.added_date') }}</b></label>
                                <input type="text" id="filter_date_range" class="form-control" placeholder="{{ __('messages.common.date_range') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- New Property Action --}}
            <div class="pl-sm-3 pr-sm-3 pl-2 pr-2 py-1 property-action">
                <a class="btn btn-primary" href="{{ route('properties.create') }}">
                    <i class="fas fa-plus"></i> {{ __('properties.new_property') }}
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
                        @include('properties.table')
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
   
   <script src="{{ mix('assets/js/properties/propertie.js') }}"></script>
    
@endsection 
