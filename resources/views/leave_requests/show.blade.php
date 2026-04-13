@extends('layouts.app')

@section('title')
    {{ __('leave_requests.new_leave_request') }} {{ __('messages.common.details') }}
@endsection

@section('content')
<section class="section">
    @include('flash::message')

    <div class="section-header">
        <h1 class="page__heading">{{ __('leave_requests.new_leave_request') }} {{ __('messages.common.details') }}</h1>
        <div class="filter-container section-header-breadcrumb justify-content-end">
            @if(!$leaveRequest->deleted_at)
                <a href="{{ route('leave-requests.edit', $leaveRequest->id) }}" class="btn btn-primary mr-2">
                    {{ __('messages.common.edit') }}
                </a>
            @endif
            <a href="{{ route('leave-requests.index') }}" class="btn btn-light">
                {{ __('messages.common.back') }}
            </a>
        </div>
    </div>

  
   
 




@if($leaveRequest->deleted_at)
    <div class="" style="display: block !important; opacity: 1 !important; border: 2px solid #ff4444; background-color: white; color: #ff4444; padding: 15px 20px; margin-bottom: 20px; border-radius: 4px; font-family: inherit; font-size: 14px;">
        <i class="fas fa-exclamation-triangle" style="color: #ff4444; margin-right: 8px;"></i>
        <strong style="color: #ff4444; font-weight: 600;">{{ __('Warning') }}:</strong> 
        <span style="color: #ff4444;">{{ __('This Leave Request Has Been Deleted And Is No Longer Available.') }}</span>
    </div>
