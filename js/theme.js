/**
 * This file is dedicated to the handling of theme changing and it's 
 * subsequent cookies.
 * 
 * @author Ryan Haytree
 */

$(document).ready(() => {
    // Check if the client already has a prefered theme in their cookies.
    if (Cookies.get('theme') != '') {
        if (Cookies.get("theme") == 'dark') {
            $("#main").removeClass('light');
            $("body").removeClass('light');
            $("#main").addClass('dark');
            $("body").addClass('dark');
        }
        else {
            $("#main").addClass('light');
            $("body").addClass('light');
        }
    }

    // Handle theme changing on click. 
    $('.toggle-theme').click(function (e) {
        if ($("#main").hasClass('light')) {
            $("#main").removeClass('light');
            $("body").removeClass('light');

            $("#main").addClass('dark');
            $("body").addClass('dark');
            Cookies.set('theme', 'dark', { expires: 14 });
        }
        else {
            $("#main").removeClass('dark');
            $("body").removeClass('dark');

            $("#main").addClass('light');
            $("body").addClass('light');
            Cookies.set('theme', 'light', { expires: 14 });
        }
    });

    // Handle the different theme icons being shown in the navbar depending on 
    // the size of the device.
    if ($('#main').hasClass('light')) {
        if ($('.page-links-responsive').is(":visible")) {
            $(".toggle-theme").append('<i class="fas fa-moon"></i><p>CHANGE THEME</p>');
        }
        else {
            $(".toggle-theme").append('<i class="fas fa-moon"></i>');
        }
    }
    else {
        if ($('.page-links-responsive').is(":visible")) { 
            $(".toggle-theme").append('<i class="fas fa-sun"></i><p>CHANGE THEME</p>');
        }
        else {
            $(".toggle-theme").append('<i class="fas fa-sun"></i>');
        }
    }
})