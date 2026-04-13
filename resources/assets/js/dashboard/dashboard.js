'use strict';

$(document).ready(function () {
    $('#userId').select2({
        width: '100%',
        placeholder: 'Select User',
    })
})

let timeRange = $('#time_range')
const today = languageName == 'ar' ? moment().lang('en') : moment();
let start = today.clone().startOf('month')
let end = today.clone().endOf('month')
let userId = $('#userId').val()
let isPickerApply = false
$(window).on('load', function () {
    if (languageName == 'ar'){
        loadUserWorkReport(start.lang('en').format('YYYY-MM-D  H:mm:ss'),
            end.lang('en').format('YYYY-MM-D  H:mm:ss'), userId);
        loadHours(start.lang('en').format('YYYY-MM-D  H:mm:ss'),
            end.lang('en').format('YYYY-MM-D  H:mm:ss'), userId);
    }else{
        loadUserWorkReport(start.format('YYYY-MM-D  H:mm:ss'),
            end.format('YYYY-MM-D  H:mm:ss'), userId);
        loadHours(start.format('YYYY-MM-D  H:mm:ss'),
            end.format('YYYY-MM-D  H:mm:ss'), userId);
    }
})

timeRange.on('apply.daterangepicker', function (ev, picker) {
    isPickerApply = true
    start = languageName == 'ar' ? picker.startDate.lang('en').format('YYYY-MM-D  H:mm:ss') : picker.startDate.format('YYYY-MM-D  H:mm:ss')
    end = languageName == 'ar' ? picker.endDate.lang('en').format('YYYY-MM-D  H:mm:ss') : picker.endDate.format('YYYY-MM-D  H:mm:ss')
    loadUserWorkReport(start, end, userId);
    loadHours(start, end, userId);
})

window.cb = function (start, end) {
    if (languageName == 'ar') {
        timeRange.find('span').
            html(start.lang('en').format('MMM D, YYYY') + ' - ' + end.lang('en').format('MMM D, YYYY'))
    }else{
        timeRange.find('span').
            html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'))
    }
}

cb(start, end)

const lastMonth = moment().startOf('month').subtract(1, 'days')

timeRange.daterangepicker({
    startDate: start,
    endDate: end,
    opens: 'left',
    showDropdowns: true,
    autoUpdateInput: false,
    locale:{
        customRangeLabel: Lang.get('messages.common.custom'),
        applyLabel:Lang.get('messages.common.apply'),
        cancelLabel: Lang.get('messages.common.cancel'),
        fromLabel:Lang.get('messages.common.from'),
        toLabel: Lang.get('messages.common.to'),
        monthNames: [
            Lang.get('messages.months.jan'),
            Lang.get('messages.months.feb'),
            Lang.get('messages.months.mar'),
            Lang.get('messages.months.apr'),
            Lang.get('messages.months.may'),
            Lang.get('messages.months.jun'),
            Lang.get('messages.months.jul'),
            Lang.get('messages.months.aug'),
            Lang.get('messages.months.sep'),
            Lang.get('messages.months.oct'),
            Lang.get('messages.months.nov'),
            Lang.get('messages.months.dec')
        ],
        daysOfWeek: [
            Lang.get('messages.weekdays.sun'),
            Lang.get('messages.weekdays.mon'),
            Lang.get('messages.weekdays.tue'),
            Lang.get('messages.weekdays.wed'),
            Lang.get('messages.weekdays.thu'),
            Lang.get('messages.weekdays.fri'),
            Lang.get('messages.weekdays.sat')
        ], 
    },
    ranges: {
        [Lang.get('messages.days.today')]: [moment(), moment()],
        [Lang.get('messages.days.this_week')]: [
            moment().startOf('week'),
            moment().endOf('week')],
        [Lang.get('messages.days.last_week')]: [
            moment().startOf('week').subtract(7, 'days'),
            moment().startOf('week').subtract(1, 'days')],
        [Lang.get('messages.days.this_month')]: [start, end],
        [Lang.get('messages.days.last_month')]: [
            lastMonth.clone().startOf('month'),
            lastMonth.clone().endOf('month')],
    },
}, cb)

$('#userId').on('change', function (e) {
    e.preventDefault();
    userId = $('#userId').val();
    let startDate = (isPickerApply) ? start : start.format(
        'YYYY-MM-D  H:mm:ss');
    let endDate = (isPickerApply) ? end : end.format('YYYY-MM-D  H:mm:ss');
    loadUserWorkReport(startDate, endDate, userId);
    loadHours(startDate, endDate, userId);
});

window.loadHours = function (startDate, endDate, userId) {
    $.ajax({
        type: 'GET',
        url: route('dashboard-total-hours'),
        dataType: 'json',
        data: {
            start_date: startDate,
            end_date: endDate,
            user_id: userId,
        },
        cache: false,
        success: function (result) {
            $('.hours').empty();
            $('.hours').append('(' + result.data + ')');
        },
    });
};

window.loadUserWorkReport = function (startDate, endDate, userId) {
    $.ajax({
        type: 'GET',
        url: route('users-work-report'),
        dataType: 'json',
        data: {
            start_date: startDate,
            end_date: endDate,
            user_id: userId,
        },
        cache: false,
    }).done(prepareUserWorkReport)
}

