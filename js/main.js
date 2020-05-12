// Signout function. Fired when .signout button is clicked in the navbar.
$(document).on('click', '.signout', function(e) {
    e.preventDefault();

    let element = $('.signout');

    $.ajax({
        type: "POST",
        url: "./actions/accountController.php",
        data: { action: 'signout' },
        success: function (response) {
            element.remove();

            $('.page-links-right').append('<a class="nav-element" href="signin.php"><i class="fas fa-user-circle"></i></a>');
            $('.responsive-nav-sidebar').append('<a class="nav-element" href="signin.php"><i class="fas fa-user-circle"></i><p>LOGIN</p></a>');

            if ($('#welcome-msg').length) {
                $('#welcome-msg').remove();
            }
        }
    });
});