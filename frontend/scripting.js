// request (POST ajax method - use for submit form)
function request(request_url, request_data, callback) {
    $.ajax({
        url: request_url,
        data: $(request_data).serialize(),
        type: "POST",
        success: callback
    })
}

// signup.php (register an account)                         [DONE]
function signup() {
    request("php/signup_submit.php", "#signupForm", function (data) {
        document.getElementById('errs').innerHTML = "";
        var transition = document.getElementById('errs').style.transition;
        document.getElementById('errs').style.transition = "none";
        document.getElementById('errs').style.opacity = 0;
        try {
            data = JSON.parse(data);
            if (!(data instanceof Array)) {
                throw Exception("Bad Data");
            }
            for (var i = 0; i < data.length; i++) {
                switch (data[i]) {
                    case 0:
                        Swal.fire({
                            title: "DONE!",
                            html: "Your account has been created successfully <br>Do you want to login now? <a href='login.php' style='color: #337ab7;'>Login</a>",
                            icon: "success",
                            confirmButtonColor: "#337ab7",
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        });
                        document.getElementById('signupForm').reset();
                        break;
                    case 1:     // invalid name
                        document.getElementById('errs').innerHTML += '<div class="err">Invalid name entered.</div>';
                        break;
                    case 2:     // invalid phone number
                        document.getElementById('errs').innerHTML += '<div class="err">Invalid phone number entered.</div>';
                        break;
                    case 3:     // invalid email
                        document.getElementById('errs').innerHTML += '<div class="err">Invalid email entered.</div>';
                        break;
                    case 4:     // invalid username
                        document.getElementById('errs').innerHTML += '<div class="err">Invalid username entered.</div>';
                        break;
                    case 5:     // invalid password
                        document.getElementById('errs').innerHTML += '<div class="err">Password must contain: <ul><li>At least 8 characters</li><li>At least one lower case letter</li><li>At least one upper case letter</li><li>At least one number</li><li>At least one special character (~?!@#$%^&*)</li></ul></div>';
                        break;
                    case 6:     // confirm password & password do not match
                        document.getElementById('errs').innerHTML += '<div class="err">Passwords do not match. Please re-enter your confirmed password.</div>';
                        break;
                    case 7:     // something wrong has happened
                        Swal.fire({
                            title: "ERROR!",
                            text: "Something wrong has happened! Please try again.",
                            icon: "error",
                            confirmButtonColor: "#337ab7",
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        });
                        document.getElementById('signupForm').reset();
                        break;
                    case 8:     // this username or email has been used by another account
                        Swal.fire({
                            title: "ERROR!",
                            text: "An account with this email/username already exists.",
                            icon: "error",
                            confirmButtonColor: "#337ab7",
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        });
                        break;
                    case 9:     // empty input fields or full filled only by whitespaces
                        Swal.fire({
                            title: "ERROR!",
                            text: "All input fields can't be left empty or full filled only by whitespaces (except Phone Number field)",
                            icon: "error",
                            confirmButtonColor: "#337ab7",
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        });
                        break;
                    default:
                        Swal.fire({
                            title: "ERROR!",
                            text: "An unknown error occurred. Please try again later.",
                            icon: "error",
                            confirmButtonColor: "#337ab7",
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        });
                        document.getElementById('signupForm').reset();
                        break;
                }
            }
        } catch (error) {
            document.getElementById('errs').innerHTML = '<div class="err">An error exception occured. Please try again later.</div>';
        }
        setTimeout(function () {
            document.getElementById('errs').style.transition = transition;
            document.getElementById('errs').style.opacity = 1;
        }, 10);
    });
}

// login.php (sign in with registered account)              [DONE]
function login() {
    request("php/login_submit.php", "#loginForm", function (response) {
        switch (response) {
            case '0':
                window.location = "products.php";
                break;
            case '1':
                Swal.fire({
                    title: "Error",
                    text: "All input fields can't be left empty or full filled only by whitespaces.",
                    icon: "error"
                });
                break;
            case '2':
                Swal.fire({
                    title: "Error",
                    text: "Incorrect username or password.",
                    icon: "error"
                });
                break;
            case '3':
                Swal.fire({
                    title: "Error",
                    text: "Something wrong has happened! Please try again.",
                    icon: "error"
                });
                document.getElementById('loginForm').reset();
                break;
            default:
                Swal.fire({
                    title: "Error",
                    text: "An unknown error occurred. Please try again later.",
                    icon: "error"
                });
                document.getElementById('loginForm').reset();
                break;
        }
    });
}

// logout.php (sign out from an account)                    [DONE]
function logout() {
    request("php/logout_submit.php", "#csrf_token", function (response) {
        if (response == '0') {
            window.location = "logout.php";
        } else {
            Swal.fire({
                title: "Error",
                text: "There's something wrong happened. Please check again!",
                icon: "error"
            });
            window.location = "index.php";
        }
    });
}

