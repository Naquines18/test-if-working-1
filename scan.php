<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "meta.php"; ?>

	<title>Scan QR CODE | Online Appointment System | Makilala Institute System and Information</title>

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
						
						<div class="col-md-12 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h3>Scan your QR CODE here: </h3>
                                    <p>Just download your QR CODE in the dashboard and place your card in the front of camera back or front.</p>
								</div>
								<div class="card-body py-3 text-center">
									<div class="embed-responsive embed-responsive-16by9">
										<video id="preview"></video>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12 text-center">
										<div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
										  <label class="btn btn-dark active">
											<input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
										  </label>
										  <label class="btn btn-success">
											<input type="radio" name="options" value="2" autocomplete="off"> Back Camera
										  </label>
										</div>
									</div>
								</div>


								<div class="card-footer">
									<form action="src/log.php" method="post">
										<input type="hidden" id="result_scan" class="form-control" name="result_scan">
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
		let scanner = new Instascan.Scanner({
                video: document.getElementById('preview')
            });

            scanner.addListener('scan', function(content) {
				document.getElementById('result_scan').value=content;
				document.forms[0].submit();
            });

            Instascan.Camera.getCameras().then(function(cameras) {

                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                    $('[name="options"]').on('change',function(){
		                if($(this).val()==1){
		                    if(cameras[0]!=""){
		                        scanner.start(cameras[0]);
		                    }else{
		                        alert('System could not found your front camera');
		                    }
		                }else if($(this).val()==2){
		                    if(cameras[1]!=""){
		                        scanner.start(cameras[1]);
		                    }else{
		                        alert('System could not found your front camera');
		                    }
		                }
		            });
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function(e) {
                console.error(e);
            });
	</script>
	<script>
		 $(document).ready(function(){
			
            <?php
            	if(isset($_GET['success'])){
            		echo "
            			Swal.fire(
            			'Success Message',
            			'You have successfully scan your QR CODE ID',
            			'success'
            			)
            		";
            	}else if(isset($_GET['failed'])){
            		echo "
            			Swal.fire(
            			'Error Message',
            			'There is a problem when you are trying to scan your QR CODE , please try again',
            			'error'
            			)
            		";
            	}
            ?>

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


		});
	</script>
</body>

</html>