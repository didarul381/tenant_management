'use strict';

$(document).ready(function() {

    // Initialize default 1-month range
    let defaultStart = moment().subtract(1, 'months').format('YYYY-MM-DD');
    let defaultEnd = moment().format('YYYY-MM-DD');

    function parseHTMLTable(html) {
        var $temp = $('<div>').html(html);
        var data = [];
        $temp.find('tbody tr').each(function() {
            var row = {};
            $(this).find('td').each(function(index) {
                switch(index) {
                    case 0: row.company_name = $(this).text().trim(); break;
                    case 1: row.display_name = $(this).text().trim(); break;
                    case 2: row.call_date = $(this).text().trim(); break;
                    case 3: row.source = $(this).text().trim(); break;
                    case 4: row.destination = $(this).text().trim(); break;
                    case 5: row.duration = $(this).text().trim(); break;
                    case 6: row.type = $(this).text().trim(); break;
                    case 7: row.status = $(this).text().trim(); break;
                    case 8: row.recordings = $(this).find('audio source').attr('src') || ''; break;
                }
            });
            data.push(row);
        });
        return data;
    }
    // ---------------------------
    // Initialize DataTable
    // ---------------------------
    let table = $('#callrecords-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: callRecordsListUrl,
            data: function(d) {
                let filters = getFilters();
                if (!filters.filter_call_date) {
                    filters.filter_call_date = defaultStart + ' - ' + defaultEnd;
                    $('#filter_call_date').val(filters.filter_call_date);
                }
                d.filter_employee_name = filters.filter_employee_name;
                d.filter_status = filters.filter_status;
                d.filter_call_date = filters.filter_call_date;
                d.filter_created_at = filters.filter_created_at;
            }
        },
        columns: [
            { data: 'employee_name', name: 'employee_name' },
            { data: 'company_name', name: 'company_name' },
            { data: 'display_name', name: 'display_name' },
            { data: 'call_date', name: 'call_date' },
            { data: 'source', name: 'source' },
            { data: 'destination', name: 'destination' },
            { data: 'duration', name: 'duration' },
            { data: 'type', name: 'type' },
            { data: 'status', name: 'status' },
            { data: 'recordings', name: 'recordings', orderable: false, searchable: false },
            { data: 'created_at', name: 'created_at' },
        ]
    });

    // Import Records
    // ---------------------------
    $('#importSubmit').click(function () {
        var $btn = $(this);
        $btn.prop('disabled', true);

        var html = $('#htmlTableInput').val();
        if (!html) {
            swal({
                title: 'Warning',
                text: 'Please paste the table first.',
                type: 'warning',
                confirmButtonColor: '#6777ef',
            });
            $btn.prop('disabled', false);
            return;
        }

        var records = parseHTMLTable(html);

        $.ajax({
            url: callRecordsImportUrl,
            method: 'POST',
            data: { records: records, _token: csrfToken },
            success: function(res) {
                swal({
                    title: 'Success!',
                    text: res.message,
                    type: 'success',
                    confirmButtonColor: '#28a745'
                }, function () {
                    $('#importModal').modal('hide');
                    table.ajax.reload();
                    updateCards();
                });
            },
            error: function(err) {
                console.error(err);
                swal({
                    title: 'Error!',
                    text: 'Import failed. Please try again.',
                    type: 'error',
                    confirmButtonColor: '#dc3545'
                });
            },
            complete: function() {
                $btn.prop('disabled', false);
            }
        });
    });
    // ---------------------------

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
    // ---------------------------
    // Filters change
    // ---------------------------
    $('#filter_employee_name, #filter_status').on('change', function() {
        table.ajax.reload();
        updateCards();
    });

    $('#filter_call_date, #filter_created_at').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        table.ajax.reload();
        updateCards();
    });

    $('#filter_call_date, #filter_created_at').on('cancel.daterangepicker', function() {
        $(this).val('');
        table.ajax.reload();
        updateCards();
    });

    // ---------------------------
    // Reset Filters
    // ---------------------------
    $('#resetFilters').on('click', function() {
        $('#filter_employee_name').val('').trigger('change');
        $('#filter_status').val('').trigger('change');

        // Reset daterangepicker
        $('#filter_call_date').data('daterangepicker').setStartDate(defaultStart);
        $('#filter_call_date').data('daterangepicker').setEndDate(defaultEnd);
        $('#filter_call_date').val(defaultStart + ' - ' + defaultEnd);

        $('#filter_created_at').data('daterangepicker').setStartDate(defaultStart);
        $('#filter_created_at').data('daterangepicker').setEndDate(defaultEnd);
        $('#filter_created_at').val('');

        table.ajax.reload();
        updateCards();
    });

    // ---------------------------
    // Datepickers
    // ---------------------------
    $('#filter_call_date').daterangepicker({
        autoUpdateInput: false,
        locale: { cancelLabel: 'Clear', format: 'YYYY-MM-DD' }
    });

    $('#filter_created_at').daterangepicker({
        autoUpdateInput: false,
        locale: { cancelLabel: 'Clear', format: 'YYYY-MM-DD' }
    });

    // ---------------------------
    // Update Cards
    // ---------------------------
    function updateCards() {
        $.ajax({
            url: callRecordsSummaryUrl,
            data: getFilters(),
            success: function(res) {
                $('#card_answered').text(res.summary['ANSWERED'] || 0);
                $('#card_busy').text(res.summary['BUSY'] || 0);
                $('#card_no_answer').text(res.summary['NO ANSWER'] || 0);
                $('#card_no_congestion').text(res.summary['CONGESTION'] || 0);
                $('#card_totalcall').text(res.totalCalls  || 0);
                $('#card_unique').text(res.uniqueNumbers || 0);
            }
        });
    }

    function getFilters() {
        return {
            filter_employee_name: $('#filter_employee_name').val(),
            filter_status: $('#filter_status').val(),
            filter_call_date: $('#filter_call_date').val(),
            filter_created_at: $('#filter_created_at').val(),
        };
    }

    // Initial cards update on page load
    updateCards();
});
