@extends('layouts.app')

@section('title')
    {{ __('messages.lead_stages.lead_stage') }} {{ __('messages.common.details') }}
@endsection

@section('page_css')
    {{-- Add any CSS needed --}}
@endsection

@section('content')
    <section class="section">
        @include('flash::message')

        <div class="section-header">
            <h1 class="page__heading">{{ __('messages.lead_stages.lead_stage') }} {{ __('messages.common.details') }}</h1>
            <div class="filter-container section-header-breadcrumb justify-content-end">
                <a href="{{ route('lead-stages.edit', $leadStage->id) }}"
                   class="btn btn-primary filter-container__btn mr-2 report-action-btn">
                    {{ __('messages.common.edit') }}
                </a>
                <a href="{{ route('lead-stages.index') }}" class="btn btn-light ml-1 report-action-btn">
                    {{ __('messages.common.back') }}
                </a>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">{{ __('messages.lead_stages.name') }} :</label>
                                    <p>{{ html_entity_decode($leadStage->name) }}</p>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">{{ __('messages.lead_stages.sort_order') }} :</label>
                                    <p>{{ $leadStage->sort_order ?? __('messages.common.n/a') }}</p>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">{{ __('messages.lead_stages.color') }} :</label>
                                    <p>
                                        <span class="badge bg-label-{{ $leadStage->color ?? 'primary' }}">
                                            {{ ucfirst($leadStage->color) ?? __('messages.common.n/a') }}
                                        </span>
                                    </p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">{{ __('messages.lead_sources.description') }} :</label>
                                    <p>{!! !empty($leadStage->description) ? html_entity_decode($leadStage->description) : __('messages.common.n/a') !!}</p>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">{{ __('messages.common.created_by') }} :</label>
                                    <p>{{ !empty($leadStage->user->name) ? html_entity_decode($leadStage->user->name) : __('messages.common.n/a') }}</p>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">{{ __('messages.common.created_on') }} :</label>
                                    <p>
                                        <span data-toggle="tooltip" data-placement="right"
                                            title="{{ \Carbon\Carbon::parse($leadStage->created_at)->translatedFormat('jS M, Y') }}">
                                            {{ $leadStage->created_at->diffForHumans() }}
                                        </span>
                                    </p>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">{{ __('messages.common.last_updated') }} :</label>
                                    <p>
                                        <span data-toggle="tooltip" data-placement="right"
                                            title="{{ \Carbon\Carbon::parse($leadStage->updated_at)->translatedFormat('jS M, Y') }}">
                                            {{ $leadStage->updated_at->diffForHumans() }}
                                        </span>
                                    </p>
                                </div>
                            </div>


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
    <script src="{{ mix('assets/js/lead_stages/lead_stage.js') }}"></script>
@endsection
