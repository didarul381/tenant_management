@extends('layouts.app')

@section('title')
    {{ __('properties.property') }} {{ __('messages.common.details') }}
@endsection

@section('content')
<section class="section">
    @include('flash::message')

    <div class="section-header">
        <h1 class="page__heading">{{ __('properties.property') }} {{ __('messages.common.details') }}</h1>
        <div class="filter-container section-header-breadcrumb justify-content-end">
            @if(!$property->deleted_at)
                <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-primary mr-2">
                    {{ __('messages.common.edit') }}
                </a>
            @endif
            <a href="{{ route('properties.index') }}" class="btn btn-light">
                {{ __('messages.common.back') }}
            </a>
        </div>
    </div>

    @if($property->deleted_at)
        <div class="alert alert-danger" style="border: 2px solid #ff4444; background-color: white; color: #ff4444;">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <strong>{{ __('Warning') }}:</strong> 
            <span>{{ __('This Property has been deleted and is no longer active in the system.') }}</span>
        </div>
    @endif

    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('properties.user') }}:</label>
                                <p>{{ $property->owner->name ?? __('messages.common.n/a') }}</p>
                            </div>


                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('properties.status') }}:</label>
                                <p>
                                    <span class="badge badge-{{ $property->status === 'active' ? 'success' : 'warning' }}">
                                        {{ ucfirst($property->status ?? __('messages.common.n/a')) }}
                                    </span>
                                </p>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('properties.rent_amount') }}:</label>
                                <p>{{ number_format($property->rent_amount, 2) }}</p>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('properties.security_deposit') }}:</label>
                                <p>{{ number_format($property->security_deposit, 2) ?? '0.00' }}</p>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('properties.available_date') }}:</label>
                                <p>{{ $property->available_date ? \Carbon\Carbon::parse($property->available_date)->format('Y-m-d') : __('messages.common.n/a') }}</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">{{ __('properties.address') }}:</label>
                                <p>{{ $property->address ?? __('messages.common.n/a') }}</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">{{ __('properties.description') }}:</label>
                                <p>{{ $property->description ?? __('messages.common.n/a') }}</p>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('messages.common.created_on') }}:</label>
                                <p>{{ $property->created_at->format('Y-m-d H:i') }}</p>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('messages.common.last_updated') }}:</label>
                                <p>{{ $property->updated_at->format('Y-m-d H:i') }}</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">{{ __('properties.attachments') }}:</label>
                                <div class="row">
                                    @forelse($property->attachments as $attachment)
                                        <div class="col-md-3 col-sm-4 col-6 mb-3">
                                            <div class="card">
                                                <img src="{{ $attachment->file_url }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                                <div class="card-body p-2 text-center">
                                                    <div class="btn-group w-100">
                                                        <a href="{{ $attachment->file_url }}" target="_blank" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('properties.download-attachment', $attachment->id) }}" class="btn btn-sm btn-success">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        @if(auth()->user()->hasRole('Admin'))
                                                            <button type="button" class="btn btn-sm btn-danger delete-property-attachment" data-id="{{ $attachment->id }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12"><p class="text-muted small">No attachments found.</p></div>
                                    @endforelse
                                </div>
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
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
      <script src="{{ mix('assets/js/properties/propertie.js') }}"></script>
@endsection
@section('page_js')

@endsection