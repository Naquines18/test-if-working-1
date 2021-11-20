<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Sign in as Administrator | New Israel Reservation System</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body id="main">
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="card text-dark m-0">
							<div class="card-header text-center">
								<h1 class="h2">Welcome back administrator!</h1>
								<p class="lead">
									Sign in to your account to continue
								</p>
							</div>
							<div class="card-body m-0">
								<div class="m-sm-4">
									<form id="login-admin" method="POST">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" id="email" name="email" placeholder="Enter your email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Enter your password" />
											<!-- <small>
                                                <a href="pages-reset-password.html">Forgot password?</a>
                                            </small> -->
										</div>
										
										<div>
											<label class="form-check form-check-inline">
											<input class="form-check-input" type="radio" id="role_1" name="role" value="1">
												<span class="form-check-label">
												Im Administrator
												</span>
											</label>
											<label class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="role_2" name="role" value="2">
												<span class="form-check-label">
												Im Staff
												</span>
											</label>
											
										</div>


										<div>
											<label class="form-check mt-4">
                                                <input class="form-check-input" type="checkbox"  name="remember" checked>
                                                <span class="form-check-label">
                                                Remember me next time
                                                </span>
                                            </label>
										</div>

										<div class="mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Sign in</button>
										</div>

									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<?php include "includes/script.php"; ?>
	<script>
		$(document).ready(function(){
			$(document).on('submit', '#login-admin', function(event){
				event.preventDefault();

				const login_data = $(this).serialize();


				if($("#email").val().trim() == ""){
					Swal.fire(
						'Error Message',
						'Sorry please enter your email address',
						'error',
					)
					return false;
				}else if($("#password").val().trim() == ""){
					Swal.fire(
						'Error Message',
						'Sorry please enter your password',
						'error',
					)
					return false;
				}else if($("input[name=role]:checked").length == 0){
					Swal.fire(
						'Error Message',
						'Sorry please select your position',
						'error',
					)
					return false;
				}else{
					$.ajax({
						url: "src/login.php",
						method: "POST",
						dataType: "json",
						data: login_data,
						success: function(responce){
							if(responce.result == "1"){
								Swal.fire(
									'Error Message',
									'Sorry your email address is invalid, please try again',
									'error',
								)
								return false;
							}else if(responce.result == "3"){
								$("#main").fadeOut();
								window.location.href="dashboard?page=main_page";
							}else if(responce.result == "2"){
								Swal.fire(
									'Error Message',
									'Sorry please select your correct position, please try again',
									'error',
								)
								return false;
								
							}else if(responce.result == "4"){
								Swal.fire(
									'Error Message',
									'Sorry your email address or password is incorrect, please try again',
									'error',
								)
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