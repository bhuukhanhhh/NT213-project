<?php
session_start();

// if admin has not logged in then admin cannot access admin-dashboard.php page anymore
if ($_SESSION['admin-log'] == false) {
    header("location: admin-login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo-2.png">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="../bootstrap/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="admin-script.js"></script>
    <title>Admin Dashboard</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <nav class="navbar navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="../index.php">Nhom14 Store</a>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="btn nav-link" onclick="admin_logout();">
                            <i class="fas fa-sign-out-alt"></i>
                            Sign Out
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link">
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            Customers
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>

    </main>

    <footer class="mt-auto">
        <div class="container">
            <center>
                <p>Copyright &copy Nhom14 Store. All Rights Reserved.</p>
            </center>
        </div>
    </footer>
</body>
<style>
    .nav-link {
        color: azure;
    }

    .nav-link:hover {
        background-color: #286090;
    }

    .sidebar {
        position: fixed;
        top: 54.49px;
        bottom: 0;
        left: 0;
        z-index: 100;
        /* Behind the navbar */
        padding: 100px 0 0;
        /* Height of navbar */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
        overflow-x: hidden;
        overflow-y: auto;
        /* Scrollable contents if viewport is shorter than content. */
    }
</style>

</html>