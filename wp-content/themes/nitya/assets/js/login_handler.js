jQuery(document).ready(function($) {
    $('#user-loginForm').submit(function(event) {
        event.preventDefault();

        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'custom_login_ajax',
                email: email,
                password: password,
            },
            success: function(response) {
                if (response === 'success') {
                    $('#message').html('Login Successful').removeClass('error').addClass('success').show();
                    window.location.replace("http://nityasite.test/user-dashboard/");
                } else {
                    $('#message').html('Enter email and password correctly.').removeClass('success').addClass('error').show();
                    $('#user-loginForm')[0].reset();
                }
            },
            error: function() {
                $('#message').html('Error occurred. Please try again later.').removeClass('success').addClass('error').show();
                $('#user-loginForm')[0].reset();
            },
        });
    });
    
});
