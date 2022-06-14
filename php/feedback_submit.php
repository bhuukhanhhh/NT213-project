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
        if (!isset($_POST['feedback'])) {
            header("location ../feedback.php");
        } else if (empty($_POST['feedback']) || ctype_space($_POST['feedback'])) {
            // [Error 1] cannot be empty or full filled only by whitespaces
            echo 1;
        } else {
            $conn = database_connection();
            if ($conn) {
                // using testing_input() function so the feedback output can have new line be displayed in browser
                $feedback_data = testing_input($_POST['feedback']);

                $user_id = mysqli_real_escape_string($conn, $_SESSION['id']);
                $user_username = mysqli_real_escape_string($conn, $_SESSION['username']);

                $insert_feedback = sql_insert($conn, "INSERT INTO users_feedbacks(user_id, user_username, submit_date, feedback) VALUES (?, ?, CURRENT_TIMESTAMP, ?)", "sss", $user_id, $user_username, $feedback_data);
                if ($insert_feedback == -1) {
                    // [Error 2] cannot insert into database --> something wrong has happened
                    echo 2;
                } else {
                    // [not an error] posted user's feedback successfully
                    echo 0;
                }
            } else {
                // [Error 2] cannot connect to database --> something wrong has happened
                echo 2;
            }
        }
    }
}
