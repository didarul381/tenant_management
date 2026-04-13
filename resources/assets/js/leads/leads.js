'use strict';

$(document).ready(function () {
    let tbl = $('#leads_table').DataTable({
        "order": [[6, "desc"]],
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
            url: route('leads.index'),
            data: function (data) {
                data.filter_stage = $('#filter_stage').val();
                data.filter_source = $('#filter_source').val();
                data.filter_user = $('#filter_user').val();
                data.date_range = $('#filter_date_range').val();
                data.follow_up_date = $('#filter_follow_up_date').val(); // <— new param

            },
        },
        columns: [
            {
                data: function(row) {
                    return `<input style="vertical-align: middle;" type="checkbox" class="lead-checkbox big-checkbox" value="${row.id}">`;
                },
                orderable: false,
                searchable: false,
                className: 'text-center',
                name: 'checkbox'
            },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'source.name', name: 'source.name', defaultContent: 'N/A' },
            { data: 'leadStage.name', name: 'leadStage.name', defaultContent: 'N/A' },
            { data: 'assignedUser.name', name: 'assignedUser.name', defaultContent: 'N/A' },
            // { data: 'website', name: 'website', defaultContent: 'N/A' },
            { 
                data: function(row) { return row.created_at ? moment(row.created_at).format('YYYY-MM-DD') : ''; },
                name: 'created_at'
            },
            // { 
            //     data: function(row) { return row.updated_at ? moment(row.updated_at).format('YYYY-MM-DD') : ''; },
            //     name: 'updated_at'
            // },
            {
                data: function (row) {
                    return actionTemplate2({
                        Url: route('leads.index'),
                        viewText: 'View',
                        editText: 'Edit',
                        followUpText: 'Follow Up', 
                        deleteText: 'Delete',
                        id: row.id,
                    });
                },
                name: 'id',
                orderable: false,
                className: 'text-center',
            },
        ],
    });

    // Delete Lead Stage
    $(document).on('click', '.delete-btn', function (event) {
        let leadStageId = $(event.currentTarget).attr('data-id');
        deleteLeadStage(route('leads.destroy', leadStageId));
    });

    $(document).on('click', '.followup-delete-btn', function (event) {
        event.preventDefault();
        let followupId = $(event.currentTarget).attr('data-id');
        
        deleteLeadfollowups(route('lead-followups.destroy', followupId));
        setTimeout(function () {
                            window.location.reload();
                        }, 3000);
    });

    
    window.deleteLeadfollowups = function (url) {
        swal({
            title: 'Are you sure!',
            text: 'You want to delete this Lead followups?',
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
                        text: 'Lead followups has been deleted.',
                        type: 'success',
                        timer: 2000,
                        confirmButtonColor: '#6777EF',
                    });
                },
                error: function (data) {
                    swal({
                        title: '',
                        text: data.responseJSON.message,
                        type: 'error',
                        timer: 5000,
                        confirmButtonColor: '#6777EF',
                    });
                },
            });
        });
    };
    window.deleteLeadStage = function (url) {
        swal({
            title: 'Are you sure!',
            text: 'You want to delete this Lead?',
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
                        text: 'Lead has been deleted.',
                        type: 'success',
                        timer: 2000,
                        confirmButtonColor: '#6777EF',
                    });
                },
                error: function (data) {
                    swal({
                        title: '',
                        text: data.responseJSON.message,
                        type: 'error',
                        timer: 5000,
                        confirmButtonColor: '#6777EF',
                    });
                },
            });
        });
    };
    $('.lead-action .dropdown').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(500);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(500);
    });

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

    // Initialize daterangepicker for single input
    // $('#filter_date_range').daterangepicker({
    //     autoUpdateInput: false,
    //     locale: {
    //         cancelLabel: 'Clear',
    //         format: 'YYYY-MM-DD'
    //     }
    // });
    $('#filter_date_range, #filter_follow_up_date').daterangepicker({
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

    // Initialize filter_follow_up_date daterangepicker for single input
    // $('#filter_follow_up_date').daterangepicker({
    //     autoUpdateInput: false,
    //     locale: {
    //         cancelLabel: 'Clear',
    //         format: 'YYYY-MM-DD'
    //     }
    // });

    $('#followUpAt, #editFollowUpAt').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: false, 
        locale: {
            format: 'YYYY-MM-DD hh:mm A'
        }
    });

    $('#filter_date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        tbl.ajax.reload();
    });

    $('#filter_follow_up_date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        tbl.ajax.reload();
    });

    $('#filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        tbl.ajax.reload();
    });

    $('#filter_follow_up_date').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        tbl.ajax.reload();
    });

    // Filters reload table
    $('#filter_stage, #filter_source, #filter_user').change(function () {
        tbl.ajax.reload();
    });

    // Reset filters
    $('#resetFilters').click(function () {
        $('#filter_stage, #filter_source, #filter_user, #filter_date_range, #filter_follow_up_date').val('').trigger('change');
        tbl.ajax.reload();
    });
      $('.modal, .editFollowUpModalLabel').modal({ show: false, backdrop: 'static' })
      
    
    // create followup click
   $(document).on('click', '.createFollowUpBtn', function(event) {
   
        $('#validationErrorsBox').html('').addClass('d-none');
        let leadId = $(event.currentTarget).attr('data-id');
    
        $('#leadId').val(leadId);
        $('#leadIdDrawer').val(leadId);
    
        // Initialize datepicker
        $('#followUpAt').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: false,
            autoUpdateInput: false,
            locale: { format: 'YYYY-MM-DD hh:mm A' }
        }).off('focus.daterangepicker');
    
        let table = $('#leads_table').DataTable();
        let row = table.row($(this).closest('tr')).data();
    
        if (!row) {
            $('#followUpModal').appendTo('body').modal('show');
        } else {
            // Load follow-ups via AJAX
            $.ajax({
                url: '/leads/' + leadId + '/follow-ups',
                type: 'GET',
                success: function(response) {
                    $('#drawerFollowUps').html(response.html);
                },
                error: function() {
                    $('#drawerFollowUps').html('<div class="text-danger">Failed to load follow-ups</div>');
                }
            });
            // Drawer info
            let tempDiv = $('<div>').html(row.name || '');
            let leadName = tempDiv.contents().get(0)?.nodeValue || 'N/A';
            let leadEmail = tempDiv.contents().get(2)?.nodeValue || 'N/A';
            let leadWebsite = tempDiv.find('a').attr('href') || 'N/A';
            let leadSource = row.source?.name || 'N/A';
            let phoneLink = $('<div>').html(row.phone || '').find('a');
            let phoneHref = phoneLink.attr('href') || 'N/A';
            let phoneNumber = phoneLink.clone().children().remove().end().text().trim();
    
            let html = `
                <div><h6>Lead Information</h6></div>
                <div><strong>Name:</strong> ${leadName}</div>
                <div><strong>Email:</strong> ${leadEmail}</div>
                <div><strong>Website:</strong> <a href="${leadWebsite}" target="_blank">${leadWebsite}</a></div>
                <div><strong>Source:</strong> ${leadSource}</div>
                <div><strong>Phone:</strong> <a href="${phoneHref}">${phoneNumber} <i class="fa fa-phone-square ms-2" style="font-size:15px"></i></a></div>
            `;
            $('#drawerUserInfo').html(html);
            $('#followUpDrawer').addClass('open');
            $('#assignedToDrawer').val(loginUserId).trigger('change');
    
        }
    });    
    
        
    // close drawer
    $(document).on('click', '#closeDrawer, #closeDrawerBtn', function() {
        $('#followUpDrawer').removeClass('open');
    });

    // Drawer submit
    $(document).on('submit', '#addFollowUpFormDrawer', function (event) {
        event.preventDefault();
        let loadingButton = $(this).find('#btnFollowUpSave');
        loadingButton.button('loading');
    
        let formData = new FormData(this);
    
        $.ajax({
            url: route('lead-followups.store'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#followUpDrawer').removeClass('open');
                    setTimeout(() => window.location.reload(), 1000);
                }
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });
    // Modal submit
    $(document).on('submit', '#addFollowUpForm', function (event) {
            event.preventDefault();
            let loadingButton = $(this).find('#btnFollowUpSave');
            loadingButton.button('loading');

            let formData = new FormData($(this)[0]);


            $.ajax({
                url: route('lead-followups.store'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    if (result.success) {
                        displaySuccessMessage(result.message);
                        //$('#followUpModal').modal('hide');
                         $('#followUpDrawer').removeClass('open');
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function (result) {
                    printErrorMessage('#validationErrorsBox', result);
                },
                complete: function () {
                    loadingButton.button('reset');
                },
            });
        });


       

    // Open edit follow-up modal
    $(document).on('click', '.editFollowUpBtn', function(event) {
        let followUpId = $(event.currentTarget).attr('data-id');
        renderFollowUpData(followUpId);
    });

    window.renderFollowUpData = function(id) {
        $.ajax({
            url: route('lead-followups.edit', id),
            type: 'GET',
            success: function(result) {
                if (result.success) {
                   
                    let followUp = result.data.followUp;
                    let users = result.data.users;

                    // Fill form fields in modal
                    $('#editFollowUpId').val(followUp.id); // hidden field for update
                    $('#editAssignedTo').val(followUp.assigned_to).trigger('change');
                    $('#editFollowUpAt').off('focus.daterangepicker'); // disables auto open on focus
                    $('#editFollowUpAt').data('daterangepicker').setStartDate(followUp.follow_up_at);

                    $('select[name="type"]').val(followUp.type).trigger('change');
                    $('select[name="status"]').val(followUp.status).trigger('change');
                    $('textarea[name="note"]').val(followUp.note);
                    $('#editFollowUpModal').appendTo('body').modal('show');
                    $('#editFollowUpModal').modal('show');
                
                }
            },
            error: function(error) {
                console.error(error);
                alert('Unable to load follow-up data.');
            }
        });
    };

    $(document).on('submit', '#editFollowUpForm', function(event) {
        event.preventDefault();

        let form = $(this);
        let loadingButton = form.find('#btnEditFollowUpSave');
        loadingButton.button('loading');

        let formData = form.serialize();
        let id = $('#editFollowUpId').val();

        $.ajax({
            url: route('lead-followups.update', id),
            type: 'PUT',
            data: formData,
            success: function(result) {
                if (result.success) {
                    displaySuccessMessage(result.message);

                    $('#editFollowUpModal').modal('hide');
                    setTimeout(function () {
                            window.location.reload();
                        }, 3000);
                    // Reload table

                } else {
                    displayErrorMessage(result.message);
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                printErrorMessage('#validationErrorsBox', errors);
            },
            complete: function() {
                loadingButton.button('reset');
            }
        });
    });

    

    // Select/Deselect all leads
    // Show/hide the bulk assign dropdown
    function toggleActionsDropdown() {
        let checkedCount = $('input.lead-checkbox:checked', tbl.rows({ 'search': 'applied' }).nodes()).length;
        if (checkedCount > 0) {
            $('#leads-actions').show();
        } else {
            $('#leads-actions').hide();
        }
    }

    // Select All checkbox
    $('#select_all_leads').on('click', function() {
        let rows = tbl.rows({ 'search': 'applied' }).nodes();
        $('input.lead-checkbox', rows).prop('checked', this.checked);
        toggleActionsDropdown();
    });

    // Single checkbox change
    $('#leads_table tbody').on('change', 'input.lead-checkbox', function() {
        let rows = tbl.rows({ 'search': 'applied' }).nodes();
        let allChecked = $('input.lead-checkbox', rows).length === $('input.lead-checkbox:checked', rows).length;
        $('#select_all_leads').prop('checked', allChecked);
        toggleActionsDropdown();
    });

    // Instant update when dropdown value changes
    $('#assigned_to').on('change', function() {
        let assignedTo = $(this).val();
        if (!assignedTo) return;

        let leadIds = [];
        $('input.lead-checkbox:checked', tbl.rows({ 'search': 'applied' }).nodes()).each(function() {
            leadIds.push($(this).val());
        });

        if (leadIds.length === 0) return;

        swal({
            title: 'Are you sure?',
            text: 'Do you want to assign selected leads to this user?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, assign!',
            cancelButtonText: 'Cancel',
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: bulkAssignUrl,
                    type: 'POST',
                    data: {
                        lead_ids: leadIds,
                        assigned_to: assignedTo,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            tbl.ajax.reload();
                            $('#assigned_to').val('');
                            $('#select_all_leads').prop('checked', false);
                            $('#leads-actions').hide();
                            swal('Success!', response.message, 'success');
                        } else {
                            swal('Failed!', 'Failed to assign leads.', 'error');
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        swal('Error!', 'Error assigning leads.', 'error');
                    }
                });
            } else {
                $('#assigned_to').val('');
            }
        });
    });

    $(document).on('focus', '.lead-stage-dropdown', function () {
        $(this).data('previous', $(this).val());
    });

    $(document).on('change', '.lead-stage-dropdown', function () {
        let stageId = $(this).val();
        let leadId = $(this).data('lead-id');
        let select = this;
        let oldValue = $(this).data('previous');

        if (!stageId || !leadId) return;

        swal({
            title: 'Are you sure?',
            text: 'Do you want to update the stage for this lead?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update!',
            cancelButtonText: 'Cancel',
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: updateLeadStageUrl.replace(':id', leadId),
                    type: 'POST',
                    data: {
                        stage_id: stageId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            updateStageColor(select);
                            swal('Success!', response.message, 'success');
                        } else {
                            swal('Failed!', response.message || 'Failed to update stage.', 'error');
                            $(select).val(oldValue).trigger('change.select2');
                        }
                    },
                    error: function () {
                        swal('Error!', 'Error updating stage.', 'error');
                        $(select).val(oldValue).trigger('change.select2');
                    }
                });
            } else {
                // Revert to old value if cancelled
                $(select).val(oldValue).trigger('change.select2');
            }
        });
    });

    function updateStageColor(select) {
        // Define stage colors
        const colors = {
            'New': '#0d6efd',       // primary
            'Contacted': '#0dcaf0', // info
            'Qualified': '#ffc107', // warning
            'Won': '#198754',       // success
            'Lost': '#dc3545'       // danger
        };

      
        const selectedText = $(select).find('option:selected').text();
        const bg = colors[selectedText] || '#6c757d';
        const textColor = (selectedText === 'Qualified') ? 'black' : 'white';
        $(select).css({
            'background-color': bg,
            'color': textColor
        });
    }




});
