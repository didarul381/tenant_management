'use strict';

$(function () {
    $('#projectId,#editProjectId').select2({
        width: '100%',
        placeholder: 'Select Projects',
    })
    $('#roleId,#editRoleId').select2({
        width: '100%',
        placeholder: 'Select Role',
        // minimumResultsForSearch: -1,
    })
    $('#weeklyHolidays,#editWeeklyHolidays').select2({
        width: '100%',
        placeholder: 'Select Weekly Holidays',
    })
    $('#filterStatus').select2({
       width:'100%',
    });
});

$(document).ready(function () {
    $('input').attr('autocomplete', 'false');
    
    // Initialize date picker for joining date
    
    $('#joiningDate').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        locale: languageName == 'ar' ? 'en' : languageName,
        icons: {
            previous: 'icon-arrow-left icons',
            next: 'icon-arrow-right icons',
        },
        sideBySide: true,
    });
    
    // Initialize date picker for edit joining date
    $('#editJoiningDate').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        locale: languageName == 'ar' ? 'en' : languageName,
        icons: {
            previous: 'icon-arrow-left icons',
            next: 'icon-arrow-right icons',
        },
        sideBySide: true,
    });
    
    
    
    
    
    
    // Bank Info Toggle for Add Modal
    $('#hasBankInfo').on('change', function() {
        if ($(this).is(':checked')) {
            $('#bankInfoFields').slideDown();
            $('#hasBankInfo').val('1');

        } else {
            $('#bankInfoFields').slideUp();
            // Clear bank fields when unchecked
           // $('#bank_name, #account_name, #account_number, #branch_name, #branch_routing_number, #swift_code').val('');
            $('#hasBankInfo').val('0');
        }
    });
    
    // Bank Info Toggle for Edit Modal
    $('#editHasBankInfo').on('change', function() {
        if ($(this).is(':checked')) {
            $('#editBankInfoFields').slideDown();
             $('#editHasBankInfo').val('1');
        } else {
            $('#editBankInfoFields').slideUp();
            // Clear bank fields when unchecked
           // $('#edit_bank_name, #edit_account_name, #edit_account_number, #edit_branch_name, #edit_branch_routing_number, #edit_swift_code').val('');
             $('#editHasBankInfo').val('0');
        }
    });
});

var tbl = $('#users_table').DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: route('users.index'),
    },
    columnDefs: [
        {
            'targets': [6],
            'orderable': false,
            'className': 'text-center',
            'width': '5%',
        },
        {
            'targets': [5],
            'orderable': false,
            'className': 'text-center',
            'width': '5%',
        },
        {
            'targets': [4],
            'className': 'text-center',
            'width': '4%',
        },
        {
            'targets': [3,7],
            'orderable': false,
            'className': 'text-center',
            'width': '6%',
        },
    ],
    columns: [
        {
            data: 'name',
            name: 'name',
        },
        {
            data: 'email',
            name: 'email',
        },
        {
            data: 'phone',
            name: 'phone',
        },
        {
            data: 'role_name',
            name: 'role_name',
            'searchable': false,
        },
        {
            data: 'salary',
            name: 'salary',
        },
        {
            data: function (row) {
                let checked = row.is_active === 0 ? '' : 'checked'
                if (loggedInUserId === row.id) {
                    return ''
                }
                return ' <label class="switch switch-label switch-outline-primary-alt">' +
                    '<input name="is_active" data-id="' + row.id +
                    '" class="switch-input is-active" type="checkbox" value="1" ' +
                    checked + '>' +
                    '<span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>' +
                    '</label>'
            }, name: 'id',
        },
        {
            data: function (row) {
                var email_verification = '<button type="button" title="Send Verification Mail" id="email-btn" class="btn action-btn btn-primary btn-sm email-btn" ' +
                    'data-loading-text="<span class=\'spinner-border spinner-border-sm\'></span>" data-id="' +
                    row.id + '">' +
                    '<i class="icon-envelope icons action-icon"></i></button>'
                if (row.is_email_verified) {
                    email_verification = '<a title="Email Verified" data-id="' +
                        row.id + '">' +
                        '<i class="cui-circle-check check-icon"></i></a>'
                }
                return email_verification
            }, name: 'id',
        },
        {
            data: function (row) {
                return '<a title="Edit" class="btn action-btn btn-primary btn-sm edit-btn mr-1" data-id="' +
                    row.id + '">'
                    +
                    '<i class="cui-pencil action-icon user-js-action-color"></i>' +
                    '</a>' +
                    '<a title="Delete" class="btn action-btn btn-danger btn-sm delete-btn" data-id="' +
                    row.id + '">' +
                    '<i class="cui-trash action-icon text-danger"></i></a>'
            }, name: 'id',
        },
    ],
});

