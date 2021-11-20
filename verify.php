<?php
session_start();

require_once "src/config.php";

if(!isset($_SESSION['client_verified'])){
	echo '<script>window.location.href="index"</script>';	
}else if($_SESSION['client_verified'] == 0){
	$check_verified = mysqli_query($conn,"SELECT verified FROM client WHERE client_id = ".$_SESSION['client_verified']." AND verified = '1' LIMIT 1");
	foreach($check_verified as $data){
		if($data['verified'] == 1){
			echo '<script>window.location.href="dashboard"</script>';	
		}
	}
}else{	
	echo '<script>window.location.href="index"</script>';
	die();
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "meta.php"; ?>

	<title>Verify Information | Online Appointment System | Makilala Institute System and Information</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Verify you account, <?php echo $_SESSION['client_firstname']; ?></h1>
							<p class="lead">
								Please sign-in to your email to get the verify link.
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
                                    <div class="card">
                                        <div class="card-body text-center justify-content-center align-items-center">
                                        	<img src="notification.png" alt="" width="60%">
                                            <p class="card-text">Please verify your account first, sign in to your email provider like gmail,yahoo,aol, ect. and click the verification link.</p>

											<div align="center" class="mb-2 mt-2">
												<a href="src/logout.php" id="logout" class="btn btn-primary">Logout Account</a>
											</div>
                                            
                                        </div>
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