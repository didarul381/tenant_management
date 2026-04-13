@extends('layouts.app')
@section('title')
    {{ __('messages.job-type.type') }}
@endsection
@section('css')
    @livewireStyles
@endsection
@section('content')
    <section class="section">
        @include('flash::message')
        <div class="section-header">
            <h1 class="page__heading">{{ __('messages.job-type.type') }}</h1>
            <div class="filter-container section-header-breadcrumb">
                <div class="ml-auto">
                    <a href="#" class="btn btn-primary addType" data-toggle="modal"
                       data-target="#addTypeModal" id="type_modal">{{ __('messages.job-type.new_type') }} <i
                                class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @livewire('job-types')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('job-type.modal')
        @include('job-type.edit_modal')
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/livewire/livewire.js') }}"></script>
    @include('livewire.livewire-turbo')
    <script>
        let newType = "{{ __('messages.job-type.new_type') }}";
    </script>
    <script src="{{ mix('assets/js/job-type/job-type.js') }}"></script>
@endsection

