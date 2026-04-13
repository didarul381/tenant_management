@extends('layouts.app')

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
@endsection
@section('css')
    @livewireStyles
<style>
    .card-border{
        border: 0 solid;
        border-radius: 0.375rem;
    }
    .gap-3 {
        gap: 0.75rem !important;
    }
    .border-4 {
        border-width: 4px !important;
    }
    .border-4 {
        border-width: 4px !important;
    }
    .border-bottom-0 {
        border-block-end: 0 !important;
    }
    .border-end-0 {
        border-inline-end: 0 !important;
    }
    .border-top-0 {
        border-block-start: 0 !important;
    }
    .border-success {
        border-color: #28a745 !important;
    }

    .border-danger {
        border-color: #dc3545 !important;
    }

    .border-primary {
        border-color: #007bff !important;
    }

    .border-info {
        border-color: #17a2b8 !important;
    }

    .border-warning {
        border-color: #ffc107 !important;
    }

    .border-secondary {
        border-color: #6c757d !important;
    }

    .bg-label-success {
        background-color: #d4edda !important;
        color: #28a745 !important;
    }

    .bg-label-danger {
        background-color: #f8d7da !important;
        color: #dc3545 !important;
    }

    .bg-label-primary {
        background-color: #cce5ff !important;
        color: #007bff !important;
    }

    .bg-label-info {
        background-color: #d1ecf1 !important;
        color: #17a2b8 !important;
    }

    .bg-label-warning {
        background-color: #fff3cd !important;
        color: #ffc107 !important;
    }

    .bg-label-secondary {
        background-color: #e2e3e5 !important;
        color: #6c757d !important;
    }
    .drawer{
        display: none;
    }


</style>
@endsection

@section('title')
    {{ __('messages.leads.lead_details') }}
@endsection

