'use strict';

$(document).ready(function () {
   // modify 19-01-2026
   function updateUserCountBadge(tasksByUser) {
        const count = tasksByUser ? Object.keys(tasksByUser).length : 0;
        const badge = document.getElementById('taskUserCountBadge');
        if (!badge) return;

        if (count > 0) {
            badge.style.display = 'inline-flex';
            badge.textContent = count + ' ' + (count === 1 ? 'User' : 'Users');
        } else {
            badge.style.display = 'none';
            badge.textContent = '0';
        }
     }


    function formatDurationHHMM(value, type) {
        // if value is already "HH:MM" (like "02:45"), keep it
        if (typeof value === 'string' && value.includes(':')) {
                const parts = value.split(':');
                const hh = String(parseInt(parts[0], 10) || 0).padStart(2, '0');
                const mm = String(parseInt(parts[1], 10) || 0).padStart(2, '0');
                return `${hh}:${mm} H`;
      }

        // fallback for numeric values
        const n = parseFloat(value) || 0;
        let totalMinutes = 0;

        if (type == 2) totalMinutes = Math.round(n);
        else if (type == 0) totalMinutes = Math.round(n * 60);
        else if (type == 1) totalMinutes = Math.round(n * 24 * 60);

        const hh = String(Math.floor(totalMinutes / 60)).padStart(2, '0');
        const mm = String(totalMinutes % 60).padStart(2, '0');
        return `${hh}:${mm} H`;
}
    // Initialize date range picker
    // Predefined ranges for the date picker
    $('#filter_date_range').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'YYYY-MM-DD'
        },

        ranges: {
            [Lang.get('messages.days.today')]: [moment(), moment()],
            ['Yesterday']: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             ['Last Workday']: [getLastNthWorkingDay(1), getLastNthWorkingDay(1)],
            ['2nd Last Workday']: [getLastNthWorkingDay(2), getLastNthWorkingDay(2)],

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

        }
    }, function(start, end, label) {
        console.log('Selected Range:', start.format('YYYY-MM-DD'), 'to', end.format('YYYY-MM-DD'));
    });

    $('#filter_date_range').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        fetchTasks();
    });

    $('#filter_date_range').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
        fetchTasks();
    });

    // Filter by user
    $('#filter_user').change(function () {
        fetchTasks();
    });

    // Reset filters
    $('#resetFilters').click(function () {
        $('#filter_user').val('');
        $('#filter_date_range').val('');
        fetchTasks();
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

    // Fetch tasks via AJAX
    function fetchTasks() {
        let userId = $('#filter_user').val();
        let dateRange = $('#filter_date_range').val();
        if (!dateRange) {
            // Default to today if no date range is selected
            let today = moment().format('YYYY-MM-DD');
            dateRange = today + ' - ' + today;
            $('#filter_date_range').val(dateRange);
        }

        $.ajax({
            url: window.location.href,
            type: 'GET',
            data: {
                user_id: userId,
                date_range: dateRange
            },
            beforeSend: function () {
                $('.section-body .row').html('<div class="col-12 text-center">Loading...</div>');
            },
            success: function (response) {
                if (response.success) {
                    renderTaskCards(response.tasksByUser, response.users, response.totalsByUser, response.tagsByUser, dateRange, response.showtagColumn);
                    updateUserCountBadge(response.tasksByUser);
                } else {
                    $('.section-body .row').html('<div class="col-12 text-center">No tasks found.</div>');
                }
            },
            error: function () {
                $('.section-body .row').html('<div class="col-12 text-center text-danger">Error fetching tasks.</div>');
            }
        });
    }
function formatTagEstimateToHHMM(value) {
  if (!value || typeof value !== 'string') return '00:00 H';

  let h = 0, m = 0;

  const matchH = value.match(/(\d+)\sHour/);
  const matchM = value.match(/(\d+)\sMin/);

  h = matchH ? parseInt(matchH[1], 10) : 0;
  m = matchM ? parseInt(matchM[1], 10) : 0;

  return `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')} H`;
}
    // Render task cards
    function renderTaskCards(tasksByUser, users, totalsByUser, tagsByUser, dateRange, showtagColumn) {
        let html = '';
        let i=0;
        const typeLabels = { 0: 'Hours', 1: 'Days', 2: 'Minutes' };

        if ($.isEmptyObject(tasksByUser)) {
            html = '<div class="col-12 text-center"><p>No tasks found for the selected filters.</p></div>';
        } else {
            $.each(tasksByUser, function (userId, tasks) {
                let actualUserId = Array.isArray(userId) ? userId[0] : userId;
                let userName = users[actualUserId] || 'Unknown';
                let totalFormatted = totalsByUser[actualUserId] || '0 Min';
                let userTags = tagsByUser[actualUserId] || {};
                i++;

                if (showtagColumn) {
                    html += `
                         <div class="col-12" ${i > 1 ? 'style="padding-left:0;padding-right:0;"' : ''}>
                            <div class="card shadow mb-4">
                                <div class="card-header bg-primary text-white d-flex justify-content-between">
                                    <span>${userName}</span>
                                    <span>Total: ${totalFormatted}</span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Task list -->
                                        <div class="col-md-3">
                                            <h6>Tasks</h6>
                                            <ul class="list-group mb-2 custom-height">`;
                    $.each(tasks, function (index, task) {
                        let unitLabel = typeLabels[task.estimate_time_type] || 'Hours';
                        html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                ${index + 1}. ${task.title}
                                <span class="">${formatDurationHHMM(task.estimate_time, task.estimate_time_type)}</span>
                            </li>`;
                    });
                    html += `</ul></div>`;

                    // Tags with formatted hours/minutes
                    html += `<div class="col-md-3">
                                <h6>Tags</h6>
                                <ul class="list-group mb-2 custom-height">`;
                    $.each(userTags, function (tagName, estimate) {
                        html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                    ${tagName}
                                   <span class="">${formatTagEstimateToHHMM(estimate)}</span>
                                </li>`;
                    });
                    html += `</ul></div>`;

                    // Pie chart
                    html += `<div class="col-md-6">
                                <h6>Distribution</h6>
                                <canvas id="pieChart-${actualUserId}"  style="width:100% !important; height:80% !important;"></canvas>
                            </div>`;

                    html += `</div></div></div>`;
                } else {
                    // Single column layout (Today/Yesterday)
                    html += `<div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header bg-primary text-white d-flex justify-content-between">
                                        <span>${userName}</span>
                                        <span>Total: ${totalFormatted}</span>
                                    </div>
                                    <div class="card-body" style="height:450px; overflow-y:auto; overflow-x:hidden;scrollbar-width: thin;">
                                        <ul class="list-group pb-3">`;
                    $.each(tasks, function (index, task) {
                        let unitLabel = typeLabels[task.estimate_time_type] || 'Hours';
                        html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                ${index + 1}. ${task.title}
                                <span class="">${formatDurationHHMM(task.estimate_time, task.estimate_time_type)}</span>
                            </li>`;
                    });
                    html += `</ul></div></div></div>`;
                }
            });
        }

        $('.section-body .row').html(html);

        // Render Pie Charts
        if (showtagColumn) {
            setTimeout(function() {
            $.each(tagsByUser, function (userId, tags) {
                let canvas = document.getElementById(`pieChart-${userId}`);
                if (!canvas) return;
                let ctx = canvas.getContext('2d');

                let tagNames = Object.keys(tags);
                let tagValues = Object.values(tags).map(v => {
                // convert "X Hour Y Min" to total hours for chart
                let h = 0, m = 0;
                if (typeof v === 'string') {
                    let matchH = v.match(/(\d+)\s*Hour/);
                    let matchM = v.match(/(\d+)\s*Min/);
                    h = matchH ? parseInt(matchH[1]) : 0;
                    m = matchM ? parseInt(matchM[1]) : 0;
                }
                return h + m / 60;
                });

                let total = tagValues.reduce((a, b) => a + b, 0);

                // Compose labels as "TagName (X%)"
                let labels = tagNames.map((name, idx) => {
                let percent = total > 0 ? ((tagValues[idx] * 100) / total).toFixed(1) : 0;
                return `${name} (${percent}%)`;
                });

                new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                    data: tagValues,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
                        '#5367bbff', '#76A346', '#D4A5A5', '#A3CEF1', '#FFB7B2', '#C1F0F6',
                        '#D5AAFF', '#FFC8A2', '#B8E986', '#FFDAC1', '#E2F0CB', '#B5EAD7',
                        '#C7CEEA', '#FF9AA2', '#9e2d25ff', '#b7947dff', '#b3d778ff', '#67c9a5ff', '#5367bbff'
                    ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                    legend: { position: 'bottom' },
                    datalabels: {
                        color: '#000',
                        font: { weight: 'bold' },
                        anchor: 'center',
                        align: 'center',
                        clamp: true,
                        clip: false,
                        formatter: (value, ctx) => {
                        let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        let percentage = (value * 100 / sum).toFixed(1) + "%";
                        return value / sum < 0.05 ? '' : percentage;
                        //return percentage;
                        }
                    }
                    }
                },
                plugins: [ChartDataLabels]
                });
            });
            }, 50);
        }
    }


    // Function to get Nth last working day (Friday off)
    function getLastNthWorkingDay(n = 1) {
        let date = moment();
        let count = 0;

        while (count < n) {
            date = date.subtract(1, 'days');
            const day = date.day(); // Sunday=0, Monday=1, ..., Friday=5, Saturday=6
            if (day !== 5) { // Friday off
                count++;
            }
        }

        return date;
    }







    // Initial fetch
    fetchTasks();

});
