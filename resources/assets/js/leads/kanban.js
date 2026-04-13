"use strict";

let containers = [];
let boardCount = document.getElementsByClassName('board').length;

for (let i = 0; i < boardCount; i++) {
    containers.push(document.querySelector('.board-' + i));
}

let id;
let drake = dragula({
    containers: containers,
    revertOnSpill: true,
    direction: 'vertical'
}).on('drag', function (el) {
    el.className = el.className.replace('ex-moved', '');
}).on('drop', function (el, container) {
    let board = $(container);
    el.className += ' ex-moved';
    id = $('.ex-moved').data('id');
    let leadStage = $('.ex-moved').data('lead-stage');
    let boardStage = $(container).data('board-stage');
    board.parent().find('.infy-loader').fadeIn();

    $.ajax({
        url: route('leads.update-stage', id),
        type: 'PUT',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            current_stage: leadStage,
            new_stage: boardStage,
        },
        cache: false,
        complete: function () {
            board.parent().find('.infy-loader').fadeOut();
        }
    })
}).on('over', function (el, container) {
    container.className += ' ex-over';
}).on('out', function (el, container) {
    container.className = container.className.replace('ex-over', '');
});

$(document).ready(function () {
    let containers = [
        document.querySelector('.flex-nowrap')
    ];

    $('.board').each(function (index, ele) {
        containers.push(document.querySelector('.board-' + index));
    });

    var scroll = autoScroll(containers, {
        margin: 200,
        autoScroll: function () {
            return this.down && drake.dragging;
        }
    });
});

/**
 * Open lead details in modal
 */
    $(document).on('click', '.lead-details', function (e) {
        e.preventDefault();
        let curEle = $(this);
        curEle.addClass('disabled');
        let leadId = $(this).attr('data-id');

        $.ajax({
            url: route('kanban-lead-details', leadId),
            type: 'get',
            success: function (result) {
                if (result.success) {
                    renderLeadDetailsKanban(result.data);
                    $('#leadKanbanDetailsModal').modal('show');
                }
            },
            error: function (result) {
                manageAjaxErrors(result)
            },
            complete: function () {
                curEle.removeClass('disabled');
            }
        })
    });

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

    // When stage filter changes
    $('#filter_stage').change(function () {
        let stageId = $(this).val();
        Livewire.emit('loadByStage', stageId);
    });

    // When user filter changes
    $('#filter_user').change(function () {
        let userId = $(this).val();
        Livewire.emit('loadByUser', userId);
    });

    // When source filter changes
    $('#filter_source').change(function () {
        let sourceId = $(this).val();
        Livewire.emit('loadBySource', sourceId);
    });

    // $('#filter_date_range, #filter_follow_up_date').daterangepicker({
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

    $('#filter_date_range, #filter_follow_up_date').on('apply.daterangepicker', function(ev, picker) {
        let range = picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD');
        $(this).val(range);
        Livewire.emit('loadByDateRange', range);
    });

    $('#filter_date_range, #filter_follow_up_date').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        Livewire.emit('loadByDateRange', null); 
    });

    // Sort dropdown
    $('#sort').change(function () {
        let sortVal = $(this).val() || null; 
        Livewire.emit('loadBySort', sortVal);
    });

    // Reset filters
    $('#resetFilters').click(function () {
        $('#filter_stage, #filter_user, #filter_source, #filter_date_range, #filter_follow_up_date, #sort').val('').trigger('change');

        Livewire.emit('loadByStage', null);
        Livewire.emit('loadByUser', null);
        Livewire.emit('loadBySource', null);
        Livewire.emit('loadByDateRange', null);
        Livewire.emit('loadBySort', null);

    });



    // Reset filters
    $('#resetFilters').click(function () {
        $('#filter_stage, #filter_source, #filter_user, #filter_date_range, #filter_follow_up_date').val('').trigger('change');
        tbl.ajax.reload();
    });

/**
 * Render Lead Details (example)
 */
const renderLeadDetailsKanban = (data) => {
    let lead = data.leadDetails;

    $('#leadId').val(lead.id);
    $('#lead_name').empty().append(lead.first_name + ' ' + lead.last_name);
    $('#lead_email').empty().append(lead.email ?? 'N/A');
    $('#lead_phone').empty().append(lead.phone ?? 'N/A');
    $('#lead_stage').empty().append(lead.stage?.name ?? 'N/A');
    $('#lead_source').empty().append(lead.source?.name ?? 'N/A');
    $('#created_by').empty().append(lead.created_user?.name ?? 'N/A');
    $('#created_date').empty().append(moment(lead.created_at).format('DD-MM-YYYY'));
}
