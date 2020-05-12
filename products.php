<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonify | Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="./introjs/introjs.css">
    <link rel="stylesheet" href="./introjs/introjs-modern.css">

    <link rel="stylesheet" href="./css/core.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/products.css">
</head>

<body>
    <div id="main" class="main">
        <!-- NAVBAR -->
        <div class="navbar">
            <div class="branding">
                <a href="./index.php">
                    <p>PHONIFY</p>
                </a>
            </div>
            <div class="page-links page-links-left">
                <a class="nav-element" href="products.php?cat=sp">
                    <p>SMARTPHONES</p>
                </a>
                <a class="nav-element" href="products.php?cat=accessories">
                    <p>ACCESSORIES</p>
                </a>
                <a class="nav-element" href="products.php?cat=repairkits">
                    <p>REPAIR KITS</p>
                </a>
            </div>
            <?php if (isset($_SESSION['user'])) ?>
            <div class="page-links page-links-right">
                <div class="nav-element toggle-theme" id="toggleTheme">
                </div>
                <a class="nav-element" href="contact.php">
                    <i class="fas fa-envelope"></i>
                </a>
                <a class="nav-element" href="cart.php">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<a class="nav-element signout" href=""><i class="fas fa-sign-out-alt"></i></a>';
                }
                else {
                    echo '<a class="nav-element" href="signin.php"><i class="fas fa-user-circle"></i></a>';
                }
                ?>
            </div>

            <div class="page-links-responsive">
                <div id="nav-toggle" class="nav-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </div>

            <div id="responsive-nav-sidebar" class="responsive-nav-sidebar">
                <a class="nav-element" href="products.php?cat=sp">
                    <p>SMARTPHONES</p>
                </a>
                <a class="nav-element" href="products.php?cat=accessories">
                    <p>ACCESSORIES</p>
                </a>
                <a class="nav-element" href="products.php?cat=repairkits">
                    <p>REPAIR KITS</p>
                </a>
                <hr>
                <div class="nav-element toggle-theme" id="toggleTheme">
                </div>
                <a class="nav-element" href="contact.php">
                    <i class="fas fa-envelope"></i>
                    <p>CONTACT US</p>
                </a>
                <a class="nav-element" href="cart.php">
                    <i class="fas fa-shopping-cart"></i>
                    <p>YOUR CART</p>
                </a>
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<a class="nav-element signout" href="">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>SIGN OUT</p>
                        </a>';
                }
                else {
                    echo '<a class="nav-element" href="signin.php">
                        <i class="fas fa-user-circle"></i>
                        <p>LOGIN</p>
                        </a>';
                }
                ?>
                </a>
            </div>
        </div>

        <!-- CORE CONTAINER -->
        <div id="main-container" class="main-container">
            <!-- SIDEBAR - FILTERS -->
            <div class="sidebar">
                <div class="sidebar-item-1" data-step="1" data-intro="Here you can select what category you would like to browse." data-position="right">
                    <div class="s-item">
                        <p id="sb-cat-tgl" class="s-item-title">CATEGORY</p>
                        <hr>
                        <div id="cat-collapse" class="s-item-content">
                        <p>Smartphones <input class="cat filter" value="sp" type="checkbox" <?php if (isset($_GET['cat'])) { if ($_GET['cat'] == "sp") { echo "checked"; }} ?> /></p>
                            <p>Accessories <input class="cat filter" value="accessories" type="checkbox" <?php if (isset($_GET['cat'])) { if ($_GET['cat'] == "accessories") { echo "checked"; }} ?> /></p>
                            <p>Repair Kits <input class="cat filter" id="test" value="repairkits" type="checkbox" <?php if (isset($_GET['cat'])) { if ($_GET['cat'] == "repairkits") { echo "checked"; }} ?> /></p>
                        </div>
                    </div>
                </div>
                <div class="sidebar-item-2" data-step="2" data-intro="Here you can select what operating system you would like to browse." data-position="right">
                    <div class="s-item">
                        <p id="sb-os-tgl" class="s-item-title">OPERATING SYSTEM</p>
                        <hr>
                        <div id="os-collapse" class="s-item-content">
                            <p>Android OS <input class="os filter" type="checkbox" value="android" <?php if (isset($_GET['os'])) { if ($_GET['os'] == "android") { echo "checked"; }} ?> /></p>
                            <p>iOS <input class="os filter" type="checkbox" value="ios" <?php if (isset($_GET['os'])) { if ($_GET['os'] == "ios") { echo "checked"; }} ?> /></p>
                        </div>
                    </div>
                </div>
                <p id="copyright">&copy; Phonify 2020</p>
            </div>
            <div class="sidebar-responsive-panel">
                <div class="filter-expand">
                    <i class="fas fa-filter"></i>
                </div>
            </div>
            <!-- PRODUCT LIST -->
            <div id="product-listings" class="product-listings">
                <?php 
                if (isset($_SESSION['user'])) {
                    echo "<p id='welcome-msg'>WELCOME BACK, " .  strtoupper($_SESSION['user']['username']) . "</p>";
                }
                ?>
                <div id="listings"></div>
            </div>

            <div class="modal">
            </div>

            <div class="help-btn">
                <i class="fas fa-question"></i>
            </div>
        </div>
    </div>
</body>
<!-- This empty space resolves a bug in chrome which causes transitions to fire when a page loads -->
<script> </script>

<!-- JavaScript Extenal Libraries -->
<script src="https://kit.fontawesome.com/732f1de971.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script src="./introjs/intro.js"></script>

<!-- Custom JavaScript -->
<script src="./js/main.js" rel="javascript/text"></script>
<script src="./js/cart.js" rel="javascript/text"></script>
<script src="./js/products.js" rel="javascript/text"></script>
<script src="./js/theme.js" rel="javascript/text"></script>
<script src="./js/navbar.js" rel="javascript/text"></script>
</html>