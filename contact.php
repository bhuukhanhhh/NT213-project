<?php
require "php/utils.php";
$PAGE_TITLE = "Contact Us [Nhom14 Store]";
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
                            <h3><b>CONTACT US</b></h3>
                        </div>
                        <div class="card-body">
                            <p>Fill in your information below and we will contact you.</p>
                            <form id="contactForm" autocomplete="off" onkeydown="if(event.key === 'Enter'){event.preventDefault();contact_us();}">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Enter your name" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" name="contact" placeholder="Enter your phone number" required="true">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="messages" rows="8" placeholder="Enter your message" style="resize: none;" required="true"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="btn btn-primary" onclick="contact_us();">
                                        Send
                                    </div>
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