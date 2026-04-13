@extends('layouts.app')

@section('title')
    {{ __('messages.absents.absents') }}
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style/css/tasks.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="section-header leave-header-section">
        <h1 class="page__heading">{{ __('messages.absents.absents') }}</h1>
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
                                <a class="btn btn-primary" id="resetFilters">{{ __('messages.absents.reset') }}</a>
                            </div>
                            <div class="form-group col-sm-6 d-flex justify-content-end">
                                <button type="button" aria-label="Close" class="close outline-none">×</button>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Employee --}}
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ __('messages.absents.employee') }}</b></label>
                                {{ Form::select('drp_user', $users, auth()->user()->hasRole('Admin') ? null : auth()->id(), ['id'=>'filter_user', 'class'=>'form-control min-width-150', 'placeholder' => auth()->user()->hasRole('Admin') ? __('messages.common.all') : false]) }}
                            </div>

                            {{-- Status --}}
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ __('messages.absents.status') }}</b></label>
                                {{ Form::select('drp_status', $statuses, null, ['id'=>'filter_status', 'class'=>'form-control min-width-150', 'placeholder' => __('messages.common.all')]) }}
                            </div>

                            {{-- Date Range --}}
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <label><b>{{ __('messages.absents.date_range') }}</b></label>
                                <input type="text" id="filter_date_range" class="form-control" placeholder="{{ __('messages.absents.date_range') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Button --}}
           
            <div class="pl-sm-3 pr-sm-3 pl-2 pr-2 py-1 leave-action">
                 @if (auth()->user()->hasRole('Admin'))
                <a class="btn btn-primary" href="{{ route('absents.create') }}">
                    <i class="fas fa-plus"></i> {{ __('messages.absents.new_absent') }}
                </a>
                @else
                 <a class="btn btn-primary disabled"
                    style="pointer-events: none; opacity: 0.6;">
                        <i class="fas fa-plus"></i> {{ __('messages.absents.new_absent') }}
                 </a>
                @endif
            </div>
          

        </div>
    </div>

    <div class="section-body">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        @include('absents.table') {{-- DataTable partial --}}
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
    <script src="{{ mix('assets/js/absents/absents.js') }}"></script>
@endsection
