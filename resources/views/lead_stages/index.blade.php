@extends('layouts.app')

@section('title')
    {{ __('messages.lead_stages.lead_stages') }}
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="page__heading">{{ __('messages.lead_stages.lead_stages') }}</h1>
            <div class="filter-container section-header-breadcrumb d-block d-md-flex">
                <a href="{{ route('lead-stages.create') }}" class="btn btn-primary mt-4 filter-container__btn float-right">
                    {{ __('messages.lead_stages.new_lead_stage') }} <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>

        <div class="section-body">
            @include('flash::message')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @include('lead_stages.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page_js')
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
@endsection

@section('scripts')
    <script src="{{ mix('assets/js/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/lead_stages/lead_stage.js') }}"></script>
@endsection
