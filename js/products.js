/**
 * THis file is dedicated to the handling of general JS for the 
 * product page. Including event-handling and data filtering.
 * 
 * @author Ryan Haytree
 */
$(document).ready(() => {

    // Filter data according to specified criteria (The checkboxes in the sidebar).
    // If no filter is selected, all items are fulled from the database.
    function filter_data() {
        let product_list_div = $("#listings");
        let action = 'fetch';
        let category = getFilter('cat');
        let os = getFilter('os');

        $.ajax({
            type: "POST",
            url: "./actions/fetchProducts.php",
            data: {action: action, category: category, os: os},
            success: function (filtered_data) {
                product_list_div.html(filtered_data);
            }
        });
    }

    // Get applied filter according to classname.
    function getFilter(class_name) {
        let filter = [];

        // Filter through all elements with class-name filter that are checked,
        // adding their subsequent values to the filter array.
        $('.' + class_name + ':checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }

    // Run filter on page load to ensure products are loaded on load.
    filter_data();

    // Whenever a filter is pressed, the products are refiltered.
    $('.filter').click(function (e) {
        filter_data();
    })

    // Handling of the category section of the sidebar collapsing on click.
    $('#sb-cat-tgl').click(function (e) { 
        e.preventDefault();
        toggleCategoryDropdown();
    });

    // Handling of the operating system section of the sidebar collapsing.
    $('#sb-os-tgl').click(function (e) { 
        e.preventDefault();
        toggleOsDropdown();
    });

    // Handle overlay and menu being disabled when the background is clicked.
    $(".product-listings").click(function (e) { 
        e.preventDefault();

        if ($(".overlay-nav").is(':visible')) {
            $("#main-container").toggleClass('overlay-nav');
            $("#responsive-nav-sidebar").toggleClass('visible-menu');
        }
    }); 

    // Handle sidebar collpasing/expanding when button is clicked.
    $(".sidebar-responsive-panel").click(function (e) { 
        e.preventDefault();
        toggleSidebar();
    });
});

function toggleSidebar() {
    if ($(".sidebar").css("left") == "-200px") {
        $(".sidebar").css("left", "0px");
        $(".sidebar-responsive-panel").css("left", "200px");
    }
    else {
        $(".sidebar").css("left", "-200px");
        $(".sidebar-responsive-panel").css("left", "0px");
    }
}

function toggleCategoryDropdown() {
    if ($('#cat-collapse').is(':visible')) {
        $('#cat-collapse').css("display", "none")
    }
    else {
        $('#cat-collapse').css("display", "block")
    }
}

function toggleOsDropdown() {
    if ($('#os-collapse').is(':visible')) {
        $('#os-collapse').css("display", "none")
    }
    else {
        $('#os-collapse').css("display", "block")
    }
}

$(document).on('click', '.help-btn', function(e) {
    if ($('.sidebar').css("left") == "-200px") {
        toggleSidebar();
    }
    if (!$('#cat-collapse').is(':visible')) {
        toggleCategoryDropdown();
    }
    if (!$('#os-collapse').is(':visible')) {
        toggleOsDropdown();
    }

    setTimeout(() => { introJs().start(); }, 500); 
});