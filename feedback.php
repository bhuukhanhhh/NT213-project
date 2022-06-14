<?php
require "php/utils.php";
$PAGE_TITLE = "Feedbacks [Nhom14 Store]";

// if user has not logged in then he/she cannot access this page (feedback.php)
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
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">COMMENTS</h3>
                            <p>Hi <?php echo $_SESSION['username']; ?>, leave us comments or feedbacks below, thank you.</p>
                            <form id="feedbackForm" autocomplete="off">
                                <div class="form-group">
                                    <textarea class="form-control" name="feedback" placeholder="Enter your feedback here" rows="5" style="resize: none;" required="true"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="btn btn-primary" onclick="send_feedback();">
                                        Post
                                    </div>
                                </div>
                                <input id="csrf_token" type="hidden" name="token" value="<?php echo generating_token(); ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <br>

        <div id="displayFeedbackSection"></div>

        <br><br><br>

    </main>

    <?php require "frontend/footer.html"; ?>

</body>
<style>
    .card-title {
        color: #337ab7;
    }

    .card-header {
        background-color: #337ab7;
        color: #fff;
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
<script>
    $(document).ready(function() {
        display_feedbacks();
    });
</script>

</html>