@section('content')
<section class="section">
    @include('flash::message')

    <div class="section-header">
        <h1 class="page__heading">{{ __('messages.leads.lead_details') }}</h1>
        <div class="filter-container section-header-breadcrumb justify-content-end">
            <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-primary mr-2">
                {{ __('messages.common.edit') }}
            </a>
            <a href="{{ route('leads.index') }}" class="btn btn-light">
                {{ __('messages.common.back') }}
            </a>
        </div>
    </div>

    <div class="section-body">

        {{-- Personal Details --}}
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">{{ __('messages.leads.personal_details') }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.first_name') }} :</label>
                        <p>{{ $lead->first_name ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.last_name') }} :</label>
                        <p>{{ $lead->last_name ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.email') }} :</label>
                        <p>{{ $lead->email ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.phone') }} :</label>
                        <p>{{ $lead->phone ?? __('messages.common.n/a') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Professional Details --}}
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">{{ __('messages.leads.professional_details') }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.company') }} :</label>
                        <p>{{ $lead->company ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.job_title') }} :</label>
                        <p>{{ $lead->job_title ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.industry') }} :</label>
                        <p>{{ $lead->industry ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.source') }} :</label>
                        <p>{{ $lead->source ? $lead->source->name : __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.stage') }} :</label>
                        <p>{{ $lead->stage ? $lead->stage->name : __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.assigned_to') }} :</label>
                        <p>{{ $lead->assignedUser ? $lead->assignedUser->name : __('messages.common.n/a') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Social Links --}}
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">{{ __('messages.leads.social_links') }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">Website :</label>
                        <p>{{ $lead->website ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">LinkedIn :</label>
                        <p>{{ $lead->linkedin ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">Facebook :</label>
                        <p>{{ $lead->facebook ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">Instagram :</label>
                        <p>{{ $lead->instagram ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">Pinterest :</label>
                        <p>{{ $lead->pinterest ?? __('messages.common.n/a') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Address --}}
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">{{ __('messages.leads.address') }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.city') }} :</label>
                        <p>{{ $lead->city ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.state') }} :</label>
                        <p>{{ $lead->state ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.zip') }} :</label>
                        <p>{{ $lead->zip ?? __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.leads.country') }} :</label>
                        <p>{{ $lead->country ?? __('messages.common.n/a') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">{{ __('messages.leads.description') }}</h5>
            </div>
            <div class="card-body">
                <p>{!! !empty($lead->description) ? nl2br(e($lead->description)) : __('messages.common.n/a') !!}</p>
            </div>
        </div>

        {{-- Created/Updated Info --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.common.created_by') }} :</label>
                        <p>{{ $lead->user ? $lead->user->name : __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.common.created_on') }} :</label>
                        <p>{{ $lead->created_at ? $lead->created_at->format('jS M, Y') : __('messages.common.n/a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('messages.common.last_updated') }} :</label>
                        <p>{{ $lead->updated_at ? $lead->updated_at->diffForHumans() : __('messages.common.n/a') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Follow-ups --}}
        <div class="card mt-3">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('messages.leads.follow_ups') }}</h5>
                <button type="button" 
                        id="createFollowUpBtn" 
                        class="btn btn-primary mr-2 createFollowUpBtn"
                        data-id="{{ $lead->id }}">
                    <i class="fa fa-plus"></i> {{ __('messages.leads.new_follow_up') }}
                </button>



            </div>
            <div class="card-body">
                @if($lead->followUps->isEmpty())
                    <p>{{ __('messages.common.no_follow_ups_found') }}</p>
                @else
                    <div class="row">
                    @foreach($lead->followUps->sortByDesc('id') as $followUp)
                    @php
                        switch(strtolower($followUp->status)) {
                            case 'pending':
                                $borderClass = 'border-warning';
                                $labelClass = 'bg-label-warning';
                                break;
                            case 'completed':
                                $borderClass = 'border-success';
                                 $labelClass = 'bg-label-success';
                                break;
                            case 'canceled':
                                $borderClass = 'border-danger';
                                 $labelClass = 'bg-label-danger';
                                break;
                            case 'rescheduled':
                                $borderClass = 'border-primary';
                                 $labelClass = 'bg-label-primary';
                                break;
                            default:
                                $borderClass = 'border-secondary';
                                $labelClass = 'bg-label-secondary';
                        }
                    @endphp
                       <div class="card-border col-md-6 card {{ $borderClass }} border-bottom-0 border-end-0 border-top-0 mb-3 border-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="fw-semibold text-primary text-uppercase mb-1">
                                            {{ __('messages.leads.follow_up_on') }}:
                                            {{ $followUp->follow_up_at ? $followUp->follow_up_at->format('d-m-Y H:i:s') : __('messages.common.n/a') }}
                                        </h6>
                                        @php
                                            switch($followUp->type) {
                                                case 'call':
                                                    $icon = 'fa-phone';
                                                    break;
                                                case 'email':
                                                    $icon = 'fa-envelope';
                                                    break;
                                                case 'meeting':
                                                    $icon = 'fa-handshake';
                                                    break;
                                                case 'sms':
                                                    $icon = 'fa-comment';
                                                    break;
                                                default:
                                                    $icon = 'fa-ellipsis-h';
                                            }
                                        @endphp

                                        <div class="d-flex align-items-center small text-muted">
                                            <i class="fa {{ $icon }} me-1"> 
                                            {{ ucfirst($followUp->type) }}
                                            <span class="badge {{$labelClass}} ms-2">
                                                {{ ucfirst($followUp->status) }}
                                            </span>
                                            </i> 
                                        </div>

                                    </div>

                                    <div class="align-items-center d-flex">
                                        <button type="button" class="btn editFollowUpBtn" title="{{ __('messages.common.edit') }}" data-id="{{ $followUp->id }}" >
                                            <i class="fa fa-edit text-primary mx-1"></i>
                                        </button>
                                        
                                        <button type="button" class="btn followup-delete-btn" data-id="{{ $followUp->id }}" title="{{ __('messages.common.delete') }}">
                                            <i class="fa fa-trash text-danger mx-1"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="small text-body mt-2">
                                    <p>{!! nl2br(e($followUp->note)) !!}</p>
                                </div>

                                <div class="d-flex small text-muted mt-3 flex-wrap gap-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-user me-1"> 
                                        <span>{{ __('messages.leads.assigned_to') }}: {{ $followUp->assignedUser ? $followUp->assignedUser->name : __('messages.common.n/a') }} </span> 
                                        </i>
                                    </div>
                                    <div class="d-flex align-items-center">
                                         <i class="fa fa-calendar-check me-1"> 
                                        <span> {{ __('messages.common.created_at') }}: {{ $followUp->created_at ? $followUp->created_at->format('d-m-Y H:i:s') : __('messages.common.n/a') }}</span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endif
            </div>
        </div>
        <!-- Follow-Up Modal -->
        
        <!-- Follow-Up Modal -->
        @include('lead_followups.modal')
        @include('lead_followups.edit_modal')


    
    </div>
</section>
@endsection
@section('page_js')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
@endsection
@section('scripts')
    let loginUserId = "{{ getLoggedInUserId() }}";
    <script src="{{ mix('assets/js/leads/leads.js') }}"></script>
@endsection


