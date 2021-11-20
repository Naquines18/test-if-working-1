<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Analytics Dashboard | MIST Appointment System</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.2/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/datatables.min.css"/>

</head>
<?php
	require 'src/countData.php';	
?>
<body>
	<div class="wrapper">
		<?php include "includes/sidebar.php"; ?>
		<div class="main">
		<?php include "includes/navbar.php"; ?>	

			<main class="content">
				<div class="container-fluid p-0">
				
					
					
				<div class="row">


				<?php
					if($_SESSION['advance_user_role'] == 1){
						echo '
						
						<h3 class="fw-300"> Visual Representation of data</h3>		

						<!-- Start Chart Line -->
						<div class="col-md-6 col-lg-6">
						<div class="col-12 col-lg-12">
							<div class="card flex-fill w-100" style="color: white !important; background-color: #222E3C;">
								<div class="card-header" style="background-color: #222E3C;">
									<h3 style="color: white !important;"><i class="align-middle" data-feather="git-pull-request"></i> Analytics of clients in a month.</h3>
									<p class="text-muted" style="color: white !important;">View the system data with the coresponding sections</p>


								</div>
								<div class="card-body">
									<div class="chart" style="color: white !important;">
										<canvas id="chartjs-line"></canvas>
									</div>
								</div>
							</div>
						</div>
						</div>

						

							
						<div class="col-md-6 col-lg-6">
						<div class="col-12 col-lg-12">
							<div class="card flex-fill w-100 border-white" style="color: white !important; background-color: #222E3C;">
								<div class="card-header" style="color: white !important;background-color: #222E3C;">
									<h3 style="color: white !important;"><i class="align-middle" data-feather="pie-chart"></i> Analytics of users browsers.</h3>
									<p class="text-muted" style="color: white !important;">View the system data with the coresponding sections</p>
								</div>
								<div class="card-body">
									<div class="chart">
										<canvas id="chartjs-doughnut"></canvas>
									</div>
								</div>
							</div>
						</div>
						</div>';
					}
				?>
						<!-- End Chart Line -->

						<h1 class="h3 mb-3">Dashboard Analytics</h1>
						<p>View the system data with the coresponding sections</p>

						<div class="col-md-12 col-xl-12 d-flex">
							<div class="w-100">
								<div class="row">

								<div class="col-sm-12">
										<div class="card" style="background-color: #222E3C;">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<h3 class="mb-4" style="color: white !important; ">Total amount of money accumulated on every client!
														</h3>
														<h1 class="mt-1 mb-3" style="color: white !important; font-size: 2rem; ">₱ (<?php echo number_format($moneyAccumulated['money'],0,".",","); ?>)</h1>
														<div class="mb-1">
															<span class="text-muted">Amount of money </span>
														</div>
													</div>
													<div class="col">
														<h3 class="mb-4" style="color: white !important; ">Total amount of money of every establishment!
														</h3>
														<?php
															$getAllMoney = mysqli_query($conn,"SELECT SUM(amount) FROM establisment_payments ");
															$fetch = mysqli_fetch_array($getAllMoney);
														?>
														<h1 class="mt-1 mb-3" style="color: white !important; font-size: 2rem; ">₱ (<?php echo number_format($fetch[0],0,".",","); ?>)</h1>
														<div class="mb-1">
															<span class="text-muted">Amount of money </span>
														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>

									<div class="col-sm-6">
										<div class="card" style="background-color: #222E3C;"> 
											<div class="card-body">
												<h3 class="mb-4" style="color: white !important; "><i class="align-end" data-feather="book"></i> Appointment
												</h3>
												<h1 class="mt-1 mb-3" style="color: white !important; font-size: 2rem;"><?php echo $countAppointmentsRows; ?></h1>
												<div class="mb-1">
													<span class="text-muted">No. of reservations  </span>
												</div>
											</div>
										</div>
										<div class="card bg-warning">
											<div class="card-body">
												<h3 class="mb-4"><i class="align-middle" data-feather="user"></i> Client
												
												</h3>
												<h1 class="mt-1 mb-3" style="font-size: 2rem;"><?php echo $countClientRows; ?></h1>
												<div class="mb-1">
													<span class="text-muted" style="color: white !important;">No. of client in the system</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card bg-primary">
											<div class="card-body">
												<h3 class="mb-4" style="color: white !important; "><i class="align-middle" data-feather="x-square"></i> Pending
												
												</h3>
												<h1 class="mt-1 mb-3" style="color: white !important; font-size: 2rem; "><?php echo $countPendingRows; ?></h1>
												<div class="mb-1">
													<span class="text-muted" style="color: white !important;">No. of pending reservation</span>
												</div>
											</div>
										</div>
										<div class="card border">
											<div class="card-body">
												<h3 class="mb-4 text-black"><i class="align-middle" data-feather="check-square"></i> Approved 
												
												</h3>
												<h1 class="mt-1 mb-3" style="font-size: 2rem;"><?php echo $countApprovedRows; ?></h1>
												<div class="mb-1">
													<span class="text-muted">No. of approved reservations</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<hr>
						

						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header text-center">
									<h3>Establishment Logs</h3>
								</div>
								<div class="card-body table-responsive py-0">
									<table class="table table-bordered table-sm" id="appointment_data">
									<thead>
										<tr class="text-center">
											<th>Establishment</th>
											<th>Amount Paid</th>
											<th class="d-none d-md-table-cell">Age</th>
											<th class="d-none d-md-table-cell">Date Scanned</th>
										</tr>
									</thead>
									<tbody>
									<?php

										$getestab = $conn->prepare("SELECT * FROM `establisment_payments` LIMIT 10");
										$getestab->execute();
										$result = $getestab->get_result();
										if($result->num_rows > 0){
											while ($row = $result->fetch_assoc()) {
												echo '
												<tr class="text-center">
													<td><span class="badge bg-primary">'.$row['establishment'].'<span></td>
													<td>'.$row['amount'].'</td>
													<td class="d-none d-md-table-cell"><span class="badge bg-info">'.$row['age'].'</span></td>
													<td class="d-none d-md-table-cell">'.$row['date'].'</td>
													
												</tr>												
												';
											}
										}

									?>
										
										
										
										
									</tbody>
								</table>
								</div>
								
							</div>
						</div>

						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header text-center">
									<h3>User browser Logs</h3>
									<!--  -->
								</div>
								<div class="card-body py-0">
									<table class="table table-bordered table-sm" id="logs">
									<thead>
										<tr class="text-center">
											<th>System</th>
											<th>IP Address</th>
											<th>Device</th>
											<th>Login Date</th>
										</tr>
									</thead>
									<tbody>
										<?php

										$getlogs = $conn->prepare("SELECT * FROM browser_logs ORDER BY loggedin_date ASC LIMIT 10");
										$getlogs->execute();
										$result = $getlogs->get_result();
										if($result->num_rows > 0){
											while ($row = $result->fetch_assoc()) {
												echo '
												<tr class="text-center">
													<td>'.$row['platform'].'</td>
													<td>'.$row['ip'].'</td>
													<td>'.$row['device'].'</td>
													<td>'.$row['loggedin_date'].'</td>
												</tr>												
												';
											}
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
	
	<?php
		$browser_chrome = mysqli_query($conn, "SELECT * FROM browser_logs WHERE browser = 'Chrome'");
		$_1 = mysqli_num_rows($browser_chrome);


		$browser_firefox = mysqli_query($conn, "SELECT * FROM browser_logs WHERE browser = 'Firefox'");
		$_2 = mysqli_num_rows($browser_firefox);


		$browser_hand = mysqli_query($conn, "SELECT * FROM browser_logs WHERE browser = 'Android'");
		$count = mysqli_num_rows($browser_hand);
	?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Doughnut chart
			new Chart(document.getElementById("chartjs-doughnut"), {
				type: "bar",
				data: {
					labels: ["Chrome","Firefox","Android Browser"],
					datasets: [{
						data: [<?php echo $_1; ?>,<?php echo $_2; ?>,<?php echo $count; ?>],
						backgroundColor: [
							window.theme.success,
							window.theme.primary,
							window.theme.secondary
						],
						borderColor: "transparent"
					}]
				},
				options: {
					maintainAspectRatio: false,
					cutoutPercentage: 65,
					legend: {
						display: false
					}
				}
			});
		});

		</script>

		<?php
		$montly_client = mysqli_query($conn, "SELECT * FROM monthly_client");
		while ($row = mysqli_fetch_array($montly_client)) {
			$month[] = $row['month'];
			$client[] = $row['no_client'];

		}
		?>
		<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Line chart
			new Chart(document.getElementById("chartjs-line"), {
				type: "line",
				data: {
					labels: <?php echo json_encode($month); ?>,
					datasets: [{
						label: "Clients",
						fill: true,
						borderColor: window.theme.primary,
						data: <?php echo json_encode($client); ?>
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.05)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 500
							},
							display: true,
							borderDash: [5, 5],
							gridLines: {
								color: "rgba(0,0,0,0)",
								fontColor: "#fff"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("#appointment_data").DataTable({
				"paging":false,
				"searching": false
			});  
			$("#logs").DataTable({
				"paging":false,
				"searching": false
			}); 
		});
	</script>
	
</body>

</html>