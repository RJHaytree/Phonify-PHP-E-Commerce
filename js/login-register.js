function processFormSubmission() {

}

$(document).on('submit', '.login', function(e) {
    e.preventDefault();
    
    let emailuid = $('#emailuid').val();
    let pass = $('#password').val();

    // Nulls checked in the actual form, but checking a second time doesn't hurt
    if (!emailuid) {
        $(".errors p").html("Email or Username must be entered!");
    }

    if (!pass) {
        $(".errors p").html("Passwod must be entered!");
    }

    if (emailuid && pass) {
        $.ajax({
            type: "POST",
            url: "./actions/accountController.php",
            data: { action: 'login', emailuid: emailuid, pass: pass },
            success: function (response) {
                console.log(response);
                if (response.indexOf('success') >= 0) {
                    Swal.fire({
                        position: 'top',
                        title: 'LOGIN SUCCESSFUL!',
                        text: 'Would you like to return to the products page?',
                        icon: 'success',
                        width: 600,
                        showCancelButton: true,
                        confirmButtonText: 'YES',
                        cancelButtonText: 'NO',
                    }).then((result) => {
                        if (result.value) {
                            window.location.replace('products.php');
                        }
                    })
                }
                else {
                    $('.errors p').html(response);
                }
            }
        });
    }

    $('#emailuid').val('');
    $('#password').val('');
});

$(document).on('submit', '.register', function(e) {
    e.preventDefault();
    let username = $('#username').val();
    let email = $('#email').val();
    let pass = $('#pass').val();
    let pass2 = $('#pass-2').val();

    // Nulls checked in the actual form, but checking a second time doesn't hurt
    if (!username) {
        $(".errors p").html("Username must be entered!");
    }
    else if (!email) {
        $(".errors p").html("Email must be entered!");
    }
    else if (!pass) {
        $(".errors p").html("Password must be entered!");
    }
    else if (!pass2) {
        $(".errors p").html("Repeat Password must be entered!");
    }
    else if (pass !== pass2) {
        $(".errors p").html("Passwords must match!");
    }
    else {
        $.ajax({
            type: "POST",
            url: "./actions/accountController.php",
            data: { action: 'register', username: username, email: email, pass: pass, pass2: pass2 },
            success: function (response) {
                if (response.indexOf('success') >= 0) {
                    Swal.fire({
                        position: 'top',
                        title: 'ACCOUNT CREATED',
                        text: 'Would you like to progress to login?',
                        icon: 'success',
                        width: 600,
                        showCancelButton: true,
                        confirmButtonText: 'YES',
                        cancelButtonText: 'NO',
                    }).then((result) => {
                        if (result.value) {
                            window.location.replace('signin.php');
                        }
                    })
                }
                else {
                    $('.errors p').html(response);
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    $('#username').val('');
    $('#email').val('');
    $('#pass').val('');
    $('#pass-2').val('');
})