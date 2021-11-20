<?php include "src/validation_loggedin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "meta.php"; ?>

	<title>Contact Information | Online Appointment System | Makilala Institute System and Information</title>

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
						<div class="col-md-12 col-xxl-7">
							<div class="card flex-fill w-100">
								<!-- <div class="card-header">
							
								</div> -->
								<div class="card-body py-3">
                                    <h3>Contact Administrator</h3>
                                    <p>Send your request, and report bugs about the system.</p>
                                    <form id="message_data" method="post">
                                        <div class="form-group mb-2">
                                            <input class="form-control mb-3" type="text" name="fullname" id="fullname" placeholder="Fullname" value="<?php echo $firstname." ".$lastname; ?>" readonly>
                                        </div>

                                        <div class="form-group mb-2">
                                            <input class="form-control mb-3" type="text" name="from" id="from" placeholder="Email Address" value="<?php echo $email; ?>" readonly>
                                        </div>

                                        <div class="form-group mb-2">
                                            <input class="form-control mb-3" type="text" name="subject" id="subject" placeholder="Enter your subject" value="">
                                        </div>

                                        <div class="form-group mb-2">
                                            <textarea class="form-control mb-3" type="text" name="message" id="message" rows="8" value="" placeholder="Enter your actual message"></textarea>
                                        </div>

                                        <div class="form-group mb-2">
                                            <button type="submit" name="send_message" id="button_submit" class="btn btn-dark">
                                            <img src="loading.svg" width="30" height="30" id="loader" class="hide">	
                                            <span id="button_text">Send Message</span></button>
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
			            
			$(document).on('submit', '#message_data', function(event){
				event.preventDefault();

				const message = $(this).serialize();
				if($("#message").val() == ""){
					Swal.fire(
						'Error Message',
						'Sorry please enter your message, and try again',
						'error'
					)
					return false;
				}else if($("#subject").val() == ""){
					Swal.fire(
						'Error Message',
						'Sorry please enter your subject or about message, and try again',
						'error'
					)
					return false;
				}else{
					$("#loader").removeClass().remove('hide');
					$("#button_submit").attr('disabled', true);
					$("#button_text").text("Sending Message.....");
					$.ajax({
						url: "src/message.php",
						method: "POST",
						data: message,
						success: function(data) {
							if(data == "success"){
								Swal.fire (
									'Good job!',
									'You have sent a message to the system administrator.',
									'success'
								)
								$("#loader").addClass('hide');
								$("#button_submit").attr('disabled', false);
								$("#button_text").text("Send Message");
								$("#message_data")[0].reset();

								
							}else{
								Swal.fire (
									'Warning Message',
									'Something happen when you send a message please try again',
									'warning'
								)
								$("#loader").addClass('hide');
								$("#button_submit").attr('disabled', false);
								$("#button_text").text("Send Message");
								$("#message_data")[0].reset();
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