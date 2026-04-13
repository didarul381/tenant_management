@extends('layouts.app')

@section('title')
    {{ __('messages.leads.edit_lead') }}
@endsection

@section('page_css')
<link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
@endsection

@section('content')
<section class="section">
    @include('flash::message')
    <div class="section-header">
        <h1 class="page__heading">{{ __('messages.leads.edit_lead') }}</h1>
        <div class="filter-container section-header-breadcrumb justify-content-end">
            <a class="btn btn-light ml-1" href="{{ route('leads.index') }}">
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

                        {{ Form::model($lead, [
                            'route' => ['leads.update', $lead->id],
                            'method' => 'put',
                            'class' => 'lead-form'
                        ]) }}

                        @include('leads.fields')

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
<script src="{{ mix('assets/js/leads/leads.js') }}"></script>
@endsection
