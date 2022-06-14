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
            $select_comments = sql_select($conn, "SELECT * FROM users_feedbacks ORDER BY submit_date DESC");
            $record_set = array();
            if ($select_comments->num_rows == 0) {
                // empty database
                echo 2;
            } else {
                while ($row = mysqli_fetch_assoc($select_comments)) {
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
