@extends('layouts.app')

@section('title')
    {{ __('Absent') }} {{ __('Details') }}
@endsection

@section('content')
<section class="section">
    @include('flash::message')

    <div class="section-header">
        <h1 class="page__heading">{{ __('Absent') }} {{ __('Details') }}</h1>
        <div class="filter-container section-header-breadcrumb justify-content-end">
         @if (auth()->user()->hasRole('Admin'))
        <a href="{{ route('absents.edit', $absent->id) }}" class="btn btn-primary mr-2">
                {{ __('Edit') }}
            </a>
        @endif
            <a href="{{ route('absents.index') }}" class="btn btn-light">
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
                            <!-- User -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('Absent User') }}:</label>
                                <p>{{ $absent->user->name ?? __('messages.common.n/a') }}</p>
                            </div>

                              <!-- Status -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('Absent Status') }}:</label>
                                <p>{{ $absent->status ?? __('messages.common.n/a') }}</p>
                            </div>

                            <!-- Partial Leave -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('Partial Absent') }}:</label>
                                <p>{{ $absent->partial_leave ? __('messages.common.yes') : __('messages.common.no') }}</p>
                            </div>

                            <!-- From Date -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('Absent From') }}:</label>
                                <p>{{ $absent->from_date ? $absent->from_date->format('Y-m-d') : __('messages.common.n/a') }}</p>
                            </div>

                            <!-- To Date -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('Absent To') }}:</label>
                                <p>{{ $absent->to_date ? $absent->to_date->format('Y-m-d') : __('messages.common.n/a') }}</p>
                            </div>

                            <!-- From Time -->
                            @if($absent->partial_leave)
                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold">{{ __('Absent From (time)') }}:</label>
                                    <p>{{ $absent->from_time ?? __('messages.common.n/a') }}</p>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold">{{ __('Absent To (time)') }}:</label>
                                    <p>{{ $absent->to_time ?? __('messages.common.n/a') }}</p>
                                </div>
                            @endif

                            <!-- Total Days -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('Total Absent Days') }}:</label>
                                <p>{{ $absent->total_days ?? __('messages.common.n/a') }}</p>
                            </div>

                            <!-- Created By -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('messages.common.created_by') }}:</label>
                                <p>{{ $absent->creator->name ?? __('messages.common.n/a') }}</p>
                            </div>

                            <!-- Created At -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('messages.common.created_on') }}:</label>
                                <p>{{ $absent->created_at->format('Y-m-d H:i') }}</p>
                            </div>

                            <!-- Updated At -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('messages.common.last_updated') }}:</label>
                                <p>{{ $absent->updated_at->format('Y-m-d H:i') }}</p>
                            </div>

                             <!-- Reason -->
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">{{ __('Absent Reason') }}:</label>
                                <p>{{ $absent->reason ?? __('messages.common.n/a') }}</p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
