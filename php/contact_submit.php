<?php
require "utils.php";

// NO ONE CAN ACCESS THIS FILE THROUGH URL

// check for CSRF Token
if (!isset($_POST['token']) || !validating_token($_POST['token'])) {
    header("location: ../index.php");
} else {
    if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['contact']) || !isset($_POST['messages'])) {
        header("location: ../contact.php");
    } else if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['contact']) || empty($_POST['messages']) || ctype_space($_POST['name']) || ctype_space($_POST['email']) || ctype_space($_POST['contact']) || ctype_space($_POST['messages'])) {
        // [Error 2] empty inputs or full filled inputs only by whitespaces
        echo 2;
    } else {
        $regex_name = "/^[a-zA-Z ]+$/";
        $regex_contact = "/^[\d ]*$/";

        if (strlen($_POST['name']) > 255 || !preg_match($regex_name, $_POST['name'])) {
            // [Error 4] invalid name format
            echo 4;
        } else if (strlen($_POST['email']) > 255 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // [Error 5] invalid email format
            echo 5;
        } else if (strlen($_POST['contact']) > 20 || !preg_match($regex_contact, $_POST['contact'])) {
            // [Error 6] invalid contact format
            echo 6;
        } else {
            $conn = database_connection();
            if ($conn) {
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $contact = mysqli_real_escape_string($conn, $_POST['contact']);
                //$messages = testing_input($_POST['messages']);
                $messages = mysqli_real_escape_string($conn, $messages);

                $insert_messages = sql_insert($conn, "INSERT INTO contact_service(name, email, contact, submit_date, messages) VALUES (?, ?, ?, CURRENT_TIMESTAMP, ?)", "ssss", $name, $email, $contact, $messages);
                if ($insert_messages != -1) {
                    // [not an error] insert messages to database successfully
                    echo 0;
                } else {
                    // [Error 3] cannot insert messages to database
                    echo 3;
                }
            } else {
                // [Error 1] cannot connect to database --> something wrong has happened
                echo 1;
            }
        }
    }
}
