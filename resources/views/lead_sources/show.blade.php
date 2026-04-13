@extends('layouts.app')

@section('title')
    {{ __('messages.lead_sources.lead_source') }} {{ __('messages.common.details') }}
@endsection

@section('page_css')
    {{-- Add any CSS needed --}}
@endsection

@section('content')
    <section class="section">
        @include('flash::message')

        <div class="section-header">
            <h1 class="page__heading">{{ __('messages.lead_sources.lead_source') }} {{ __('messages.common.details') }}</h1>
            <div class="filter-container section-header-breadcrumb justify-content-end">
                <a href="{{ route('lead-sources.edit', $leadSource->id) }}"
                   class="btn btn-primary filter-container__btn mr-2 report-action-btn">
                    {{ __('messages.common.edit') }}
                </a>
                <a href="{{ route('lead-sources.index') }}" class="btn btn-light ml-1 report-action-btn">
                    {{ __('messages.common.back') }}
                </a>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @include('flash::message')

                            @include('lead_sources.show_fields')

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
    <script src="{{ mix('assets/js/lead_sources/lead_source.js') }}"></script>
@endsection