@endif

    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- User -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('leave_requests.user') }}:</label>
                                <p>{{ $leaveRequest->user->name ?? __('messages.common.n/a') }}</p>
                            </div>

                            <!-- Partial Leave -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('leave_requests.partial_leave') }}:</label>
                                <p>{{ $leaveRequest->partial_leave ? __('messages.common.yes') : __('messages.common.no') }}</p>
                            </div>

                            <!-- From Date -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('leave_requests.from_date') }}:</label>
                                <p>{{ $leaveRequest->from_date ? $leaveRequest->from_date->format('Y-m-d') : __('messages.common.n/a') }}</p>
                            </div>

                            <!-- To Date -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('leave_requests.to_date') }}:</label>
                                <p>{{ $leaveRequest->to_date ? $leaveRequest->to_date->format('Y-m-d') : __('messages.common.n/a') }}</p>
                            </div>

                            <!-- From Time -->
                            @if($leaveRequest->partial_leave)
                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold">{{ __('leave_requests.from_time') }}:</label>
                                    <p>{{ $leaveRequest->from_time ?? __('messages.common.n/a') }}</p>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold">{{ __('leave_requests.to_time') }}:</label>
                                    <p>{{ $leaveRequest->to_time ?? __('messages.common.n/a') }}</p>
                                </div>
                            @endif

                            <!-- Total Days -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('leave_requests.total_days') }}:</label>
                                <p>{{ $leaveRequest->total_days ?? __('messages.common.n/a') }}</p>
                            </div>



                            <!-- Status -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('leave_requests.status') }}:</label>
                                <p>
                                {{ $leaveRequest->status ?? __('messages.common.n/a') }}
                                 @if($leaveRequest->status == 'swap' && $leaveRequest->swap_date)
                                    
                                         ({{ __('leave_requests.swap_date') }} {{ $leaveRequest->swap_date->format('Y-m-d') }})
                                    
                                @endif
                            </p>
                                                        <!-- Swap Date -->
                               
                            </div>

    

                            <!-- Created By -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('messages.common.created_by') }}:</label>
                                <p>{{ $leaveRequest->creator->name ?? __('messages.common.n/a') }}</p>
                            </div>
                                                        <!-- Reason -->
                            

                            <!-- Created At -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('messages.common.created_on') }}:</label>
                                <p>{{ $leaveRequest->created_at->format('Y-m-d H:i') }}</p>
                            </div>

                            <!-- Updated At -->
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">{{ __('messages.common.last_updated') }}:</label>
                                <p>{{ $leaveRequest->updated_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">{{ __('leave_requests.reason') }}:</label>
                                <p>{{ $leaveRequest->reason ?? __('messages.common.n/a') }}</p>
                            </div>

                            <!-- Attachments -->
                           
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">{{ __('leave_requests.attachments') }}:</label>
                                    <div class="row">
                                        @foreach($leaveRequest->attachments as $attachment)
                                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                                <div class="card">
                                                    <img src="{{ $attachment->file_url }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $attachment->file }}">
                                                    <div class="card-body p-2">
                                                        <p class="card-text small text-truncate mb-1">{{ $attachment->file }}</p>
                                                        <div class="btn-group w-100" role="group">
                                                            <a href="{{ $attachment->file_url }}" target="_blank" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-eye"></i> {{ __('messages.common.view') }}
                                                            </a>
                                                            <a href="{{ route('leave-requests.download-attachment', $attachment->id) }}" 
                                                                class="btn btn-sm btn-success"
                                                                onclick="event.preventDefault(); window.location.href=this.href;">
                                                                <i class="fas fa-download"></i> {{ __('messages.common.download') }}
                                                            </a>
                                                            
                                                             @if(auth()->user()->hasRole('Admin') || (auth()->id() == $leaveRequest->user_id && $leaveRequest->status == 'pending'))
                                                                <button type="button" class="btn btn-sm btn-danger delete-attachment" data-id="{{ $attachment->id }}">
                                                                    <i class="fas fa-trash"></i> {{ __('messages.common.delete') }}
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
<script src="{{ asset('assets/js/leave_requests/leave_requests.js') }}"></script>

<script>
// Delete attachment functionality for show page
$(document).ready(function() {
    //console.log('Show page loaded, initializing delete attachment handlers');
    
    // Delete attachment handler
    $(document).on('click', '.delete-attachment', function (e) {
        e.preventDefault();
        e.stopPropagation();
        
        let attachmentId = $(this).data('id');
        //console.log('Delete attachment clicked, ID:', attachmentId);
       // console.log('SweetAlert available:', typeof swal);
        
        // Check if SweetAlert is available
        if (typeof swal === 'undefined') {
            //console.error('SweetAlert is not loaded!');
            if (confirm('Are you sure you want to delete this attachment?')) {
                // Fallback to simple AJAX without SweetAlert
                performDelete(attachmentId);
            }
            return;
        }
        
        swal({
            title: 'Are you sure!',
            text: 'You want to delete this attachment?',
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777EF',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes, delete',
        }, function () {
            console.log('User confirmed deletion for attachment ID:', attachmentId);
            performDelete(attachmentId);
        });
    });
    
    function performDelete(attachmentId) {
        $.ajax({
            url: '/leave-requests/attachments/' + attachmentId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log('Delete successful:', response);
                
                if (typeof swal !== 'undefined') {
                    swal({
                        title: 'Deleted!',
                        text: 'Attachment deleted successfully.',
                        type: 'success',
                        timer: 1000,
                        confirmButtonColor: '#6777EF',
                    });
                } else {
                    alert('Attachment deleted successfully!');
                }
                
                // Remove the attachment from DOM
                $('.delete-attachment[data-id="' + attachmentId + '"]').closest('.col-md-3').fadeOut(300, function () {
                    $(this).remove();
                });
                
                // Reload page after delay
                // setTimeout(function() {
                //     location.reload();
                // }, 1000);
            },
            error: function (xhr) {
                console.log('Delete error:', xhr);
                
                if (typeof swal !== 'undefined') {
                    swal({
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Failed to delete attachment.',
                        type: 'error',
                        confirmButtonColor: '#6777EF',
                    });
                } else {
                    alert('Error: Failed to delete attachment.');
                }
            }
        });
    }
});
</script>
@endsection
