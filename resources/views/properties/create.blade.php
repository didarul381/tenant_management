@extends('layouts.app')

@section('title')
    {{ __('properties.new_property') }}
@endsection

@section('page_css')
    {{-- Properties often use image galleries or maps; daterangepicker is kept if you have an 'Available Date' --}}
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
@endsection

@section('content')
<section class="section">
    @include('flash::message')
    <div class="section-header">
        <h1 class="page__heading">{{ __('properties.new_property') }}</h1>
        <div class="filter-container section-header-breadcrumb justify-content-end">
            <a class="btn btn-light ml-1" href="{{ route('properties.index') }}">
                {{ __('messages.common.back') }}
            </a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.errors')
                        {{-- Updated route to properties.store --}}
                        {{ Form::open(['route' => 'properties.store', 'method' => 'post', 'class' => 'property-form', 'enctype' => 'multipart/form-data']) }}
                        
                        {{-- Updated include path for property fields --}}
                        @include('properties.fields')

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page_js')
<script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
{{-- Updated to point to property-specific JavaScript --}}
 <script src="{{ mix('assets/js/properties/propertie.js') }}"></script>
@endsection

@section('scripts')
{{-- Add any property-specific initialization here, like Google Maps for location --}}
@endsection