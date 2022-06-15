<?php
require "utils.php";

// NO ONE CAN ACCESS THIS FILE THROUGH URL

// if user has not logged in then redirect to login page (login.php)
if ($_SESSION['logged_in'] == false) {
    // because of 'add to cart' button so we need to check like this below
    if (!isset($_POST['token']) || !validating_token($_POST['token'])) {
        header("location: ../login.php");
    } else {
        echo 3;
    }
} else {
    // if user has logged in then check for CSRF Token
    if (!isset($_POST['token']) || !validating_token($_POST['token'])) {
        header("location: ../index.php");
    } else {
        if (!isset($_GET['iid']) || !isset($_SESSION['id'])) {
            // [Error 2] don't have item id or user id so system cannot add product to user's cart
            echo 2;
        } else {
            $conn = database_connection();
            if ($conn) {
                $user_id = mysqli_real_escape_string($conn, $_SESSION['id']);
                $item_id = mysqli_real_escape_string($conn, $_GET['iid']);

                $select_duplicated_product_in_cart = sql_select($conn, "SELECT * FROM user_cart WHERE user_id=? AND product_id=? AND quantity >= 1 AND status=?", "sss", $user_id, $item_id, "Added to cart");
                if ($select_duplicated_product_in_cart->num_rows != 0) {
                    $increase_quantity = sql_update($conn, "UPDATE user_cart SET quantity=quantity+1 WHERE user_id=? AND product_id=? AND quantity >= 1 AND status=?", "sss", $user_id, $item_id, "Added to cart");
                    if ($increase_quantity) {
                        // [not an error] add the same product to cart successfully
                        echo 0;
                    } else {
                        // [Error 2] cannot add the same product to cart
                        echo 2;
                    }
                } else {
                    $insert_item = sql_insert($conn, "INSERT INTO user_cart(user_id, product_id, status) VALUES (?, ?, ?)", "sss", $user_id, $item_id, "Added to cart");
                    if ($insert_item == -1) {
                        // [Error 2] cannot add product to cart
                        echo 2;
                    } else {
                        // [not an error] add product to cart successfully
                        echo 0;
                    }
                }
            } else {
                // [Error 1] cannot connect to database --> something wrong has happened
                echo 1;
            }
        }
    }
}
