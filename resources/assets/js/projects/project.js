'use strict';

const pickr = Pickr.create({
    el: '.color-wrapper',
    theme: 'nano', // or 'monolith', or 'nano'
    closeWithKey: 'Enter',
    autoReposition: true,
    defaultRepresentation: 'HEX',
    swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 1)',
        'rgba(156, 39, 176, 1)',
        'rgba(103, 58, 183, 1)',
        'rgba(63, 81, 181, 1)',
        'rgba(33, 150, 243, 1)',
        'rgba(3, 169, 244, 1)',
        'rgba(0, 188, 212, 1)',
        'rgba(0, 150, 136, 1)',
        'rgba(76, 175, 80, 1)',
        'rgba(139, 195, 74, 1)',
        'rgba(205, 220, 57, 1)',
        'rgba(255, 235, 59, 1)',
        'rgba(255, 193, 7, 1)',
    ],

    components: {
        // Main components
        preview: true,
        hue: true,

        // Input / output Options
        interaction: {
            input: true,
            clear: false,
            save: false,
        },
    },
});

const editPickr = Pickr.create({
    el: '.color-wrapper',
    theme: 'nano', // or 'monolith', or 'nano'
    closeWithKey: 'Enter',
    autoReposition: true,
    defaultRepresentation: 'HEX',
    swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 1)',
        'rgba(156, 39, 176, 1)',
        'rgba(103, 58, 183, 1)',
        'rgba(63, 81, 181, 1)',
        'rgba(33, 150, 243, 1)',
        'rgba(3, 169, 244, 1)',
        'rgba(0, 188, 212, 1)',
        'rgba(0, 150, 136, 1)',
        'rgba(76, 175, 80, 1)',
        'rgba(139, 195, 74, 1)',
        'rgba(205, 220, 57, 1)',
        'rgba(255, 235, 59, 1)',
        'rgba(255, 193, 7, 1)',
    ],

    components: {
        // Main components
        preview: true,
        hue: true,

        // Input / output Options
        interaction: {
            input: true,
            clear: false,
            save: false,
        },
    },
});

pickr.on('change', function () {
    const color = pickr.getColor().toHEXA().toString();

    if (wc_hex_is_light(color)) {
        $('#validationErrorsBox').text('');
        $('#validationErrorsBox').show().html('');
        $('#validationErrorsBox').text('Pick a different color');
        setTimeout(function () {
            $('#validationErrorsBox').slideUp();
        }, 5000);
        $(':input[id="btnSave"]').prop('disabled', true);
        return;
    }
    $(':input[id="btnSave"]').prop('disabled', false);
    pickr.setColor(color);
    $('#color').val(color);
});

editPickr.on('change', function () {
    const color = editPickr.getColor().toHEXA().toString();
    if (wc_hex_is_light(color)) {
        $('.editValidationErrorsBox').text('');
        $('.editValidationErrorsBox').show().html('');
        $('.editValidationErrorsBox').text('Pick a different color');
        setTimeout(function () {
            $('.editValidationErrorsBox').slideUp();
        }, 5000);
        $(':input[id="btnEditSave"]').prop('disabled', true);
        return;
    }
    $(':input[id="btnEditSave"]').prop('disabled', false);
    editPickr.setColor(color);
    $('#edit_color').val(color);
});

