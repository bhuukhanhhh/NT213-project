<?php
require "php/utils.php";
$PAGE_TITLE = "Sign Up [Nhom14 Store]";

// if user has logged in then he/she cannot access signup.php page
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
                            <h3><b>SIGN UP</b></h3>
                        </div>
                        <div class="card-body">
                            <p>Sign up for an account so you can go shopping online in our store.</p>
                            <form id="signupForm" autocomplete="off" onkeydown="if(event.key === 'Enter'){event.preventDefault();signup();}">
                                <div id="errs" class="errcontainer"></div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter your name" name="name" required="true">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="tel" placeholder="Enter your phone number" name="contact">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="Enter your email" name="email" required="true">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter your username" name="username" required="true">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Enter your password" name="password" required="true">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Confirm your password" name="confirm-password" required="true">
                                </div>
                                <div class="form-group">
                                    <div class="btn btn-primary" onclick="signup();">
                                        Sign Up
                                    </div>
                                </div>
                                <input id="csrf_token" type="hidden" name="token" value="<?php echo generating_token(); ?>">
                            </form>
                        </div>
                        <div class="card-footer">
                            Already have an account? <a href="login.php" style="color: #337ab7;">Login</a>
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