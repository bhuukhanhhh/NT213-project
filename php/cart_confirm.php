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
        if (!isset($_GET['uid'])) {
            // [Error 2]
            echo 2;
        } else {
            $conn = database_connection();
            if ($conn) {
                $user_id = mysqli_real_escape_string($conn, $_GET['uid']);
                $update_status = sql_update($conn, "UPDATE user_cart SET status=? WHERE user_id=?", "ss", "Confirmed", $user_id);
                if ($update_status) {
                    // [not an error] update status successfully
                    echo 0;
                } else {
                    // [Error 3] cannot update user's orders
                    echo 3;
                }
            } else {
                // [Error 1] cannot connect to database --> something wrong has happened
                echo 1;
            }
        }
    }
}
