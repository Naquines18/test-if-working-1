<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "meta.php"; ?>

	<title>Reset Password | Online Appointment System | Makilala Institute System and Information</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<style type="text/css">
	.hide{
		display: none;
	}
</style>
<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
                                        <div class="card-body text-center">
										<h1>Password Reset!</h1>
										<img src="notification.png" class="img-fluid" width="50%">
                                            <p class="card-text">Please verify your account first, sign in to your email provider like gmail,yahoo,aol, ect. and click the reset password link.</p>

                                        	<?php
                                        		if(isset($_GET["code"]) OR isset($_GET['charset']) OR isset($_GET['activation']) OR isset($_GET['email'])){
                                        			if(empty($_GET["code"]) AND empty($_GET["charset"]) AND empty($_GET["activation"]) ){
                                        				echo "<script>window.location.href='login?message=epmty_activation'</script>";
                                        			}else{
                                        				echo '
		                                        			<form id="password_new" method="POST">
																<h3 class="text-center">Enter New Password</h3>
																<input type="hidden" name="change_email" value='.$_GET['email'].' readonly>
																<input type="password" name="change_password" id="new_password" placeholder="New Password" class="form-control">
																<input type="password" name="password_confirm" id="confirm_password" placeholder="Confirm Password" class="form-control mt-3">

																<button type="submit" name="btn" id="button" class="mt-4 btn btn-primary">
																<img src="loading.svg" width="30" id="loading_img" height="30" class="hide">
																<span id="text_reset">Save Password</span>
																</button>
															</form>
		                                        			';
                                        			}
                                        		}else{
                                        			echo '
                                        			<form id="reset_request" class="text-center" method="POST">
														<input type="text" name="email" id="email" placeholder="Enter your email address" class="form-control">

														<button type="submit" name="btn" id="button" class="mt-2 btn btn-primary">
														<img src="loading.svg" width="30" id="loading_img" height="30" class="hide">
														<span id="text_reset">Send Reset Link</span>
														</button> 
													</form>
                                        			';
                                        		}
                                        	?>
                                        	
                                            
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
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('submit', '#reset_request', function(event){
				event.preventDefault();
				const reset_data = $(this).serialize();

				if($("#email").val() == ""){
					Swal.fire(
						'Error Messsage',
						'Please enter your registered email',
						'error',
					)
					return false;
				}else{
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
					  confirmButtonText: 'Yes, change it!',
					  cancelButtonText: 'No, cancel!',
					  reverseButtons: true
					}).then((result) => {
					  if (result.isConfirmed) {
					  	$("#loading_img").removeClass().remove('hide');
					  	$("#button").attr('disabled', true);
					  	$("#text_reset").text('Sending Password Reset Link....');
					   	$.ajax({
					   		url: "src/reset.php",
					   		method: "POST",
					   		data: reset_data,
					   		success: function(responce){
					   			if(responce == "confirmed"){
					   				 swalWithBootstrapButtons.fire(
									      'Success Message',
									      'Password reset link will be send to your email address that you provided, page will be refresh in 3 seconds',
									      'success',
									    )
					   				 $("#loading_img").addClass('hide');
								  	$("#button").attr('disabled', false);
								  	$("#text_reset").text('Successfully Send Password Reset Link');
					   				 interval();

					   			}else if(responce == "failed"){
					   				swalWithBootstrapButtons.fire(
									      'Error Message!',
									      'No Operation has been occured, page will be refresh in 3 seconds',
									      'error',
									    )
					   					 $("#loading_img").addClass('hide');
								  	$("#button").attr('disabled', false);
								  	$("#text_reset").text('Error occured please try again');

					   					interval();
					   			}else if(responce == "error_email"){
					   				swalWithBootstrapButtons.fire(
									      'Error Message!',
									      'Email you entered is not a registered email, please try again',
									      'error',
									    )
					   				 $("#loading_img").addClass('hide');
								  	$("#button").attr('disabled', false);
								  	$("#text_reset").text('Email is not found');
					   			}


					   			function interval(){
					   				setInterval(function(){
					   					window.location.href='reset';
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
					      'Operation has been cancelled',
					      'success'
					    )
					  }
					})
			
				}

			});
			
			$(document).on('submit', '#password_new', function(event){
				event.preventDefault();
				const reset_password = $(this).serialize();

				if($("#new_password").val() == ""){
					Swal.fire(
						'Error Message',
						'Sorry, password must not be empty',
						'error',
					)
				}else if($("#confirm_password").val() == ""){
					Swal.fire(
						'Error Message',
						'Sorry, password confirm must not be empty',
						'error',
					)
				}else if($("#new_password").val() !== $("#confirm_password").val()){
					Swal.fire(
						'Error Message',
						'Sorry, passwords must equal',
						'error',
					)
				}else{
					$("#loading_img").removeClass().remove('hide');
				  	$("#button").attr('disabled', true);
				  	$("#text_reset").text('Changing Password Please Wait....');

				  	$.ajax({
					   		url: "src/reset.php",
					   		method: "POST",
					   		data: reset_password,
					   		success: function(responce){
					   			if(responce == "success"){
					   				 Swal.fire(
										'Success Message',
										'You have successfully change your password',
										'success',
									)
					   				
					   				$("#loading_img").addClass('hide');
								  	$("#button").attr('disabled', false);
								  	$("#text_reset").text('Successfully Send Password Reset Link');
					   				 interval();

					   			}else if(responce == "failed"){
					   				Swal.fire(
										'Error Message',
										'Failed to change your password',
										'error',
									)
					   					 
					   				$("#loading_img").addClass('hide');
								  	$("#button").attr('disabled', false);
								  	$("#text_reset").text('Error occured please try again');

					   					interval();
					   			}else{
									console.log(responce)	
								}

					   			function interval(){
					   				setInterval(function(){
					   					window.location.href='login';
					   				}, 3000);
					   			}
					   		  }
						})
				
					}

				});
				 
		});
	</script>
</body>

</html>