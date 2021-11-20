<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include "includes/meta.php"; ?>
        <title>Dashboard | Add Staff | MIST Appointment System</title>
        <link href="css/app.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    </head>
        <body>
            <div class="wrapper">
                <?php include "includes/sidebar.php"; ?>

                <div class="main">
                    <?php include "includes/navbar.php"; ?>

                    <main class="content">
                        <div class="container-fluid p-0">
                            <div class="row">

                                <div class="col-xl-12 col-xxl-7">
                                    <div class="card flex-fill w-100">
                                        <div class="card-header">
                                            <h3>Fill up all the neccesary fields.</h3>
                                            <p>Please fill up all the fields with the correct information to avoid conflict in the future.</p>
                                        </div>
                                        <div class="card-body py-3">
                                            <form id="add_doc" method="post">
                                             

                                                <div class="form-group mb-3">
                                                    <input class="form-control mb-3" type="text" id="username" name="username" placeholder="Enter Username">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <input class="form-control mb-3" type="text" id="email" name="email" placeholder="Email Address">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <select class="form-control mb-3" id="gender" name="gender">
                                                        <option selected value="" disabled>--- Select Gender ---</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <input class="form-control mb-3" type="password" id="password" autocomplete="" name="password" placeholder="Password">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-2">
                                                    <button type="submit" class="btn btn-dark">Submit Staff Info</button>
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>





                        </div>
                    </main>

                    <?php include "includes/footer.php"; ?>
                </div>
            </div>

            <?php include "includes/script.php"; ?>
            <script>
                $(document).ready(function() {
                    $(document).on('submit', '#add_doc', function(event) {
                        event.preventDefault();
                        const doc_data = $(this).serialize();


                        if ($("#username").val() == "") {
                            Swal.fire(
                                'Error Message',
                                "Sorry please enter your firstname.",
                                'error'
                            )
                            return false;
                        }else if ($("#email").val() == "") {
                            Swal.fire(
                                'Error Message',
                                "Sorry please enter your email.",
                                'error'
                            )
                            return false;
                        } else if ($("select[name=gender]").val() == 0) {
                            Swal.fire(
                                'Error Message',
                                "Sorry please select your gender.",
                                'error'
                            )
                            return false;
                        } else if ($("#password").val() == "") {
                             Swal.fire(
                                'Error Message',
                                "Sorry please enter your password.",
                                'error'
                            )
                            return false;
                        } else {
                            $.ajax({
                                url: "src/add_doctor.php",
                                method: "POST",
                                dataType: "json",
                                cache: false,
                                data: doc_data,
                                success: function(responce) {
                                    if (responce.result == "email_used") {
                                        Swal.fire(
                                            'Error Message',
                                            "Sorry your email address " + $("#email").val() + " is already used.",
                                            'error'
                                        )
                                        return false;
                                    } else if (responce.result == "failed_firstname") {
                                         Swal.fire(
                                            'Error Message',
                                            "Sorry you entered a firstname " + $("#firstname").val() + " with a illegal characters.",
                                            'error'
                                        )
                                        return false;
                                    } else if (responce.result == "failed_lastname") {
                                         Swal.fire(
                                            'Error Message',
                                            "Sorry you entered a lastname " + $("#lastname").val() + " with a illegal characters.",
                                            'error'
                                        )
                                        return false;
                                    } else if (responce.result == "failed_password") {

                                        Swal.fire(
                                            'Error Message',
                                            "Sorry you entered a password that is considered weak.",
                                            'error'
                                        )
                                        return false;
                                    } else if (responce.result == "success") {
                                        Swal.fire(
                                            'Success Message',
                                            "You have successfully added a staff.",
                                            'success'
                                        )                                        
                                        $("#add_doc")[0].reset();
                                        return true;
                                    }
                                }
                            });
                        }
                    });
                });
            </script>
        </body>

</html>