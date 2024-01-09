jQuery(document).ready(function($) {
    $('a#custom-logout-button').on('click', function(e) {
        e.preventDefault();
        custom_logout();
    });
});