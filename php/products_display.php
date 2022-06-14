<?php
require "utils.php";

// NO ONE CAN ACCESS THIS FILE THROUGH URL

// check for CSRF Token
if (!isset($_POST['token']) || !validating_token($_POST['token'])) {
    header("location: ../index.php");
} else {
    $conn = database_connection();
    if ($conn) {
        $select_products = sql_select($conn, "SELECT * FROM store_products");
        $record_set = array();
        if ($select_products->num_rows == 0) {
            // empty table
            echo 2;
        } else {
            while ($row = mysqli_fetch_assoc($select_products)) {
                array_push($record_set, $row);
            }
            echo json_encode($record_set);
        }
    } else {
        // [Error 1] cannot connect to database --> something wrong has happened
        echo 1;
    }
}
