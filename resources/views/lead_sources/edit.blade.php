@extends('layouts.app')

@section('title')
    {{ __('messages.lead_sources.edit_lead_source') }}
@endsection

@section('page_css')
    {{-- Add any CSS needed for this page --}}
@endsection

@section('content')
    <section class="section">
        @include('flash::message')
        <div class="section-header">
            <h1 class="page__heading">{{ __('messages.lead_sources.edit_lead_source') }}</h1>
            <div class="filter-container section-header-breadcrumb justify-content-end">
                <a class="btn btn-light ml-1" href="{{ route('lead-sources.index') }}">
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
                            @include('layouts.errors')

                            {{ Form::model($leadSource, [
                                'route' => ['lead-sources.update', $leadSource->id],
                                'method' => 'put',
                                'class' => 'lead-source-form'
                            ]) }}

                               <div class="alert alert-danger display-none" id="validationErrorsBox"></div>

                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        {{ Form::label('name', __('messages.lead_sources.name').':') }}<span class="required">*</span>
                                        {{ Form::text('name', isset($leadSource->name) ? $leadSource->name : null, [
                                            'class' => 'form-control',
                                            'id' => 'name',
                                            'required',
                                            'placeholder' => __('messages.lead_sources.name')
                                        ]) }}
                                    </div>

                                    <div class="form-group col-sm-12">
                                        {{ Form::label('description', __('messages.lead_sources.description').':') }}
                                        {{ Form::textarea('description', isset($leadSource->description) ? $leadSource->description : null, [
                                            'class' => 'form-control',
                                            'id' => 'description',
                                            'rows' => 3,
                                            'placeholder' => __('messages.lead_sources.description')
                                        ]) }}
                                    </div>

                                    <!-- Submit Field -->
                                    <div class="form-group col-sm-12 mt-2">
                                        {{ Form::button(__('messages.common.save'), [
                                            'type' => 'submit',
                                            'class' => 'btn btn-primary save-btn',
                                            'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."
                                        ]) }}
                                        <a href="{{ route('lead-sources.index') }}" class="btn btn-light ml-1">{{ __('messages.common.cancel') }}</a>
                                    </div>
                                </div>



                            {{ Form::close() }}

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
