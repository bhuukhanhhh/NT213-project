function admin_login() {
    $.ajax({
        url: "admin-php/admin-login-submit.php",
        data: $("#adminLoginForm").serialize(),
        type: "POST",
        success: function (response) {
            switch (response) {
                case '0':       // login successfully
                    window.location = "admin-dashboard.php";
                    break;
                case '1':       // empty inputs or full filled inputs only by whitespaces
                    alert("All input fields can not be left empty or full filled only by whitespaces.");
                    //window.location = "../admin/admin-login.php";
                    break;
                case '2':       // something wrong has happened
                    alert("Something wrong has happened! Please try again.");
                    //window.location = "../admin/admin-login.php";
                    break;
                case '3':       // invalid username or password
                    alert("Incorrect username or password.");
                    //window.location = "../admin/admin-login.php";
                    break;
                default:
                    alert("An unknown error occurred. Please try again later.");
                    //window.location = "../admin/admin-login.php";
                    break;
            }
        }
    });
}

function admin_logout() {
    $.post("admin-php/admin-logout-submit.php", function (response) {
        if (response == '0') {
            alert("Admin user is now logged out!");
            window.location = "admin-login.php";
        } else {
            alert("There's something wrong happened. Please check again!");
        }
    });
}