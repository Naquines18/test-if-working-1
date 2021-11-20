<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Staff  | MIST Appointment System</title>

	<link href="css/app.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.2/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/datatables.min.css"/>	
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
	<div class="wrapper">
		<?php include "includes/sidebar.php"; ?>
		<div class="main">
		<?php include "includes/navbar.php"; ?>	

			<main class="content">
				<div class="container-fluid p-0">

					<div class="card">

					<div class="card-header">
						<h3>Staff Data</h3>
						<div align="right">
							<?php
								if($_SESSION['advance_user_role'] == "2"){
									echo '<a href="#" class="btn btn-danger"><i class="align-middle text-white" data-feather="plus"></i> Not Authorize</a>';
								}else{
									echo '<a href="add_staff?page=add_staff" class="btn btn-dark"><i class="align-middle text-white" data-feather="plus"></i> Add Staff</a>';
								}
							?>
						</div> 
					</div>

                        <div class="card-body py-0">
                        	 <div class="row">
                            <div class="col-md-12 w-100 table-responsive">
                                    
                            <table class="table table-bordered my-0" id="doctor">
                                    <thead>
                                        <tr class="text-center">
											<th>No.</th>
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            <th>Position</th>
											<th>Profile Image</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										
										// $getdoc = $conn->prepare("SELECT * FROM advance_user WHERE advance_user_role = '2' AND advance_user_id != ?");
										$getdoc = $conn->prepare("SELECT * FROM advance_user WHERE advance_user_role = '2'");
										// $getdoc->bind_param("s",$id);
										$getdoc->execute();
										$result = $getdoc->get_result();
										$i = 1;
										while ($row = $result->fetch_assoc()) {
											echo '
											<tr class="text-center">
											<td>'.$i++.'</td>
                                            <td>'.$row['advance_user_name'].'</td>
                                            <td>'.$row['advance_user_email'].'</td>
                                            <td>Staff</td>
											<td class="text-center"><img src="'.$row['profile_image'].'" class="rounded-circle" width="50" ></td>
                                            <td>';
												if($_SESSION['advance_user_id'] != $row['advance_user_id']){
													echo '<a href="#not_you" class="btn btn-danger" id="update"><i class="align-middle text-white" data-feather="edit"></i>This is not you</a>';
												}else{
													echo '<a href="update_staff?doctor='.$row['advance_user_id'].'&&charset='.md5($row['advance_user_id']).'" class="btn btn-dark" id="update"><i class="align-middle text-white" data-feather="edit"></i></a>';
												}
                                            echo '</td>
                                        </tr> 
											';
										}
										?>

										<!-- <button class="btn btn-danger" id="delete" data-id="'.$row['advance_user_id'].'"><i class="align-middle text-white" data-feather="delete"></i></button> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>

					<div class="card">
					<div class="card-header">
						<h3>Administrators Data</h3>
						<h6 class="card-subtitle text-muted">List of administrators.</h6>

						<div align="right">
							<?php
							if($role == "1"){
								echo '<a href="add_administrator?page=add_administrator" class="btn btn-dark"><i class="align-middle text-white" data-feather="plus"></i> Add Administrator</a>';
							}else{
								echo '<a href="#need_administrator_prevelage" class="btn btn-dark"><i class="align-middle text-white" data-feather="x"></i> Not Authorize</a>';
							}
							
							?>
						</div> 
					</div>
					<div class="card-body py-0">
						<div class="table-responsive">
						<table class="table table-bordered mb-0" id="administrator">
							<thead>
								<tr class="text-center">
									<th scope="col">#</th>
									<th scope="col">Username</th>
									<th scope="col">Email Address</th>
									<th scope="col">Gender</th>
									<th scope="col">Position</th>
									<th scope="col">Profile Image</th>
									<th scope="col">Manage</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$position = "1";
								$query = $conn->prepare("SELECT * FROM advance_user WHERE advance_user_role = ? AND advance_user_id != ?");
								$query->bind_param("ss",$position,$id);
								$query->execute();
								$result = $query->get_result();
								if($result->num_rows > 0){
									while ($admin = $result->fetch_assoc()) {
										echo '
											<tr>
												<th scope="row">'.$position++.'</th>
												<td>'.$admin['advance_user_name'].'</td>
												<td>'.$admin['advance_user_email'].'</td>
												<td>'.$admin['gender'].'</td>
												<td>Administrator</td>
												<td><img src="'.$admin['profile_image'].'" class="rounded-circle" width="50" ></td>
												<th class="align-items-center justify-content-center text-center">';
													if($role == "1"){
														echo '<div class="btn-group">
														<a href="update_admin?id='.$admin['advance_user_id'].'" class="btn btn-dark" id="update"><i class="align-middle text-white" data-feather="edit"></i></a>
														<button class="btn btn-danger" id="delete_admin" data-id="'.$admin['advance_user_id'].'"><i class="align-middle text-white" data-feather="delete"></i></button>
													</div>';
													}else{
														echo '<button class="btn btn-danger" data-id="'.$admin['advance_user_id'].'"><i class="align-middle text-white" data-feather="x"></i> You are not authorize</button>';
													}
												echo '</th>
											</tr>';
									}
								}		
								$query->close();
								$conn->close();
								?>
							</tbody>
						</table>
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
			$(document).on('click', '#delete_admin', function(event){
				const delete_admin = $(this).data('id');

				$.ajax({
					url: "src/add_administrator.php",
					method: "POST",
					data: {
						'delete_admin': delete_admin,
					},
					success: function(data) {
						if(data == "success"){
							Swal.fire(
								'Good job!',
								'Administrator is successfully deleted',
								'success'
							)

							setInterval(function(){
								window.location.href="staff?page=staff_page";
							}, 3000);

							
						}else {
							Swal.fire(
								'Error!',
								'Administrator is unsuccessfully deleted.',
								'error'
							)

							setInterval(function(){
								window.location.href="staff?page=staff_page";
							}, 3000);
						}
					}
				})

			});

			$(document).on('click', '#delete', function() {
				const delete_doc = $(this).data('id');
				$.ajax({
					url: "src/add_doctor.php",
					method: "POST",
					data: {
						'delete_doc': delete_doc,
					},
					dataType: "json",
					success: function(data) {
						
						if(data.result == "success"){

							Swal.fire(
								'Good job!',
								'You have successfully remove a staff.',
								'success'
							)

							setInterval(function(){
								window.location.href="staff?page=staff_page";
							}, 3000);
						}
					}
				});
			});


		
			$("#doctor").DataTable({
				"paging": false,
			});
			$("#administrator").DataTable({
				"paging": false,
			});
		});
	</script>
</body>

</html>