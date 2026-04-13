@extends('layouts.app')

@section('title')
    {{ __('messages.leads.kanban_list') }}
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style/css/tasks.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/style/css/task-details-kanban.css') }}">
@endsection

@section('css')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('assets/css/dragula.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/style/css/kanban.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/style/css/task-details-kanban.css') }}">
    <style>
   
   

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #6c63ff;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
        margin-right: 10px;
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .menu {
        cursor: pointer;
        font-size: 18px;
        position: relative;
    }

    .menu-content {
        display: none;
        position: absolute;
        right: 0;
        top: 24px;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
        z-index: 10;
        min-width: 8rem;
    }

    .menu-content a {
        display: block;
        padding: 5px 16px;
        font-size: 14px;
        color: #333;
        text-decoration: none;
    }

    .menu-content a:hover {
        background: #f0f0f0;
    }

    .menu-content .delete {
        color: #ff4d4f;
    }

    .menu-content .convert {
        color: #6c63ff;
    }

    .leads-kanban-wrp .card {
        background-clip: border-box;
        border: 0 solid #d9dee3;
        border-radius: 0.5rem;
    }

    .card-body h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }

    .card-body p {
        margin: 4px 0;
        font-size: 14px;
        color: #555;
    }

    .card-body .contact {
        display: flex;
        align-items: center;
        font-size: 14px;
        color: #555;
        margin-top: 6px;
    }

    .card-body .contact span {
        margin-left: 6px;
        color: #3498db;
    }
    .bg-label-info {
        background-color: #d7f5fc !important;
        color: #03c3ec !important;
    }

</style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
           <h1 class="page__heading">{{ __('messages.leads.kanban_list') }}</h1>
            <div class="section-header-breadcrumb justify-content-end">
                <div class="filter-container section-header-breadcrumb row justify-content-md-end align-items-center">
                    
                    {{-- Filter Dropdown --}}
                    <div class="pl-sm-3 py-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle btn btn-primary" href="#" data-toggle="dropdown"
                               title="{{ __('messages.common.filter') }}" id="filter_toggle">
                                <i class="fas fa-filter"></i>
                            </a>
                            <div class="dropdown-menu dropdown-large dropdown-menu-right p-3">
                                {{-- Reset + Close --}}
                                <div class="row mb-2">
                                    <div class="form-group col-sm-6 d-flex justify-content-start">
                                        <a class="btn btn-primary" id="resetFilters">{{ __('messages.leads.reset') }}</a>
                                    </div>
                                    <div class="form-group col-sm-6 d-flex justify-content-end">
                                        <button type="button" aria-label="Close" class="close outline-none">×</button>
                                    </div>
                                </div>

                                {{-- Filters --}}
                                <div class="row">
                                    {{-- Lead Stage --}}
                                    <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                        <label><b>{{ __('messages.leads.stage') }}</b></label>
                                        {{ Form::select('drp_stage', $stages, null, ['id'=>'filter_stage', 'class'=>'form-control min-width-150', 'placeholder' => __('messages.common.all')]) }}
                                    </div>

                                    {{-- Lead Source --}}
                                    <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                        <label><b>{{ __('messages.leads.source') }}</b></label>
                                        {{ Form::select('drp_source', $sources, null, ['id'=>'filter_source', 'class'=>'form-control min-width-150', 'placeholder' => __('messages.common.all')]) }}
                                    </div>

                                    {{-- Assigned User --}}
                                    <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                        <label><b>{{ __('messages.leads.assigned_to') }}</b></label>
                                        {{ Form::select('drp_user', $users, null, ['id'=>'filter_user', 'class'=>'form-control min-width-150', 'placeholder' => __('messages.common.all')]) }}
                                    </div>
                                </div>

                                {{-- Date Range + Sort --}}
                                <div class="row mt-3">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                        <label><b>{{ __('messages.leads.date_range') }}</b></label>
                                        <input type="text" id="filter_date_range" class="form-control" placeholder="{{ __('messages.leads.date_range') }}">
                                    </div>
                                       
                                    <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                        <label><b>{{ __('messages.leads.select_follow_up_date') }}</b></label>
                                        <input type="text" id="filter_follow_up_date" 
                                            class="form-control" 
                                            placeholder="{{ __('messages.leads.select_follow_up_date') }}">
                                    </div>
                            
                                    <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                        <label><b>{{ __('messages.common.sort_by') }}</b></label>
                                        {{ Form::select('drp_sort', [
                                            'newest' => __('messages.common.newest'),
                                            'oldest' => __('messages.common.oldest'),
                                            'recently-updated' => __('messages.common.recently_updated'),
                                            'earliest-updated' => __('messages.common.earliest_updated')
                                        ], null, [
                                            'id' => 'sort',
                                            'class' => 'form-control min-width-150',
                                            'placeholder' => __('messages.common.select_sort')
                                        ]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Switch to List View --}}
                    <div class="pl-sm-3 py-1">
                        <a href="{{ route('leads.index') }}" class="btn btn-warning" title="{{ __('messages.common.list_view') }}" data-toggle="tooltip">
                            <i class="fa fa-list font-size-20px"></i>
                        </a>
                    </div>

                    {{-- Add New Lead --}}
                    <div class="pl-sm-3 py-1">
                        <a href="{{ route('leads.create') }}" class="btn btn-primary" title="{{ __('messages.leads.new_lead') }}" data-toggle="tooltip">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="col-12">
                    <div class="row flex-nowrap pt-3 overflow-auto board-container">
                        <div class="lock-board"></div>
                        @livewire('lead-kanban')
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
    <script src="{{ asset('vendor/livewire/livewire.js') }}"></script>
    @include('livewire.livewire-turbo')
    <script>
        let leadUrl = '{{ url('leads') }}';
        let loginUserRole = "{{ getLoggedInUser()->hasRole('Admin') ? true : false}}";
        let authUserId = "{{ getLoggedInUserId() }}";
        let currentLoggedInUserId = "{{ getLoggedInUserId() }}";
    </script>
    <script src="{{ mix('assets/js/dom-autoscroller.js') }}"></script>
    <script src="{{ mix('assets/js/dragula.js') }}"></script>
    <script src="{{ mix('assets/js/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/leads/kanban.js') }}"></script>
   

@endsection
