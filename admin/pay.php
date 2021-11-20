<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Scan QR CODE | MIST Appointment System</title>

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
									<h3>Pay using your QR CODE here: </h3>
									<p class="text-muted">Scan your QR CODE and pay 100 pesos to the cashier. <span class="text-warning">If you want to scan with a establishment <br> please select a establishment name on the select input below.<span></p>
								</div>
								<div class="card-body">
									<div class="row">
									<div class="col-md-1"></div>
										<div class="col-md-10">
											<form action="src/pay_scan.php" method="post">

												<select name="payment_method" class="form-select" id="payment_method">
													<option value="Payment" selected>Payment</option>
													<option value="Establishment Payment">Establishment Payment</option>
												</select>
												<small class="text-muted">You can leave this field as default.</small>
												<br>
												<select name="establishments" class="form-select" id="establishments">
													<?php
														$query = mysqli_query($conn,"SELECT * FROM establishments");
														echo '<option value="none" selected>Select Establishment</option>';
														foreach($query as $row){
															echo '<option value="'.$row["establishments_name"].'">'.$row["establishments_name"].'</option>';
														}
													?>
												</select>
												<small class="text-muted mb-2">You can leave this field as blank</small>

												<input type="hidden" id="payment_user" class="form-control" name="payment_user">
											</form>
											<br>
											<div class="embed-responsive embed-responsive-16by9 text-center">
												<video id="preview" style="width: 100%; height:auto;" ></video>
											</div>
										</div>
									<div class="col-md-1"></div>
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
			let scanner = new Instascan.Scanner({
                video: document.getElementById('preview')
            });

			scanner.addListener('scan', function(content) {
				document.getElementById('payment_user').value=content;
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
		                        alert('System could not found your camera');
		                    }
		                }else if($(this).val()==2){
		                    if(cameras[1]!=""){
		                        scanner.start(cameras[1]);
		                    }else{
		                        alert('System could not found your camera');
		                    }
		                }
		            });

                } else {
                    console.error('No cameras found.');
                }
            }).catch(function(e) {
                console.error(e);
            });


			<?php
            	if(isset($_GET['success'])){
            		echo "
            			Swal.fire(
            			'Success Message',
            			'You have successfully payed 100 Pesos',
            			'success'
            			)
            		";
            	}else if(isset($_GET['failed'])){
            		echo "
            			Swal.fire(
            			'Error Message',
            			'There is a problem when you are trying to pay , please try again',
            			'error'
            			)
            		";
            	}
            ?>

			<?php
            	if(isset($_GET['sucess_payment'])){
            		echo "
            			Swal.fire(
            			'Success Message',
            			'You have successfully payed',
            			'success'
            			)
            		";
            	}else if(isset($_GET['error_payment'])){
            		echo "
            			Swal.fire(
            			'Error Message',
            			'There is a problem when you are trying to pay , please try again',
            			'error'
            			)
            		";
            	}
            ?>

		});
	</script>
</body>

</html>