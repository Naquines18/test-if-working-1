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
									<h3>Scan your QR CODE here: </h3>
									
									<h4 class="text-muted"> <span class="text-danger"><i class="align-middle" data-feather="alert-circle"></i> Take Note!</span> Before you scan your ID please make sure the client complete their profile.</h4>
								</div>
								<div class="card-body py-3">
									<div class="row">
									<div class="col-md-1"></div>
										<div class="col-md-10">
											<div class="embed-responsive embed-responsive-16by9 text-center">
												<video id="preview" style="width: 100%; height:auto;" ></video>
											</div>
										</div>
									<div class="col-md-1"></div>
									</div>
								</div>
								<div class="card-footer">
									<form action="src/log.php" method="post">
										<input type="hidden" id="result_scan" class="form-control" name="result_scan">
									</form>
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
		});
	</script>
</body>

</html>