@extends('layouts.app')

@section('title')
    {{ __('messages.lead') }}
@endsection
@section('page_css')
    <style>
        .lead-stage-dropdown>option {
            background: #fff !important;
            color: #555 !important;
        }
        .big-checkbox {
            transform: scale(1.2);
        }
        .lead-stage-dropdown {
           height: 35px !important;                      
           padding: 0 5px 0 5px !important;           
        }
        .drawer {
           display: none;
           position: fixed;
           top: 70px;
           right: -100%;
           width: 650px;
           height: 100%; 
           background: #fff;
           box-shadow: -2px 0 8px rgba(0,0,0,0.3);
           transition: right 0.7s ease-in-out, top 0.7s ease-in-out; /* 👈 ADD THIS */
           display: flex;
           flex-direction: column;
           overflow-y: auto;
           z-index: 1060 !important;
        }
        .drawer.open {
          display: block;
          right: 0;
        }
        .drawer.scrolled {
             top: 0;
        }
        .drawer-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 1rem;
          border-bottom: 1px solid #dee2e6;
        }
        .drawer-body {
           padding: 1rem;
           flex: 1;   
           z-index: 1060 !important;
        }
        .drawer::-webkit-scrollbar {
         width: 6px !important;
        }
        .btn.bg-h:hover {
            background-color: transparent !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style/css/tasks.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/style/css/task-details-kanban.css') }}">
@endsection
@section('css')
    @livewireStyles
@endsection

@section('content')
    <section class="section">
    <div class="section-header lead-header-section">
        <h1 class="page__heading">{{ __('messages.lead') }}</h1>
        <div class="filter-container section-header-breadcrumb row justify-content-md-end">
            {{-- Bulk Assign Dropdown --}}
            <div id="leads-actions" style="display: none;">
                <!-- <label for="clients" class="lbl-block mr-2"><b>{{ __('messages.project.client') }}</b></label> -->
                 <div class="">
                    <!-- {{ Form::label(
                       'assigned_to',
                       __('messages.leads.assigned_to').':',
                       ['class' => 'me-2']
                     ) }} -->
                     {{ Form::select(
                         'assigned_to',
                         $users,
                         null,
                         ['class' => 'form-control', 'id'=>'assigned_to', 'placeholder'=>__('messages.leads.assigned_to'), 'style' => 'width:auto;text-transform: capitalize;']
                     ) }}
                 </div>
            </div>

            {{-- Filter Dropdown --}}
            <div class="pl-sm-3 py-1">
                <div class="dropdown">
                    <a class="dropdown-toggle btn btn-primary" href="#" data-toggle="dropdown"
                    title="{{ __('messages.common.filter') }}" id="filter_toggle">
                    <i class="fas fa-filter"></i>
                    </a>
                    <div class="dropdown-menu dropdown-large dropdown-menu-right">
                        <div class="row mb-2">
                            <div class="form-group col-sm-6 d-flex justify-content-start">
                                <a class="btn btn-primary" id="resetFilters">{{ __('messages.leads.reset') }}</a>
                            </div>
                            <div class="form-group col-sm-6 d-flex justify-content-end">
                                <button type="button" aria-label="Close" class="close outline-none">×</button>
                            </div>
                        </div>

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

                        
                        {{-- Date Range Filter --}}
                        <div class="row mt-3">
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <input type="text" id="filter_date_range" class="form-control" placeholder="{{ __('messages.leads.date_range') }}">
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-lg-4">
                                <input type="text" id="filter_follow_up_date" 
                                  class="form-control" 
                                   placeholder="{{ __('messages.leads.select_follow_up_date') }}">
                            </div>
                            
                        </div>

                    </div>

                </div>
            </div>

            {{-- Switch to Kanban --}}
            <div class="pl-sm-3 pl-2 py-1">
                <a href="{{ route('leads.kanban') }}" class="btn btn-primary" 
                title="{{ __('messages.leads.switch_to_kanban') }}" data-toggle="tooltip" style="padding-top: 8px;padding-bottom: 3px">
                <i class="fab fa-trello font-size-20px"></i>
                </a>
            </div>

            {{-- Action Dropdown --}}
            <div class="pl-sm-3 pr-sm-3 pl-2 pr-2 py-1 lead-action">
                <div class="dropdown d-inline">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ __('messages.common.action') }}
                    </button>
                    <div class="dropdown-menu copy-today-activity ">
                        <a class="dropdown-item has-icon" href="{{ route('leads.create') }}">
                            <i class="fas fa-plus"></i> {{ __('messages.leads.new_lead') }}
                        </a>
                        <a class="dropdown-item has-icon" href="{{ route('bulk-upload.index') }}">
                            <i class="fas fa-upload"></i> {{ __('messages.leads.bulk_upload') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Follow-Up Modal -->
        @include('lead_followups.modal')
        @include('lead_followups.edit_modal')

        <div class="section-body">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @include('leads.table')
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
     <script>
        var bulkAssignUrl = "{{ route('leads.bulkAssign') }}";
        var updateLeadStageUrl = "{{ route('leads.updateStage', ':id') }}";
     </script>
    <script src="{{ mix('assets/js/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/leads/leads.js') }}"></script>
    <script>
        window.addEventListener('scroll', function() {
           const drawer = document.querySelector('.drawer');
           if (window.scrollY > 70) {
               drawer.classList.add('scrolled');
           } else {
               drawer.classList.remove('scrolled');
           }
       })
    </script>
@endsection
