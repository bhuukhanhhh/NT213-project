<?php
require "../../php/utils.php";

if (isset($_SESSION['admin-log']) && $_SESSION['admin-log'] == true) {
    header("location: ../admin-dashboard.php");
} else {
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        header("location: ../admin-login.php");
    } else if (empty($_POST['username']) || empty($_POST['password']) || ctype_space($_POST['username']) || ctype_space($_POST['password'])) {
        // [Error 1] empty inputs or full filled inputs only by whitespaces
        echo 1;
    } else {
        $conn = database_connection();
        if ($conn) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $select_admin = sql_select($conn, "SELECT * FROM user_info WHERE username=? AND id=0", "s", $username);
            if ($select_admin->num_rows == 1) {
                $admin = $select_admin->fetch_assoc();
                if (password_verify($password, $admin['password'])) {
                    $_SESSION['admin-id'] = $admin['id'];
                    $_SESSION['admin-name'] = $admin['name'];
                    $_SESSION['admin-username'] = $admin['username'];
                    $_SESSION['admin-log'] = true;
                    // admin login successfully
                    echo 0;
                } else {
                    // [Error 3] invalid username or password
                    echo 3;
                }
            } else {
                // [Error 3] invalid username or password
                echo 3;
            }
        } else {
            // [Error 2] cannot connect to database --> something wrong has happened
            echo 2;
        }
    }
}
