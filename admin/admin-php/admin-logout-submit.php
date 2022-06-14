<?php
session_start();

if (!isset($_SESSION['admin-log']) || $_SESSION['admin-log'] == false) {
    header("location: ../admin-login.php");
} else {
    session_unset();
    session_destroy();
    $_SESSION['admin-log'] = false;
    // log out successfully
    echo 0;
}
