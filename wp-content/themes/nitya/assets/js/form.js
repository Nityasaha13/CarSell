jQuery(document).ready(function ($) {
    $('#appycodes-leads-form').submit(function (event) {
        event.preventDefault();

        var name = $('#name').val(); 
        var email = $('#email').val();
        var message =$('#usermessage').val();

        if (name === '' || email === '') {
            $('#message').html('Please fill in all fields.').removeClass('success').addClass('error').show();
            return;
        }
        
        var formData = $(this).serializeArray(); // Serialize the form data as an array

        // Convert the array to a JSON object
        var formDataJSON = {};
        $.each(formData, function (i, field) {
          formDataJSON[field.name] = field.value;
        });

        $('#submit-button').attr('disabled', true).html('Submitting...');

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url, 
            data: {
                action: 'appycodes_leads_submit', // AJAX action
                formData: formDataJSON, // Serialized form data
            },
            beforeSend: function () {
                $('#submit-button').attr('disabled', true).html('Submitting...');
            },
            success: function (response) {
                if (response === 'UserExists') {
                    $('#message').html('User Already Exists.').removeClass('success').addClass('error').show();
                    $('#appycodes-leads-form')[0].reset();
                } else if (response === 'Success') {
                    $('#message').html('Form submitted successfully').removeClass('error').addClass('success').show();
                    $('#appycodes-leads-form')[0].reset();
                } else {
                    $('#message').html('Error occurred. Please try again later.').removeClass('success').addClass('error').show();
                }
            },
            error: function () {
                $('#message').html('Error occurred. Please try again later.').removeClass('success').addClass('error').show();
            },
            complete: function () {
                // Re-enable the submit button and remove the loader
                $('#submit-button').attr('disabled', false).html('Submit');
            },
        });
    });


    // Click event handler for the "Export CSV" button
    $('#export').click(function (event) {
        event.preventDefault();
        console.log(event);
        // Send an AJAX request to trigger the CSV export
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'appycodes_leads_export_csv', // Replace with your export action
            },
            success: function (data) {
                // Check if the data is empty or an error occurred
                if (data) {
                    // Create a Blob object with the CSV data and set its type
                    var blob = new Blob([data], { type: 'text/csv' });
                    var url = window.URL.createObjectURL(blob);
            
                    // Create a temporary <a> element to trigger the download
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = 'appycodes_leads.csv';
            
                    // Simulate a click on the <a> element to trigger the download
                    document.body.appendChild(a);
                    a.click();
            
                    // Clean up by revoking the object URL and removing the <a> element
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);
                } else {
                    // Handle the case where no data is received or an error occurs
                    console.error('No data received or an error occurred.');
                }
            }
        });
    });

});

function initMap() {
    // Coordinates for your company's location
    var companyLocation = { lat:26.7271, lng:88.3953 }; // Replace with your actual coordinates

    // Create a new Google Map centered at your company's location
    var map = new google.maps.Map(document.getElementById('map'), {
        center: companyLocation,
        zoom: 15 // Adjust the zoom level as needed
    });

    // Add a marker at your company's location
    var marker = new google.maps.Marker({
        position: companyLocation,
        map: map,
        title: 'Company Location' // Tooltip text for the marker
    });
}