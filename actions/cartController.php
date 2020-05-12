<?php
/**
 * Cart Controller
 * ------------------------------
 * Controls all interactions with the client's cart.
 * 
 * @author Ryan Haytree
 */

$filepath = realpath(dirname(__FILE__));
require_once($filepath . './../database/Database.php');

session_start();

# Check if cart array is present, and if not, create new array. A shopping cart array must be present!
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['action'])) {
    # If the add action is received, add the selected item to the cart array.
    if ($_POST['action'] == 'add') {
        $item_id = '';
        $quantity = 0;
        
        # Check the item_id has been sent successfully.
        if (isset($_POST['item_id'])) {
            $item_id = $_POST['item_id'];
        }

        # Check if quantity has been sent successfully.
        if (isset($_POST['item_id'])) {
            $quantity = $_POST['quantity'];
        }

        # Check if the item already exists in the cart array. 
        if (array_key_exists($item_id, $_SESSION['cart'])) {
            echo '<p style="color: #CA4427">Item is already in your cart!</p>';
        }
        else {
            # if not present, the item is added to the cart using the item_id as the key.
            # This allows for incredibly easy access to individual items.
            $_SESSION['cart'][$item_id] = $quantity;
            echo '<p style="color: #28C41B">Item added to your cart</p>';
        }
    }

    # If the remove action is selected, remove the item from the cart array.
    if ($_POST['action'] == 'remove') {
        $item_id = $_POST['item_id'];
        unset($_SESSION['cart'][$item_id]);
        echo '<p style="color: green">Item Removed</p>';
    }

    # If the update action is received, update the item using the item_id and quantity.
    if ($_POST['action'] == 'update') {
        $_SESSION['cart'][$_POST['item_id']] = $_POST['quantity'];
    }

    # if the get action is received, retrive a series of cards which contain the items in the user's cart.
    if ($_POST['action'] == 'get') {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            # Establish db connection to retrived info that was not saved in the session.
            $db = new Database();
            $conn = $db->getConnection();

            $data = '';

            # Iterate through the cart array in the session.
            foreach ($_SESSION['cart'] as $id => $quantity) {
                $query = "SELECT * FROM `tbl_products` WHERE `id` = " . $id;
                $result = $db->select($query);
        
                if ($result && $result->num_rows > 0) {
                    foreach ($result as $key => $r) {
                        # Check for first item, and if item is the first item, append attributes used for introJs.
                        if ($key == 0) {
                            $data .= 
                            '<div class="cart-item" data-step="5" data-intro="Here you can see one of your cart items.">
                                <div class="left">
                                    <img src="' . $r['img_url'] . '"' . $r['name'] . '">
                                </div>
                                <div class="right">
                                    <h3>' . $r['name'] . '</h3>
                                    <p>' . $r['description'] .'</h3>
                                    <div class="quantity" data-step="6" data-intro="The quantity the selected item can be altered here.">
                                        <input type="number" name="quantity" id="quantity" value="' . $quantity . '" readonly/>
                                        <div class="increase-quantity-btn">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="decrease-quantity-btn">
                                            <i class="fas fa-minus"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="price">
                                    <p>£ ' . formatCurrency($r['price'] * $quantity) . '</p>
                                </div>
                                <div class="remove" name="remove-btn" id="' . $r['id'] .'" data-step="7" data-intro="An item can be removed by simply pressing this button.">
                                    <p>REMOVE</p>
                                </div>
                            </div>';
                        }
                        else {
                            $data .= 
                            '<div class="cart-item">
                                <div class="left">
                                    <img src="' . $r['img_url'] . '"' . $r['name'] . '">
                                </div>
                                <div class="right">
                                    <h3>' . $r['name'] . '</h3>
                                    <p>' . $r['description'] .'</h3>
                                    <div class="quantity">
                                        <input type="number" name="quantity" id="quantity" value="' . $quantity . '" readonly/>
                                        <div class="increase-quantity-btn">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="decrease-quantity-btn">
                                            <i class="fas fa-minus"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="price">
                                    <p>£ ' . formatCurrency($r['price'] * $quantity) . '</p>
                                </div>
                                <div class="remove" name="remove-btn" id="' . $r['id'] .'">
                                    <p>REMOVE</p>
                                </div>
                            </div>';
                        }
                    }
                }
            }
            echo $data;
        }
        else {
            echo '<p id="empty">You cart is currently empty</p>';
        }
    }

    # If clear action is received, reset the user's cart array.
    if ($_POST['action'] == 'clear') {
        $_SESSION['cart'] = [];
    }
    
    # If the get-summary action is received, retrive the number of items and the total cost of the cart.
    if ($_POST['action'] == 'get-summary') {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $db = new Database();
            $num_items = 0;
            
            $total = 0;
            $data = '';

            foreach ($_SESSION['cart'] as $id => $quantity) {
                $num_items = $num_items + $quantity;
                $query = "SELECT `price` FROM `tbl_products` WHERE `id` =" . $id;
                $result = $db->select($query);

                if ($result && $result->num_rows > 0) {
                    foreach ($result as $r) {
                        $total = ($r['price'] * $quantity) + $total;
                    }
                }
            }
            $data .= "<p>Number of Items: <b>" . $num_items . "</b></p>";
            $data .= "<p>Cart Total: <b>£ " . formatCurrency($total) . "</b></p>";
            echo $data;

        }
        else {
            echo "<p>No cart summary available. Your cart is empty!</p>";
        }
    }

    # On checkout action, clear the cart and echo that the cart was cleared successfully.
    if ($_POST['action'] == 'checkout') {
        $_SESSION['cart'] = [];
        echo 'success';
    }
}

# Format number as currency function. Present due to the money_format function being depreciated. 
function formatCurrency($price){
    return number_format($price, 2, '.', ',');
}