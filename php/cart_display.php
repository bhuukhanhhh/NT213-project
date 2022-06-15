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
        $conn = database_connection();
        if ($conn) {
            $user_id = $_SESSION['id'];
            $select_user_cart = sql_select($conn, "SELECT product_id AS id, store_products.name, store_products.price, quantity, user_id AS uid FROM user_cart JOIN store_products ON store_products.id = user_cart.product_id WHERE user_cart.user_id=? AND user_cart.status=?", "ss", $user_id, "Added to cart");
            $record_set = array();
            if ($select_user_cart->num_rows == 0) {
                // empty cart
                echo 2;
            } else {
                while ($row = mysqli_fetch_assoc($select_user_cart)) {
                    array_push($record_set, $row);
                }
                echo json_encode($record_set);
            }
        } else {
            // [Error 1] cannot connect to database --> something wrong has happened
            echo 1;
        }
    }
}
