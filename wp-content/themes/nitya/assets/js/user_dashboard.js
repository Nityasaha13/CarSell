jQuery(document).ready(function ($) {

    const showFormButton = document.getElementById("custom-post-button");
    const postForm = document.getElementById("custom-post-form");

    // Add an event listener to the button
    showFormButton.addEventListener("click", function () {
        // Toggle the visibility of the form
        if (postForm.style.display === "none") {
            postForm.style.display = "block";
            showFormButton.innerText = "Cancel";
        } else {
            postForm.style.display = "none";
            showFormButton.innerText = "+ Post Car";
        }
    });

    $('#custom-post-form').submit(function (event) {
        event.preventDefault();

        var formData = $(this).serializeArray();
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'create_wordpress_custom_post',
                formData: formData,
            },
            success: function(response) {
                if (response === 'success') {
                    $('#message').html('Post created Successfully').removeClass('error').addClass('success').show();
                } else {
                    $('#message').html('Oops! Something went wrong. ' + response).removeClass('success').addClass('error').show();
                    $('#signup-form')[0].reset();
                }
            },
        });
    });
});