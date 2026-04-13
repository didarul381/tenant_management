@extends('layouts.app')

@section('title')
    {{ __('messages.leads.bulk_upload') }}
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
@endsection

@section('content')
<section class="section">
    @include('flash::message')

    <div class="section-header">
        <h1 class="page__heading">{{ __('messages.leads.bulk_upload') }}</h1>
        <div class="section-header-breadcrumb ml-auto">
            <a href="{{ route('leads.create') }}" class="btn btn-primary mr-2">
                <i class="fas fa-plus"></i> {{ __('messages.leads.new_lead') }}
            </a>
            <a href="{{ route('leads.index') }}" class="btn btn-light">
                <i class="fas fa-list"></i> {{ __('messages.leads.list_view') }}
            </a>
        </div>
    </div>

    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.errors')
                        {{-- Download Template --}}
                        <div class="mb-3 text-right">
                            <a href="{{ route('bulk-upload.template') }}" class="btn btn-success">
                                <i class="fas fa-download"></i> {{ __('messages.leads.download_template') }}
                            </a>
                        </div>

                        {{-- Upload Form --}}
                        {{ Form::open(['route' => 'bulk-upload.import', 'files' => true, 'method' => 'post']) }}
                            <div class="form-group">
                                {{ Form::label('file', __('messages.leads.upload_file').':') }}
                                {{ Form::file('file', ['class' => 'form-control', 'required', 'accept' => '.xlsx,.csv']) }}
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">
                                <i class="fas fa-upload"></i> {{ __('messages.leads.upload') }}
                            </button>
                        {{ Form::close() }}

                        <p class="text-muted mt-3">
                            {{ __('messages.leads.bulk_upload_instruction', ['example' => 'first_name, last_name, email, phone, etc.']) }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
