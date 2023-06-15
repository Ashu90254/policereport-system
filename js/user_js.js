$(document).ready(function() {
    // Handle form submission
    $('#register-complaint').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        // Get form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '../user/register_complaint.php', // Replace with your PHP script file name
            data: formData,
            success: function(response) {
                $('#message').text(response);
                if(response === "sucess"){
                    Swal.fire(
                        'Good job!',
                        'You have sucesfully register!',
                        'success',
                    ).then((result) => {
                        if (result.isConfirmed) {
                          location.reload();
                        }
                      });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong try again!',
                    })
                }
            }
        });
    });
});