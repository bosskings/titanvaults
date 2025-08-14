function makeSeen(id) {

    $.ajax({
        url: "/approve_activity", // Route to search
        type: "GET",
        data: { 
            data: "seen", 
            id: id
        },

        success: function(data) {
            
            if(data.success) {
                $('#statusArea').css('display', 'none')   
            }
        }, 
        error: function() {
            // Handle any errors in the AJAX request
            $('.statusArea').append('<span>Error occurred while searching</span>');
        }
    });
    
}


// function to change balance
function changeBalance(id){

    $.ajax({
        url: "/change_balance", // Route to search 
        type: "GET",
        data: { 
            amount: $('#balance'+id).val(),
            user_id: id
        },

        success: function(data) {
            
            if(data.success) {
                $('#resultBalance'+id).append('<span style="color:green">success</span>')   
            }
        }, 
        error: function(e) {
            // console.error(e && e.responseJSON && e.responseJSON.message ? e.responseJSON.message : e);
            
            // Handle any errors in the AJAX request
            $('#resultBalance'+id).append('<span style="color:red">Error occurred while searching</span>');
        }
    });    
}



// function to aid admin change status
function changeStatus(id){

    $.ajax({
        url: "/change_status", // Route to search 
        type: "GET",
        data: { 
            status: $('#status'+id).val(),
            user_id: id
        },

        success: function(data) {
            
            if(data.success) {
                $('#resultStatus'+id).append('<span style="color:green">success</span>')   
            }
        }, 
        error: function(e) {
            // console.error(e && e.responseJSON && e.responseJSON.message ? e.responseJSON.message : e);
            
            // Handle any errors in the AJAX request
            $('#resultStatus'+id).append('<span style="color:red">Error occurred while searching</span>');
        }
    });
}


// function to suspend user
function suspend_user(id){

    $.ajax({
        url: "/suspend_user", // Route to search 
        type: "GET",
        data: { 
            status: $('#suspend'+id).val(),
            user_id: id
        },

        success: function(data) {
            
            if(data.success) {
                $('#resultSuspend'+id).append('<span style="color:green">success</span>')   
            }
        }, 
        error: function(e) {
            // console.error(e && e.responseJSON && e.responseJSON.message ? e.responseJSON.message : e);
            
            // Handle any errors in the AJAX request
            $('#resultSuspend'+id).append('<span style="color:red">Error occurred while searching</span>');
        }
    });
}



// Function to send custom email from admin dashboard
function sendMail() {
    
    var email = $('#Uemail').val();
    var title = $('#emailSub').val();
    var message = $('#writeUp').val();


    // Show loading indicator
    $('#lamb').html('<span style="color:blue;">Sending...</span>');

    $.ajax({
        url: "/admin_email",
        type: "POST",
        data: {
            email: email,
            title: title,
            message: message,
            // If you use Laravel's CSRF protection, include the token:
            _token: typeof $('meta[name="csrf-token"]').attr('content') !== 'undefined' ? $('meta[name="csrf-token"]').attr('content') : undefined
        },
        success: function(data) {
            if (data.success) {
                $('#lamb').html('<span style="color:green;">Email sent successfully.</span>');
                // Optionally clear the fields
                $('#Uemail').val('');
                $('#emailSub').val('');
                $('#writeUp').val('');
            } else {
                $('#lamb').html('<span style="color:red;">' + (data.message || 'Failed to send email.') + '</span>');
            }
        },
        error: function(xhr) {
            let msg = 'Failed to send email.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }
            $('#lamb').html('<span style="color:red;">' + msg + '</span>');
        }
    });
}
