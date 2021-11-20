<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Update Profile | MIST Appointment System</title>
	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body id="main">
	<div class="wrapper">
		<?php include "includes/sidebar.php"; ?>

		<div class="main">
		<?php include "includes/navbar.php"; ?>

			<?php 

			if($role == "1"){
				echo '
				<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Settings</h1>

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
											<form id="update_user" method="POST" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<label class="form-label" for="fname">Username</label>
															<input type="hidden" class="form-control" id="update_id" name="update_id" value="'.$id.'">
															<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="'.$username.'">
														</div>
														<div class="mb-2">
															<label class="form-label" for="email">Email</label>
															<input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="'.$email.'">
														</div>
														<div class="form-group mb-2">
														<label class="form-label" for="gender">Gender</label>
															<select class="form-control mb-3" id="gender" name="gender">
																<option selected value="" disabled>--- Select Gender ---</option>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="text-center">';
														
															$getprofileimage = mysqli_query($conn,"SELECT profile_image FROM advance_user WHERE advance_user_id = '$id' LIMIT 1");
															while($getimage = mysqli_fetch_assoc($getprofileimage)){
																echo '
																<img alt="Charles Hall" id="image" src="'.$getimage["profile_image"].'" alt="'.$username.'" class="img-responsive mt-2" width="128" height="128" />
																';
															}	
														
															echo '<div class="mt-2">
                                                                <input type="file" class="form-sm" name="image_upload" id="image_upload" onchange="PreviewImage(this,$(this))">
                                                            </div>
															<small>For best results, use an image at least 128px by 128px in .jpg format</small>
														</div>
													</div>
													
												</div>

												<button type="submit" class="btn btn-dark">Save changes</button>
											</form>

										</div>
									</div>

									<div class="card">
										<div class="card-header">

											<h5 class="card-title mb-0">Private info</h5>
										</div>
										<div class="card-body">';
										$checkprofile_id = mysqli_query($conn,"SELECT * FROM advance_user_profile WHERE admin_advance_user_id = '$id'");	
										if(mysqli_num_rows($checkprofile_id) > 0){
											while ($rows = mysqli_fetch_assoc($checkprofile_id)) {
												echo '
											
											<form id="update_info" method="POST">
												
											<div class="mb-3">
												<label class="form-label" for="update_address">Address</label>
												<input type="hidden" class="form-control" id="update_id" name="update_id" value="'.$id.'">
												<input type="text" class="form-control" id="update_address" name="update_address" placeholder="1234 Main St" value="'.$rows['admin_address'].'">
											</div>
										
											<div class="mb-3">
												<label class="form-label" for="update_confirm_address">Confirm Address</label>
												<input type="text" class="form-control" id="update_confirm_address" name="update_confirm_address" placeholder="Apartment, studio, or floor" value="'.$rows['admin_address'].'">
											</div>

											<div class="mb-3">
												<label class="form-label" for="update_city">City</label>
												<input type="text" class="form-control" id="update_city" name="update_city" placeholder="City" value="'.$rows['city'].'">
											</div>

											<div class="mb-3">
												<label class="form-label" for="update_bio">Bio</label>
												<input type="text" class="form-control" id="update_bio" name="update_bio" placeholder="Biography" value="'.$rows['admin_bio'].'">
											</div>
											
											<div class="row">
												<div class="mb-3 col-md-6">
													<label class="form-label" for="update_mobile">Mobile No.</label>
													<input type="number" class="form-control" id="update_mobile" name="update_mobile" value="'.$rows['admin_mobile'].'">
												</div>
												<div class="mb-3 col-md-6">
													<label class="form-label" for="update_bday">Date of birth</label>
														<input type="date" class="form-control" id="update_bday" name="update_bday" value="'.$rows['birthdate'].'">
												</div>											
											</div>
											<button type="submit" class="btn btn-dark">Save Update</button>
										</form>';
											}
										}else{
											echo '
											
											<form id="add_info" method="POST">
												
											<div class="mb-3">
												<label class="form-label" for="address">Address</label>
												<input type="hidden" class="form-control" id="id" name="id" value="'.$id.'">
												<input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
											</div>
										
											<div class="mb-3">
												<label class="form-label" for="confirm_address">Confirm Address</label>
												<input type="text" class="form-control" id="confirm_address" name="confirm_address" placeholder="Apartment, studio, or floor">
											</div>

											<div class="mb-3">
												<label class="form-label" for="city">City</label>
												<input type="text" class="form-control" id="city" name="city" placeholder="City">
											</div>

											<div class="mb-3">
												<label class="form-label" for="bio">Bio</label>
												<input type="text" class="form-control" id="bio" name="bio" placeholder="Biography">
											</div>
											
											<div class="row">
												<div class="mb-3 col-md-6">
													<label class="form-label" for="mobile">Mobile No.</label>
													<input type="number" class="form-control" id="mobile" name="mobile">
												</div>
												<div class="mb-3 col-md-6">
													<label class="form-label" for="bday">Date of birth</label>
														<input type="date" class="form-control" id="bday" name="bday">
												</div>											
											</div>
											<button type="submit" class="btn btn-dark">Save changes</button>
										</form>';
										}

										

										echo '</div>
									</div>

								</div>
								<div class="tab-pane fade" id="password" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Password</h5>

											<form>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordCurrent">Current password</label>
													<input type="password" class="form-control" id="inputPasswordCurrent">
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordNew">New password</label>
													<input type="password" class="form-control" id="inputPasswordNew">
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordNew2">Verify password</label>
													<input type="password" class="form-control" id="inputPasswordNew2">
												</div>
												<button type="submit" class="btn btn-dark">Save changes</button>
											</form>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>
				';
			}else{
				echo '
				<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Settings</h1>

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
											
									<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">
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
											<form id="update_doc" method="POST" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<label class="form-label" for="doc_fname">Username</label>
															<input type="hidden" class="form-control" id="doc_id" name="doc_id" value="'.$id.'">
															<input type="text" class="form-control" id="doc_username" name="doc_username" placeholder="Username" value="'.$username.'">
														</div>
														<div class="mb-2">
															<label class="form-label" for="doc_email">Email</label>
															<input type="text" class="form-control" id="doc_email" name="doc_email" placeholder="Email Address" value="'.$email.'">
														</div>
														<div class="form-group mb-2">
														<label class="form-label" for="doc_gender">Gender</label>
															<select class="form-control mb-3" id="doc_gender" name="doc_gender">
																<option selected value="" disabled>--- Select Gender ---</option>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="text-center">';
														
															$getprofileimage = mysqli_query($conn,"SELECT profile_image FROM advance_user WHERE advance_user_id = '$id' LIMIT 1");
															while($getimage = mysqli_fetch_assoc($getprofileimage)){
																echo '
																<img alt="Charles Hall" id="image" src="'.$getimage["profile_image"].'" alt="'.$username.'" class="img-responsive mt-2" width="128" height="128" />
																';
															}	
														
															echo '<div class="mt-2">
                                                                <input type="file" class="form-sm" name="doc_image_upload" id="doc_image_upload" onchange="PreviewImage(this,$(this))">
                                                            </div>
															<small>For best results, use an image at least 128px by 128px in .jpg format</small>
														</div>
													</div>
													
												</div>

												<button type="submit" class="btn btn-dark">Save changes</button>
											</form>

										</div>
									</div>

									<div class="card">
										<div class="card-header">

											<h5 class="card-title mb-0">Private info</h5>
										</div>
										<div class="card-body">';
										$checkprofile_id = mysqli_query($conn,"SELECT * FROM advance_user_profile WHERE admin_advance_user_id = '$id'");	
										if(mysqli_num_rows($checkprofile_id) > 0){
											while ($rows = mysqli_fetch_assoc($checkprofile_id)) {
												echo '
											
											<form id="update_doc_info" method="POST">
												
											<div class="mb-3">
												<label class="form-label" for="update_doc_address">Address</label>
												<input type="hidden" class="form-control" id="update_doc_id" name="update_doc_id" value="'.$id.'">
												<input type="text" class="form-control" id="update_doc_address" name="update_doc_address" placeholder="1234 Main St" value="'.$rows['admin_address'].'">
											</div>
										
											<div class="mb-3">
												<label class="form-label" for="update_doc_confirm_address">Confirm Address</label>
												<input type="text" class="form-control" id="update_doc_confirm_address" name="update_doc_confirm_address" placeholder="Apartment, studio, or floor" value="'.$rows['admin_address'].'">
											</div>

											<div class="mb-3">
												<label class="form-label" for="update_doc_city">City</label>
												<input type="text" class="form-control" id="update_doc_city" name="update_doc_city" placeholder="City" value="'.$rows['city'].'">
											</div>

											<div class="mb-3">
												<label class="form-label" for="update_doc_bio">Bio</label>
												<input type="text" class="form-control" id="update_doc_bio" name="update_doc_bio" placeholder="Biography" value="'.$rows['admin_bio'].'">
											</div>
											
											<div class="row">
												<div class="mb-3 col-md-6">
													<label class="form-label" for="update_doc_mobile">Mobile No.</label>
													<input type="number" class="form-control" id="update_doc_mobile" name="update_doc_mobile" value="'.$rows['admin_mobile'].'">
												</div>
												<div class="mb-3 col-md-6">
													<label class="form-label" for="update_doc_bday">Date of birth</label>
														<input type="date" class="form-control" id="update_doc_bday" name="update_doc_bday" value="'.$rows['birthdate'].'">
												</div>											
											</div>
											<button type="submit" class="btn btn-dark">Save Update</button>
										</form>';
											}
										}else{
											echo '
											
											<form id="add_info_doc" method="POST">
												
											<div class="mb-3">
												<label class="form-label" for="doc_add_address">Address</label>
												<input type="hidden" class="form-control" id="doc_add_id" name="doc_add_id" value="'.$id.'">
												<input type="text" class="form-control" id="doc_add_address" name="doc_add_address" placeholder="1234 Main St">
											</div>
										
											<div class="mb-3">
												<label class="form-label" for="doc_add_confirm_address">Confirm Address</label>
												<input type="text" class="form-control" id="doc_add_confirm_address" name="doc_add_confirm_address" placeholder="Apartment, studio, or floor">
											</div>

											<div class="mb-3">
												<label class="form-label" for="doc_add_city">City</label>
												<input type="text" class="form-control" id="doc_add_city" name="doc_add_city" placeholder="City">
											</div>

											<div class="mb-3">
												<label class="form-label" for="doc_add_bio">Bio</label>
												<input type="text" class="form-control" id="doc_add_bio" name="doc_add_bio" placeholder="Biography">
											</div>
											
											<div class="row">
												<div class="mb-3 col-md-6">
													<label class="form-label" for="doc_add_mobile">Mobile No.</label>
													<input type="number" class="form-control" id="doc_add_mobile" name="doc_add_mobile">
												</div>
												<div class="mb-3 col-md-6">
													<label class="form-label" for="doc_add_bday">Date of birth</label>
														<input type="date" class="form-control" id="doc_add_bday" name="doc_add_bday">
												</div>											
											</div>
											<button type="submit" class="btn btn-dark">Save</button>
										</form>';
										}

										echo '</div>
									</div>

								</div>
								
							</div>
						</div>
					</div>

				</div>
			</main>
				';
			}


			?>

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
	</script>

	<script>
		$(document).ready(function(){
			

			// =========== Staff Functionality ===========//

			//update staff information
			$(document).on('submit', '#update_doc', function(event){
				event.preventDefault();

				const update_doc = new FormData($(this)[0]);
				
				if ($("#doc_username").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your username.',
						'error',
					)
				} else if ($("#doc_email").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your email.',
						'error',
					)
				} else if ($("#doc_image_upload").val() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please upload your profile image.',
						'error',
					)
				} else if ($("select[name=doc_gender]").val() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please select your gender.',
						'error',
					)
				} else {
					$.ajax({
						url: "src/update_account.php",
						method: "POST",
						data: update_doc,
						cache: false,
						contentType: false,
						processData: false,
						success: function(responce) {
							switch(responce){
								case "1":
									Swal.fire(
										'Warning Message',
										'Please enter valid Email Address',
										'warning'
									)
									break;
								case "2":
									Swal.fire(
										'Warning Message',
										'Invalid file extension',
										'warning'
									)
									break;
								case "3":
									Swal.fire(
										'Warning Message',
										'File exceed file limit',
										'warning'
									)
									break;
								case "6":
									Swal.fire(
										'Success Message',
										'You have updated your information',
										'success'
									)
									break;
								case "7":
									Swal.fire(
										'Error Message',
										'Invalid MYSQL QUERY',
										'error'
									)
									break;
								case "8":
									Swal.fire(
										'Error Message',
										'Could not upload file!',
										'error'
									)
									break;
								default:
									Swal.fire(
										'Error Message',
										'No Responce from server',
										'error'
									)
							}
						}
					});
					
				}

			});

			//update staff information
			$(document).on('submit', '#update_doc_info', function(event){
				event.preventDefault();

				const update_doc_data = $(this).serialize();

				if ($("#update_doc_address").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your address.',
						'error',
					)
				} else if ($("#update_doc_address").val() !== $("#update_doc_confirm_address").val()) {
					Swal.fire(
						'Error Message',
						'Sorry please enter same address.',
						'error',
					)
				} else if ($("#update_doc_confirm_address").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please confirm your address',
						'error',
					)
				} else if ($("#update_doc_mobile").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your mobile number',
						'error',
					)
				} else if ($("#update_doc_bio").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your bio',
						'error',
					)
				} else if ($("#update_doc_city").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your city',
						'error',
					)
				} else if ($("#update_doc_bday").val().trim() == "") {
					alert("Sorry enter your birthdate.");Swal.fire(
						'Error Message',
						'Sorry please enter your birthdate',
						'error',
					)
				} else {
					$.ajax({
						url: "src/add_info.php",
						method: "POST",
						data: update_doc_data,
						success: function(responce) {
							switch(responce){
									case "1":
									Swal.fire(
										'Success Message',
										'You have added your information',
										'success'
									)
									break;
								default:
									Swal.fire(
										'Error Message',
										'No Responce from server',
										'error'
									)
							}
						}
					});

					
				}
			});

			//Add Information to the staff
			$(document).on('submit', '#add_info_doc', function(event){
				event.preventDefault();
				const add_doc_data = $(this).serialize();
				
				if ($("#doc_add_address").val() == "") {
                    Swal.fire(
						'Error Message',
						'Sorry please enter your address',
						'error',
					)
				} else if ($("#doc_add_address").val() !== $("#doc_add_confirm_address").val()) {
					 Swal.fire(
						'Error Message',
						'Sorry please enter same address',
						'error',
					)
				} else if ($("#doc_add_confirm_address").val() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter confirm address',
						'error',
					)
				} else if ($("#doc_add_mobile").val() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your mobile number',
						'error',
					)
				} else if ($("#doc_add_bio").val() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your bio',
						'error',
					)
				} else if ($("#doc_add_city").val() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your city',
						'error',
					)
				} else if ($("#doc_add_bday").val() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your birthdate',
						'error',
					)				} else {
					$.ajax({
						url: "src/add_info.php",
						method: "POST",
						data: add_doc_data,
						success: function(data) {
							switch(data){
									case "1":
									Swal.fire(
										'Success Message',
										'You have added your information',
										'success'
									)
									$("#add_info_doc")[0].reset();
									break;
								default:
									Swal.fire(
										'Error Message',
										'No Responce from server',
										'error'
									)
							}
						}
					});
					
				}

			});


			// =========== Admin Functionality ===========//


			//Add Information to the admin
			$(document).on('submit', '#add_info', function(event){
				event.preventDefault();
				const add_data = new FormData($(this)[0]);
				
				if ($("#address").val().trim() == "") {
                    Swal.fire(
						'Error Message',
						'Sorry please enter your address',
						'error',
					)
				} else if ($("#address").val() !== $("#confirm_address").val()) {
					Swal.fire(
						'Error Message',
						'Sorry please enter same address',
						'error',
					)
				} else if ($("#confirm_address").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter confirm address',
						'error',
					)
				} else if ($("#mobile").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your mobile number',
						'error',
					)
				} else if ($("#bio").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your bio',
						'error',
					)
				} else if ($("#city").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your city',
						'error',
					)
				} else if ($("#bday").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your birthdate',
						'error',
					)
				} else {
					$.ajax({
						url: "src/add_info.php",
						method: "POST",
						data: add_data,
						cache: false,
						contentType: false,
						processData: false,
						success: function(data) {
							if(data == "1"){
								window.location.href="profile.php";
							}
						}
					});
				}

			});
			//Update Information to the admin
			$(document).on('submit', '#update_info', function(event){
				event.preventDefault();

				const update_data = $(this).serialize();

				if ($("#update_address").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your address.',
						'error',
					)
				} else if ($("#update_address").val() !== $("#update_confirm_address").val()) {
					Swal.fire(
						'Error Message',
						'Sorry please enter same address.',
						'error',
					)
				} else if ($("#update_confirm_address").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter confirm address.',
						'error',
					)
				} else if ($("#update_mobile").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your mobile number.',
						'error',
					)
				} else if ($("#update_bio").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your bio.',
						'error',
					)
				} else if ($("#update_city").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your city.',
						'error',
					)
				} else if ($("#update_bday").val().trim() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your birthdate.',
						'error',
					)
				} else {
					$.ajax({
						url: "src/add_info.php",
						method: "POST",
						data: update_data,
						success: function(data) {
							if(data == '1'){
								Swal.fire(
									'Success Message',
									'Client information has been updated',
									'success'
								)
							}else{
								Swal.fire(
									'Error Message',
									'Client information was not updated',
									'error'
								)
							}
						}
					});
					
				}

			});
			//Update Information to the Admin
			$(document).on('submit', '#update_user', function(event){
				event.preventDefault();

				const update_data = new FormData($(this)[0]);
				
				if ($("#username").val() == "") {
                    Swal.fire(
						'Error Message',
						'Sorry please enter your username.',
						'error',
					)
				} else if ($("#email").val() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please enter your email.',
						'error',
					)
				} else if ($("#image_upload").val() == "") {
					Swal.fire(
						'Error Message',
						'Sorry please select profile image.',
						'error',
					)
				} else if ($("select[name=gender]").val() == 0) {
					Swal.fire(
						'Error Message',
						'Sorry please select your gender.',
						'error',
					)
				} else {
					$.ajax({
						url: "src/update_account.php",
						method: "POST",
						data: update_data,
						cache: false,
						contentType: false,
						processData: false,
						success: function(data) {
							if(data == "1"){
								Swal.fire(
									'Error Message',
									'Sorry please enter correct email.',
									'error',
								)
							}else if(data == "2"){
								Swal.fire(
									'Error Message',
									'Sorry please select another image',
									'error',
								)
							}else if(data == "3"){
								Swal.fire(
									'Error Message',
									'Sorry file size exceeded try again',
									'error',
								)	
							}else if(data == "4"){
								Swal.fire(
									'Error Message',
									'Sorry username requires text only',
									'error',
								)
							}else if(data == "5"){
								Swal.fire(
									'Error Message',
									'Sorry gender requires text only',
									'error',
								)
							}else if(data == "6"){
								Swal.fire(
									'Success Message',
									'Information has been updated successfully.',
									'success',
								)
								$("#update_user")[0].reset();
							}else if(data == "7"){
								Swal.fire(
									'Error Message',
									'Sorry error in updating information',
									'error',
								)
							}else if(data == "8"){
								Swal.fire(
									'Error Message',
									'Sorry error in uploading the image information',
									'error',
								)
							}
						}
					});
				}

			});
		});
	</script>

</body>

</html>