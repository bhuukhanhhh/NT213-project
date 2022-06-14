<?php
require "php/utils.php";
$PAGE_TITLE = "Log In [Nhom14 Store]";

// if user has logged in then he/she cannot access login.php page
if ($_SESSION['logged_in'] == true) {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<?php require "frontend/metadata.html"; ?>

<body class="d-flex flex-column min-vh-100">

    <?php require "frontend/header.html"; ?>

    <main>

        <br><br><br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3><b>LOG IN</b></h3>
                        </div>
                        <div class="card-body">
                            <p>Log in to make a purchase.</p>
                            <form id="loginForm" autocomplete="off" onkeydown="if(event.key === 'Enter'){event.preventDefault();login();}">
                                <div class="form-group">
                                    <input class="form-control" name="username" type="text" placeholder="Username" required="true">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="password" type="password" placeholder="Password" required="true">
                                </div>
                                <div class="form-group">
                                    <div class="btn btn-primary" onclick="login();">
                                        Log In
                                    </div>
                                </div>
                                <input id="csrf_token" type="hidden" name="token" value="<?php echo generating_token(); ?>">
                            </form>
                        </div>
                        <div class="card-footer">
                            Don't have an account yet? <a href="signup.php" style="color: #337ab7;">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br>

    </main>

    <?php require "frontend/footer.html"; ?>

</body>
<style>
    .card-header {
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
    }

    .btn-primary {
        color: #fff;
        background-color: #337ab7;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #286090;
        border-color: #204d74;
    }
</style>

</html>