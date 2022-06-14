<?php
require "php/utils.php";
$PAGE_TITLE = "Shopping [Nhom14 Store]";
?>

<!DOCTYPE html>
<html lang="en">

<?php require "frontend/metadata.html"; ?>

<body class="d-flex flex-column min-vh-100">

    <?php require "frontend/header.html"; ?>

    <main>

        <section class="jumbotron text-center">
            <div class="container">
                <h1 style="font-weight: bold; color:black;">Welcome to our Nhom14 Store!</h1>
                <p class="lead" style="color: #8F9193;">We have the best cameras, watches and shirts for you.<br>No need to hunt around, we have all in one place.</p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div id="displayProducts" class="container"></div>

            <!-- Pagination -->
            <!-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav> -->
        </div>
        <br><br>

    </main>

    <?php require "frontend/footer.html"; ?>

</body>
<style>
    .jumbotron {
        padding-top: 12rem;
        margin-bottom: 5;
        background-image: url('images/thumbnail/online-shopping2.jpg');
        background-size: cover;
    }

    .jumbotron p:last-child {
        margin-bottom: 0;
    }

    .jumbotron h1 {
        font-weight: 300;
    }

    .jumbotron .container {
        max-width: 40rem;
        height: 25rem;
    }

    .col-md-4 {
        width: 300px;
        height: 400px;
    }

    .card .mb-4 .shadow-sm {
        margin-bottom: 0;
    }

    .img-thumbnail {
        padding: 0;
        width: 100%;
        height: 250px;
    }

    .card-title {
        font-size: large;
        font-weight: 700;
    }
</style>
<script>
    $(document).ready(function() {
        display_products();
    });
</script>

</html>