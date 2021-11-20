<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Client Settings | MIST Appointment System</title>

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
				<div class="container-fluid">

				

					<div class="card">
						<div class="card-header">
							<h3>Client List</h3>
							<div align="right">
								<a href="add_client.php" class="btn btn-dark"><i class="align-middle text-white" data-feather="plus"></i> Create Account</a>
							</div>
						</div>
						
                        <div class="card-body py-0">
                        	<div class="row">
                            <div class="col-xl-12 w-100 table-responsive">  
                            <table class="table table-bordered my-0" id="mytable">
                                    <thead>
                                        <tr class="text-center">
											<th class="d-none d-md-table-cell">No.</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th class="d-none d-md-table-cell">Email</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										
										$getclients = $conn->prepare("SELECT * FROM client");
										$getclients->execute();
										$result = $getclients->get_result();
										$i = 1;
										while ($row = $result->fetch_assoc()) {
											echo '
											<tr>
											<td class="d-none d-md-table-cell">'.$i++.'</td>
                                            <td>'.$row['client_firstname'].'</td>
                                            <td>'.$row['client_lastname'].'</td>
                                            <td class="d-none d-md-table-cell">'.$row['client_email'].'</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="update_client.php?profile='.$row['client_id'].'&&'.md5($row['client_gender']).'&&gender='.$row['client_gender'].'" class="btn btn-success "><i class="align-middle text-white" data-feather="edit"></i></a>
                                                    <button class="btn btn-danger" id="delete" data-id="'.$row['client_id'].'"><i class="align-middle text-white" data-feather="delete"></i></button>
													<a href="view_profile.php?profile_id='.$row['client_id'].'" class="btn btn-info" id="view"><i class="align-middle text-white" data-feather="eye"></i></a>
                                                </div>
                                            </td>
                                        </tr> 
											';
										}
								
										?>
                                    </tbody>
                                </table>
								</div>
							</div>
                        </div>
						</div>

					
							<div class="card">
								<div class="card-header">
									<h3>Client Feedbacks</h3>
									<h6 class="card-subtitle text-muted">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</h6>
								</div>
								<div class="card-body py-0">
									
									<div class="table-responsive">
									<table class="table table-bordered mb-0" id="messages">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Sender</th>
												<th scope="col">Message</th>
												<th scope="col">Subject</th>
												<th scope="col">Sent Time</th>
												<th scope="col">Manage</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$message_i = 1;
										$messages = $conn->prepare("SELECT * FROM messages ");
										$messages->execute();
										$messages_result = $messages->get_result();
										if($messages_result->num_rows > 0){
											while ($message = $messages_result->fetch_assoc()) {
												echo '
													<tr>
														<th scope="row">'.$message_i++.'</th>
														<td>'.$message['fullname'].'</td>
														<td>'.$message['body'].'</td>
														<td>'.$message['subject'].'</td>
														<td>'.$message['message_date'].'</td>
														<th class="text-center">
															<div class="btn-group">
																<button class="btn btn-danger" id="delete_feedback" data-id="'.$message['message_id'].'"><i class="align-middle text-white" data-feather="delete"></i></button>
															</div>
														</th>
													</tr>';
											}
										}		
										$messages->close();
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
			$(document).on('click', '#delete_feedback', function(event){
				event.preventDefault();
				const id_appointment_delete = $(this).data('id');

				if(confirm("Are you sure you want to remove this feedback")){
					$.ajax({
						url: "src/add_administrator.php",
						method: "POST",
						data: {
							'id_appointment_delete':id_appointment_delete,
						},
						success: function(data) {
							alert(data);
						}
					})
				}else {
					return false;
				}
			}); 
		});
	</script>
	<script>

		$(document).ready(function(){
			$(document).on('click', '#delete', function() {
			const delete_id = $(this).data('id');
				$.ajax({
					url: "src/add_client.php",
					method: "POST",
					data: {
						'delete_id': delete_id,
					},
					success: function(data) {
						Swal.fire(
							'Success Message',
							'Client appointment successfully remove client.',
							'success'
						)
						setInterval(function(){
							window.location.href="clients?page=client_page"; 
						}, 2000)
					}
				});
			});


			$(document).on('click', '#update', function() {
			const update_id = $(this).data('id');
				$.ajax({
					url: "src/add_client.php",
					method: "POST",
					data: {
						'update_id': update_id,
					},
					success: function(data) {
						Swal.fire(
							'Good job!',
							'Client appointment successfully disapproved',
							'warning'
						)
						
					}
				});
			});

			$("#mytable").DataTable({
				"paging": false,
			});
			$("#messages").DataTable({
				"paging": false,
			});
		});

	</script>
</body>

</html>