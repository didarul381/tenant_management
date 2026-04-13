@extends('layouts.app')
@section('title')
    {{ __('messages.job-status.status') }}
@endsection
@section('css')
    @livewireStyles
@endsection
@section('content')
    <section class="section">
        @include('flash::message')
        <div class="section-header">
            <h1 class="page__heading">{{ __('messages.job-status.status') }}</h1>
            <div class="filter-container section-header-breadcrumb">
                <div class="ml-auto">
                    <a href="#" class="btn btn-primary addStatus" data-toggle="modal"
                       data-target="#addStatusModal" id="status_modal">{{ __('messages.job-status.new_status') }} <i
                                class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @livewire('job-statuses')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('job-status.modal')
        @include('job-status.edit_modal')
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/livewire/livewire.js') }}"></script>
    @include('livewire.livewire-turbo')
    <script>
        let newStatus = "{{ __('messages.job-status.new_status') }}";
    </script>
    <script src="{{ mix('assets/js/job-status/job-status.js') }}"></script>
@endsection

