document.addEventListener("DOMContentLoaded", function () {
    var header = document.getElementById("myHeader");

    // Show the header
    if (header!=null || header!=undefined) {
        header.style.display = "block";

        // Add the 'pop-up' class to trigger the slide-in animation
        header.classList.add("pop-up");

        // Set a timeout to add the 'fade-out' class after 3 seconds
        setTimeout(function () {
            header.classList.add("fade-out");

            // Set a timeout to hide the header after the fade-out animation completes
            setTimeout(function () {
                header.style.display = "none";
            }, 500); // Wait for the fade-out animation to complete (0.5 seconds)
        }, 2500); // 3000 milliseconds (3 seconds)
    }
});
