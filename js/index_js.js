const blinkingText = document.getElementById('blinking-text');

setInterval(() => {
    blinkingText.style.visibility = (blinkingText.style.visibility === 'hidden') ? 'visible' : 'hidden';
}, 500);

$(document).ready(function() {
    // Handle form submission
    $('#user_registration_form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        // Get form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'user/registration.php', // Replace with your PHP script file name
            data: formData,
            success: function(response) {
                $('#message').text(response);
                Swal.fire(
                    'Good job!',
                    'You have sucesfully register!',
                    'success',
                )
                $('#user_registration_form').trigger('reset');
            }
        });
    });
});


