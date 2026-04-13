'use strict';

$(document).ready(function () {
    let tbl = $('#absents_table').DataTable({
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
            url: route('absents.index'),
            data: function (data) {
                data.filter_user = $('#filter_user').val();
                data.filter_status = $('#filter_status').val();
                data.date_range = $('#filter_date_range').val();
            },
        },
        columns: [
            { data: function(row) { return row.user.name; }, name: 'user.name' },
            // { 
            //     data: 'partial_leave', 
            //     name: 'partial_leave',
            //     render: function(data) { return data ? 'Yes' : 'No'; }
            // },
             {
                data: 'absent_day',
                name: 'absent_day'
            },
            // { 
            //     data: 'from_date', 
            //     name: 'from_date',
            //     render: function(data) { return data ? moment(data).format('YYYY-MM-DD') : ''; }
            // },
            // { 
            //     data: 'to_date', 
            //     name: 'to_date',
            //     render: function(data) { return data ? moment(data).format('YYYY-MM-DD') : ''; }
            // },
             {
                data: 'total_days',
                name: 'total_days'
            },
           
            // { 
            //     data: 'from_time', 
            //     name: 'from_time', 
            //     defaultContent: 'N/A',
            //     render: function(data) { return data ? moment(data, 'HH:mm:ss').format('hh:mm A') : 'N/A'; }
            // },
            // { 
            //     data: 'to_time', 
            //     name: 'to_time', 
            //     defaultContent: 'N/A',
            //     render: function(data) { return data ? moment(data, 'HH:mm:ss').format('hh:mm A') : 'N/A'; }
            // },
            { data: 'reason', name: 'reason', defaultContent: 'N/A' },
           
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

            // { 
            //     data: function(row) { return row.created_at ? moment(row.created_at).format('YYYY-MM-DD') : ''; }, 
            //     name: 'created_at'
            // },
            {
                data: 'created_at',
                name: 'created_at'
            },

            // { 
            //     data: function(row) { return row.updated_at ? moment(row.updated_at).format('YYYY-MM-DD') : ''; }, 
            //     name: 'updated_at'
            // },
            // {
            //     data: function(row) {
            //         return actionTemplate({
            //            // Url: route('absents.index'),
            //            Url: route('absents.index'),
            //             viewText: 'View',
            //             editText: 'Edit',
            //             deleteText: 'Delete',
            //             id: row.id,
            //         });
            //     },
            //     name: 'id',
            //     orderable: false,
            //     className: 'text-center',
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

    // Delete/Approve/Reject/Pending Absent
    $(document).on('click', '.delete-btn', function (event) {
        let leadStageId = $(event.currentTarget).attr('data-id');
        deleteLeadStage(route('absents.destroy', leadStageId));
    });

    $(document).on('click', '.approve-btn', function (event) {
        let absentId = $(event.currentTarget).attr('data-id');
        updateAbsentStatus(route('absents.update-status', absentId), 'approved');
    });

    $(document).on('click', '.reject-btn', function (event) {
        let absentId = $(event.currentTarget).attr('data-id');
        updateAbsentStatus(route('absents.update-status', absentId), 'rejected');
    });

     $(document).on('click', '.pending-btn', function (event) {
        let absentId = $(event.currentTarget).attr('data-id');
        updateAbsentStatus(route('absents.update-status', absentId), 'pending');
    });
    
     window.deleteLeadStage = function (url) {
        swal({
            title: 'Are you sure!',
            text: 'You want to delete this absent record?',
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
                        text: 'Absent has been deleted.',
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


    window.updateAbsentStatus = function (url, status) {
        let actionText = status === 'pending' ? 'Pending Status' : status.charAt(0).toUpperCase() + status.slice(1);
        let actionLower = status === 'pending' ? 'Pending the status of' : actionText.toLowerCase();
        let actionPast = status === 'pending' ? 'Pending' : actionText.toLowerCase() + 'd';
        swal({
            title: 'Are you sure!',
            text: `You want to ${actionLower} this absent?`,
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
                data: { status: status, _token: $('meta[name="csrf-token"]').attr('content') },
                dataType: 'json',
                success: function (obj) {
                    if (obj.success) {
                        tbl.ajax.reload(null, false);
                    }

                    swal({
                        title: `${actionText}!`,
                        text: `Absent has been ${actionPast}.`,
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
    //   $('#filter_date_range').daterangepicker({
    //       autoUpdateInput: false,
    //       locale: {
    //           cancelLabel: 'Clear',
    //           format: 'YYYY-MM-DD'
    //       }
    //   });
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
});
