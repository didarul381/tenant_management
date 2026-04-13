$(document).ready(function () {
    'use strict';
    
    $(document).on('submit', '#addNewTypeForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#btnSave');
        loadingButton.button('loading');
        $.ajax({
            url: route('job-type.store'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addTypeModal').modal('hide');
                    window.livewire.emit('refresh');
                }
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
            },
            complete: function () {
                loadingButton.button('reset');
                window.livewire.emit('refresh');
            },
        });
    });

    $(document).on('submit', '#editForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#btnEditSave');
        loadingButton.button('loading');
        var id = $('#typeId').val();
        $.ajax({
            url: route('job-type.update', id),
            type: 'put',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#EditModal').modal('hide');
                    window.livewire.emit('refresh');
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
            complete: function () {
                loadingButton.button('reset');
                window.livewire.emit('refresh');
            },
        });
    });

    $('#addTypeModal').on('hidden.bs.modal', function () {
        resetModalForm('#addNewTypeForm', '#validationErrorsBox');
    });

    $('#EditModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
    });

    window.renderData = function (id) {
        $.ajax({
            url: route('job-type.edit',id),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let element = document.createElement('textarea');
                    element.innerHTML = result.data.name;
                    $('#typeId').val(result.data.id);
                    $('#typeName').val(element.value);
                    $('#orderNum').val(result.data.order);
                    $('#descriptionNum').val(result.data.description);
                    $('#EditModal').appendTo('body').modal('show');
                    if (result.data.type === 0 || result.data.type ===
                        1) {
                        $('.edit_name').hide();
                    } else {
                        $('.edit_name').show();
                    }
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    $(document).on('click', '.edit-btn', function (event) {
        let typeId = $(event.currentTarget).attr('data-id');
        renderData(typeId);

    });

    $(document).on('click', '.delete-btn', function (event) {
        let typeId = $(event.currentTarget).attr('data-id');
        deleteItem(route('job-type.destroy',typeId), '#type_table', 'Type',
            'location.reload()');
    });

    $(document).on('click', '.addNewType', function () {
        $('#addTypeModal').appendTo('body').modal('show');
    });

    // $(document).on('click', '#type_modal', function () {
    //     $.ajax({
    //         url: 'order',
    //         type: 'get',
    //         success: function (result) {
    //             $('#order').val(result.data.order + 1);
    //         },
    //     });
    // });

    $('.modal').on('show.bs.modal', function () {
        $(this).appendTo('body');
    });
});