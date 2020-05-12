$(document).on('submit', '.contact', function (e) {
    e.preventDefault();
    
    // Get value from input fields.
    let email = $('#email').val();
    let subject = $('#subject').val();
    let content = $('#content').val();

    // Validate email address format, check if subject and content is not empty
    if (!email || !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))) {
        $('.errors p').html("Your email address is invalid!");
    }
    else if (!subject) {
        $('.errors p').html("The subject cannot be empty!");
    }
    else if (!content) {
        $('.errors p').html("You cannot send an empty email!");
    }
    else {
        // Send alert stating email was sent.
        Swal.fire({
            position: 'top',
            title: 'EMAIL SENT',
            text: 'A representative should get back to you shortly!',
            icon: 'success',
            width: 600
        });

        // Clear input fields.
        $('#email').val('');
        $('#subject').val('');
        $('#content').val('');
    }
})