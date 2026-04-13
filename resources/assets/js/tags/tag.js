$(document).ready(function () {
    'use strict';

    $('#department_ids,#edit_department_ids').select2({
        width: '100%',
        placeholder: 'Select Users',
    });
    $('#tags_table').DataTable({
        processing: true,
        serverSide: true,
        'order': [[0, 'asc']],
        ajax: {
            url: route('tags.index'),
        },
        columnDefs: [
            {
                'targets': [1],
                'orderable': false,
                'className': 'text-center',
                'width': '5%',
            },
        ],
        columns: [
            {
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    return '<a title="Edit" class="btn action-btn btn-primary btn-sm edit-btn mr-1" data-id="' +
                        row.id + '">' +
                        '<i class="cui-pencil action-icon"></i>' + '</a>' +
                        '<a title="Delete" class="btn action-btn btn-danger btn-sm delete-btn" data-id="' +
                        row.id + '">' +
                        '<i class="cui-trash action-icon"></i></a>';
                }, name: 'id',
            },
        ],
    });

    $('#AddModal').on('shown.bs.modal', function () {

         let $department = $('#department_ids');
     
         if ($department.hasClass("select2-hidden-accessible")) {
             $department.select2('destroy');
         }
     
         $department.select2({
             width: '100%',
             placeholder: 'Select Departments',
             dropdownParent: $('#AddModal')
         });
    });

    $('#AddModal').on('hidden.bs.modal', function () {
       $('#department_ids').val(null).trigger('change');
    });

    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#btnSave');
        loadingButton.button('loading');
        $.ajax({
            url: route('tags.store'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#AddModal').modal('hide');
                    $('#tags_table').DataTable().ajax.reload(null, false);
                    window.livewire.emit('refresh');
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

    // ===============================
    // Edit Modal: initialize Select2
    // ===============================
    $('#EditModal').on('shown.bs.modal', function () {
        let $department = $('#edit_department_ids');

        if ($department.hasClass("select2-hidden-accessible")) {
            $department.select2('destroy');
        }

        $department.select2({
            width: '100%',
            placeholder: 'Select Departments',
            dropdownParent: $('#EditModal')
        });

        
    });

    $('#EditModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
        window.editDepartments = [];
    });

    $(document).on('submit', '#editForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#btnEditSave');
        loadingButton.button('loading');
        var id = $('#tagId').val();
        $.ajax({
            url: route('tags.update', id),
            type: 'put',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#EditModal').modal('hide');
                    $('#tags_table').DataTable().ajax.reload(null, false);
                    window.livewire.emit('refresh');
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $('#AddModal').on('hidden.bs.modal', function () {
        $('#tagHeader').html(newTag);
        resetModalForm('#addNewForm', '#validationErrorsBox');
    });

    $('#EditModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
    });

    window.renderData = function (id) {
        $.ajax({
            url: route('tags.edit',id),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let element = document.createElement('textarea');
                    element.innerHTML = result.data.name;
                    $('#tagId').val(result.data.id);
                    $('#tagName').val(element.value);
                     // Pre-select departments (similar to your project users example)
                     let tag = result.data;
                    if (tag.departments && tag.departments.length > 0) {
                        let deptIds = tag.departments.map(d => d.id);
                        $('#edit_department_ids').val(deptIds).trigger('change');
                    } else {
                        $('#edit_department_ids').val(null).trigger('change');
                    }

                    // Set is_active switch state
                    $('#is_active_switch').prop('checked', tag.is_active == 1);

                    $('#EditModal').appendTo('body').modal('show');
    
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    window.setBulkTags = function () {
        $('#isBulkTags').val(true);
        $('#tagHeader').html(addBulkTag);
    };

    $(document).on('click', '.edit-btn', function (event) {
        let tagId = $(event.currentTarget).attr('data-id');
        renderData(tagId);

    });

     if ($('#edit_department_ids').length) {
       $('#edit_department_ids').select2({
           width: '100%',
           placeholder: 'Select Departments'
       });
    }


    $(document).on('click', '.delete-btn', function (event) {
        let tagId = $(event.currentTarget).attr('data-id');
        deleteItem(route('tags.destroy',tagId), '#tags_table', 'Tag', 'location.reload()');
    });

    $(document).on('click', '.addBulkTags', function () {
        $('#AddModal').appendTo('body').modal('show');
    });

    $(document).on('click', '.addNewTag', function () {
        $('#AddModal').appendTo('body').modal('show');
    });

    $('.modal').on('show.bs.modal', function () {
        $(this).appendTo('body');
    });
});
