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
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            header("location: ../login.php");
        } else if (empty($_POST['username']) || empty($_POST['password']) || ctype_space($_POST['username']) || ctype_space($_POST['password'])) {
            // [Error 1] empty inputs or full filled inputs only by whitespaces
            echo 1;
        } else {
            $conn = database_connection();
            if ($conn) {
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $select_user = sql_select($conn, "SELECT * FROM user_info WHERE username=?", "s", $username);
                if ($select_user->num_rows === 1) {
                    $user = $select_user->fetch_assoc();
                    if (password_verify($password, $user['password'])) {
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['name'] = $user['name'];
                        $_SESSION['contact'] = $user['contact'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['logged_in'] = true;
                        // login successfully
                        echo 0;
                    } else {
                        // [Error 2] Invalid username or password
                        echo 2;
                    }
                } else {
                    // [Error 2] Invalid username or password
                    echo 2;
                }
            } else {
                // [Error 3] cannot connect to database --> something wrong has happened
                echo 3;
            }
        }
    }
}