$(document).ready(function () {
    $('#client_id,#edit_client_id').select2({
        width: canManageClients?'calc(100% - 44px)':'100%',
        placeholder: 'Select Employee',
    });
    $('#budget_type,#edit_budget_type,#editStatusProject,#projectStatus').
        select2({
            width: '100%',
        });

    $('#filterClient').select2();
    $('#currency,#editCurrency').select2({
        width: '100%',
        // placeholder: 'Select Currency',
    });
    $('#user_ids,#edit_user_ids').select2({
        width: '100%',
        placeholder: 'Select Users',
    });
    $('#editProjectUser').select2({
        width: '100%',
    });
    $('#department_id,#edit_department_id').select2({
        width: '100%',
        placeholder: 'Select Department',
    });
});
$(document).on('click','.edit-project-assignees',function (e){
    let id = $(this).attr('data-id');
    startLoader();
    $.ajax({
       url: route('projects.edit',id),
       type: 'GET',
       success: function (result)
       {
           if (result.success) {
               let projectId = result.data.project['id'];
               let allUsers = result.data.project.allUsers;
               $.each(allUsers, function( index, value ) {
                   $('#editProjectUser').
                       append($('<option>', { value: value, text: value.name }));
               })
               $('#hdnProjectId').val(projectId);
               let userIds = result.data.users;
               $('#editProjectUser').val(userIds).trigger('change')
               $("#editProjectUser").val(result.data.users).trigger('change');
               stopLoader();
               $('#assignProjectUserModal').appendTo('body').modal('show');
           }
       },
        error: function (error) {
            manageAjaxErrors(error)
        },
    });
});
$(document).on('click', '#btnSaveAssigneesProject', function () {
    var loadingButton = jQuery(this);
    loadingButton.button('loading');
    window.livewire.emit('updateAssigneesProject', $('#editProjectUser').val(),
        $('#hdnProjectId').val());
    $('#assignProjectUserModal').modal('hide');
    displaySuccessMessage('Project assignee updated successfully');
});

$('#assignProjectUserModal').on('hidden.bs.modal', function () {
    $('#editProjectUser').val(null).trigger('change');
    var loadingButton = jQuery('#btnSaveAssigneesProject');
    loadingButton.button('reset');
});

$('#description,#editDescription').summernote({
    placeholder: 'Add Project description...',
    minHeight: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['paragraph']]],
});

let tbl = $('#projects_table').DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: route('projects.index'),
        data: function (data) {
            data.filter_client = $('#filterClient').
                find('option:selected').
                val()
        },
    },
    columnDefs: [
        {
            'targets': [0],
            'className': 'text-center',
            'width': '7%',
        },
        {
            'targets': [3],
            'orderable': false,
            'className': 'text-center',
            'width': '5%',
        },
    ],
    columns: [
        {
            data: 'prefix',
            name: 'prefix',
        },
        {
            data: 'name',
            name: 'name',
        },
        {
            data: 'client.name',
            defaultContent: '',
            name: 'client.name',
        },
        {
            data: function (row) {
                return '<a title="Edit" class="btn action-btn btn-primary btn-sm edit-btn mr-1" data-id="' +
                    row.id + '">' +
                    '<i class="cui-pencil action-icon"></i>' + '</a>' +
                    '<a title="Delete" class="btn action-btn btn-danger btn-sm delete-btn" data-id="' +
                    row.id + '">' +
                    '<i class="cui-trash action-icon" ></i></a>'
            }, name: 'id',
        },
    ],
    'fnInitComplete': function () {
        $(document).on('change', '#filterClient', function () {
            tbl.ajax.reload();
        });
    },
})

var picked = false;

$(document).on('submit', '#color', function () {
    picked = true;
});

$('#AddModal').on('show.bs.modal', function (event) {
    $('.pcr-button').css({ 'color': '#3F51B5', 'border': '1px solid grey' });
});

$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    let $description = $('<div />').html($('#description').summernote('code'));
    let empty = $description.text().trim().replace(/ \r\n\t/g, '') === '';
    let loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    if ($('#color').val() == '') {
        displayErrorMessage('Please select your color.');
        loadingButton.button('reset');
        return false;
    }
    let form = $(this);
    let formdata = $(this).serializeArray();
    formdata[formdata.length] = { name: 'color', value: $('#color').val() };
    $.ajax({
        url: route('projects.store'),
        type: 'POST',
        data: formdata,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#AddModal').modal('hide');
                $('#projects_table').DataTable().ajax.reload(null, false);
                revokerTracker();
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            printErrorMessage('#validationErrorsBox', result)
        },
        complete: function () {
            loadingButton.button('reset')
        },
    })
})

