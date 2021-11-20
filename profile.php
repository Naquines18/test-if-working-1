<?php include "src/validation_loggedin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "meta.php"; ?>

	<title>Profile Information | Online Appointment System | Makilala Institute System and Information</title>

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
					<?php
						$check_profile = mysqli_query($conn,"SELECT * FROM client_profile INNER JOIN client ON client_profile.client_id = client.client_id  WHERE client_profile.client_id = '$id' AND client.client_id = '$id' LIMIT 1");
						$check_row = mysqli_num_rows($check_profile);

						if($check_row === 1){
							while($row = mysqli_fetch_assoc($check_profile)){
							echo '
							<h1 class="h3 mb-3">'.$row['client_firstname'].' '.$row['client_lastname'].' Profile</h1>
								<div align="right">
									<a href="settings?page=manage_information" class="btn btn-dark btn-lg">Manage Profile</a>
								</div>	
							<div class="row mt-2">
								<div class="col-md-4 col-xl-3">
									<div class="card mb-3">
										<div class="card-header">
											<h5 class="card-title mb-0">About Details</h5>
										</div>
										<div class="card-body text-center">
											<img src="'.$row['client_image'].'" alt="'.$row['client_firstname'].' '.$row['client_lastname'].'" class="img-fluid rounded mb-2" width="128" height="128" />
											<h5 class="card-title mb-0">'.$row['client_firstname'].' '.$row['client_lastname'].'</h5>
											<div class="text-muted mb-2">Client</div>
		
											<div>
												<a class="btn btn-primary btn-sm btn-block" href="contact.php">Message</a>
											</div>
										</div>
										<hr class="my-0" />
										<div class="card-body">
											<h5 class="h6 card-title">About</h5>
											<ul class="list-unstyled mb-0">
												<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#">'.$row['client_profile_address'].'</a></li>
		
												<li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Account <a href="#">Client</a></li>
												<li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span> Gender <a href="#">Male</a></li>
											</ul>
										</div>
										<hr class="my-0" />
									</div>
								</div>
		
								<div class="col-md-8 col-xl-9">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Informations</h5>
										</div>
		
									<div class="card-body h-100">							
										<div class="row">
											<div class="col-sm-4">
											<h6 class="mb-0">Firstname: </h6>
											</div>
											<div class="col-sm-8 text-secondary">
											'.$row['client_firstname'].'
											</div>
										</div>
									<hr>
										<div class="row">
											<div class="col-sm-4">
											<h6 class="mb-0">Lastname: </h6>
											</div>
											<div class="col-sm-8 text-secondary">
											'.$row['client_lastname'].'
											</div>
										</div>
									<hr>
										<div class="row">
											<div class="col-sm-4">
											<h6 class="mb-0">Email Address: </h6>
											</div>
											<div class="col-sm-8 text-secondary">
											'.$row['client_email'].'
											</div>
										</div>
									<hr>
										<div class="row">
											<div class="col-sm-4">
											<h6 class="mb-0">Gender: </h6>
											</div>
											<div class="col-sm-8 text-secondary">
											Male
											</div>
										</div>
									<hr>
										<div class="row">
											<div class="col-sm-4">
											<h6 class="mb-0">Address: </h6>
											</div>
											<div class="col-sm-8 text-secondary">
											'.$row['client_profile_address'].'
											</div>
										</div>
									<hr>
										<div class="row">
											<div class="col-sm-4">
											<h6 class="mb-0">Account type: </h6>
											</div>
											<div class="col-sm-8 text-secondary">
											Client
											</div>
										</div>
									<hr>
										<div class="row">
											<div class="col-sm-4">
											<h6 class="mb-0">Account Created: </h6>
											</div>
											<div class="col-sm-8 text-secondary">
											'.$row['account_created'].'
											</div>
										</div>
									<hr>	
		
											
		
											
		
											
										</div>
									</div>
								</div>
							</div>
							';
							}
						}else{
							echo '<script>window.location.href="settings?message=complete_profile"</script>';
						}
					?>

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
		});
	</script>
</body>

</html>