// 5 seconds countdown timer in logout.php page and then redirect to home page
// logout.php (show countdown timer)                        [DONE]
function countdown_timer_for_logout() {
    var seconds = 5;
    var foo = setInterval(function () {
        document.getElementById("seconds_countdown").innerHTML = seconds;
        seconds--;
        if (seconds == -1) {
            clearInterval(foo);
            document.location.href = "index.php";
        }
    }, 1000);
}

// contact.php                                              [DONE]
function contact_us() {
    request("php/contact_submit.php", "#contactForm", function (response) {
        switch (response) {
            case '0':
                Swal.fire({
                    title: "Done!",
                    text: "Our employees will contact to help you soon, thank you!",
                    icon: "success",
                });
                document.getElementById('contactForm').reset();
                break;
            case '1':
                Swal.fire({
                    title: "Error!",
                    text: "Something wrong has happened! Please try again.",
                    icon: "error"
                });
                break;
            case '2':
                Swal.fire({
                    title: "Error",
                    text: "All input fields can't be left empty or full filled only by whitespaces.",
                    icon: "error"
                });
                break;
            case '3':
                Swal.fire({
                    title: "Error!",
                    text: "There's something is missing, system can not remove item out of your cart. Please try again.",
                    icon: "error",
                });
                break;
            case '4':
                Swal.fire({
                    title: "Error!",
                    text: "Invalid name entered.",
                    icon: "error",
                });
                break;
            case '5':
                Swal.fire({
                    title: "Error!",
                    text: "Invalid email entered.",
                    icon: "error",
                });
                break;
            case '6':
                Swal.fire({
                    title: "Error!",
                    text: "Invalid phone number entered.",
                    icon: "error",
                });
                break;
            default:
                Swal.fire({
                    title: "Error!",
                    text: "An unknown error occurred! Please try again later.",
                    icon: "error",
                });
                break;
        }
    });
}

// setting-password.php (changing user's password)          [DONE]
function change_password() {
    request("php/settingpassword_submit.php", "#changingpasswordForm", function (response) {
        switch (response) {
            case '0':
                Swal.fire({
                    title: "Done",
                    text: "Your new password has been updated successfully!",
                    icon: "success"
                });
                document.getElementById('changingpasswordForm').reset();
                break;
            case '1':
                Swal.fire({
                    title: "Error",
                    text: "All input fields can not be left empty or full filled only by whitespaces.",
                    icon: "error"
                });
                break;
            case '2':
                Swal.fire({
                    title: "Error",
                    text: "Something wrong has happened! Please try again.",
                    icon: "error"
                });
                break;
            case '3':
                Swal.fire({
                    title: "Error",
                    text: "Passwords do not match. Please check again.",
                    icon: "error"
                });
                break;
            case '4':
                Swal.fire({
                    title: "Error",
                    html: "Your new password is invalid. Password must contain:<br> <ul style='text-align: left; margin-left: 15px;'><li>At least 8 characters</li><li>At least one lower case letter</li><li>At least one upper case letter</li><li>At least one number</li><li>At least one special character (~?!@#$%^&*)</li></ul>",
                    icon: "error"
                });
                break;
            default:
                Swal.fire({
                    title: "Error",
                    text: "An unknown error occurred. Please try again later.",
                    icon: "error"
                });
                document.getElementById('changingpasswordForm').reset();
                break;
        }
    });
}

// feedback.php (posting user's feedbacks)                  [DONE]
function send_feedback() {
    request("php/feedback_submit.php", "#feedbackForm", function (response) {
        switch (response) {
            case '0':
                Swal.fire({
                    title: "Done",
                    text: "Your feedback has been posted successfully, thanks!",
                    icon: "success"
                });
                document.getElementById('feedbackForm').reset();
                display_feedbacks();
                break;
            case '1':
                Swal.fire({
                    title: "Error",
                    text: "Your feedback can't be left empty or full filled only by whitespaces.",
                    icon: "error"
                });
                break;
            case '2':
                Swal.fire({
                    title: "Error",
                    text: "Something wrong has happened! Please try again.",
                    icon: "error"
                });
                break;
            default:
                Swal.fire({
                    title: "Error",
                    text: "An unknown error occurred! Please try again later.",
                    icon: "error"
                });
                document.getElementById('feedbackForm').reset();
                break;
        }
    });
}

