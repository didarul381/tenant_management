$(document).ready(function() {
    // Check current attendance status on page load
    checkAttendanceStatus();
    
    // Check in button click
    $(document).on('click', '#signInBtn', function() {
        signIn();
    });
    
    // Check out button click
    $(document).on('click', '#signOutBtn', function() {
        signOut();
    });
    
    // Break button click
    $(document).on('click', '#breakBtn', function() {
        startBreak();
    });
    
    // Back button click
    $(document).on('click', '#backBtn', function() {
        endBreak();
    });
    
    // Check attendance status every 30 seconds
    setInterval(checkAttendanceStatus, 30000);
});

function checkAttendanceStatus() {
    $.ajax({
        url: '/attendance/current-status',
        method: 'GET',
        success: function(response) {
            updateAttendanceButtons(response);
        },
        error: function(xhr) {
            console.error('Error checking attendance status:', xhr.responseJSON);
        }
    });
}

// function updateAttendanceButtons(status) {
//     var signInBtn = $('#signInBtn');
//     var signOutBtn = $('#signOutBtn');
//     var breakBtn = $('#breakBtn');
//     var backBtn = $('#backBtn');
    
//     // Hide all buttons first
//     signInBtn.addClass('d-none');
//     signOutBtn.addClass('d-none');
//     breakBtn.addClass('d-none');
//     backBtn.addClass('d-none');
    
//     if (status.is_signed_in) {
//         // User is Checked in, show Check out button and Break button
//         signOutBtn.removeClass('d-none');
        
//         if (status.is_on_break) {
//             // User is currently on break, show Back button
//             backBtn.removeClass('d-none');
//         } else {
//             // User is checked in but not on break, show Break button
//             breakBtn.removeClass('d-none');
//         }
//     } else if (status.is_signed_out) {
//         // User already Checked out today, hide both buttons
//         // All buttons are already hidden
//     } else {
//         // User hasn't Checked in today, show Check in button
//         signInBtn.removeClass('d-none');
//     }
// }

function updateAttendanceButtons(status) {
    var signInBtn = $('#signInBtn');
    var signOutBtn = $('#signOutBtn');
    var breakBtn = $('#breakBtn');
    var backBtn = $('#backBtn');
    var attendanceSection = $('#attendanceSection');
    var signOutSep = $('#signOutSeparator');

    // Hide all buttons first
    signInBtn.addClass('d-none');
    signOutBtn.addClass('d-none');
    breakBtn.addClass('d-none');
    backBtn.addClass('d-none');
     signOutSep.addClass('d-none'); // hide separator

    // ======== Existing logic =========
    if (status.is_signed_in) {
        attendanceSection
            .removeClass('attendance-hidden')
            .addClass('attendance-visible');
            signOutSep.removeClass('d-none');

        signOutBtn.removeClass('d-none');

        if (status.is_on_break) {
            backBtn.removeClass('d-none');
        } else {
            breakBtn.removeClass('d-none');
        }

    } else if (status.is_signed_out) {
        attendanceSection
            .removeClass('attendance-visible')
            .addClass('attendance-hidden');

    } else {
        // not signed in yet
        signInBtn.removeClass('d-none');
        attendanceSection
            .removeClass('attendance-hidden')
            .addClass('attendance-visible');
    }

    // ======== Frontend fallback for deleted attendance ========
    // If all buttons are hidden, show Sign In
    if (
        signInBtn.hasClass('d-none') &&
        signOutBtn.hasClass('d-none') &&
        breakBtn.hasClass('d-none') &&
        backBtn.hasClass('d-none')
    ) {
        // signInBtn.removeClass('d-none');
        // attendanceSection
        //     .removeClass('attendance-hidden')
        //     .addClass('attendance-visible');
    }
}

function signIn() {
    $.ajax({
        url: '/attendance/sign-in',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                showNotification(response.message, 'success');
                checkAttendanceStatus();
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function(xhr) {
            var message = xhr.responseJSON ? xhr.responseJSON.message : 'Error Checking in';
            showNotification(message, 'error');
        }
    });
}

function signOut() {
    // Show confirmation popup
    if (!confirm('Are you sure you want to check out?')) {
        return;
    }
    
    $.ajax({
        url: '/attendance/sign-out',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                showNotification(response.message, 'success');
                checkAttendanceStatus();
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function(xhr) {
            var message = xhr.responseJSON ? xhr.responseJSON.message : 'Error Checking out';
            showNotification(message, 'error');
        }
    });
}

function startBreak() {
    $.ajax({
        url: '/attendance/start-break',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                showNotification(response.message, 'success');
                checkAttendanceStatus();
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function(xhr) {
            var message = xhr.responseJSON ? xhr.responseJSON.message : 'Error starting break';
            showNotification(message, 'error');
        }
    });
}

function endBreak() {
    $.ajax({
        url: '/attendance/end-break',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                showNotification(response.message, 'success');
                checkAttendanceStatus();
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function(xhr) {
            var message = xhr.responseJSON ? xhr.responseJSON.message : 'Error ending break';
            showNotification(message, 'error');
        }
    });
}

function showNotification(message, type) {
    // Create notification element
    var notification = $('<div class="alert alert-' + (type === 'success' ? 'success' : 'danger') + ' alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;">' +
        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        message +
        '</div>');
    
    // Add to body
    $('body').append(notification);
    
    // Auto remove after 5 seconds
    setTimeout(function() {
        notification.alert('close');
    }, 5000);
}