$('#users_table').on('draw.dt', function () {
    $('[data-toggle="tooltip"]').tooltip()
});

window.renderData = function (userId) {
    $.ajax({
        url: route('users.edit',userId),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let user = result.data;
                let element = document.createElement('textarea');
                element.innerHTML = user.name;
                $('#userId').val(user.id);
                $('#edit_name').val(element.value);
                $('#edit_email').val(user.email);
                $('#edit_phone').val(user.phone);
                $('#edit_salary').val(user.salary);
                $('.price-input').trigger('input');
                $('#editProjectId').val(user.project_ids).trigger('change');
                if (user.is_active) {
                    $('#edit_is_active').val(1).prop('checked', true);
                }
                if(user.email_verified_at) {
                    $('#edit_email_verified_at').val(1).prop('checked',true).attr('disabled', true);
                }else{
                    $('#edit_email_verified_at').attr('disabled', false);
                }
                $('#edit_email_verified_at').trigger('change');
                $('#editRoleId').val(user.role_id).trigger('change');
                $('#editDepartmentId').val(user.department_id).trigger('change');
                
                // Update project statistics
                if (user.project_stats) {
                    $('#totalProjects').text(user.project_stats.total_projects || 0);
                    $('#incompleteProjects').text(user.project_stats.projects_with_incomplete_tasks || 0);
                } else {
                    $('#totalProjects').text(0);
                    $('#incompleteProjects').text(0);
                }
                
                // Set project IDs to hidden field to prevent clearing
                // Clear existing project hidden fields
                $('input[name="project_ids[]"]').remove();
                
                // Add hidden fields for each project ID
                if (user.project_ids && Array.isArray(user.project_ids)) {
                    user.project_ids.forEach(function(projectId) {
                        $('#editForm').append('<input type="hidden" name="project_ids[]" value="' + projectId + '">');
                    });
                }
                
                // Handle new fields
                $('#editJoiningDate').val(user.joining_date || '');
                $('#editOfficeFromTime').val(user.office_from_time || '');
                $('#editOfficeToTime').val(user.office_to_time || '');
                
                // Handle weekly holidays (JSON array)
                if (user.weekly_holidays) {
                    let holidays = Array.isArray(user.weekly_holidays) ? user.weekly_holidays : JSON.parse(user.weekly_holidays);
                    $('#editWeeklyHolidays').val(holidays).trigger('change');
                }

                if(user.hold_account) {
                    $('#edit_hold_account').prop('checked', true);
                } else {
                    $('#edit_hold_account').prop('checked', false);
                }
                
               

                // Handle bank info fields
                const hasBankInfo = user.bank_name || user.account_name || user.account_number || user.branch_name || user.branch_routing_number || user.swift_code;
                
                if (hasBankInfo) {
                    $('#editHasBankInfo').prop('checked', true);
                    $('#editBankInfoFields').show();
                    
                    // Populate bank info fields
                    $('#edit_bank_name').val(user.bank_name || '');
                    $('#edit_account_name').val(user.account_name || '');
                    $('#edit_account_number').val(user.account_number || '');
                    $('#edit_branch_name').val(user.branch_name || '');
                    $('#edit_branch_routing_number').val(user.branch_routing_number || '');
                    $('#edit_swift_code').val(user.swift_code || '');
                } else {
                    $('#editHasBankInfo').prop('checked', false);
                    $('#editBankInfoFields').hide();
                    
                    // Clear bank info fields
                    $('#edit_bank_name').val('');
                    $('#edit_account_name').val('');
                    $('#edit_account_number').val('');
                    $('#edit_branch_name').val('');
                    $('#edit_branch_routing_number').val('');
                    $('#edit_swift_code').val('');
                }

                if (!isEmpty(user.img_avatar)) {
                    $('#editPreviewImage').attr('src', user.img_avatar);
                } else {
                    $('#editPreviewImage').attr('src', defaultImageUrl);
                }
                $('#editDepartmentId').val(user.department_id).trigger('change');
                $('#EditModal').modal('show');
            }
        },
        error: function (error) {
            manageAjaxErrors(error)
        },
    })
};

