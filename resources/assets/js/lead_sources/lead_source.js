'use strict';
$(document).ready(function () {

    // DataTable initialization
    let tbl = $('#lead_source_table').DataTable({
        language: {
            'paginate': {
                'previous': '<i class="fas fa-angle-left"></i>',
                'next': '<i class="fas fa-angle-right"></i>',
            },
            'info': 'Showing _START_ to _END_ of _TOTAL_ entries',
        },
        processing: true,
        serverSide: true,
        'order': [[0, 'asc']],
        ajax: {
            url: route('lead-sources.index'),
        },
        columnDefs: [
            {
                'targets': [3], // Action column index
                'orderable': false,
                'className': 'text-center',
                'width': '80px',
            },
        ],
        columns: [
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { 
                data: function (row) {
                    return row.user ? row.user.name : 'N/A'; // Created By
                }, 
                name: 'user.name',
            },
            {
                data: function (row) {
                    return actionTemplate({
                        Url: route('lead-sources.index'),
                        viewText: 'View',
                        editText: 'Edit',
                        deleteText: 'Delete',
                        id: row.id,
                    });
                },
                name: 'id',
            },
        ],
    });

    // Summernote for description
    $('#leadSourceDescription').summernote({
        placeholder: 'Add description...',
        minHeight: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['paragraph']],
        ],
    });

    // Form submit validation
    $(document).on('submit', '.lead-source-form', function () {
        let $description = $('<div />').html($('#leadSourceDescription').summernote('code'));
        let empty = $description.text().trim() === '';
        let loadingButton = $(this).find('.save-btn');
        loadingButton.button('loading');

        if ($('#name').val().trim() === '') {
            displayErrorMessage('Name field is required.');
            loadingButton.button('reset');
            return false;
        }

        if ($('#leadSourceDescription').summernote('isEmpty') || empty) {
            $('#leadSourceDescription').val('');
        }
    });

    // Delete Lead Source
    $(document).on('click', '.delete-btn', function (event) {
        let leadSourceId = $(event.currentTarget).attr('data-id');
        deleteLeadSource(route('lead-sources.destroy', leadSourceId));
    });

    window.deleteLeadSource = function (url) {
        swal({
            title: 'Are you sure!',
            text: 'You want to delete this Lead Source?',
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
                        text: 'Lead Source has been deleted.',
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

});
