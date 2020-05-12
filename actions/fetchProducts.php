<?php
/**
 * FetchProducts 
 * ----------------------------------
 * Returns the products that meet the client's filters.
 * 
 * @author Ryan Haytree
 */

$filepath = realpath(dirname(__FILE__));
require_once($filepath . './../database/Database.php');

# Check if the action being sent in a fetch request.
if (isset($_POST['action']) && $_POST['action'] == "fetch") {
    $db = new Database();

    # When writing the initial query, it must be done so all other criteria can be appended easily.
    # Furthermore, 'SELECT * FROM `table`' was not used, since you'd need to check if 'AND' was already
    # used in the query when a filter was being appended.
    $query = "SELECT * FROM `tbl_products` WHERE `id` > '0'";

    if (isset($_POST['category'])) {
        # Implode category array into String.
        $cat_filter = implode("', '", $_POST['category']);
        $query .= " AND `category` IN('" . $cat_filter . "')";
    } 

    if (isset($_POST['os'])) {
        # Impload os array into String.
        $os_filter = implode("', '", $_POST['os']);
        $query .= " AND `os` IN('" . $os_filter . "')";
    }

    # Submit query to the database.
    $result = $db->select($query);
    $filtered_data = '';

    if ($result && $result->num_rows > 0) {
        foreach ($result as $key => $r) {
            $attributes = '';
            if ($key == 0) {
                $attributes = 'data-step="3" data-intro="This is a product card. Here you can see products, as well as add them to your cart."';
            }

            if (isset($r['os']) && $r['os'] != '') {
                $filtered_data .= '
                <div class="card" ' . $attributes . '>
                <img src="' . $r['img_url'] . '" alt="' . $r['name'] . '">
                <h1 id="name">' . $r['name'] . '</h1>
                <p> <b>OS: '  . strtoupper($r['os']) . '</b></p>
                <p>' . $r['description'] . '</p>
                <div class="price"> <p> £' . formatCurrency($r['price']) . '</p></div>
                <div class="add-btn" name="add-btn" id="' . $r['id'] . '"><p>ADD TO BASKET</p></div>
                </div>
                ';
            }
            else {
                $filtered_data .= '
                <div class="card">
                <img src="' . $r['img_url'] . '" alt="' . $r['name'] . '">
                <h1 id="name">' . $r['name'] . '</h1>
                <p>' . $r['description'] . '</p>
                <div class="price"> <p> £' . formatCurrency($r['price']) . '</p></div>
                <div class="add-btn" name="add-btn" id="' . $r['id'] . '"><p>ADD TO BASKET</p></div>
                </div>
                ';
            }
        }
    }
    else {
        $filtered_data = '<h1 id="none-found"> No Products Found </h1>';
    }

    echo $filtered_data;
}

function formatCurrency($price){
    return number_format($price, 2, '.', ',');
}

?>