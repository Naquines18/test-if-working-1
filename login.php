<?php
session_start();
include "src/config.php";

function verify_account($conn){
    if(isset($_GET["firstname"]) && isset($_GET["lastname"]) &&  isset($_GET["code"]) && isset($_GET["charset"])){
        $status = "1";


        function verify($data){
            $data = htmlspecialchars($data);
            $data = stripcslashes($data);
            $data = trim($data);

            return $data;
        }

        $newData        = verify($status);
        $newfirstname   = verify($_GET["firstname"]);
        $newlastname    = verify($_GET["lastname"]);

        $update_verification_status = $conn->prepare("UPDATE client SET verified = ? WHERE client_firstname = ? AND client_lastname = ? LIMIT 1");
        $update_verification_status->bind_param("sss",$newData, $newfirstname,$newlastname);
        if($update_verification_status->execute()){
            header("location: login?verified=Account Verified");
        }else{
            echo "Account failed to verify";
        }
        
    }
}


verify_account($conn);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include "meta.php"; ?>

        <title>Login Client | Online Appointment System | Makilala Institute System and Information</title>

        <link href="css/app.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <style>
            body{
                background-image: url("css__/bg.svg");
                background-repeat: no-repeat;
                margin-top: 10px;
                background-position: right;
                background-size: 50%;
            }
        </style>
    </head>

    <body id="main">
        <main class="d-flex w-100">
            <div class="container d-flex flex-column">
                <div class="row vh-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">

                            <div class="card">
                                <div class="card-header">
                                    <div class="text-center mt-4">
                                        <h1 class="h2">Welcome back, <?php if(isset($_SESSION['client_firstname'])){ echo htmlspecialchars($_SESSION['client_firstname']); }else{ echo "Client"; } ?></h1>
                                        <p class="lead">
                                            Sign in to your account to continue
                                        </p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <form id="login_form" method="POST">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><i data-feather="at-sign"></i></span>
                                                <input class="form-control form-control-lg" type="text" id="email" name="email" placeholder="Enter your email" />
                                            </div>
                                            <div class="input-group mb-1">
                                               <span class="input-group-text" id="basic-addon1"><i data-feather="lock"></i></span>
                                                <input class="form-control form-control-lg" autocomplete="" type="password" id="password" name="password" placeholder="Enter your password" />
                                            </div>
                                            <div align="left" class="mb-3">
													<a href="reset">Forgot password?</a>
												</div>
                                            <div>
                                                <label class="form-check">
												<input class="form-check-input" type="checkbox"  id="remember-me" name="remember_me" checked>
												<span class="form-check-label">
												Remember me next time
												</span>
											</label>
                                                	
												

											
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                                            </div>
                                        </form>
                                        <div align="right" class="mt-3">
                                            Dont have account? <a href="register?page=register">Create Account</a>
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

                <?php
                    if(isset($_GET['verified'])){
                        ?>
                            Swal.fire(
                                'Success Message',
                                'Horray! Your account has been verified you can now login.',
                                'success'
                            )
                        <?php
                    }
                ?>
                $(document).on('submit', '#login_form', function(event) {
                    event.preventDefault();
                    const login_data = $(this).serialize();
                    if ($("#email").val().trim() == "") {
                        Swal.fire(
                            'Error Message',
                            'Sorry! Please input your registered email address.',
                            'error'
                        )
                        //alert("Sorry! Please input your registered email address.");
                    } else if ($("#password").val().trim() == "") {
                        Swal.fire(
                            'Error Message',
                            'Sorry! Please input your password.',
                            'error'
                        )
                        //alert("Sorry! Please input your password.");
                    } else {
                        $.ajax({
                            url: "src/login.php",
                            method: "POST",
                            dataType: "json",
                            data: login_data,
                            success: function(data) {
                                //console.log(data.result)

                                if (data.result == "1") {
                                    Swal.fire(
                                        'Error Message',
                                        'Sorry! Your email address is incorrect or not register, please try again',
                                        'error'
                                    )
                                    //alert("Sorry! Your email address is incorrect or not register, please try again.");
                                } else if (data.result == "2") {
                                    Swal.fire(
                                        'Error Message',
                                        'Sorry! Your email address is invalid format, please try again',
                                        'error'
                                    )
                                    //alert("Sorry! Your email address is invalid format, please try again.");
                                } else if (data.result == "3") {
                                    Swal.fire(
                                        'Error Message',
                                        'Sorry! Incorrect email or password, please try again.',
                                        'error'
                                    )
                                    //alert("Sorry! Incorrect email or password, please try again.");
                                    
                                } else if (data.result == "4") {
                                    Swal.fire(
                                        'Error Message',
                                        'Sorry! Could not login this time, please try again later',
                                        'error'
                                    )
                                    window.location.href = "verify";
                                }else if (data.result == "5") {
                                    $("#main").fadeOut();
                                    window.location.href = "dashboard";
                                }

                            }
                        });
                    }
                });
            });
        </script>
    </body>

</html>