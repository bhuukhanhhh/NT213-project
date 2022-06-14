<?php
require "utils.php";

// NO ONE CAN ACCESS THIS FILE THROUGH URL

// if user has logged in then redirect to home page (index.php)
if ($_SESSION['logged_in'] == true) {
    header("location: ../index.php");
} else {
    // if user has not logged in then check for CSRF Token
    if (!isset($_POST['token']) || !validating_token($_POST['token'])) {
        header("location: ../index.php");
    } else {
        $errors = [];

        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['confirm-password']) || ctype_space($_POST['name']) || ctype_space($_POST['email']) || ctype_space($_POST['username']) || ctype_space($_POST['password']) || ctype_space($_POST['confirm-password']) || ctype_space($_POST['contact'])) {
            // [Error 9] all input fields cannot be empty or full filled only by whitespaces (except contact field)
            $errors[] = 9;
        } else {
            $regex_name = "/^[a-zA-Z ]+$/";
            $regex_contact = "/^[\d ]*$/";
            $regex_username = "/^[a-zA-Z-._]+[0-9]*$/";
            $regex_password = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\~?!@#\$%\^&\*])(?=.{8,})/";

            if (!isset($_POST['name']) || strlen($_POST['name']) > 255 || !preg_match($regex_name, $_POST['name'])) {
                // [Error 1] Invalid name
                $errors[] = 1;
            }

            if (!isset($_POST['contact']) || strlen($_POST['contact']) > 20 || !preg_match($regex_contact, $_POST['contact'])) {
                // [Error 2] Invalid phone number
                $errors[] = 2;
            }

            if (!isset($_POST['email']) || strlen($_POST['email']) > 255 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                // [Error 3] Invalid email
                $errors[] = 3;
            }

            if (!isset($_POST['username']) || strlen($_POST['username']) > 255 || !preg_match($regex_username, $_POST['username'])) {
                // [Error 4] Invalid username
                $errors[] = 4;
            }

            if (!isset($_POST['password']) || strlen($_POST['password']) > 255 || !preg_match($regex_password, $_POST['password'])) {
                // [Error 5] Invalid password
                $errors[] = 5;
            } else if (!isset($_POST['confirm-password']) || strlen($_POST['confirm-password']) > 255 || $_POST['confirm-password'] !== $_POST['password']) {
                // [Error 6] Confirm password & Password do not match
                $errors[] = 6;
            }

            if (count($errors) === 0) {
                $conn = database_connection();
                if ($conn) {
                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $password = mysqli_real_escape_string($conn, $_POST['password']);

                    $select_user = sql_select($conn, "SELECT * FROM user_info WHERE username=? OR email=?", "ss", $username, $email);
                    if ($select_user->num_rows === 0) {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $new_user_id = sql_insert($conn, "INSERT INTO user_info(name, contact, email, username, password) VALUES (?, ?, ?, ?, ?)", "sssss", $name, $contact, $email, $username, $hashed_password);

                        // [not an error] creating an account successfully
                        $errors[] = 0;
                    } else {
                        // [Error 8] this email or username has been used by another account
                        $errors[] = 8;
                    }
                } else {
                    // [Error 7] cannot connect to database --> something wrongs happened.
                    $errors[] = 7;
                }
            }
            //echo json_encode($errors);
        }
        echo json_encode($errors);
    }
}