window.prepareUserWorkReport = function (result) {
    $('#daily-work-report').html('')
    let data = result.data
    if (data.totalRecords === 0) {
        $('#work-report-container').html('')
        $('#work-report-container').
            append(
                '<div align="center" class="no-record">'+ noRecordFoundMessage +'</div>')
        return true
    } else {
        $('#work-report-container').html('')
        $('#work-report-container').
            append('<canvas id="daily-work-report"></canvas>')
    }

    let barChartData = {
        labels: data.date,
        datasets: data.data,
        total_hrs: data.totalHrs,
    };
    let ctx = document.getElementById('daily-work-report').getContext('2d');
    ctx.canvas.style.height = '400px';
    ctx.canvas.style.width = '100%';
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            title: {
                display: false,
                text: data.label,
            },
            tooltips: {
                mode: 'index',
                callbacks: {
                    title: function (tooltipItem, data) {
                        const labelDate = tooltipItem[0]['label'];

                        return labelDate + ' - ' + roundToQuarterHour(data.total_hrs[labelDate]);
                    },
                    label: function (tooltipItem, data) {
                     const result = roundToQuarterHour(tooltipItem.yLabel);
                        if (result === '0min') {
                            return ''
                        }
                        let element = document.createElement('textarea');
                        element.innerHTML = data.datasets[tooltipItem.datasetIndex].label;
                        let label = element.value || '';

                        if (label) {
                            label += ': '
                        }

                        return label + result
                    },
                },
            },
            responsive: false,
            maintainAspectRatio: false,
            scales: {

                xAxes: [
                    {
                        stacked: true,
                    }],
                yAxes: [
                    {
                        stacked: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Hours',
                        },
                        ticks: {
                            min: 0,
                            stepSize: 1,
                        },
                    }],
            },
        },
    })
};

window.roundToQuarterHour = function (duration) {
    const totalTime = duration.toString().split('.')
    const hours = parseInt(totalTime[0])
    const minutes = Math.floor((duration * 60)) - Math.floor((hours * 60))
    if (hours === 0) {
        return minutes + 'min'
    }

    if (minutes > 0) {
        return hours + 'hr ' + minutes + 'min'
    }
    return hours + 'hr'
}

$(document).ready(function () {
    let applyBtn = $('.range_inputs > button.applyBtn');
    $(document).on('click','.ranges li', function () {
        if($(this).data('range-key') === 'Custom Range') {
            applyBtn.css('display','initial')
        } else {
            applyBtn.css('display','none')
        }
    });
    applyBtn.css('display','none')
})

// KPI date range and loader
$(function () {
    const kpiEl = $('#kpi_range');
    if (!kpiEl.length) return;

    const now = moment();
    let kpiStart = now.clone().startOf('month');
    let kpiEnd = now.clone().endOf('month');

    function setKpiLabel(s, e) {
        kpiEl.find('span').html(s.format('MMM D, YYYY') + ' - ' + e.format('MMM D, YYYY'))
    }

    function loadKpis(s, e) {
        $('#kpi-loader').removeClass('d-none');
        $('#kpi-cards').addClass('d-none');
        $.ajax({
            type: 'GET',
            url: route('dashboard.stats'),
            dataType: 'json',
            data: {
                start_date: s.format('YYYY-MM-D  H:mm:ss'),
                end_date: e.format('YYYY-MM-D  H:mm:ss'),
            },
            cache: false,
        }).done(function (res) {
            const d = res.data || {};
            $('#kpi-total-onboarded').text(d.total_onboarded ?? 0);
            $('#kpi-total-ongoing').text(d.total_ongoing ?? 0);
            $('#kpi-total-paid-jobs').text(d.total_paid_jobs ?? 0);
            $('#kpi-total-due-jobs').text(d.total_due_jobs ?? 0);
            $('#kpi-total-paid-amount').text(d.total_paid_amount ?? 0);
            $('#kpi-total-due-amount').text(d.total_due_amount ?? 0);
            $('#kpi-total-employees').text(d.total_employees ?? 0);
            $('#kpi-total-active-employees').text(d.total_active_employees ?? 0);
            $('#kpi-total-inactive-employees').text(d.total_inactive_employees ?? 0);
            $('#kpi-total-inactive').text(d.total_inactive_jobs ?? 0);
        }).always(function () {
            $('#kpi-loader').addClass('d-none');
            $('#kpi-cards').removeClass('d-none');
        });
    }

    setKpiLabel(kpiStart, kpiEnd);

    const yearStart = now.clone().startOf('year');
    // earliest project date injected from blade as ISO string if available
    let earliestProjectDate = typeof window.earliestProjectDate !== 'undefined' && window.earliestProjectDate
        ? moment(window.earliestProjectDate)
        : moment('2010-01-01');
    kpiEl.daterangepicker({
        startDate: kpiStart,
        endDate: kpiEnd,
        opens: 'left',
        showDropdowns: true,
        autoUpdateInput: false,
        ranges: {
            'All Time': [earliestProjectDate.clone().startOf('day'), moment().endOf('day')],
            'Today': [moment().startOf('day'), moment().endOf('day')],
            'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            'Last 7 Days': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
            'Last 30 Days': [moment().subtract(29, 'days').startOf('day'), moment().endOf('day')],
            'This Month': [now.clone().startOf('month'), now.clone().endOf('month')],
            'Last Month': [now.clone().subtract(1, 'month').startOf('month'), now.clone().subtract(1, 'month').endOf('month')],
            'This Year': [yearStart, now.clone().endOf('day')],
        },
    }, setKpiLabel);

    kpiEl.on('apply.daterangepicker', function (ev, picker) {
        kpiStart = picker.startDate;
        kpiEnd = picker.endDate;
        loadKpis(kpiStart, kpiEnd);
    });

    loadKpis(kpiStart, kpiEnd);
});
