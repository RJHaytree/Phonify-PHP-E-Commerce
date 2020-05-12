<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonify | Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/core.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/form.css">
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
        <div id="main-container" class="main-container signin-main-container">
            <div class="signin-container signup-container">
                <div class="header">
                    <h1>REGISTER</h1>
                </div>
                <div class="form-container">
                    <form class="form register">
                        <div class="errors"><p></p></div>
                        <input id="username" type="text" name="username" placeholder="Username" required/>
                        <input id="email" type="text" name="email" placeholder="Email Address" required/>
                        <input id="pass" type="password" name="password" placeholder="Password" required autocomplete="off" />
                        <input id="pass-2" type="password" name="password-repeat" placeholder="Repeat Password" required autocomplete="off" />
                        <button type="submit">Register</button>
                        <p>Already have an account? Login <a href="./signin.php">HERE</a></p>
                    </form>
                </div>
            </div>
            <!-- footer -->
            <div class="footer">
                <div id="copyright">&copy; Phonify 2020 - All Rights Reserved - Ryan Haytree</div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- Custom JavaScript -->
<script src="./js/main.js" rel="javascript/text"></script>
<script src="./js/theme.js" rel="javascript/text"></script>
<script src="./js/navbar.js" rel="javascript/text"></script>
<script src="./js/login-register.js" rel="javascript/text"></script>
</html>