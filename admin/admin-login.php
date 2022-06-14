<?php
session_start();

// if admin has logged in then admin cannot access admin-login.php page anymore
if (isset($_SESSION['admin-log']) && $_SESSION['admin-log'] == true) {
    header("location: admin-dashboard.php");
} else if ($_SESSION['admin-log'] == false) {
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
        <script type="text/javascript" src="admin-script.js"></script>
        <title>Admin Login</title>
    </head>

    <body class="d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar navbar-dark bg-primary">
                <div class="container">
                    <a class="navbar-brand" href="../index.php">Nhom14 Store</a>
                </div>
            </nav>
        </header>

        <main>
            <br><br><br><br><br><br>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header" style="background-color: #007bff; color: azure;">
                                <h3><b>LOG IN</b></h3>
                            </div>
                            <div class="card-body">
                                <form id="adminLoginForm" autocomplete="off" onkeydown="if(event.key === 'Enter'){event.preventDefault();admin_login();}">
                                    <!-- Error Messages -->
                                    <div id="errs" class="errcontainer"></div>
                                    <!-- Data Form -->
                                    <div class="form-group">
                                        <input class="form-control" name="username" type="text" placeholder="Username" required="true">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="password" type="password" placeholder="Password" required="true">
                                    </div>
                                    <div class="form-group">
                                        <div class="btn btn-primary" onclick="admin_login();">
                                            Log In
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br>
        </main>

        <footer class="mt-auto">
            <div class="container">
                <center>
                    <p>Copyright &copy Nhom14 Store. All Rights Reserved.</p>
                </center>
            </div>
        </footer>
    </body>

    </html>

<?php } ?>