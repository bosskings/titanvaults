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