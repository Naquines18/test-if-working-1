<?php include "src/validation_loggedin.php"; ?>
<?php
if(isset($_GET['page'])){
    if($_GET['page'] == "logout"){
        session_start();
        session_unset();
        session_destroy();

        echo '<script>window.location.href="index?page=login"</script>';
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include "meta.php"; ?>

        <title>Profile Information Settings | Online Appointment System | Makilala Institute System and Information</title>

        <link href="css/app.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    </head>
    <style type="text/css">
        .hide{
            display: none;
        }
    </style>
        <body>
            <div class="wrapper">
                <?php include "includes/sidebar.php"; ?>

                <div class="main">
                    <?php include "includes/navbar.php"; ?>

                    <main class="content">
                        <div class="container-fluid p-0">

                            <h1 class="h3 mb-3">Manage your information:</h1>

                            <div class="row">
                                <div class="col-md-3 col-xl-2">

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Profile Settings</h5>
                                        </div>

                                        <div class="list-group list-group-flush" role="tablist">
                                            <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
										Account
										</a>
                                            <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
										Password
										</a>
                                            <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" id="delete_account" role="tab">
										Delete account
										</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9 col-xl-10">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="account" role="tabpanel">

                                            <div class="card">
                                                <div class="card-header">

                                                    <h5 class="card-title mb-0">Public info</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form id="update_profile" method="POST" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-7">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="fname">Firstname</label>
                                                                    <input type="hidden" class="form-control" id="client_id" name="client_id" value="<?php echo $id; ?>">
                                                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Firstname" value="<?php echo $firstname; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="lname">Lastname</label>
                                                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Lastname" value="<?php echo $lastname; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="email">Email</label>
                                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>">
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <select class="form-control mb-3" id="gender" name="gender">
																		<option selected value="" disabled>--- Select Gender ---</option>
																		<option value="Male">Male</option>
																		<option value="Female">Female</option>
																	</select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="text-center">
                                                                    <?php 
                                                                        $getprofileimage = mysqli_query($conn,"SELECT client_image FROM client WHERE client_id = '$id' LIMIT 1");
                                                                        foreach($getprofileimage as $data){
                                                                            $prof_image = $data['client_image'];
                                                                            ?>
                                                                                 <img alt="<?php echo $firstname." ".$lastname; ?>" src="<?php if(isset($prof_image)){ echo $prof_image; }else{ echo " images/default.png"; } ?>" name="image" id="image" class="rounded img-responsive mt-2" width="128" height="128" />
                                                                            <?php
                                                                            
                                                                        }
                                                                    ?>
                                                                   

                                                                    <div class="mt-2">
                                                                        <input type="file" class="form-sm" name="image_upload" id="image_upload" onchange="PreviewImage(this,$(this))">
                                                                    </div>
                                                                    <small>For best results, use an image at least 128px by 128px in .png format</small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="submit" id="button_submit_1" class="btn btn-dark">
                                                        <img src="loading.svg" id="spinner_1" width="30" height="30" class="hide">    
                                                        <span id="password_txt_1">Save changes</span></button>
                                                    </form>

                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header">

                                                    <h5 class="card-title mb-0">Your private info</h5>
                                                </div>
                                                <div class="card-body">
                                                    <?php
                                                    $query = $conn->prepare("SELECT * FROM client_profile WHERE client_id = ? LIMIT 1");
                                                    $query->bind_param("s", $id);
                                                    $query->execute();
                                                    $results = $query->get_result();

                                                    if($results->num_rows > 0){
                                                        while ($row = $results->fetch_assoc()) {
                                                            echo '
                                                            <form id="update_profile_client" method="POST">

                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputAddress">Address</label>
                                                                <input type="hidden" id="id" name="id"  value="'.$row['client_id'].'">
                                                                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="'.$row['client_profile_address'].'">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputAddress2">Confirm Address</label>
                                                                <input type="text" class="form-control" id="confirm_address" name="confirm_address" placeholder="Apartment, studio, or floor" value="'.$row['client_profile_address'].'">
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label" for="mobile">Mobile No.</label>
                                                                    <input type="number" name="mobile" class="form-control" id="mobile" value="'.$row['client_profile_phone'].'">
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label" for="bday">Date of birth</label>
                                                                    <input type="date" name="birthday" class="form-control" id="birthday" value="'.$row['client_profile_birthday'].'">
                                                                </div>

                                                            </div>
                                                            <button type="submit" name="update_profile" id="button_submit_2" class="btn btn-dark">

                                                            <img src="loading.svg" id="spinner_2" width="30" height="30" class="hide"> Update <span id="text_button">Information</span></button>
                                                        </form>
                                                        ';
                                                        }
                                                    }else{ 
                                                        echo '
                                                            <form id="add_profile_client" method="POST">

                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputAddress">Address</label>
                                                                <input type="hidden"  id="id" name="add_id" value="'.$id.'">
                                                                <input type="text" class="form-control" id="inputAddress" name="add_address" placeholder="1234 Main St">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputAddress2">Confirm Address</label>
                                                                <input type="text" class="form-control" id="inputAddress2" name="add_confirm_address" placeholder="Apartment, studio, or floor">
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label" for="mobile">Mobile No.</label>
                                                                    <input type="number" name="add_mobile" class="form-control" id="mobile">
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label" for="bday">Date of birth</label>
                                                                    <input type="date" name="add_birthday" class="form-control" id="bday">
                                                                </div>

                                                            </div>
                                                            <button type="submit" name="add_profile" id="button_submit_3" class="btn btn-dark">

                                                            <img src="loading.svg" id="spinner_3" width="30" height="30" class="hide"> <span id="text_button">Update Information</span></button>
                                                        </form>
                                                        ';
                                                    }
                                                    ?>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="password" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Password</h5>

                                                    <form id="update_password">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="current_password">Current password</label>
                                                            <input type="hidden" class="form-control" id="pass_id" name="pass_id" value="<?php echo $id; ?>">
                                                            <input type="password" class="form-control" id="current_password" autocomplete="" name="current_password">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="new_password">New password</label>
                                                            <input type="password" class="form-control" id="new_password" autocomplete="" name="new_password">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="verify_password">Verify password</label>
                                                            <input type="password" class="form-control" id="verify_password" autocomplete="" name="verify_password">
                                                        </div>
                                                        <button type="submit" id="button_submit" class="btn btn-primary">
                                                            <img src="loading.svg" width="28" height="28" id="spinner" class="hide">
                                                            <span id="password_txt">Save Password Changes</span></button>
                                                    </form>

                                                </div>
                                            </div>
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
                function PreviewImage(input, _this) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#image').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $(document).ready(function() {
                    $(document).on('submit', '#add_profile_client', function(event) {
                        event.preventDefault();

                        if ($("#address").val() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your address, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#confirm_address").val() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please confirm address your address, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#mobile").val() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your mobile, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#birthday").val() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your birthday, and try again',
                                'error'
                            )
                            return false;
                        } else {

                            $("#spinner_3").removeClass().remove("hide");
                            $("#button_submit_3").attr('disabled', true);
                            $("#text_button").text('Saving to server....');

                            $.ajax({
                                url: "src/update_profile.php",
                                method: "POST",
                                data: $(this).serialize(),
                                success: function(data) {
                                    if (data == "success") {
                                        Swal.fire(
                                            'Success Message',
                                            'You have successfully updated your information',
                                            'success'
                                        )

                                        $("#spinner_3").addClass("hide");
                                        $("#button_submit_3").attr('disabled', false);
                                        $("#text_button").text('Changes Made To Your Account');


                                            setInterval(function(){
                                                window.location.href="settings";
                                            }, 1000);

                                        } else {
                                        Swal.fire(
                                            'Error Message',
                                            'Sorry please, try again',
                                            'error'
                                        )

                                        $("#spinner_3").addClass("hide");
                                        $("#button_submit_3").attr('disabled', false);
                                        $("#text_button").text('Error has oocured');
                                    }
                                }
                            });
                        }
                    });


                    $(document).on('submit', '#update_profile_client', function(event) {
                        event.preventDefault();

                        if ($("#address").val().trim() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your address, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#confirm_address").val().trim() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please confirm address your address, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#mobile").val().trim() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your mobile, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#birthday").val().trim() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your birthday, and try again',
                                'error'
                            )
                            return false;
                        } else {

                            $("#spinner_2").removeClass().remove("hide");
                            $("#button_submit_2").attr('disabled', true);
                            $("#text_button").text('Saving to server....');

                            $.ajax({
                                url: "src/update_profile.php",
                                method: "POST",
                                data: $(this).serialize(),
                                success: function(data) {
                                    if (data == "success") {
                                        Swal.fire(
                                            'Success Message',
                                            'You have successfully updated your information',
                                            'success'
                                        )

                                        $("#spinner_2").addClass("hide");
                                        $("#button_submit_2").attr('disabled', false);
                                        $("#text_button").text('Changes Made To Your Account');

                                         setInterval(function(){
                                                window.location.href="settings";
                                            }, 1000);

                                    } else {
                                        Swal.fire(
                                            'Error Message',
                                            'Sorry please, try again',
                                            'error'
                                        )

                                        $("#spinner_2").addClass("hide");
                                        $("#button_submit_2").attr('disabled', false);
                                        $("#text_button").text('No Changes Made To Your Account');
                                    }
                                }
                            });
                        }
                    });

                    $(document).on('submit', '#update_profile', function(event) {
                        event.preventDefault();

                        if ($("#fname").val().trim() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your firstname, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#lname").val().trim() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your lastname, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#email").val().trim() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your email address, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#image_upload").val().trim() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please upload your profile photo, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("select[name=gender]").val() == 0) {
                            Swal.fire(
                                'Error Message',
                                'Sorry please select your gender, and try again',
                                'error'
                            )
                            return false;
                        } else {

                            $("#spinner_1").removeClass().remove("hide");
                            $("#button_submit_1").attr('disabled', true);
                            $("#password_txt_1").text('Saving to server....');

                            $.ajax({
                                url: "src/update_profile.php",
                                method: "POST",
                                data: new FormData($(this)[0]),
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(data) {
                                    if (data == "success") {
                                        Swal.fire(
                                            'Success Message',
                                            'You have successfully updated your information',
                                            'success'
                                        )

                                        $("#spinner_1").addClass("hide");
                                        $("#button_submit_1").attr('disabled', false);
                                        $("#password_txt_1").text('Changes Made To Your Account');

                                         setInterval(function(){
                                                window.location.href="settings";
                                            }, 1000);

                                    } else {
                                        Swal.fire(
                                            'Error Message',
                                            'Sorry please select your gender, and try again',
                                            'error'
                                        )

                                        $("#spinner_1").addClass("hide");
                                        $("#button_submit_1").attr('disabled', false);
                                        $("#password_txt_1").text('No Changes Made To Your Account');
                                    }
                                }
                            });
                        }
                    });

                    $(document).on('click', '#logout', function(event){
            event.preventDefault();
            const logout_data = "getLogout";


            const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
              },
              buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
              title: 'Are you sure you want to logout?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, logout it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {

              if (result.isConfirmed) {

                $.ajax({
                    url: "src/logout.php",
                    method: "POST",
                    data : {
                        'logout_data': logout_data,
                    },
                    success: function(event){
                        if(event == "success"){
                            if (result.isConfirmed) {
                                Swal.fire(
                                  'Success Message!',
                                  'You are about to logout in 3 seconds',
                                  'success'
                                )
                            }

                          setInterval(function(){
                            window.location.href="index?success=logout";  
                          }, 3000);
                        }
                    }
                  });
                
              } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons.fire(
                  'Cancelled',
                  'You successfully Cancelled the operation',
                  'error'
                )
              }
            })
        });

                    $(document).on('submit', '#update_password', function(event) {
                        event.preventDefault();
                        const password_data = $(this).serialize();
                        if ($("#current_password").val() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your current password, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#new_password").val() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your new password, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#verify_password").val() == "") {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter your verify password, and try again',
                                'error'
                            )
                            return false;
                        } else if ($("#verify_password").val() !== $("#new_password").val()) {
                            Swal.fire(
                                'Error Message',
                                'Sorry please enter same password on new and verify password, and try again',
                                'error'
                            )
                            return false;
                        } else {

                            $("#spinner").removeClass().remove("hide");
                            $("#button_submit").attr('disabled', true);
                            $("#password_txt").text('Saving to server....');

                            $.ajax({
                                url: "src/change_password.php",
                                method: "POST",
                                data: password_data,
                                cache: false,
                                success: function(data) {
                                    if(data == "success"){
                                        Swal.fire(
                                            'Success Message',
                                            'You have successfully updated your password',
                                            'success'
                                        )

                                        $("#spinner").addClass("hide");
                                        $("#button_submit").attr('disabled', false);
                                        $("#password_txt").text('Password Saved Successfully');
                                        $("#update_password")[0].reset();

                                    }else if(data == "error"){
                                        Swal.fire(
                                            'Error Message',
                                            'Sorry your password that you have entered is incorrect and not the same with the current password, and try again',
                                            'error'
                                        )
                                        $("#spinner").addClass("hide");
                                        $("#button_submit").attr('disabled', false);
                                        $("#password_txt").text('Password Saved Successfully');
                                        $("#update_password")[0].reset();
                                    }
                                }
                            });
                        }
                    });



                    $(document).on('click', '#delete_account', function(event){
                        event.preventDefault();


                        const swalWithBootstrapButtons = Swal.mixin({
                          customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                          },
                          buttonsStyling: false
                        })

                        swalWithBootstrapButtons.fire({
                          title: 'Are you sure?',
                          text: "You won't be able to revert this!",
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonText: 'Yes, delete it!',
                          cancelButtonText: 'No, cancel!',
                          reverseButtons: true
                        }).then((result) => {
                          if (result.isConfirmed) {
                            const data = "delete_account";
                            $.ajax({
                                url: "src/delete_account.php",
                                method: "POST",
                                data: {
                                    'data':data,
                                },
                                success : function(reseponce){
                                    if(reseponce == "success"){
                                         swalWithBootstrapButtons.fire(
                                          'Success Message',
                                          'Account Deleted',
                                          'success'
                                        )
                                        interval(); 
                                    }

                                   function interval(){
                                        setInterval(function(){
                                            window.location.href='settings?page=logout';
                                        }, 3000);
                                   }

                                }
                            });
                          } else if(
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                          ) {
                            swalWithBootstrapButtons.fire(
                              'Cancelled',
                              'Operation has been canceled',
                              'error'
                            )
                          }
                        })
                    });
                });
            </script>
        </body>

</html>