$(document).on('submit', '#editFormProject', function (event) {
    event.preventDefault();
    let $description = $('<div />').
        html($('#editDescription').summernote('code'));
    let empty = $description.text().trim().replace(/ \r\n\t/g, '') === '';
    if ($('#editPrice').val() == 0) {
        displayErrorMessage('The budget amount should be a minimum of 1.');
        return false;
    }
    if (removeCommas($('#editPrice').val()).length > 12) {
        displayErrorMessage('Maximum 12 digits budget amount is allowed.');
        return false;
    }
    let form = $(this);
    var loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    if ($('#editDescription').summernote('isEmpty')) {
        $('#editDescription').summernote('code');
    }else if (empty){
        displayErrorMessage('Description field is not contain only white space');
        loadingButton.button('reset');
        return false;
    }
    let formdata = $(this).serializeArray();
    formdata[formdata.length] = {
        name: 'color',
        value: $('#edit_color').val(),
    };
    var id = $('#projectId').val();
    $.ajax({
        url: route('projects.update',id),
        type: 'put',
        data: formdata,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#ProjectEditModal').modal('hide');
                $('#projects_table').DataTable().ajax.reload(null, false);
                revokerTracker();
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
        complete: function () {
            loadingButton.button('reset')
        },
    })
})

$(document).on('submit', '#addNewClientForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnClientSave');
    loadingButton.button('loading');
    $.ajax({
        url: '/client/store',
        type: 'POST',
        data:  $(this).serializeArray(),
        success: function (result) {
            $("#client_id").empty();
            if (result.success) {
                displaySuccessMessage(result.message);
                var option = "<option value=''>Select Employee</option>";
                $.each(result.data.clients, function (key, value) {
                    option += "<option value='" + key + "'>" + value +
                        "</option>";
                    $("#client_id, #edit_client_id").html(option);
                });
                if ($('#AddModal').hasClass('show')) {
                    $('#client_id').val(result.data.client.id).trigger('change.select2');
                } else if ($('#ProjectEditModal').hasClass('show')) {
                    $('#edit_client_id').val(result.data.client.id).trigger('change.select2');
                }
                $('#addClientModal').modal('hide');
            }
        },
        error: function (result) {
            printErrorMessage('#clientValidationErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$('#addClientModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewClientForm', '#clientValidationErrorsBox');
    $('#department_id').val('').trigger('change.select2');
});

$('#AddModal').on('hidden.bs.modal', function () {
    $('#client_id').val(null).trigger('change');
    $('#user_ids').val(null).trigger('change');
    $('#currency').val(0).trigger('change');
    $('#budget_type').val(null).trigger('change');
    pickr.setColor('#42445A');
    pickr.hide();
    $('#description').summernote('code', '');
    resetModalForm('#addNewForm', '#validationErrorsBox');
});
$('#ProjectEditModal').on('show.bs.modal', function () {
    $('.pcr-button').css('border', '1px solid grey');
    $('.project_remaining_user').popover('hide');
});

$('#ProjectEditModal').on('hidden.bs.modal', function () {
    $('#editDescription').summernote('code', '');
    editPickr.hide();
    resetModalForm('#editFormProject', '#editValidationErrorsBox');
});

window.renderData = function (id) {
    $.ajax({
        url: route('projects.edit',id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let project = result.data.project;
                let element = document.createElement('textarea');
                element.innerHTML = project.name;
                $('#projectId').val(project.id);
                $('#edit_name').val(element.value);
                $('#edit_domain_name').val(project.domain_name);
                $('#edit_prefix').val(project.prefix);
                editPickr.setColor(project.color);
                $('#edit_client_id').val(project.client_id).trigger('change');
                $('#editStatusProject').val(project.status).trigger('change');
                $('#editDescription').summernote('code', project.description);
                if (!isEmpty(project.price)) {
                    $('#editPrice').val(getFormattedPrice(project.price));
                }
                $('#editCurrency').val(project.currency).trigger('change');
                $('#edit_budget_type').
                    val(project.budget_type).
                    trigger('change');
                // Set Job Type from project.job_type (handle null/empty case)
                if (project.job_type && project.job_type !== '') {
                    $('#edit_job_type').val(project.job_type).trigger('change');
                } else {
                    $('#edit_job_type').val('').trigger('change');
                }
                var valArr = result.data.users;
                $('#edit_user_ids').val(valArr);
                $('#edit_user_ids').trigger('change');
                $('#ProjectEditModal').modal('show');
            }
        },
        error: function (result) {
            manageAjaxErrors(result)
        },
    })
}

$(document).on('click', '.edit-btn', function (event) {
    let projectId = $(event.currentTarget).attr('data-id');
    renderData(projectId)

})

$(document).on('click', '.delete-btn', function (event) {
    let projectId = $(event.currentTarget).attr('data-id');
    let alertMessage = '<div class="alert alert-warning swal__alert">\n' +
        '<strong class="swal__text-warning">' + byDeleteThisProject +
        '</strong><div class="swal__text-message">' + deleteProjectConfirm +
        '</div></div>';
    let stopwatchProjectId = getItemFromLocalStorage('project_id')
    let isClockRunning = getItemFromLocalStorage('clockRunning')
    if (projectId === stopwatchProjectId && isClockRunning === 'true') {
        tbl.ajax.reload();
        swal({
            'title': 'Warning',
            'text': 'Please stop timer before delete project.',
            'type': 'warning',
            confirmButtonColor: '#6777ef',
        });
        return false;
    }

    deleteItemInputConfirmation(route('projects.destroy', projectId), '#projects_table',
        'Project', alertMessage)
    setTimeout(function () {
        revokerTracker()
    }, 1000)
});

$(document).on('click', '.clone-btn', function (event) {
    event.preventDefault();
    let projectId = $(event.currentTarget).attr('data-id');
    console.log('Clone button clicked for project ID:', projectId);
    
    // Check if modal exists
    if ($('#cloneProjectModal').length === 0) {
        console.error('Clone modal not found');
        swal({
            title: 'Error',
            text: 'Clone modal not found',
            type: 'error'
        });
        return;
    }
    
    // Fetch project data and populate clone modal
    $.ajax({
        url: '/projects/' + projectId + '/clone-data',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            console.log('Fetching clone data for project:', projectId);
        },
        success: function (response) {
            console.log('Clone data response:', response);
            if (response.success) {
                // Generate unique prefix for cloned project
                const basePrefix = response.data.prefix || response.data.name.substring(0, 6).toUpperCase();
                const uniquePrefix = generateUniquePrefix(basePrefix);
                
                // Populate clone modal with project data
                $('#cloneProjectId').val(response.data.id);
                $('#cloneProjectName').val('Copy - ' + response.data.name);
                $('#clonePrefix').val(uniquePrefix); // Set generated prefix
                
                // Required fields - start empty (user must fill)
                $('#CloneUserIds').val([]).trigger('change'); // Empty users selection
                $('#clonePrice').val(''); // Empty budget
                
                // Set default values
                $('#cloneBudgetType').val('1'); // Fixed Cost (value = 1)
                // $('#cloneCurrency').val('7'); // BDT currency (value = 7) - REMOVED
                $('#cloneStatus').val('1'); // Ongoing (value = 1)
                
                // Optional fields - populate from original
                $('#cloneClientId').val(response.data.client_id || '');
                $('#cloneDomainName').val(response.data.domain_name || '');
                $('#cloneDescription').val(response.data.description || '');
                $('#cloneColor').val(response.data.color || '');
                // $('#cloneJobType').val(response.data.job_type || ''); // REMOVED - Start empty
                
                console.log('Modal populated, showing modal...');
                // Show clone modal
                $('#cloneProjectModal').modal('show');
            } else {
                swal({
                    title: 'Error',
                    text: 'Failed to load project data',
                    type: 'error'
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('Error fetching clone data:', xhr.responseText);
            swal({
                title: 'Error',
                text: 'Failed to load project data: ' + error,
                type: 'error'
            });
        }
    });
});

// Initialize select2 for clone modal
$(document).ready(function () {
    $('#CloneUserIds').select2({
        width: '100%',
        placeholder: 'Select Users',
    });
    
    // Initialize currency select2 and set default value
    $('#cloneCurrency').select2({
        width: '100%',
    }).val('7').trigger('change.select2');
});

// Generate unique prefix function
function generateUniquePrefix(basePrefix) {
    // Ensure prefix is uppercase and max 8 characters
    basePrefix = basePrefix.toUpperCase().substring(0, 6);
    
    // Simple client-side generation (server will validate uniqueness)
    const timestamp = Date.now().toString().slice(-2);
    return basePrefix.substring(0, 5) + timestamp;
}

// Handle clone form submission
$('#cloneForm').on('submit', function (e) {
    e.preventDefault();
    
    let formData = {
        project_id: $('#cloneProjectId').val(),
        name: $('#cloneProjectName').val(),
        prefix: $('#clonePrefix').val(),
        client_id: $('#cloneClientId').val(),
        domain_name: $('#cloneDomainName').val(),
        status: $('#cloneStatus').val(),
        description: $('#cloneDescription').val() || '', // Ensure empty string, not undefined
        price: $('#clonePrice').val() || '', // Budget field
        budget_type: $('#cloneBudgetType').val() || '', // Budget type field
        currency: $('#cloneCurrency').val() || '', // Currency field
        color: $('#cloneColor').val() || '', // Color field
        job_type: $('#cloneJobType').val() || '', // Job type field
        user_ids: $('#CloneUserIds').val() || [] // Users field
    };
    
    $.ajax({
        url: '/projects/clone',
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                $('#cloneProjectModal').modal('hide');
                swal({
                    title: 'Success',
                    text: 'Project cloned successfully',
                    type: 'success',
                    confirmButtonColor: '#6777ef'
                }).then(function () {
                    // Reload the page or Livewire component
                    window.livewire.emit('refreshProjects');
                });
            } else {
                swal({
                    title: 'Error',
                    text: response.message || 'Failed to clone project',
                    type: 'error'
                });
            }
        },
        error: function (xhr) {
            let errorMessage = 'Failed to clone project';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                let originalMessage = xhr.responseJSON.message;
                
                // Check for duplicate name error
                if (originalMessage.includes('Duplicate entry') && originalMessage.includes('projects_name_unique')) {
                    errorMessage = 'Project name already exists. Please choose a different name.';
                }
                // Check for duplicate prefix error
                else if (originalMessage.includes('Duplicate entry') && originalMessage.includes('projects_prefix_unique')) {
                    errorMessage = 'Project prefix already exists. Please choose a different prefix.';
                }
                // Check for general duplicate entry
                else if (originalMessage.includes('Duplicate entry')) {
                    errorMessage = 'Name and Prefix should be unique. Please choose different values.';
                }
                else {
                    errorMessage = originalMessage;
                }
            }
            swal({
                title: 'Error',
                text: errorMessage,
                type: 'error'
            });
        }
    });
});

