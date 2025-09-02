$(document).ready(function() {
    $('#send_message').click(function(e) {
        e.preventDefault(); // Stop form submission

        var error = false;

        var firstName = $('#first_name').val().trim();
        var lastName = $('#last_name').val().trim();
        var email = $('#email').val().trim();
        var phone = $('#phone').val().trim();
        var message = $('#message').val().trim();

        // Remove error style on click
        $('#first_name, #last_name, #email, #phone, #message').click(function() {
            $(this).removeClass("error_input");
        });

        // Validate first name
        if (firstName.length === 0) {
            error = true;
            $('#first_name').addClass("error_input");
        } else {
            $('#first_name').removeClass("error_input");
        }

        // Validate last name
        if (lastName.length === 0) {
            error = true;
            $('#last_name').addClass("error_input");
        } else {
            $('#last_name').removeClass("error_input");
        }

        // Validate email
        if (email.length === 0 || email.indexOf('@') === -1) {
            error = true;
            $('#email').addClass("error_input");
        } else {
            $('#email').removeClass("error_input");
        }

        // Validate phone
        if (phone.length === 0) {
            error = true;
            $('#phone').addClass("error_input");
        } else {
            $('#phone').removeClass("error_input");
        }

        // Optional: validate message
        if (message.length === 0) {
            error = true;
            $('#message').addClass("error_input");
        } else {
            $('#message').removeClass("error_input");
        }

        // If valid, send AJAX
        if (!error) {
            $('#send_message').attr({ 'disabled': 'true', 'value': 'Sending...' });

            $.post("request.php", $("#booking_form").serialize(), function(result) {
                if (result === 'sent') {
                    $('#booking_form').remove();
                    $('#success_message_col').fadeIn(500);
                } else {
                    $('#mail_fail').fadeIn(500);
                    $('#send_message').removeAttr('disabled').attr('value', 'Send Appointment');
                }
            });
        }
    });
});
