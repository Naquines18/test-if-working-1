<?php include "src/validation_loggedin.php"; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Profile Information | MIST Appointment System</title>

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
					if($role == "1"){
						$checkProfile = $conn->prepare("SELECT * FROM advance_user_profile WHERE admin_advance_user_id = ? LIMIT 1");
						$checkProfile->bind_param("s",$id);
						$checkProfile->execute();
						$checkProfile->store_result();
						
						if($checkProfile->num_rows > 0){
							$getinformation = $conn->prepare("SELECT * FROM advance_user INNER JOIN advance_user_profile ON advance_user.advance_user_id = advance_user_profile.admin_advance_user_id WHERE advance_user.advance_user_id = ? AND  advance_user_profile.admin_advance_user_id = ? LIMIT 1");

							$getinformation->bind_param("ss", $id,$id);
							$getinformation->execute();
							$result = $getinformation->get_result();

							while ($row = $result->fetch_assoc()) {
								echo '
									<h1 class="h3 mb-3">'.$username.' Profile</h1>

									<div class="row">
										<div class="col-md-4 col-xl-3">
											<div class="card mb-3">
												<div class="card-header">
													<h5 class="card-title mb-0">About Details</h5>
												</div>
												<div class="card-body text-center">
													<img src="'.$row['profile_image'].'" alt="'.$row['advance_user_name'].'" class="img-fluid rounded mb-2" width="128" height="128" />
													<h5 class="card-title mb-0">'.$row['advance_user_name'].'</h5>
													<div class="text-muted mb-2">';
													if($row['verified'] == "1"){
														echo '<small>Account Verified</small>';
													}else{
														echo '<small>Account Not Verified</small>';
													}
													echo '</div>
				
													<div>
														<a href="settings?page=update_information" class="btn btn-dark btn-sm">Update Info</a>         
													</div>
												</div>
												<hr class="my-0" />
												<div class="card-body">
													<h5 class="h6 card-title">About</h5>
													<ul class="list-unstyled mb-0">
														<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#">'.$row['admin_address'].'</a></li>
				
														<li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Account type<a href="#"> Admin</a></li>
														<li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> Gender <a href="#">'.$row['gender'].'</a></li>
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
													<h6 class="mb-0">Username: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['advance_user_name'].'
													</div>
												</div>
											<hr>
											
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">Email Address: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['advance_user_email'].'
													</div>
												</div>
											<hr>
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">City: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['city'].'
													</div>
												</div>
											<hr>
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">Address: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['admin_address'].'
													</div>
												</div>
											<hr>
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">Bio: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['admin_bio'].'
													</div>
												</div>
											<hr>

											
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">Mobile No: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['admin_mobile'].'
													</div>
												</div>
											<hr>
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">Account Created: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['advance_user_created'].'
													</div>
												</div>
											<hr>	
			
												
			
												
			
												
											</div>
										</div>
									</div>
								</div>
								
								';
							}	

							

							
						$checkProfile->close();
						$conn->close();
						}else{
							echo '<script>window.location.href="settings?suggestion=Complete your information below"</script>';
						}
						
					}else{
						$checkProfile = $conn->prepare("SELECT * FROM advance_user_profile WHERE admin_advance_user_id = ? LIMIT 1");
						$checkProfile->bind_param("s",$id);
						$checkProfile->execute();
						$checkProfile->store_result();
						
						if($checkProfile->num_rows > 0){
							$getinformation = $conn->prepare("SELECT * FROM advance_user INNER JOIN advance_user_profile ON advance_user.advance_user_id = advance_user_profile.admin_advance_user_id WHERE advance_user.advance_user_id = ? AND  advance_user_profile.admin_advance_user_id = ? LIMIT 1");

							$getinformation->bind_param("ss", $id,$id);
							$getinformation->execute();
							$result = $getinformation->get_result();

							while ($row = $result->fetch_assoc()) {
								echo '
									<h1 class="h3 mb-3">'.$username.' Profile</h1>

									<div class="row">
										<div class="col-md-4 col-xl-3">
											<div class="card mb-3">
												<div class="card-header">
													<h5 class="card-title mb-0">About Details</h5>
												</div>
												<div class="card-body text-center">
													<img src="'.$row['profile_image'].'" alt="'.$row['advance_user_name'].'" class="img-fluid rounded mb-2" width="128" height="128" />
													<h5 class="card-title mb-0">'.$row['advance_user_name'].'</h5>
													<div class="text-muted mb-2">';
													if($row['verified'] == "1"){
														echo '<small>Account Verified</small>';
													}else{
														echo '<small>Account Not Verified</small>';
													}
													echo '</div>
				
													<div>
														<a href="settings" class="btn btn-dark btn-sm">Update Info</a>         
													</div>
												</div>
												<hr class="my-0" />
												<div class="card-body">
													<h5 class="h6 card-title">About</h5>
													<ul class="list-unstyled mb-0">
														<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#">'.$row['admin_address'].'</a>
														 City <a href="#">'.$row['city'].'</a>
														</li>
				
														<li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Account type<a href="#"> Admin</a></li>
														<li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> Gender <a href="#">'.$row['gender'].'</a></li>
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
													<h6 class="mb-0">Username: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['advance_user_name'].'
													</div>
												</div>
											<hr>
											
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">Email Address: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['advance_user_email'].'
													</div>
												</div>
											<hr>
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">City: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['city'].'
													</div>
												</div>
											<hr>
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">Address: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['admin_address'].'
													</div>
												</div>
											<hr>
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">Bio: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['admin_bio'].'
													</div>
												</div>
											<hr>

											
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">Mobile No: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['admin_mobile'].'
													</div>
												</div>
											<hr>
												<div class="row">
													<div class="col-sm-4">
													<h6 class="mb-0">Account Created: </h6>
													</div>
													<div class="col-sm-8 text-secondary">
													'.$row['advance_user_created'].'
													</div>
												</div>
											<hr>	
			
												
			
												
			
												
											</div>
										</div>
									</div>
								</div>
								
								';
							}	

							

							
						$checkProfile->close();
						$conn->close();
						}else{
							echo '<script>window.location.href="settings?suggestion=Complete your information below"</script>';
						}
					}

					?>

				</div>
			</main>

			<?php include "includes/footer.php"; ?>
		</div>
	</div>

	<?php include "includes/script.php"; ?>			
</body>

</html>