window.sendVerificationEmail = function (userId) {

    $.ajax({
        url: route('send-email',userId),
        type: 'GET',
        beforeSend: function beforeSend() {
            startLoader();
        },
        success: function (result) {
            if (result.success) {
                swal('Success!', result.message, 'success')
            }
        },
        error: function (error) {
            manageAjaxErrors(error)
        },
        complete: function () {
            stopLoader();
            $('.email-btn').html('<i class="fas fa-sync font-size-12px"></i>');
        },
    })
};

$('#new_password, #new_confirm_password').on('keypress', function (e) {
    if (e.which == 32){
        return false;
    }
});

$(function () {
    // create new user
    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        
        // Check if bank info is enabled
        const hasBankInfo = $('#hasBankInfo').val() === '1';
        
        // Add/remove required attribute to bank fields (excluding swift_code)
        if (hasBankInfo) {
            $('#bank_name, #account_name, #account_number, #branch_name, #branch_routing_number').prop('required', true);
            $('.bank-required').show();
        } else {
            $('.bank-field').prop('required', false);
            $('.bank-required').hide();
            // Also clear any validation errors
            $('.bank-field').removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }
        
        var loadingButton = jQuery(this).find('#btnSave');
        loadingButton.button('loading');
        $.ajax({
            url: route('users.store'),
            type: 'POST',
            data: new FormData($(this)[0]),
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#AddModal').modal('hide');
                    $('#users_table').DataTable().ajax.reload(null, false);
                    window.livewire.emit('refresh');
                    location.reload();
                }
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
               // location.reload();
            },
            complete: function () {
                loadingButton.button('reset');
                //location.reload();
            },
        })
    });

    // update user
    $(document).on('submit', '#editForm', function (event) {
        event.preventDefault();
        $('#edit_email_verified_at').attr('disabled', false);
        
        // Check if bank info is enabled AT SUBMISSION TIME
       
        const hasBankInfo = $('#editHasBankInfo').val() === '1';
        
       
        // Add required attribute only if bank info is checked (excluding swift_code)
        if (hasBankInfo) {
            $('#edit_bank_name, #edit_account_name, #edit_account_number, #edit_branch_name, #edit_branch_routing_number').prop('required', true);
            $('.bank-required').show();
        }else{
            $('.bank-field').prop('required', false);
            $('.bank-required').hide();
            // Also clear any validation errors
            $('.bank-field').removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }
        
        var loadingButton = jQuery(this).find('#btnEditSave');
        loadingButton.button('loading');
        var id = $('#userId').val();
        $.ajax({
            url: route('users-update',id),
            type: 'POST',
            data: new FormData($(this)[0]),
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#EditModal').modal('hide');
                    $('#users_table').DataTable().ajax.reload(null, false);
                    if(window.location.pathname == '/users'){
                        window.livewire.emit('refresh');
                        location.reload();
                    }
                    location.reload();
                }
            },
            error: function (error) {
                manageAjaxErrors(error);
                $('#edit_email_verified_at').attr('disabled', true);
                //location.reload();
              
            },
            complete: function () {
                  
                loadingButton.button('reset');
               
            },
        })
    });

    $('#AddModal').on('hidden.bs.modal', function () {
        $('#projectId').val(null).trigger('change')
        $('#roleId').val(null).trigger('change');
        $('#weeklyHolidays').val(null).trigger('change');
        $('#previewImage').attr('src', defaultImageUrl);
        resetModalForm('#addNewForm', '#validationErrorsBox');
    });

    $('#EditModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox')
    });

    // open edit user model
    $(document).on('click', '.edit-btn', function (event) {
        let userId = $(event.currentTarget).attr('data-id');
        renderData(userId)
    })

    // open delete confirmation model
    $(document).on('click', '.delete-btn', function (event) {
        let userId = $(event.currentTarget).attr('data-id');
        let alertMessage = '<div class="alert alert-warning swal__alert">\n' +
            '<strong class="swal__text-warning">' + deleteMessage + ' ' + user + '?' +
            '</strong><div class="swal__text-message">' + deleteUserConfirm +
            '</div></div>';
        setTimeout(function () {
            revokerTracker()
        }, 1000)

            swal({
                    type: 'input',
                    inputPlaceholder: deleteConfirm + ' "' + deleteWord + '" ' +
                        toTypeDelete + ' ' + 'User' + '.',
                    title: deleteHeading + ' !',
                    text: alertMessage,
                    html: true,
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonColor: '#6777ef',
                    cancelButtonColor: '#d33',
                    cancelButtonText: noMessages,
                    confirmButtonText: yesMessages,
                    imageUrl: baseUrl + 'images/warning.png',
                },
                function (inputVal) {
                    if (inputVal === false) {
                        return false
                    }
                    if (inputVal == '' || inputVal.toLowerCase() != 'delete') {
                        swal.showInputError(
                            'Please type "delete" to delete this client.')
                        $('.sa-input-error').css('top', '23px!important');
                        $(document).find('.sweet-alert.show-input :input').val('');
                        return false
                    }
                    if (inputVal.toLowerCase() === 'delete') {
                        $.ajax({
                            url: route('users.destroy',userId),
                            type: 'DELETE',
                            dataType: 'json',
                            success: function (obj) {
                                if (obj.success) {
                                    window.livewire.emit('refresh');
                                }
                                swal({
                                    title: 'Deleted!',
                                    text: 'User has been deleted.',
                                    confirmButtonColor: '#6777ef',
                                    type: 'success',
                                    timer: 2000,
                                })
                            },
                            error: function (data) {
                                swal({
                                    title: '',
                                    text: data.responseJSON.message,
                                    confirmButtonColor: '#6777ef',
                                    type: 'error',
                                    timer: 5000,
                                })
                            },
                        })
                    }
                })
    });

    $(document).on('click', '.email-btn', function (event) {
        $(this).html('<i class="fas fa-sync font-size-12px fa-spin"></i>');
        let userId = $(event.currentTarget).attr('data-id');
        sendVerificationEmail(userId)
    })
});

