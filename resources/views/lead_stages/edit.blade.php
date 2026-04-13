@extends('layouts.app')

@section('title')
    {{ __('messages.lead_stages.edit_lead_stage') }}
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
@endsection

@section('content')
    <section class="section">
        @include('flash::message')
        <div class="section-header">
            <h1 class="page__heading">{{ __('messages.lead_stages.edit_lead_stage') }}</h1>
            <div class="filter-container section-header-breadcrumb justify-content-end">
                <a class="btn btn-light ml-1" href="{{ route('lead-stages.index') }}">
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
                            {{ Form::model($leadStage, [
                                'route' => ['lead-stages.update', $leadStage->id],
                                'method' => 'put',
                                'class' => 'lead-stage-form'
                            ]) }}

                             @include('lead_stages.fields')

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
@endsection

@section('scripts')
    <script src="{{ mix('assets/js/lead_stages/lead_stage.js') }}"></script>
@endsection
