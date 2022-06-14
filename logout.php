<?php
require "php/utils.php";
$PAGE_TITLE = "Sign Out [Nhom14 Store]";

if ($_SESSION['logged_in'] == true) {
    // if user has logged in then unset all the session (sign out that account) and redirect to home page (index.php)
    session_unset();
    session_destroy();
    $_SESSION['logged_in'] = false;
    echo '<script>alert("Please sign in again, you have been logged out of your account."); window.location = "index.php";</script>';
}
// if user has not logged in then show logout.php page with the notifications below
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
                            <h3><b>SIGN OUT</b></h3>
                        </div>
                        <div class="card-body">
                            <?php if ($_SESSION['logged_in'] == false) { ?>
                                <p><strong>You have been logged out.</strong></p><br>
                                <p>And you will be automatically redirected to home page in <b><span id="seconds_countdown" style="color: red;">5</span></b> seconds.</p>
                                <p>Click here to <a href="login.php" style="color: #337ab7;">Login again.</a></p>
                            <?php } ?>
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
</style>

<script>
    countdown_timer_for_logout();
</script>

</html>