$('.modal').on('show.bs.modal', function () {
    $(this).appendTo('body');
});

$(document).on('change', '#filterClient', function () {
    window.livewire.emit('filterProjects', $(this).val());
});

// $('#price,#editPrice').on('keyup', function () {
//     let regex = /^\d{0,6}?$/;
//     if (!regex.test($(this).val())) {
//         $(this).val('');
//     }
// });

$(document).on('click', '#all-projects', function () {
    projectStatusLivewire(null);
});

$('document').ready(function () {
    screenUnLock();
    $('#statusOngoing').trigger('click');
});

$(document).on('change', '#projectStatus', function () {
    let projectStatus = $(this).val();
    projectStatusLivewire(projectStatus);
});

window.projectStatusLivewire = function ($projectStatus) {
    window.livewire.emit('projectsStatus', $projectStatus);
};

$(document).on('change', '#myProjects', function () {
    let userId = $(this).data('id');

    if ($('#myProjects').prop('checked') == true) {
        window.livewire.emit('usersProject', userId);
    } else {
        window.livewire.emit('usersProject', null);
    }
});
document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        $('#editProjectUser').select2({
            width: '100%',
        });
        $('#projectStatus').select2({
            width: '100%',
        });
    });
});

// Project Invoice Modal handlers
$(document).on('click', '#addProjectInvoice', function (e) {
    e.preventDefault();
    const $modal = $('#addProjectInvoiceModal');
    $modal.appendTo('body').modal('show');
    // reset fields
    $('#pi_in_word').val('');
    $('#pi_for').val('');
    // seed amount/due based on project price and approved sum
    const onboardAmount = parseInt($modal.data('onboard-amount') || $('#pi_onboard_amount').val() || '0') || 0;
    const approvedPaid = parseInt($modal.data('approved-paid') || $('#pi_approved_paid').val() || '0') || 0;
    const initialDue = Math.max(onboardAmount - approvedPaid, 0);
    $('#pi_amount_display').val(new Intl.NumberFormat().format(onboardAmount));
    $('#pi_paid').val(0).attr('max', initialDue).trigger('input');
    $('#pi_due').val(new Intl.NumberFormat().format(initialDue));
    // mark as create mode
    $modal.data('mode', 'create');
    $modal.removeData('current-paid-original');
    $modal.removeData('current-status');
});