// feedback.php (displaying all user's feedbacks/comments)  [DONE]
function display_feedbacks() {
    let get_token = document.getElementById('csrf_token');

    $.post("php/feedback_display.php", $(get_token).serialize(), function (response) {
        switch (response) {
            case '1':
                Swal.fire({
                    title: "Error",
                    text: "Something wrong has happened! Please try again.",
                    icon: "error"
                });
                break;
            case '2':
                document.getElementById('displayFeedbackSection').innerHTML = "";
                break;
            default:
                response = JSON.parse(response);
                var list_comment = $("<div class='container'>");
                for (var i = 0; i < response.length; i++) {
                    var user_username = response[i]['user_username'];
                    var user_date = response[i]['submit_date'];
                    var user_feedback = response[i]['feedback'];

                    var each_comment = "<div class='row'><div class='col-md-6 offset-md-3'><div class='card'>"
                        + "<div class='card-body'><h6 class='card-title'>Posted by <strong>" + user_username + "</strong> on " + user_date + "</h6>"
                        + "<div class='card-text'>" + user_feedback
                        + "</div></div></div></div></div><br><br>";

                    list_comment.append(each_comment);
                }
                $("#displayFeedbackSection").html(list_comment);
                break;
        }
    });
}

// cart.php (fetching user's cart)                          [DONE]
function display_user_cart() {
    let get_token = document.getElementById('csrf_token');

    $.post("php/cart_display.php", $(get_token).serialize(), function (response) {
        switch (response) {
            case '1':
                Swal.fire({
                    title: "Error",
                    text: "Something wrong has happened! Please try again.",
                    icon: "error"
                });
                break;
            case '2':
                var list_cart = document.createElement("tbody");
                var empty_cart = "<tr><td colspan='5'><center>There's no product in your cart.</center></td></tr>";
                $(list_cart).append(empty_cart);
                $(list_cart).insertAfter("#headTable");
                break;
            default:
                response = JSON.parse(response);
                //var list_cart = document.createElement("tbody").setAttribute("id", "bodyTable");
                var list_cart = $("<tbody>");
                var total_price = 0;

                for (var i = 0; i < response.length; i++) {
                    var item_id = response[i]['id'];
                    var item_name = response[i]['name'];
                    var item_price = response[i]['price'];
                    var item_quantity = response[i]['quantity'];
                    var item_number = i + 1;
                    var uid = response[i]['uid'];

                    var each_item = "<tr><th scope='row'>" + item_number + "</th>"
                        + "<td>" + item_name + "</td>"
                        + "<td><span>&#36;</span>" + item_price + "</td>"
                        + "<td>" + item_quantity + "</td>"
                        + "<td><a class='removeSection' onclick='remove_product(" + item_id + ", " + item_quantity + ");'>Remove Item</a></td></tr>";

                    //$(list_cart).append(each_item);
                    list_cart.append(each_item);

                    total_price = total_price + (item_price * item_quantity);
                    if (i == response.length - 1) {
                        var total_row = "<tr><th colspan='2'><center>Total Price:</center></th>"
                            + "<th colspan='2' text-align: left;'><span>&#36;</span>" + total_price + "</th>"
                            + "<th><div class='btn btn-primary' onclick='check_out(" + uid + ");'>Confirm Order</div></th></tr>";
                        list_cart.append(total_row);
                    }
                }
                //$("#bodyTable").html(list_cart);
                list_cart.insertAfter("#headTable");
                break;
        }
    });
}

