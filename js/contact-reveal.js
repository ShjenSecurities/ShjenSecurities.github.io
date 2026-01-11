$(document).ready(function() {
    // Listen for clicks on the entire document for the specific ID
    $(document).on('click', '#reveal-contact', function(e) {
        e.preventDefault();

        // Reveals the flipped text
        $('#contact-details').fadeIn(400);

        // Hides the "Click here" link
        $(this).hide();
    });
});
