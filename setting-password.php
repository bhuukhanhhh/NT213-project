<?php
require "php/utils.php";
$PAGE_TITLE = "Settings [Nhom14 Store]";

// if user has not logged in then he/she cannot access this page (setting-password.php)
if ($_SESSION['logged_in'] == false) {
    header("location: login.php");
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
                            <h3><b>SETTINGS</b></h3>
                        </div>
                        <div class="card-body">
                            <p>Fill in your information below to change your passwords</p>
                            <form id="changingpasswordForm" autocomplete="off" onkeydown="if(event.key === 'Enter'){event.preventDefault();change_password();}">
                                <div id="errs" class="errcontainer"></div>

                                <div class="form-group">
                                    <input type="password" class="form-control" name="oldPassword" placeholder="Old password" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="newPassword" placeholder="New password" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="retypingPassword" placeholder="Confirm new password" required="true">
                                </div>
                                <div class="form-group">
                                    <div class="btn btn-primary" onclick="change_password();">Submit</div>
                                </div>
                                <input id="csrf_token" type="hidden" name="token" value="<?php echo generating_token(); ?>">
                            </form>
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