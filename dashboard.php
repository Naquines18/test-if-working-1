<?php include "src/validation_loggedin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "meta.php"; ?>

	<title>Client Dashboard | Online Appointment System | Makilala Institute System and Information</title>

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

				<div class="row">
						<div class="col-12 col-md-6 col-xxl-12 d-flex order-2 order-xxl-3">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h3 class="mb-0"><i class="align-middle" data-feather="eye"></i> Visual Representation of your appointment.</h3>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="py-3">
											<div class="chart">
												<canvas id="chartjs-dashboard-pie"></canvas>
											</div>
										</div>

										<table class="table mb-0">
											<tbody>
												<?php
													//pending
													$countpending = mysqli_query($conn,"SELECT * FROM `appointments` WHERE status= 'Pending' AND appointment_email = '$email' ");
													$countPendingRows = htmlspecialchars(mysqli_num_rows($countpending));

													//pending
													$countfinished = mysqli_query($conn,"SELECT * FROM `appointments` WHERE status= 'Finished' AND appointment_email = '$email' ");
													$countFinishedRows = htmlspecialchars(mysqli_num_rows($countfinished));




													//approved
													$countapproved = mysqli_query($conn,"SELECT * FROM `appointments` WHERE status='Approved' AND appointment_email = '$email'");
													$countApprovedRows = htmlspecialchars(mysqli_num_rows($countapproved));
												?>
												<tr>
													<td class="text-danger">
														<span class="badge bg-danger">Pending</span>
													</td>
													<td class="text-end">
														<?php echo $countPendingRows; ?>
													</td>
												</tr>
												<tr>
													<td class="text-success">
														<span class="badge bg-success">Approved</span> 
													</td>
													<td class="text-end">
														<?php echo $countApprovedRows; ?>
													</td>
												</tr>
												<tr>
													<td class="text-primary">
														<span class="badge bg-primary">Finished</span> 
													</td>
													<td class="text-end">
														<?php echo $countFinishedRows; ?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-12 col-md-6 col-xxl-12 d-flex order-1 order-xxl-1">
							<div class="card flex-fill">
								<div class="card-header">

									<h3 class="mb-0"><i class="align-middle" data-feather="calendar"></i> Todays date</h3>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div id="datetimepicker-dashboard"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


				
					<div class="row">
						
						<div class="col-md-12 col-lg-12 col-xxl-12">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h3><i class="align-middle" data-feather="book"></i> Your Reservations: </h3>

									<div align="right">
										<a href="appointment?page=add_reservation" class="btn btn-dark"><i class="align-middle text-white" data-feather="plus"></i> Add Reservation</a>
									</div>
								</div>
								<div class="card-body py-3 table-responsive">
								<table class="table table-bordered my-0" id="appointments_data">
									<thead>
										<tr class="text-center">
											<th>No.</th>
											<th>Name</th>
											<th>Gender</th>
											<th>Staff</th>
											<th>Manage</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$i = 1;
										$getAppointment = $conn->prepare("SELECT * FROM appointments WHERE appointment_email = ?");
										$getAppointment->bind_param("s",$email);
										$getAppointment->execute();				
										$result = $getAppointment->get_result();
										
											while($row = $result->fetch_assoc()){
											echo '
											<tr class="text-center">
												<td>'.$i++.'.</td>
												<td>'.$row['appointment_fullname'].'</td>
												<td>'.$row['gender'].'</td>
												<td>'.$row['patient_doctor'].'</td>
												<td>
													<div class="btn-group text-center">';
														if($row['status'] == "Pending"){
															echo '<button class="btn btn-danger">Pending</button>';
															echo '<button class="btn btn-primary" id="cancel" data-id="'.$row["appointment_id"].'">Cancel</button>';
														}else if($row['status'] == "Approved"){
								

															echo '<a id="print_card" data-staff="'.$row['patient_doctor'].'" data-id="'.$row['appointment_id'].'" class="btn btn-secondary" href=""><i data-feather="copy"></i> Print QR CODE</a>';

															echo '<button class="btn btn-primary" id="finished" data-id='.$row['appointment_id'].'><i data-feather="check"></i> Reservation Approved</button>';
														}else if($row['status'] == "Finished"){
															echo '<button class="btn btn-primary"><i data-feather="check"></i> Finished Appointment</button>';
														}	
													echo '</div>
												</td>
											</tr>';														
											}
									
									?>
									</tbody>
								</table>
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


		$(document).on('click', '#print_card', function(event){
			event.preventDefault()
			Swal.fire({
				title: '<h3>Your Appointment ID template</h3>',
				heightAuto: true,
				width: 700,
				padding: '5em',
				html:
					'<div class="container"><img class="img-fluid" src="src/image/front_1.jpg"></div>',
				showCloseButton: true,
				showCancelButton: true,
				focusConfirm: false,
				cancelButtonColor: '#d33',
				confirmButtonText: 'Download My ID'
			}).then((result) => {
				if(result.isConfirmed){
					if (result.isConfirmed) {
						const value = $(this).data('staff');
						const id = $(this).data('id');
						$.ajax({
							url: "src/generate_qrcode.php",
							method: "POST",
							data : {
								'value': value,
								'id': id,
							},
							success: function(event){
								if(event == "success"){
									Swal.fire(
									'Your Appointment ID is now generated!',
									'You can now download or take a picture on it!',
									'success'
									)

								}
							}
						});


						

						
					}
				}
			});
		});

		$("#appointments_data").DataTable({
			"paging": false,
		});


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

		$(document).on('click', '#cancel', function(){
			event.preventDefault();
			const cancel_reservation = $(this).data('id');



			const swalWithBootstrapButtons = Swal.mixin({
			  customClass: {
			    confirmButton: 'btn btn-success ml-2',
			    cancelButton: 'btn btn-danger'
			  },
			  buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
			  title: 'Are you sure you want to cancel reservation?',
			  text: "You won't be able to revert this!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonText: 'I want to proceed',
			  cancelButtonText: 'I want to cancel this operation.',
			  reverseButtons: true
			}).then((result) => {

			  if (result.isConfirmed) {

			  	$.ajax({
			  	url: "src/cancel.php",
			  	method: "POST",
			  	data : {
			  		'cancel_reservation': cancel_reservation,
			  	},
			  	success: function(event){
			  		if(event == "success"){
			  			if (result.isConfirmed) {
						    Swal.fire(
						      'Success Message!',
						      'You have cancel and deleted your reservation.',
						      'success'
						    )
					  	}

					  setInterval(function(){
					   window.location.href="dashboard?success=cancelled"; 
					  }, 3000);
			  		}else{
			  			if (result.isConfirmed) {
						    Swal.fire(
						      'Error Message!',
						      'Cancellation error ocurred, please try again',
						      'success'
						    )
					  	}
					  setInterval(function(){
					   window.location.href="dashboard"; 
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
			      'success'
			    )
			  }
			})
		});


		$(document).on('click', '#finished', function(){
			const finished_reservation = $(this).data('id');

			const swalWithBootstrapButtons = Swal.mixin({
			  customClass: {
			    confirmButton: 'btn btn-success ml-2',
			    cancelButton: 'btn btn-danger'
			  },
			  buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
			  title: 'Are you sure you already finished this reservation?',
			  text: "You won't be able to revert this!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonText: 'I want to proceed',
			  cancelButtonText: 'I want to cancel this operation.',
			  reverseButtons: true
			}).then((result) => {

			  if (result.isConfirmed) {

			  	$.ajax({
			  	url: "src/finished.php",
			  	method: "POST",
			  	data : {
			  		'finished_reservation': finished_reservation,
			  	},
			  	success: function(event){
			  		if(event == "success"){
			  			if (result.isConfirmed) {
						    Swal.fire(
						      'Success Message!',
						      'You have finished your reservation.',
						      'success'
						    )
					  	}

					  setInterval(function(){
					   window.location.href="dashboard"; 
					  }, 3000);
			  		}else{
			  			if (result.isConfirmed) {
						    Swal.fire(
						      'Error Message!',
						      'Cancellation error ocurred, please try again',
						      'success'
						    )
					  	}
					  setInterval(function(){
					   window.location.href="dashboard"; 
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
			      'success'
			    )
			  }
			})

		});


	});
	<?php
	$getDataChart = mysqli_query($conn, "SELECT * FROM appointments WHERE appointment_email = '$email' AND status = 'Pending' ");
	$count = mysqli_num_rows($getDataChart);

	$getDataChart__0 = mysqli_query($conn, "SELECT * FROM appointments WHERE appointment_email = '$email' AND status = 'Finished' ");
	$count__0 = mysqli_num_rows($getDataChart__0);

	//echo $getDataChart;

	$getDataChart__1 = mysqli_query($conn, "SELECT * FROM appointments WHERE appointment_email = '$email' AND status = 'Approved' ");
	$count__1 = mysqli_num_rows($getDataChart__1);
	?>
	document.addEventListener("DOMContentLoaded", function() {
		// Pie chart
		new Chart(document.getElementById("chartjs-dashboard-pie"), {
			type: "line",
			data: {
				labels: ["Pending","Approved","Finished"],
				datasets: [{
					data: [<?php echo $count; ?>,<?php echo $count__1; ?>, <?php echo $count__0; ?>],
					backgroundColor: [
						window.theme.primary,
						window.theme.warning,
						window.theme.dark,
					],
					borderWidth: 5
				}]
			},
			options: {
				responsive: !window.MSInputMethodContext,
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				cutoutPercentage: 75
			}
		});
	});
	
		document.addEventListener("DOMContentLoaded", function() {
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
			});
		});
	</script>
	

</body>

</html>