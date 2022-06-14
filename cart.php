<?php
require "php/utils.php";
$PAGE_TITLE = "Cart [Nhom14 Store]";

// if user has not logged in then he/she cannot access this page (cart.php)
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

        <br><br><br>
        <div class="container">
            <center>
                <h2>List of items that you have added to your cart</h2>
                <br><br>
            </center>

            <table class="table table-bordered table-striped table-hover">
                <thead id="headTable">
                    <tr>
                        <th scope="col" class="col-2">Item number</th>
                        <th scope="col">Item name</th>
                        <th scope="col">Price</th>
                        <th scope="col" class="col-2">Quantity of item</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <!-- <tbody id="bodyTable"></tbody> -->
            </table>
        </div>
        <br><br><br>

    </main>

    <?php require "frontend/footer.html"; ?>

</body>
<style>
    .removeSection {
        font-weight: bold;
        color: #337ab7;
        cursor: pointer;
    }

    .removeSection:hover {
        color: #286090;
    }
</style>
<script>
    $(document).ready(function() {
        display_user_cart();
    });
</script>

</html>