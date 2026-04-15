'use strict';

$(document).ready(function () {

    let tbl = $('#properties_table').DataTable({
        order: [[5, "desc"]],
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
            url: route('properties.index'),
            data: function (data) {
                data.filter_user = $('#filter_user').val();
                data.filter_status = $('#filter_status').val();
            },
        },

        columns: [
            { data: 'owner.name', name: 'owner.name', defaultContent: 'N/A' },
            { data: 'name', name: 'name' },
            { data: 'total_floors', name: 'total_floors', className: 'text-center' },
            { data: 'total_units', name: 'total_units', className: 'text-center' },

            {
                data: 'status',
                name: 'status',
                render: function (data) {
                    let label = 'secondary';
                    if (data === 'active') label = 'success';
                    else if (data === 'inactive') label = 'warning';
                    else if (data === 'sold') label = 'danger';

                    return `<span class="badge bg-${label} text-white">${data}</span>`;
                }
            },

            {
                data: 'created_at',
                name: 'created_at',
                render: function (data) {
                    return data ? moment(data).format('YYYY-MM-DD') : '';
                }
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center',
            },
        ],
    });

    /*
    ==========================================
        DELETE PROPERTY
    ==========================================
    */
    $(document).on('click', '.delete-btn', function () {

        let propertyId = $(this).data('id');

        swal({
            title: 'Are you sure!',
            text: 'You want to delete this property?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6777EF',
        }, function () {

            $.ajax({
                url: route('properties.destroy', propertyId),
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {

                    if (res.success) {
                        tbl.ajax.reload(null, false);
                    }

                    swal({
                        title: 'Deleted!',
                        text: 'Property deleted successfully.',
                        type: 'success',
                        timer: 2000
                    });
                }
            });

        });
    });

    /*
    ==========================================
        FILTER
    ==========================================
    */
    $('#filter_user, #filter_status').change(function () {
        tbl.ajax.reload();
    });

    $('#resetFilters').click(function () {
        $('#filter_user, #filter_status').val('').trigger('change');
    });


    /*
    ==========================================
        🔥 ATTACHMENT SYSTEM (LIKE LEAVE REQUEST)
    ==========================================
    */

    let propertyAttachments = [];

    initializeAttachmentHandlers();

    function initializeAttachmentHandlers() {

        // Choose Button
        $('.choose-button').off('click').on('click', function (e) {
            e.preventDefault();
            $('#Add_attachment').val('').trigger('click');
        });

        // File Input Change
        $('#Add_attachment').off('change').on('change', function (e) {

            e.preventDefault();

            propertyAttachments = [];

            let files = this.files;

            if (files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    propertyAttachments.push(files[i]);
                }
            }

            displayPropertyAttachments();

            return false;
        });

        // Remove File
        $(document).on('click', '.remove-attachment', function (e) {
            e.preventDefault();

            let index = $(this).data('index');

            propertyAttachments.splice(index, 1);

            displayPropertyAttachments();

            if (propertyAttachments.length === 0) {
                $('#Add_attachment').val('');
            }
        });
    }

    /*
    ==========================================
        PREVIEW FILES
    ==========================================
    */
    function displayPropertyAttachments() {

        let html = '';

        if (propertyAttachments.length > 0) {

            propertyAttachments.forEach((file, index) => {

                let fileURL = URL.createObjectURL(file);
                let isImage = file.type.startsWith('image');

                html += `
                    <div class="col-md-3 mb-3">
                        <div class="card">

                            ${
                                isImage
                                    ? `<img src="${fileURL}" class="card-img-top" style="height:150px;object-fit:cover;">`
                                    : `<div class="text-center p-4"><i class="fas fa-file fa-2x"></i></div>`
                            }

                            <div class="card-body p-2">
                                <p class="small text-truncate">${file.name}</p>

                                <button type="button"
                                    class="btn btn-sm btn-danger remove-attachment"
                                    data-index="${index}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                `;
            });

        } else {
            html = '<p class="text-muted">No files selected</p>';
        }

        $('#previewImage').html(html);
    }

    /*
    ==========================================
        DELETE EXISTING DOCUMENT
    ==========================================
    */


    $(document).on('click', '.delete-property-attachment', function () {

    let attachmentId = $(this).data('id');

    swal({
        title: 'Are you sure!',
        text: 'You want to delete this property attachment?',
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
            url: route('properties.delete-attachment', attachmentId),
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },

            success: function (response) {

                if (response.success) {
                    

                    // Remove from DOM (safe both cases)
                    $('.delete-property-attachment[data-id="' + attachmentId + '"]')
                        .closest('.col-md-3')
                        .fadeOut(300, function () {
                            $(this).remove();
                        });

                    swal({
                        title: 'Deleted!',
                        text: 'Attachment deleted successfully.',
                        type: 'success',
                        timer: 1000,
                        confirmButtonColor: '#6777EF',
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