jQuery(document).ready(function($) {
    $('#signup-form').submit(function(event) {
        event.preventDefault();
        
        var formData = $(this).serializeArray();
        var files = $('#profile-picture')[0].files[0];
        formData.push({ name: 'profile-picture', value: files });
        formData.push({ name: 'security', value: ajax_object.nonce }); // Add nonce
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'custom_signup_ajax',
                formData:formData,
            },
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting content type
            success: function(response) {
                var responseData = JSON.parse(response);
                if (responseData.status === 'success') {
                    $('#message').html('Signup Successful').removeClass('error').addClass('success').show();
                    window.location.replace("http://nityasite.test/login/");
                } else {
                    $('#message').html('Oops! Something went wrong. ' + responseData.message).removeClass('success').addClass('error').show();
                    $('#signup-form')[0].reset();
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error(xhr.responseText);
                $('#message').html('Error occurred. Please try again later.').removeClass('success').addClass('error').show();
                $('#signup-form')[0].reset();
            }            
        });
    });
});