$(document).on('input change', '#pi_paid', function () {
    const $modal = $('#addProjectInvoiceModal');
    const onboardAmount = parseInt($modal.data('onboard-amount') || $('#pi_onboard_amount').val() || '0') || 0;
    const approvedPaidBase = parseInt($modal.data('approved-paid') || $('#pi_approved_paid').val() || '0') || 0;
    const mode = $modal.data('mode') || 'create';
    const currentPaidOriginal = parseInt($modal.data('current-paid-original') || '0') || 0;
    const currentStatus = ($modal.data('current-status') || '').toString();
    // Exclude current invoice's paid from approved sum when editing and current is approved
    const approvedPaid = mode === 'edit' && currentStatus === 'approved'
        ? Math.max(approvedPaidBase - currentPaidOriginal, 0)
        : approvedPaidBase;

    let paid = parseInt($(this).val() || '0') || 0;
    if (paid < 0) paid = 0;
    // max allowed = onboard - approvedPaid (remaining before this payment)
    const maxAllow = Math.max(onboardAmount - approvedPaid, 0);
    if (paid > maxAllow) paid = maxAllow;
    $(this).val(paid);
    const due = Math.max(onboardAmount - (approvedPaid + paid), 0);
    $('#pi_due').val(new Intl.NumberFormat().format(due));
});

