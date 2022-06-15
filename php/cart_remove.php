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
        if (!isset($_GET['iid']) || !isset($_SESSION['id']) || !isset($_GET['num'])) {
            // [Error 2] don't have item id or user id so system cannot remove product out of user's cart
            echo 2;
        } else {
            $conn = database_connection();
            if ($conn) {
                $user_id = mysqli_real_escape_string($conn, $_SESSION['id']);
                $item_quantity = mysqli_real_escape_string($conn, $_GET['num']);
                $item_id = mysqli_real_escape_string($conn, $_GET['iid']);

                $select_id_product = sql_select($conn, "SELECT * FROM user_cart WHERE user_id=? AND product_id=? AND quantity >= 1", "ss", $user_id, $item_id);
                if ($select_id_product->num_rows != 0) {
                    $product_detail = $select_id_product->fetch_assoc();
                    if ($item_quantity == $product_detail['quantity']) {
                        // delete all
                        $delete_entire_item = sql_delete($conn, "DELETE FROM user_cart WHERE user_id=? AND product_id=?", "ss", $user_id, $item_id);
                        if ($delete_entire_item) {
                            // [not an error] remove entire product out of cart successfully
                            echo 0;
                        } else {
                            // [Error 1] cannot delete entire product --> something wrong has happened
                            echo 1;
                        }
                    } else if ($item_quantity < $product_detail['quantity']) {
                        $delete_nums_item = sql_update($conn, "UPDATE user_cart SET quantity=quantity-? WHERE user_id=? AND product_id=? AND quantity >= 1", "sss", $item_quantity, $user_id, $item_id);
                        if ($delete_nums_item) {
                            // [not an error] remove product successfully
                            echo 0;
                        } else {
                            echo 1;
                        }
                    }
                } else {
                    // error
                }
            } else {
                // [Error 1] cannot connect to database --> something wrong has happened
                echo 1;
            }
        }
    }
}
