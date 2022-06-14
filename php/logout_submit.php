<?php
require "utils.php";

// NO ONE CAN ACCESS THIS FILE THROUGH URL

// if user has not logged in then redirect to login page (login.php)
if ($_SESSION['logged_in'] == false) {
    header("location: ../login.php");
} else {
    // if user has logged in then check for CSRF Token
    if (!isset($_POST['token']) || !validating_token($_POST['token'])) {
        header("location: ../index.php");
    } else {
        session_unset();
        session_destroy();
        $_SESSION['logged_in'] = false;
        // validated and unset all sessions successfully
        echo 0;
    }
}
