'use strict';

$(document).ready(function () {
    let tbl = $('#leave_requests_table').DataTable({
        "order": [[5, "desc"]],
        language: {
            paginate: {
                previous: '<i class="fas fa-angle-left"></i>',
                next: '<i class="fas fa-angle-right"></i>',
            },
            info: 'Showing _START_ to _END_ of _TOTAL_ entries',
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: route('leave-requests.index'),
            data: function (data) {
                data.filter_user = $('#filter_user').val();
                data.filter_status = $('#filter_status').val();
                data.date_range = $('#filter_date_range').val();
            },
        },
        columns: [
            {
                data: function(row) { return row.user.name; },
                name: 'user.name'
            },
            // {
            //     data: 'partial_leave',
            //     name: 'partial_leave',
            //     render: function(data) {
            //         return data ? 'Yes' : 'No';
            //     }
            // },
             {
                data: 'leave_day',
                name: 'leave_day'
            },

            // {
            //     data: 'from_date',
            //     name: 'from_date',
            //     render: function(data) {
            //         return data ? moment(data).format('YYYY-MM-DD') : '';
            //     }
            // },
            // {
            //     data: 'to_date',
            //     name: 'to_date',
            //     render: function(data) {
            //         return data ? moment(data).format('YYYY-MM-DD') : '';
            //     }
            // },
            {
                data: 'total_days',
                name: 'total_days'
            },
            // {
            //     data: 'from_time',
            //     name: 'from_time',
            //     defaultContent: 'N/A',
            //     render: function(data) {
            //         return data ? moment(data, 'HH:mm:ss').format('hh:mm A') : 'N/A';
            //     }
            // },
            // {
            //     data: 'to_time',
            //     name: 'to_time',
            //     defaultContent: 'N/A',
            //     render: function(data) {
            //         return data ? moment(data, 'HH:mm:ss').format('hh:mm A') : 'N/A';
            //     }
            // },
            {
                data: 'reason',
                name: 'reason',
                defaultContent: 'N/A'
            },
            {
                data: 'status',
                name: 'status',
                render: function(data) {
                    let label = 'secondary';
                    if (data === 'approved') label = 'success';
                    else if (data === 'rejected') label = 'danger';
                    else if (data === 'pending') label = 'warning';
                    return `<span class="text-white badge bg-${label}">${data.charAt(0).toUpperCase() + data.slice(1)}</span>`;
                }
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            // {
            //     data: function(row) { return row.updated_at ? moment(row.updated_at).format('YYYY-MM-DD') : ''; },
            //     name: 'updated_at'
            // },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center',
            },
        ],
    });

    // Handle show more/less for reason
    $(document).on('click', '.show-more-reason', function() {
        $(this).closest('.reason-container').find('.reason-short').hide();
        $(this).closest('.reason-container').find('.reason-full').show();
        $(this).hide();
        $(this).closest('.reason-container').find('.show-less-reason').show();
    });

    $(document).on('click', '.show-less-reason', function() {
        $(this).closest('.reason-container').find('.reason-full').hide();
        $(this).closest('.reason-container').find('.reason-short').show();
        $(this).hide();
        $(this).closest('.reason-container').find('.show-more-reason').show();
    });

     $(document).on('click', '.delete-btn', function (event) {
        let leadStageId = $(event.currentTarget).attr('data-id');
        deleteLeadStage(route('leave-requests.destroy', leadStageId));
    });

    $(document).on('click', '.approve-btn', function (event) {
        let leaveId = $(event.currentTarget).attr('data-id');
        updateLeaveStatus(route('leave-requests.update-status', leaveId), 'approved');
    });

    $(document).on('click', '.reject-btn', function (event) {
        let leaveId = $(event.currentTarget).attr('data-id');
        updateLeaveStatus(route('leave-requests.update-status', leaveId), 'rejected');
    });

    $(document).on('click', '.swap-btn', function (event) {
        let leaveId = $(event.currentTarget).attr('data-id');

    // Create a custom modal with proper date picker
    let modalHtml = `
        <div class="modal fade" id="swapDateModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Swap Leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Choose Swap Date First To Swap The Status Of This Leave?</p>
                        <div class="form-group">
                            <label for="swapDatePicker">Swap Date <span class="text-danger">*</span></label>
                            <input type="text" id="swapDatePicker" class="form-control" placeholder="Select swap date">
                            <small class="text-danger d-none" id="swapDateError">
                                Swap date is required
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmSwap">Next</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Remove existing modal if any
    $('#swapDateModal').remove();
    
    // Add modal to body
    $('body').append(modalHtml);
    
    // Initialize DateTimePicker
    $('#swapDatePicker').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        locale: languageName == 'ar' ? 'en' : languageName,
        icons: {
            previous: 'icon-arrow-left icons',
            next: 'icon-arrow-right icons',
        },
        sideBySide: true,
    });

    // Show modal
    $('#swapDateModal').modal('show');

    // Handle confirm button click
    $('#confirmSwap').on('click', function() {
        let swapDate = $('#swapDatePicker').val();
        
        if (!swapDate) {
            $('#swapDateError').removeClass('d-none');
            $('#swapDatePicker').addClass('is-invalid');
            return;
        }
        

        // Close modal
        $('#swapDateModal').modal('hide');
        
        // Update status
        updateLeaveStatus(route('leave-requests.update-status', leaveId), 'swap', swapDate);
    });
    });


    window.deleteLeadStage = function (url) {
        swal({
            title: 'Are you sure!',
            text: 'You want to delete this leave?',
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777EF',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
        }, function () {
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                success: function (obj) {
                    if (obj.success) {
                        tbl.ajax.reload(null, false);
                    }

                    swal({
                        title: 'Deleted!',
                        text: 'leave has been deleted.',
                        type: 'success',
                        timer: 2000,
                        confirmButtonColor: '#6777EF',
                    });
                },
                error: function (data) {
                    let errorMessage = 'An error occurred. Please try again.';
                    
                    if (data.responseJSON && data.responseJSON.message) {
                        errorMessage = data.responseJSON.message;
                    } else if (data.responseJSON && data.responseJSON.error) {
                        errorMessage = data.responseJSON.error;
                    } else if (data.responseText) {
                        try {
                            const response = JSON.parse(data.responseText);
                            errorMessage = response.message || response.error || errorMessage;
                        } catch (e) {
                            errorMessage = data.responseText;
                        }
                    }
                    
                    swal({
                        title: 'Error',
                        text: errorMessage,
                        type: 'error',
                        timer: 5000,
                        confirmButtonColor: '#6777EF',
                    });
                },
            });
        });
    };


    window.updateLeaveStatus = function (url, status, swapDate = null) {
        let actionText = status === 'swap' ? 'Swap Status' : status.charAt(0).toUpperCase() + status.slice(1);
        let actionLower = status === 'swap' ? 'swap the status of' : actionText.toLowerCase();
        let actionPast = status === 'swap' ? 'swapped' : actionText.toLowerCase() + 'd';
        let data = {
        status: status,
        _token: $('meta[name="csrf-token"]').attr('content')
    };

    if (status === 'swap') {
        data.swap_date = swapDate;
    }
        swal({
            title: 'Are you sure!',
            text: `You want to ${actionLower} this leave?`,
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777EF',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
        }, function () {
            $.ajax({
                url: url,
                type: 'PATCH',
                data: data,
                dataType: 'json',
                success: function (obj) {
                    if (obj.success) {
                        tbl.ajax.reload(null, false);
                    }

                    swal({
                        title: `${actionText}!`,
                        text: `Leave has been ${actionPast}.`,
                        type: 'success',
                        timer: 2000,
                        confirmButtonColor: '#6777EF',
                    });
                },
                error: function (data) {
                    let errorMessage = 'An error occurred. Please try again.';
                    
                    if (data.responseJSON && data.responseJSON.message) {
                        errorMessage = data.responseJSON.message;
                    } else if (data.responseJSON && data.responseJSON.error) {
                        errorMessage = data.responseJSON.error;
                    } else if (data.responseText) {
                        try {
                            const response = JSON.parse(data.responseText);
                            errorMessage = response.message || response.error || errorMessage;
                        } catch (e) {
                            errorMessage = data.responseText;
                        }
                    }
                    
                    swal({
                        title: 'Error',
                        text: errorMessage,
                        type: 'error',
                        timer: 5000,
                        confirmButtonColor: '#6777EF',
                    });
                },
            });
        });
    };


    $('#dropdownMenuButton2').click(function () {
        return false;
    });

    $('.dropdown-large').on('click', function (event) {
        if ($(this).parent().hasClass('show')) {
            $(this).parent().toggleClass('show');
        } else {
            $(this).parent().removeClass('show');
        }
    });

    $(document).on('click', '.close', function () {
        $('.dropdown-large').removeClass('show');
    });

    // Filters reload table
    $('#filter_user, #filter_status').change(function () {
        tbl.ajax.reload();
    });

    // Initialize daterangepicker for single input
    // $('#filter_date_range').daterangepicker({
    //     autoUpdateInput: false,
    //     locale: {
    //         cancelLabel: 'Clear',
    //         format: 'YYYY-MM-DD'
    //     }
    // });
     $('#filter_date_range').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'YYYY-MM-DD'
        },

        ranges: {
            [Lang.get('messages.days.today')]: [moment(), moment()],
            ['Yesterday']: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            [Lang.get('messages.days.this_week')]: [
                moment().startOf('week'),
                moment().endOf('week')],
            [Lang.get('messages.days.last_week')]: [
                moment().startOf('week').subtract(7, 'days'),
                moment().startOf('week').subtract(1, 'days')],
            [Lang.get('messages.days.this_month')]: [moment().startOf('month'), moment().endOf('month')],
            [Lang.get('messages.days.last_month')]: [
                moment().subtract(1, 'month').startOf('month'),
                    moment().subtract(1, 'month').endOf('month')],

        },
    });

    $('#filter_date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        tbl.ajax.reload();
    });

    $('#filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        tbl.ajax.reload();
    });

    // Reset filters
    $('#resetFilters').click(function () {
        $('#filter_user, #filter_status, #filter_date_range').val('').trigger('change');
        tbl.ajax.reload();
    });

    // Attachment functionality
   // Attachment functionality
let leaveRequestAttachments = [];

$(document).ready(function() {
    // Initialize attachment functionality
    initializeAttachmentHandlers();
});

function initializeAttachmentHandlers() {
    // Choose file button click - FIXED
    $('.choose-button').off('click').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        
        console.log('Choose button clicked');
        
        let fileInput = $('#Add_attachment');
        if (fileInput.length > 0) {
            // Reset file input to ensure change event triggers
            fileInput.val('');
            
            // Trigger click on file input
            fileInput.trigger('click');
        } else {
            console.error('File input not found!');
        }
    });

    // File input change event - FIXED
    $('#Add_attachment').off('change').on('change', function (event) {
        // Prevent any default behavior
        event.preventDefault();
        event.stopPropagation();
        
        console.log('File input changed');
        console.log('Files selected:', this.files.length);
        
        // Cancel the event to prevent page redirect
        if (event.originalEvent) {
            event.originalEvent.preventDefault();
            event.originalEvent.stopPropagation();
        }
        
        // Clear previous attachments array
        leaveRequestAttachments = [];
        
        let files = this.files;
        if (files && files.length > 0) {
            // Convert FileList to array
            for (let i = 0; i < files.length; i++) {
                console.log('Adding file:', files[i].name);
                leaveRequestAttachments.push(files[i]);
            }
            
            // Display preview
            displayLeaveRequestAttachments();
        }
        
        // Important: return false to prevent any default action
        return false;
    });

    // Remove attachment handler
    $(document).off('click', '.remove-attachment').on('click', '.remove-attachment', function (e) {
        e.preventDefault();
        e.stopPropagation();
        
        let index = $(this).data('index');
        if (index !== undefined) {
            leaveRequestAttachments.splice(index, 1);
            displayLeaveRequestAttachments();
            
            // Clear the file input if no attachments left
            if (leaveRequestAttachments.length === 0) {
                $('#Add_attachment').val('');
            }
        }
    });
}

// Display attachments in preview
function displayLeaveRequestAttachments() {
    let html = '';
    
    if (leaveRequestAttachments.length > 0) {
        for (let i = 0; i < leaveRequestAttachments.length; i++) {
            let file = leaveRequestAttachments[i];
            let fileName = file.name;
            let fileURL = URL.createObjectURL(file);
            
            html += `
                <div class="col-md-3 col-sm-4 col-6 mb-3 attachment-item" data-index="${i}">
                    <div class="card">
                        <img src="${fileURL}" class="card-img-top attachment-image" alt="${fileName}" style="height: 150px; object-fit: cover;">
                        <div class="card-body p-2">
                            <p class="card-text small text-truncate mb-1">${fileName}</p>
                            <button type="button" class="btn btn-sm btn-danger remove-attachment" data-index="${i}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }
    } else {
        html = '<p class="text-muted">No attachments selected</p>';
    }
    
    $('#previewImage').html(html);
}

// Clean up object URLs when done
$(window).on('beforeunload', function() {
    if (leaveRequestAttachments.length > 0) {
        $('.attachment-image').each(function() {
            let src = $(this).attr('src');
            if (src && src.startsWith('blob:')) {
                URL.revokeObjectURL(src);
            }
        });
    }
});

    // Delete attachment
    $(document).on('click', '.delete-attachment', function () {
        let attachmentId = $(this).data('id');
        
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
            $.ajax({
                url: route('leave-requests.delete-attachment', attachmentId),
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        // Remove attachment from DOM
                        $(`.attachment-item[data-index="${attachmentId}"]`).remove();
                        
                        // Show success message
                        swal({
                            title: 'Deleted!',
                            text: 'Attachment deleted successfully.',
                            type: 'success',
                            timer: 1000,
                            confirmButtonColor: '#6777EF',
                        });

                         // Remove the attachment from DOM
                        $('.delete-attachment[data-id="' + attachmentId + '"]').closest('.col-md-3').fadeOut(300, function () {
                            $(this).remove();
                        });
                       
                    } else {
                        swal({
                            title: 'Error!',
                            text: response.message || 'Failed to delete attachment.',
                            type: 'error',
                            confirmButtonColor: '#6777EF',
                        });
                    }
                },
                error: function (xhr) {
                    swal({
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Failed to delete attachment.',
                        type: 'error',
                        confirmButtonColor: '#6777EF',
                    });
                }
            });
        });
    });
});
