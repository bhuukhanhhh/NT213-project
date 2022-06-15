<?php
require "php/utils.php";
$PAGE_TITLE = "Check Out [Nhom14 Store]";

// if user has not logged in then he/she cannot access this page (checkout.php)
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
                <div class="col-md-7 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3><b>CONFIRMATION ORDERS</b></h3>
                        </div>
                        <div class="card-body">
                            <h5><b>Your order is confirmed!</b></h5>
                            <p>Thank you for ordering with us, we'll contact you by email with your order details.</p><br>
                        </div>
                        <div class="card-footer">
                            <p>Click here to purchase other products. <a href="products.php" style="color: #337ab7;">Go Shopping!</a></p>
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

</html>