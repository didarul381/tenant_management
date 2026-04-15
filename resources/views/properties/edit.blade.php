@extends('layouts.app')

@section('title')
    {{ __('properties.edit_property') }}
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
@endsection

@section('content')
<section class="section">
    @include('flash::message')

    <div class="section-header">
        <h1 class="page__heading">{{ __('properties.edit_property') }}</h1>
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

                        {{-- Bind the $property model to the form --}}
                        {{ Form::model($property, [
                            'route' => ['properties.update', $property->id],
                            'method' => 'put',
                            'class' => 'property-form',
                            'enctype' => 'multipart/form-data'
                        ]) }}

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
      <script src="{{ mix('assets/js/properties/propertie.js') }}"></script>
@endsection

@section('scripts')
{{-- Include property-specific logic if needed --}}
<script>
$(document).ready(function() {
    // Logic for property-specific interactions (e.g., dynamic tax calculations or deposit logic) 
    // can be placed here if it's not in the external properties.js file.
});
</script>
@endsection