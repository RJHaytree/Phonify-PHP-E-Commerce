/**
 * This file is dedicated to the handling of all cart actions.
 * All interactions with the cart are done using AJAX.
 * 
 * @author Ryan Haytree
 */

/**
 * Open a modal that allows the user to adjust the quantity of 
 * the item before it is added to their cart. 
 * 
 * @param {*} item_id the item that was clicked.
 * @param {*} name the name of the item that was clicked.
 */
function openAddModal(item_id, name) {
    $('.modal').css("display", "block");
    $('.modal').append('<div class="modal-container"><h1>' + name + '</h1><div class="close-modal"><i class="fa fa-times" aria-hidden="true"></i></div><div class="modal-content"><input class="quantity-selector" type="number" value="1" min="1" max="100" /></div><div class="add-item-btn" id="' + item_id + '"><p>Add Item to Cart</p></div></div>');
}

/**
 * Close the add-modal divider.
 */
function closeAddModel() {
    $('.modal').css("display", "none");
    $('.modal-container').remove();
}

// Open quatity selector modal. This should only be used on the products page.
$(document).on('click', '.add-btn', function (e) {
    let item_id = $(this).attr('id');
    let name = $(this).parent().find('#name').text();

    openAddModal(item_id, name);
});

// Close modal when overlay is clicked.
$(document).on('click', '.modal', function (e) {
    e.preventDefault();
    if (e.target !== e.currentTarget) return;
    closeAddModel();
});

// Add item to cart using when the modal's add btn os c;ocled/
$(document).on('click', '.add-item-btn', function (e) {
    if ($('.quantity-selector').val() > 0) {
        addItemToCart($('.add-item-btn').attr('id'), $('.quantity-selector').val());
        $(this).remove();
    }
    else {
        $('.modal-container').append('<p>You cannot have less than 1 item!</p>');
    }
});

$(document).on('click', '.modal-container', function (e) {
    e.preventDefault();
});

$(document).on('click', '.close-modal', function (e) {
    e.preventDefault();
    closeAddModel();
});

// Remvoe item from cart when it's corresponding remove btn is clicked.
$(document).on('click', '.remove', function (e) {
    removeCartItem($(this).attr('id'), $(this));
});

// Increase quality of selected item when it's respective increase button is clicked.
$(document).on('click', '.increase-quantity-btn', function (e) {
    e.preventDefault();
    let item_id = $(this).parent().parent().parent().find('.remove').attr('id');
    let quantity = parseInt($(this).parent().find("#quantity").val()) + 1;

    updateCartItem(item_id, quantity);
});

// Decrease quality of selected item when it's respective increase button is clicked.
$(document).on('click', '.decrease-quantity-btn', function (e) {
    e.preventDefault();

    let item_id = $(this).parent().parent().parent().find('.remove').attr('id');
    let quantity = parseInt($(this).parent().find("#quantity").val()) - 1;

    if (quantity > 0) {
        updateCartItem(item_id, quantity);
    }
});

// Clearn cart when clear-cart-btn is clicked.
$(document).on('click', '.clear-cart-btn', function (e) {
    clearCart();
});

/**
 * Add an item to the cart through AJAX.
 * 
 * @param {*} item_id the id of the item to be added.
 * @param {number} quantity the quantity of the item to be added.
 */
function addItemToCart(item_id, quantity) {
    let url = "./actions/cartController.php";

    $.ajax({
        type: "POST",
        url: url,
        data: { action: "add", item_id: item_id, quantity: quantity },
        success: function (response) {
            $('.modal-content').html(response);
        },
        error: function (response) {
            $('.modal-content').html(response);
        }
    });

}

/**
 * Remove an item from the cart using its ID.
 * 
 * @param {*} item_id 
 */
function removeCartItem(item_id, item) {
    let url = "./actions/cartController.php";

    $.ajax({
        type: "POST",
        url: url,
        data: { action: "remove", item_id: item_id },
        success: function (response) {
            item.parent().remove();
            getClientCart();
            getCartSummary();
        }
    });
}

/**
 * Update the quantity of an item in the cart.
 * 
 * @param {*} item_id 
 * @param {number} quantity 
 */
function updateCartItem(item_id, quantity) {
    let url = "./actions/cartController.php";

    $.ajax({
        type: "POST",
        url: url,
        data: { action: 'update', item_id: item_id, quantity: quantity},
        success: function (response) {
            getClientCart();
            getCartSummary();
        }
    });
}

/**
 * Clear the client's cart of items.
 */
function clearCart() {
    let url = "./actions/cartController.php";

    $.ajax({
        type: "POST",
        url: url,
        data: { action: 'clear' },
        success: function (response) {
            console.log(response);
            getClientCart();
            getCartSummary();
        }
    });
}

/**
 * Gets the clients current cart to be displayed on the cart page.
 */
function getClientCart() {
    let action = 'get';

    $.ajax({
        type: "POST",
        url: "./actions/cartController.php",
        data: { action: action },
        success: function (response) {
            $('.item-list').html(response);
        }
    });
}

/**
 * Gets cart summary for display.
 */
function getCartSummary() {
    let action = 'get-summary';

    $.ajax({
        type: "POST",
        url: "./actions/cartController",
        data: { action: action },
        success: function (response) {
            $('.summary').html(response);
        }
    });
}

/**
 * Checkout function - sents client an alert and clears their cart.
 */
function checkout() {
    let action = 'checkout';

    $.ajax({
        type: "POST",
        url: "./actions/cartController",
        data: { action: action },
        success: function (response) {
            if (response.indexOf('success') >= 0) {
                Swal.fire({
                    position: 'top',
                    title: 'ORDER PLACED',
                    text: 'Thank you for shopping with phonify! You should receive an email receipt shortly.',
                    icon: 'success',
                    width: 600
                });

                getClientCart();
                getCartSummary();
            }
        }
    });
}

// Start IntroJs when the help button is clicked.
$(document).on('click', '.help-btn', function(e) {
    introJs().start();
});

// Handle the checkout when the checkout button is clicked.
$(document).on('click', '#checkout', function(e) {
    e.preventDefault();
    checkout();
});