<?php include "src/validation_loggedin.php"; ?>
<?php
if(!isset($_GET["establishments_mobile"]) && !isset($_GET["establishments_desc"]) && !isset($_GET["establishments_name"]) && !isset($_GET["establishment_id"]) && !isset($_GET["amount"])){
    header("location: establishments.php");
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include "includes/meta.php"; ?>
        <title>Dasboard | Update Establisment | MIST Appointment System</title>
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
                                            <p>Please fill up all the fields with the correct information to avoid conflict in the feauture.</p>
                                        </div>
                                        <div class="card-body py-3">
                                            <form action="src/update_establishment.php" method="post">
                                             

                                                <div class="form-group mb-3">
                                                    <input class="form-control mb-3" type="hidden" id="estab_id" name="estab_id" placeholder="Establisment Name" value="<?php echo $_GET["establishment_id"]; ?>" required>
                                                    <input class="form-control mb-3" type="text" id="estab_name" name="estab_name" placeholder="Establisment Name" value="<?php echo $_GET["establishments_name"]; ?>" required readonly>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <input class="form-control mb-3" type="number" id="estab_mobile" name="estab_mobile" placeholder="Establisment Mobile Number" value="<?php echo $_GET["establishments_mobile"]; ?>" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <input class="form-control mb-3" type="number" id="estab_amount" name="estab_amount" placeholder="Establisment Payment Amount" value="<?php echo $_GET["amount"]; ?>" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <textarea name="estab_desc" id="estab_desc" cols="30" rows="7" class="form-control" placeholder="Establisment Description" required><?php echo $_GET["establishments_desc"]; ?></textarea>
                                                </div>


                                                <div class="form-group mb-2">
                                                    <button type="submit" class="btn btn-dark">Update Establisment</button>
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
                    $(document).on('submit', '#add_admin', function(event) {
                        event.preventDefault();
                        const doc_data = $(this).serialize();


                        if ($("#username").val() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry! Please enter your username.',
                                'error'
                            )
                            return false;
                        }else if ($("#email").val() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry! Please enter your email.',
                                'error'
                            )
                            return false;
                        } else if ($("select[name=gender]").val() == 0) {
                            Swal.fire(
                                'Error Message',
                                'Sorry! Please select your gender.',
                                'error'
                            )
                            return false;
                        } else if ($("#password").val() == "") {
                             Swal.fire(
                                'Error Message',
                                'Sorry! Please enter your password.',
                                'error'
                            )
                            return false;
                        } else {
                            $.ajax({
                                url: "src/add_administrator.php",
                                method: "POST",
                                dataType: "json",
                                cache: false,
                                data: doc_data,
                                success: function(responce) {
                                    if (responce.result == "email_used") {
                                        Swal.fire(
                                            'Error Message',
                                            "Sorry your email address " + $("#email").val() + " is already used",
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
                                            "Sorry you entered a firstname " + $("#lastname").val() + " with a illegal characters.",
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
                                            "You have successfully added a Administrator.",
                                            'success'
                                        )                                        
                                        $("#add_admin")[0].reset();
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