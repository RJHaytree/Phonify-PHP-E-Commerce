$(document).ready(() => {
    $("#nav-toggle").click(function (e) { 
        e.preventDefault();

        $("#main-container").toggleClass('overlay-nav');
        $("#responsive-nav-sidebar").toggleClass('visible-menu')
    });

    $('.cart-main-container').click(function (e) {

        if ($("#main-container").hasClass('overlay-nav')) {
            $("#main-container").toggleClass('overlay-nav');
            $("#responsive-nav-sidebar").toggleClass('visible-menu')
        };
    });

    $('.signin-main-container').click(function(e) {
        if ($("#main-container").hasClass('overlay-nav')) {
            $("#main-container").toggleClass('overlay-nav');
            $("#responsive-nav-sidebar").toggleClass('visible-menu')
        };
    });
})