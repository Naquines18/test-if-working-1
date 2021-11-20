<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include "meta.php"; ?>


        <title>Register As Client | Online Appointment System | Makilala Institute System and Information</title>

        <link href="css/app.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    </head>
    <style type="text/css">
        .hide{
            display: none;
        }
        /* body{
            background-image: url("css__/bg.svg");
            background-repeat: no-repeat;
            background-position: left;
            background-size: 30%;
            margin-top: 1rem;

        } */
    </style>
    <body id="main">
        <main class="d-flex w-100">
            <div class="container d-flex flex-column">
                <div class="row vh-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <h3 class="text-center">Register Now!</h3>
                                        <p class="lead text-center">
                                            Start creating the best possible user experience for your client.
                                        </p>
                                        <form id="register_form" method="POST">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label">Firstname</label>
                                                        <input class="form-control form-control-lg" type="text" name="firstname" id="firstname" placeholder="Enter your firstname" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label">Lastname</label>
                                                        <input class="form-control form-control-lg" type="text" name="lastname" id="lastname" placeholder="Enter your lastname" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input class="form-control form-control-lg" type="email" name="email" id="email" placeholder="Enter your email" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Gender</label>
                                                <div class="form-group mb-2">
                                                    <select class="form-control mb-3" id="gender" name="gender">
													<option selected="" value="" readonly>--- Select Gender ---</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Password</label>
                                                        <input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Enter password" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Confirm Password</label>
                                                        <input class="form-control form-control-lg" type="password" id="confirm_password" name="confirm_password"  placeholder="Enter confirm password" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="submit" id="btn_reg" class="btn btn-lg btn-primary btn-block">
                                                <img src="loading.svg" width="30" height="30" id="loading" class="hide">
                                                <span id="text">Create Account</span>
                                                </button>
                                            </div>
                                        </form>

                                        <div align="center" class="mt-3">
                                             <span>Already have an account? <a href="login?page=login">Click here</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include "includes/script.php"; ?>
        <script>
            $(document).ready(function() {
                $(document).on('submit', '#register_form', function(event) {
                    event.preventDefault();

                    const register_data = $(this).serialize();
                    if ($("#firstname").val().trim() == "") {
                        Swal.fire(
                        'Error Message',
                        'Sorry, please enter your firstname and try again',
                        'error',
                        )

                        return false;
                    } else if ($("#lastname").val().trim() == "") {
                        Swal.fire(
                        'Error Message',
                        'Sorry, please enter your lastname and try again',
                        'error',
                        )

                        return false;
                    } else if ($("#email").val().trim() == "") {
                        Swal.fire(
                        'Error Message',
                        'Sorry, please enter your email and try again',
                        'error',
                        )

                        return false;
                    } else if ($("#password").val().trim() == "") {
                         Swal.fire(
                        'Error Message',
                        'Sorry, please enter your password and try again',
                        'error',
                        )

                        return false;
                    } else if ($("#confirm_password").val().trim() == "") {
                        Swal.fire(
                        'Error Message',
                        'Sorry, please enter your confirm password and try again',
                        'error',
                        )

                        return false;
                    } else if ($("select[name=gender]").val() == 0) {
                         Swal.fire(
                        'Error Message',
                        'Sorry, please select your gender and try again',
                        'error',
                        )

                        return false;
                    } else if ($("#password").val() !== $("#confirm_password").val()) {
                         Swal.fire(
                        'Error Message',
                        'Sorry, password and confirm password must match and try again',
                        'error',
                        )

                        return false;
                    } else {

                        $("#loading").removeClass().remove('hide');
                        $("#btn_reg").attr('disabled', true);
                        $("#text").text('Sending Confirmation Link....');
                        $.ajax({
                            url: "src/register.php",
                            method: "POST",
                            data: register_data,
                            success: function(data) {
                                if (data == "0") {
                                     Swal.fire(
                                        "Error Message",
                                        "Sorry but this "+ $('#email').val() +" is already used by someone, please try another email.",
                                        "error",
                                    )
                                    $("#loading").addClass('hide');
                                    $("#btn_reg").attr('disabled', false);
                                    $("#text").text('Sign up');

                                    return false;
                                } else if (data == "1") {
                                    Swal.fire(
                                        "Error Message",
                                        "Sorry invalid firstname, please try again.",
                                        "error",
                                    )
                                    $("#loading").addClass('hide');
                                    $("#btn_reg").attr('disabled', false);
                                    $("#text").text('Sign up');
                                    return false;
                                } else if (data == "2") {
                                    Swal.fire(
                                        "Error Message",
                                        "Sorry invalid lastname please try again.",
                                        "error",
                                    )
                                    $("#loading").addClass('hide');
                                    $("#btn_reg").attr('disabled', false);
                                    $("#text").text('Sign up');
                                    return false;
                                } else if (data == "3") {
                                    Swal.fire(
                                        "Error Message",
                                        "Sorry invalid email address, please try again.",
                                        "error",
                                    )
                                
                                    $("#loading").addClass('hide');
                                    $("#btn_reg").attr('disabled', false);
                                    $("#text").text('Sign up');
                                    return false;
                                } else if (data == "4") {
                                    alert("Sorry your password is very weak, please try again.");
                                    $("#loading").addClass('hide');
                                    $("#btn_reg").attr('disabled', false);
                                    $("#text").text('Sign up');
                                    return false;
                                } else if(data == "5"){
                                    Swal.fire(
                                        "Success Message",
                                        "Confirmation email has been sent to your email address.",
                                        "success",
                                    )
                                    setInterval(function(){
                                        $("#main").fadeOut();
                                        window.location.href = "login";
                                    }, 3000)
                                }else if(data == "6"){
                                    Swal.fire(
                                        "Error Message",
                                        "Please check your internet connectivity, or avoid using a vpn that blocks SMTP Servers and try again",
                                        "error",
                                    )
                                    $("#loading").addClass('hide');
                                    $("#btn_reg").attr('disabled', false);
                                    $("#text").text('Sign up');
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </body>

</html>