// listen user activation deactivation change event
$(document).on('change', '.is-active', function (event) {
    const userId = $(event.currentTarget).attr('data-id');
    activeDeActiveUser(userId)
});

// activate de-activate user
window.activeDeActiveUser = function (id) {
    $.ajax({
        url: route('active-de-active-user',id),
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                tbl.ajax.reload();
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
            setTimeout(location.reload(true), 700);
        },
    })
};

$('.modal').on('show.bs.modal', function () {
    $(this).appendTo('body');
});

$(document).on('change', '#userProfile', function () {
    let ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
        $(this).val('');
        $('#validationErrorsBox').html('The profile image must be a file of type: jpeg, jpg, png.').show();
        setTimeout(function () {
            $('#validationErrorsBox').slideUp();
        }, 5000);
    } else {
        displayPhoto(this, '#previewImage');
    }
});

$(document).on('change', '#userEditProfile', function () {
    let ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
        $(this).val('');
        $('#editValidationErrorsBox').html('The profile image must be a file of type: jpeg, jpg, png.').show();
        setTimeout(function () {
            $('#editValidationErrorsBox').slideUp();
        }, 5000);
    } else {
        displayPhoto(this, '#editPreviewImage');
    }
});

$(document).on('change', '#filterStatus', function () {
    window.livewire.emit('filterUsers', $(this).val());
});

$(document).on('click', '.permanent-delete', function (event) {
    let id = $(event.currentTarget).attr('data-id');
        swal({
            title: deleteHeading + ' !',
            text: 'Are you sure  want to delete this "User" ?',
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777ef',
            cancelButtonColor: '#d33',
            cancelButtonText: noMessages,
            confirmButtonText: yesMessages
        }, function () {
            $.ajax({
                url: 'users/'+ id +'/delete',
                type: 'DELETE',
                dataType: 'json',
                success: function (obj) {
                    if (obj.success) {
                        window.livewire.emit('refresh');
                    }
                    swal({
                        title: 'Deleted!',
                        text: 'User has been deleted.',
                        confirmButtonColor: '#6777ef',
                        type: 'success',
                        timer: 2000,
                    })
                },
                error: function (data) {
                    swal({
                        title: '',
                        text: data.responseJSON.message,
                        confirmButtonColor: '#6777ef',
                        type: 'error',
                        timer: 5000,
                    })
                },
            })
        });
    });

$(document).on('click', '.restore-btn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    swal({
        title: 'Restore' + ' !',
        text: 'Are you sure  want to restore this User ?',
        type: 'info',
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d33',
        cancelButtonText: noMessages,
        confirmButtonText: yesMessages,
    }, function () {
        $.ajax({
            url: 'users/'+id +'/restore',
            type: 'POST',
            dataType: 'json',
            success: function (obj) {
                if (obj.success) {
                    window.livewire.emit('refresh');
                }
                swal({
                    title: 'Restored!',
                    text: 'User has been restored.',
                    type: 'success',
                    timer: 2000,
                })
            },
            error: function (data) {
                swal({
                    title: '',
                    text: data.responseJSON.message,
                    type: 'error',
                    timer: 5000,
                })
            },
        })
    });
});
