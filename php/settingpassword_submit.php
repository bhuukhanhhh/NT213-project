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
        if (!isset($_POST['oldPassword']) || !isset($_POST['newPassword']) || !isset($_POST['retypingPassword'])) {
            header("location: ../setting-password.php");
        } else if (empty($_POST['oldPassword']) || empty($_POST['newPassword']) || empty($_POST['retypingPassword']) || ctype_space($_POST['oldPassword']) || ctype_space($_POST['newPassword']) || ctype_space($_POST['retypingPassword'])) {
            // [Error 1] cannot be empty or full filled only by whitespaces
            echo 1;
        } else {
            $conn = database_connection();
            if ($conn) {
                // password format
                $regex_password = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\~?!@#\$%\^&\*])(?=.{8,})/";

                $old_password = mysqli_real_escape_string($conn, $_POST['oldPassword']);
                $new_password = mysqli_real_escape_string($conn, $_POST['newPassword']);
                $retyping_password = mysqli_real_escape_string($conn, $_POST['retypingPassword']);

                $username = mysqli_real_escape_string($conn, $_SESSION['username']);
                $email = mysqli_real_escape_string($conn, $_SESSION['email']);

                $select_user = sql_select($conn, "SELECT * FROM user_info WHERE username=? AND email=?", "ss", $username, $email);
                if ($select_user->num_rows === 1) {
                    $fetch_user_info = $select_user->fetch_assoc();
                    if (password_verify($old_password, $fetch_user_info['password'])) {
                        if (preg_match($regex_password, $new_password)) {
                            if ($retyping_password == $new_password) {
                                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                                $update_password = sql_update($conn, "UPDATE user_info SET password=? WHERE username=? AND email=?", "sss", $hashed_new_password, $username, $email);
                                if ($update_password) {
                                    // [not an error] updated new password into database successfully
                                    echo 0;
                                } else {
                                    // [Error 2] Cannot update into database --> something wrong has happened.
                                    echo 2;
                                }
                            } else {
                                // [Error 3] confirm password & new password do not match
                                echo 3;
                            }
                        } else {
                            // [Error 4] new password doesn't correct with the format
                            echo 4;
                        }
                    } else {
                        // [Error 3] old password typed in and password in database do not match
                        echo 3;
                    }
                } else {
                    // [Error 2] username & email in $_SESSION don't exist in the database --> something wrong has happened.
                    echo 2;
                }
            } else {
                // [Error 2] cannot connect to database --> Something wrong has happened.
                echo 2;
            }
        }
    }
}
