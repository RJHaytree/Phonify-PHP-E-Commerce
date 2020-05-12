<?php
/**
 * AccountController
 * ------------------------------
 * Controls all interactions with the client's account.
 * 
 * @author Ryan Haytree
 */
$filepath = realpath(dirname(__FILE__));
require_once($filepath . './../account/Login.php');
require_once($filepath . './../account/Register.php');

session_start();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'login') {
        # If the login action is received, instantiate Login object passing the credentials as arguments.
        new Login($_POST['emailuid'], $_POST['pass']);
    }

    if ($_POST['action'] == 'register') {
        # If the register action is received, instantiate Register object passing the credentials as arguments.
        new Register($_POST['username'], $_POST['email'], $_POST['pass'], $_POST['pass2']);
    }

    if ($_POST['action'] == 'signout') {
        # If the signout action is received, simply unless the user array in the session.
        unset($_SESSION['user']);
    }
}
?>