// products.php (adding products to user's cart)            [DONE]
function add_product(item_id) {
    var get_token = document.getElementById('csrf_token');
    $.post("php/cart_add.php?iid=" + item_id, $(get_token).serialize(), function (response) {
        switch (response) {
            case '0':
                Swal.fire({
                    title: "DONE!",
                    text: "Added product to your cart successfully!",
                    icon: "success",
                    confirmButtonColor: "#337ab7",
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
                break;
            case '1':
                Swal.fire({
                    title: "ERROR!",
                    text: "Something wrong has happened! Please try again.",
                    icon: "error",
                    confirmButtonColor: "#337ab7",
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
                break;
            case '2':
                Swal.fire({
                    title: "ERROR!",
                    text: "There's something is missing, system can not add item to your cart. Please try again.",
                    icon: "error",
                    confirmButtonColor: "#337ab7",
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
                break;
            case '3':
                Swal.fire({
                    title: "Failed!",
                    text: "You need to login to add products to your cart!",
                    icon: "info",
                    confirmButtonColor: "#337ab7",
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
                break;
            default:
                console.log(response);
                Swal.fire({
                    title: "ERROR!",
                    text: "An unknown error occurred! Please try again later.",
                    icon: "error",
                    confirmButtonColor: "#337ab7",
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
                break;
        }
    });
}

// cart.php (removing user's products out from the cart)    [DONE]
function remove_product(item_id, nums) {
    if (nums > 1) {
        Swal.fire({
            title: "Removing your product!",
            html: "How many item do you want to remove?<br><br><input id='quantity' type='number' style='width: 70px;' value='1' min='1' max='" + nums + "'>",
            icon: "info",
            confirmButtonColor: "#337ab7",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                var item_quantity = document.getElementById('quantity').value;
                var get_token = document.getElementById('csrf_token');

                $.post("php/cart_remove.php?iid=" + item_id + "&num=" + item_quantity, $(get_token).serialize(), function (response) {
                    console.log(response);
                    switch (response) {
                        case '0':
                            Swal.fire({
                                title: "DONE!",
                                icon: "success",
                                text: "Remove successfully!",
                                confirmButtonColor: "#337ab7"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "cart.php";
                                }
                            })
                            break;
                        case '1':
                            Swal.fire({
                                title: "Error!",
                                text: "There's something is missing, system can not remove item out of your cart. Please try again.",
                                icon: "error",
                            });
                            break;
                        case '2':
                            Swal.fire({
                                title: "Error!",
                                text: "Something wrong has happened! Please try again.",
                                icon: "error"
                            });
                            break;
                        default:
                            break;
                    }
                });
            }
        })
    } else if (nums == 1) {
        Swal.fire({
            title: "Are you sure?",
            icon: "info",
            confirmButtonColor: "#337ab7",
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                var get_token = document.getElementById('csrf_token');
                console.log(get_token);
                $.post("php/cart_remove.php?num=1&iid=" + item_id, $(get_token).serialize(), function (response) {
                    console.log(response);
                    switch (response) {
                        case '0':
                            Swal.fire({
                                title: "DONE!",
                                icon: "success",
                                text: "Remove successfully!",
                                confirmButtonColor: "#337ab7"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "cart.php";
                                }
                            })
                            break;
                        case '1':
                            Swal.fire({
                                title: "Error!",
                                text: "There's something is missing, system can not remove item out of your cart. Please try again.",
                                icon: "error",
                            });
                            break;
                        case '2':
                            Swal.fire({
                                title: "Error!",
                                text: "Something wrong has happened! Please try again.",
                                icon: "error"
                            });
                            break;
                        default:
                            Swal.fire({
                                title: "Error",
                                text: "Unknown error",
                                icon: "error"
                            });
                            break;
                    }
                });
            }
        })
    }
}

// products.php (displaying all products from database)     [DONE]
function display_products() {
    let get_token = document.getElementById('csrf_token');

    $.post("php/products_display.php", $(get_token).serialize(), function (response) {
        switch (response) {
            case '1':
                Swal.fire({
                    title: "Error",
                    text: "Something wrong has happened! Please try again.",
                    icon: "error"
                });
                break;
            case '2':
                Swal.fire({
                    title: "Error",
                    text: "It is our fault, please come back later, we will fix this right away.",
                    icon: "error"
                });
                break;
            default:
                response = JSON.parse(response);
                console.log(response);
                let list_products = $("<div class='row'>");

                for (let i = 0; i < response.length; i++) {
                    let product_id = response[i]['id'];
                    let product_name = response[i]['name'];
                    let product_price = response[i]['price'];
                    let product_img = response[i]['img'];

                    let each_product = "<div class='col-md-4'><div class='card mb-4 shadow-sm'><a><img class='img-thumbnail' src='" + product_img + "'></a>"
                        + "<div class='card-body'><h6 class='card-title'>" + product_name + "</h6>"
                        + "<p class='card-text'>Price: <span>&#36;</span>" + product_price + "</p>"
                        + "<div class='d-flex justify-content-between align-items-center'><div class='btn-group'><button type='button' class='btn btn-sm btn-outline-secondary' onclick='add_product(" + product_id + ");'>Add to Cart</button></div></div>"
                        + "</div></div></div>";

                    list_products.append(each_product);
                }
                $("#displayProducts").html(list_products);
                break;
        }
    });
}

// checkout.php (confirm customer's order)
function check_out(uid) {
    var get_token = document.getElementById('csrf_token');
    Swal.fire({
        title: "Confirmation",
        text: "You want to buy all these products?",
        icon: "info",
        confirmButtonColor: "#337ab7",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("php/cart_confirm.php?uid=" + uid, $(get_token).serialize(), function (response) {
                switch (response) {
                    case '0':
                        window.location.href = "checkout.php";
                        break;
                    case '1':
                        Swal.fire({
                            title: "Error",
                            text: "Something wrong has happened! Please try again.",
                            icon: "error",
                            confirmButtonColor: "#337ab7"
                        });
                        break;
                    case '2':
                        Swal.fire({
                            title: "Error",
                            text: "There is missing something, we can't confirm your order. Please try again.",
                            icon: "error",
                            confirmButtonColor: "#337ab7"
                        });
                        break;
                    case '3':
                        Swal.fire({
                            title: "Error",
                            text: "It's our fault, we will fix this later. Sorry for this inconvenience.",
                            icon: "error",
                            confirmButtonColor: "#337ab7"
                        });
                        break;
                }
            });
        }
    })


}

