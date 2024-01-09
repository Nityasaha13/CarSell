jQuery(document).ready(function ($) {

    var galleryImages = $('.gallery-img img');


    galleryImages.on('click', function () {
        // Remove the blue border from all gallery images
        galleryImages.removeClass('active-image');

        // Add the blue border to the clicked image
        $(this).addClass('active-image');

        // Get the index of the clicked image
        var clickedIndex = galleryImages.index(this);

        // Move the carousel to the clicked image
        $('#carouselExampleControls').carousel(clickedIndex);
    });

    // Listen for the carousel's slide event
    $('#carouselExampleControls').on('slide.bs.carousel', function (e) {
        var nextIndex = $(e.relatedTarget).index();
        galleryImages.removeClass('active-image');
        galleryImages.eq(nextIndex).addClass('active-image');
    });
});
