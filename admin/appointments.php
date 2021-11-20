<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Appointments Settings | MIST Appointment System</title>

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

						<h3>Manage Reservation Data</h3>
									<!-- <h6 class="card-subtitle text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h6> -->

							<div align="right">
								<a href="add_appointment.php" class="btn btn-dark"><i class="align-middle text-white" data-feather="plus"></i> Create Reservation</a>
							</div>   
							
						</div>                        
						
						<div class="card-body py-0">
							

								<div class="row">
                            <div class="col-md-12 w-100 table-responsive">
                                
                            <?php
								if($role === "1"){
									echo '
									<table class="table table-bordered my-0" id="myTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>Fullname</th>
                                            <th>Address</th>
                                            <th>City</th>
											<th>Staff</th>
											<th>Manage</th>
                                        </tr>
                                    </thead>';
									$i = 1;
                                    $stmtAll = $conn->prepare("SELECT * FROM appointments");
									$stmtAll->execute();
									$result = $stmtAll->get_result();
									while($row = $result->fetch_assoc()){
									echo '
									<tbody>
									<tr>
										<td>'.$i++.'</td>
										<td>'.$row['appointment_fullname'].'</td>
										<td>'.$row['address'].'</td>
										<td>'.$row['city'].'</td>
										<td>'.$row['patient_doctor'].'</td>
										<td>
											<div class="btn-group">
												<a href="update_appointment.php?appointment='.$row['appointment_id'].'&&charset_'.md5($row['appointment_id']).'&&fullname='.$row['appointment_fullname'].'&&email='.$row['appointment_fullname'].'&&gender='.$row['gender'].'&&staff='.$row['patient_doctor'].'" class="btn btn-dark" id="update" data-id="'.$row['appointment_id'].'"><i class="align-middle text-white" data-feather="edit"></i></a>
												<button class="btn btn-danger" id="delete" data-id="'.$row['appointment_id'].'"><i class="align-middle text-white" data-feather="delete"></i></button>
											</div>
										</td>
										</tr>
									</tbody>';
									}

									
                                	echo '</table>';
								}else{
									echo '
									<table class="table table-bordered my-0" id="myTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>Fullname</th>
                                            <th>Address</th>
                                            <th>City</th>
											<th>Staff</th>
											<th>Manage</th>
                                        </tr>
                                    </thead>';
                                    $stmt = $conn->prepare("SELECT * FROM appointments WHERE patient_doctor = ?");
									$stmt->bind_param("s",$username);
									$stmt->execute();
									$result = $stmt->get_result();
									$i = 1;
									while($row = $result->fetch_assoc()){
									echo '
									<tbody>
									<tr>
										<td>'.$i++.'</td>
										<td>'.$row['appointment_fullname'].'</td>
										<td>'.$row['address'].'</td>
										<td>'.$row['city'].'</td>
										<td>'.$row['patient_doctor'].'</td>
										<td class="text-center">
											<div class="btn-group">';
												if($row['status'] == "Pending"){
													echo '<button class="btn btn-outline-danger" id="approve" data-id="'.$row['appointment_id'].'">Pending</button>';
												}else{
													echo '<button class="btn btn-outline-dark" id="disapprove" data-id="'.$row['appointment_id'].'">Approve</button>';

												}
												echo '<button class="btn btn-outline-danger" id="delete" data-id="'.$row['appointment_id'].'">Delete</button>
											</div>
										</td>
										</tr>
									</tbody>
									';
									}

	
                                echo '</table>
									';	
								}

							?>
                            </div>
                        </div>

						</div>
                    </div>

					<div class="card">
								<div class="card-header">
									<h3>Reservation's list</h3>
								</div>
								
								<div class="card-body py-0">
									<div class="table-responsive mt-2">
									<table class="table table-bordered mb-0" id="status">
										<thead>
											<tr class="text-center">
												<th scope="col">#</th>
												<th scope="col">Fullname</th>
												<th scope="col">Gender</th>
												<th scope="col">Age</th>
												<th scope="col">Phone</th>
												<th scope="col">Status</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$message_i = 1;
										$appointments = $conn->prepare("SELECT * FROM appointments");
										$appointments->execute();
										$appointment_result = $appointments->get_result();
										if($appointment_result->num_rows > 0){
											while ($row = $appointment_result->fetch_assoc()) {
												echo '
													<tr>
														<th scope="row">'.$message_i++.'</th>
														<td>'.$row['appointment_fullname'].'</td>
														<td>'.$row['gender'].'</td>
														<td>'.$row['age'].'</td>
														<td>'.$row['phone'].'</td>
														<th class="text-center">';
															if($row['status'] == "Pending"){
																echo '<span class="badge bg-danger">'.$row['status'].'</span>';
															}else if($row['status'] == "Approved"){
																echo '<span class="badge bg-success">'.$row['status'].'</span>';
															}else{
																echo '<span class="badge bg-primary">'.$row['status'].'</span>';
															}
														echo '</th>
													</tr>';
											}
										}		
										$appointments->close();
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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.2/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/datatables.min.js"></script>
	<script>
	$(document).ready(function(){
		$(document).on('click', '#approve', function() {
			const approve_appointment = $(this).data('id');

			$.ajax({
				url: "src/approve.php",
				method: "POST",
				data: {
					'approve_appointment': approve_appointment,
				},
				success: function(data) {
					Swal.fire(
						'Good job!',
						'Client appointment successfully sapproved',
						'success'
					)
					setInterval(function(){
						window.location.href="appointments.php";
					}, 2000);
					
				}
			});
		});
		$(document).on('click', '#disapprove', function() {
			const disapprove_appointment = $(this).data('id');
			$.ajax({
				url: "src/approve.php",
				method: "POST",
				data: {
					'disapprove_appointment': disapprove_appointment,
				},
				success: function(data) {
					Swal.fire(
						'Good job!',
						'Client appointment successfully disapproved',
						'warning'
					)
					setInterval(function(){
						window.location.href="appointments.php";
					}, 2000);
				}
			});
		});


		$(document).on('click', '#delete', function() {
			const delete_id = $(this).data('id');

			const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
			}).then((result) => {
			if (result.isConfirmed) {

				$.ajax({
				url: "src/approve.php",
				method: "POST",
				data: {
					'delete_id': delete_id,
				},
				success: function(data) {
					swalWithBootstrapButtons.fire(
						'Deleted!',
						'Appointment has been deleted.',
						'success'
					)
					setInterval(function(){
						window.location.href="appointments.php";
					}, 2000);
				}
			});

				
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				swalWithBootstrapButtons.fire(
					'Cancelled',
					'Operation has been cancelled',
					'success'
				)
			}
			})

			
		});

		$('#myTable').DataTable({
			"paging":false,
		});
		$('#status').DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy',
				'excel',
				'print',
				'pdf'
			],
			"paging":false,
		});
	});

	
	</script>
</body>

</html>