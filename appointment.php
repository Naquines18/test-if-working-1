<?php include "src/validation_loggedin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "meta.php"; ?>

	<title>Add Reservation | Online Appointment System | Makilala Institute System and Information</title>

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
					<div class="row">
						
						<div class="col-md-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h3>Fill up all the neccesary fields.</h3>
                                    <p>Please fill up all the fields with the correct information to avoid conflict in the feauture.</p>
								</div>
								<div class="card-body py-3">
                                <form id="reservation" method="post">
                                        <div class="form-group mb-2">
                                            <input class="form-control mb-3" type="text" id="fullname" name="fullname" placeholder="Fullname" value="<?php echo $firstname." ".$lastname; ?>" readonly>
                                        </div>

                                        <div class="form-group mb-2">
                                            <input class="form-control mb-3" type="text" id="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>" readonly>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="number" id="age" name="age" placeholder="Age" title="How old are you?">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="date" name="date" placeholder="What date you want to go?" id="date" title="Date you want to go?">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="time" name="time" placeholder="What time you want to go?" id="time" title="Time you want to go?">
                                                </div>
                                            </div>



                                            <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="number" id="phone" name="phone" placeholder="Your current mobile number" title="Your working mobile number?">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="city" id="city" name="city" placeholder="Your current city" title="Your current City?">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="address" id="address" name="address" placeholder="Your current address" title="Your current address?">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <select class="form-control mb-3" id="gender" name="gender">
                                                        <option selected="">--- Select Gender ---</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                            <div class="form-group mb-4">
                                            <select name="staff" id="staff" class="form-control" title="The staff you choose will be output on your Reservation ID">
                                            <option value="" selected>--- Select Staff ---</option>
                                            <?php
                                            $getdoctor = $conn->prepare("SELECT advance_user_name FROM advance_user WHERE advance_user_role = 2");
                                            $getdoctor->execute();
                                            $result = $getdoctor->get_result();
                                            while($doctor = $result->fetch_assoc()){
                                                
                                            $doc = $doctor['advance_user_name'];
                                            $query = mysqli_query($conn,'SELECT * FROM appointments WHERE patient_doctor = "'.$doc.'"  AND appointment_email = "'.$email.'" AND status = "Pending" ');     
                                                if($query){
                                                    if(mysqli_num_rows($query) === 1){
                                                        echo'<option value="" disabled>Not Available '.$doctor['advance_user_name'].'</option>';
                                                    }else{
                                                        echo'<option value="'.$doctor['advance_user_name'].'">'.$doctor['advance_user_name'].'</option>';
                                                    }
                                                }                                       
                                                
                                            }
                                            ?>
                                        </select>
                                        </div>
                                        </div>

                                        <div class="form-group mb-2">
                                            <select name="establishments" class="form-control" id="establishments" required>
                                            <?php
                                                $query = mysqli_query($conn,"SELECT * FROM establishments");
                                                echo '<option value="none" selected>Select Establishment</option>';
                                                foreach($query as $row){
                                                    echo '<option value="'.$row["establishments_id"].'">'.$row["establishments_name"].'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-2">
                                            <textarea class="form-control mb-3" type="text" name="comment" id="comment" rows="8" placeholder="Enter why you want to have a reservation there is a limit of character which is 70." maxlength="70" title="Enter why you want to have a reservation?"></textarea>
                                        </div>

                                        <div class="form-group mb-2">
                                            <button type="submit" id="button" class="btn btn-dark btn-lg" name="submit_reservation">
                                                <img src="loading.svg" width="28" height="28" id="spinner" class="hide">
                                                <span id="span_txt">Submit Reservation</span>
                                            </button>
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
    <script type="text/javascript">
        $(document).ready(function(){

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
            
            $(document).on('submit', '#reservation', function(event){
                event.preventDefault();
                const reservation_data = $(this).serialize();
                if($("#age").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Please enter your age, and try again',
                        'error'
                    )

                    return false;
                }else if($("#date").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Please enter date your going to come, and try again',
                        'error'
                    )

                    return false;
                }else if($("#time").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Please enter time your going to come, and try again',
                        'error'
                    )

                    return false;
                }else if($("#city").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Please enter your city, and try again',
                        'error'
                    )

                    return false;
                }else if($("#address").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Please enter your address, and try again',
                        'error'
                    )

                    return false;
                }else if($("#phone").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Please enter your phone number, and try again',
                        'error'
                    )

                    return false;
                }else if($("#address").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Please enter your address, and try again',
                        'error'
                    )

                    return false;
                }else if($("select[name=gender]").val() == 0){
                    Swal.fire(
                        'Error Message',
                        'Please select your gender, and try again',
                        'error'
                    )

                    return false;
                }else if($("select[name=staff]").val() == 0){
                    Swal.fire(
                        'Error Message',
                        'Please select available staff, and try again',
                        'error'
                    )

                    return false;
                }else if($("#comment").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Please enter your comment or purpose of visiting, and try again',
                        'error'
                    )

                    return false;
                }else {

                    $("#spinner").removeClass().remove("hide");
                    $("#spinner").attr('disabled', true);
                    $("#span_txt").text('Saving to server....');


                    $.ajax({
                        url: "src/appointment.php",
                        method: "POST",
                        dataType: "json",
                        data: reservation_data,
                        success: function(event){
                            if(event.result == "success"){
                                Swal.fire(
                                    'Success Message',
                                    'Horray! successfully submit your reservation. Page will redirect to home page with in 3 seconds',
                                    'success'
                                )
                                
                                $("#spinner").addClass("hide");
                                $("#button").addClass("btn btn-info");
                                $("#spinner").attr('disabled', false);
                                $("#span_txt").text('Reservation Saved Successfully');
                                
                                setInterval(function(){
                                    window.location.href='dashboard?page=dashboard'
                                }, 3000);
                                return true;
                            }else if(event.result == "exceeded"){
                                Swal.fire(
                                    'Error Message',
                                    'Sorry, reservation exceeded',
                                    'error'
                                )
                                
                                $("#spinner").addClass("hide");
                                $("#spinner").attr('disabled', false);
                                $("#span_txt").text('Failed to save to server');

                                return false;

                            }else if(event.result == "char_error"){
                                Swal.fire(
                                    'Error Message',
                                    'Sorry, fullname support text only',
                                    'error'
                                )
                                
                                $("#spinner").addClass("hide");
                                $("#spinner").attr('disabled', false);
                                $("#span_txt").text('Failed to save to server');

                                return false;

                            }else if(event.result == "char_error_3"){
                                Swal.fire(
                                    'Error Message',
                                    'Sorry, comment support text only',
                                    'error'
                                )
                                
                                $("#spinner").addClass("hide");
                                $("#spinner").attr('disabled', false);
                                $("#span_txt").text('Failed to save to server');

                                return false;

                            }else if(event.result == "email_error"){
                                Swal.fire(
                                    'Error Message',
                                    'Sorry, email requires @ symbol',
                                    'error'
                                )
                                
                                $("#spinner").addClass("hide");
                                $("#spinner").attr('disabled', false);
                                $("#span_txt").text('Failed to save to server');

                                return false;

                            }else if(event.result == "qr_failed"){
                                Swal.fire(
                                    'Error Message',
                                    'Sorry, QR CODE already generated, try again ',
                                    'error'
                                )
                                
                                $("#spinner").addClass("hide");
                                $("#spinner").attr('disabled', false);
                                $("#span_txt").text('Failed to save to server');

                                return false;

                            }else if(event.result == "failed"){
                                Swal.fire(
                                    'Error Message',
                                    'Sorry, unable to get areservation please try again ',
                                    'error'
                                )
                                
                                $("#spinner").addClass("hide");
                                $("#spinner").attr('disabled', false);
                                $("#span_txt").text('Failed to save to server');

                                return false;

                            }
                        }
                    });
                    
            
                }
            });



    
        });
    </script>
</body>

</html>