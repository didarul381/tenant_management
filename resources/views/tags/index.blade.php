@extends('layouts.app')
@section('title')
    {{ __('messages.tags') }}
@endsection
@section('css')
    @livewireStyles
@endsection
@section('content')
    <section class="section">
        @include('flash::message')
        <div class="section-header">
            <h1 class="page__heading">{{ __('messages.tags') }}</h1>
            <div class="filter-container section-header-breadcrumb">
                <form method="GET" action="{{ route('tags.index') }}">
                <div class="ml-auto d-inline-block d-flex align-items-center">
                    @if(auth()->user()->role === 'Admin')
                    <a href="#" class="btn btn-primary addBulkTags addTags mr-md-3 mr-1" onclick="setBulkTags()"
                       data-toggle="modal"
                       data-target="#AddModal">{{ __('messages.tag.bulk_tags') }} <i class="fas fa-plus"></i></a>
                    <a href="#" class="btn btn-primary addTags mr-1" data-toggle="modal"
                       data-target="#AddModal">{{ __('messages.tag.new_tag') }} <i class="fas fa-plus"></i></a>
                    @endif
                    <div class="dropdown d-inline-block ml-auto">
                        @php
                            $selectedText = 'All Departments';
                            $selectedValue = 'all';
                            if(request('department_filter') == 'non_departmental') {
                                $selectedText = 'Common';
                                $selectedValue = 'non_departmental';
                            } elseif(request('department_filter') && isset($departments[request('department_filter')])) {
                                $selectedText = $departments[request('department_filter')];
                                $selectedValue = request('department_filter');
                            }
                        @endphp
                        <input type="hidden" name="department_filter" id="department_filter_hidden" value="{{ $selectedValue }}">
                        <button class="btn btn-info dropdown-toggle" type="button" id="departmentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $selectedText }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="departmentDropdown">
                            <a class="dropdown-item {{ $selectedValue == 'all' ? 'active' : '' }}" href="#" onclick="document.getElementById('department_filter_hidden').value='all'; this.closest('form').submit();">All Departments</a>
                            <a class="dropdown-item {{ $selectedValue == 'non_departmental' ? 'active' : '' }}" href="#" onclick="document.getElementById('department_filter_hidden').value='non_departmental'; this.closest('form').submit();">Common</a>
                            @foreach($departments as $id => $name)
                                <a class="dropdown-item {{ $selectedValue == $id ? 'active' : '' }}" href="#" onclick="document.getElementById('department_filter_hidden').value='{{ $id }}'; this.closest('form').submit();">{{ $name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <!-- Status Filter Dropdown -->
                    <div class="dropdown d-inline-block ml-2">
                        @php
                            $statusSelectedText = 'All Status';
                            $statusSelectedValue = 'all';
                            if(request('status_filter') == '1') {
                                $statusSelectedText = 'Active';
                                $statusSelectedValue = '1';
                            } elseif(request('status_filter') == '0') {
                                $statusSelectedText = 'Inactive';
                                $statusSelectedValue = '0';
                            }
                        @endphp
                        <input type="hidden" name="status_filter" id="status_filter_hidden" value="{{ $statusSelectedValue }}">
                        <button class="btn btn-info dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $statusSelectedText }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="statusDropdown">
                            <a class="dropdown-item {{ $statusSelectedValue == 'all' ? 'active' : '' }}" href="#" onclick="document.getElementById('status_filter_hidden').value='all'; this.closest('form').submit();">All Status</a>
                            <a class="dropdown-item {{ $statusSelectedValue == '1' ? 'active' : '' }}" href="#" onclick="document.getElementById('status_filter_hidden').value='1'; this.closest('form').submit();">Active</a>
                            <a class="dropdown-item {{ $statusSelectedValue == '0' ? 'active' : '' }}" href="#" onclick="document.getElementById('status_filter_hidden').value='0'; this.closest('form').submit();">Inactive</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @livewire('tags')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('tags.modal')
        @include('tags.edit_modal')
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/livewire/livewire.js') }}"></script>
    @include('livewire.livewire-turbo')
    <script>
        let addBulkTag = "{{ __('messages.tag.add_bulk_tag') }}";
        let newTag = "{{ __('messages.tag.new_tag') }}";
    </script>
    <script src="{{ mix('assets/js/tags/tag.js') }}"></script>
@endsection

