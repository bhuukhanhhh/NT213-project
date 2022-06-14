<?php
require "php/utils.php";
$PAGE_TITLE = "Nhom14 Store";
?>

<!DOCTYPE html>
<html lang="en">

<?php require "frontend/metadata.html"; ?>

<body class="d-flex flex-column min-vh-100">

    <?php require "frontend/header.html"; ?>

    <main>

        <div id="bannerImage">
            <div class="container">
                <center>
                    <div id="bannerContent">
                        <h1>We sell lifestyle with one click.</h1>
                        <a href="products.php" class="btn btn-danger">Shop Now</a>
                    </div>
                </center>
            </div>
        </div>

        <br><br><br>

        <div class="card-deck py-5">
            <div class="container">
                <div class="row">
                    <div class="col mb-4">
                        <div class="card">
                            <a href="products.php">
                                <img class="img-thumbnail" src="images/thumbnail/camera.jpg" alt="Camera">
                            </a>
                            <div class="card-body">
                                <center>
                                    <h3 class="card-title">Cameras</h3>
                                    <p class="card-text">The best cameras available in the world.</p>
                                </center>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card">
                            <a href="products.php">
                                <img class="img-thumbnail" src="images/thumbnail/watch.jpg" alt="Watch">
                            </a>
                            <div class="card-body">
                                <center>
                                    <h3 class="card-title">Watches</h3>
                                    <p class="card-text">Original watches from the best brands.</p>
                                </center>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card">
                            <a href="products.php">
                                <img class="img-thumbnail" src="images/thumbnail/shirt.jpg" alt="Shirt">
                            </a>
                            <div class="card-body">
                                <center>
                                    <h3 class="card-title">Shirts</h3>
                                    <p class="card-text">Our exquisite collection of shirts.</p>
                                </center>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>

    </main>

    <?php require "frontend/footer.html"; ?>

</body>
<style>
    .card-body {
        height: 160px;
    }
</style>

</html>