$(document).on('submit', '#addProjectInvoiceForm', function (e) {
    e.preventDefault();
    const loadingButton = jQuery('#btnProjectInvoiceSave');
    loadingButton.button('loading');
    const projectId = $('#pi_project_id').val();
    const payload = {
        paid: $('#pi_paid').val(),
        in_word: $('#pi_in_word').val(),
        for: $('#pi_for').val(),
    };
    $.ajax({
        url: route('projects.invoices.store', projectId),
        type: 'POST',
        data: payload,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addProjectInvoiceModal').modal('hide');
                // refresh livewire project details if present
                window.livewire && window.livewire.emit('refresh');
                // reload page section
                location.reload();
            }
        },
        error: function (xhr) {
            printErrorMessage('#projectInvoiceValidationErrorsBox', xhr);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$(document).on('focusout', '#name', function (e) {
    let name = $(this).val();
    name = name.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
    $('#prefix').val(name.toUpperCase().slice(0, 8));
});

$(document).on('focusout', '#prefix', function (e) {
    let prefix = $(this).val();
    prefix = prefix.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
    $(this).val(prefix.toUpperCase().slice(0, 8));
});

$(document).on('focusout', '#edit_name', function (e) {
    // Only auto-fill prefix from name if the prefix field is empty
    let existingPrefix = $('#edit_prefix').val();
    if (existingPrefix && existingPrefix.trim().length > 0) {
        return;
    }
    let name = $(this).val();
    name = name.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
    $('#edit_prefix').val(name.toUpperCase().slice(0, 8));
});

$(document).on('focusout', '#edit_prefix', function (e) {
    let prefix = $(this).val();
    prefix = prefix.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
    $(this).val(prefix.toUpperCase().slice(0, 8));
});
