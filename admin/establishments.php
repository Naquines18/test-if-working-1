<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Establishment Settings | MIST Appointment System</title>

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

						<h3>Manage Establishment Data</h3>
								

							<div align="right">
								<a href="add_establishment.php" class="btn btn-dark"><i class="align-middle text-white" data-feather="plus"></i> Create Establishment</a>
							</div>   
							
						</div>                        
						
						<div class="card-body py-0">
							

								<div class="row">
                            <div class="col-md-12 w-100 table-responsive">
                                
                            <?php
									echo '
									<table class="table table-bordered my-0" id="myTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>Establishment</th>
                                            <th>Establishment Description</th>
                                            <th>Establishment Mobile No</th>
											<th>Establishment Payment</th>
											<th>Establishment Total Money</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>';
                                    $stmt = $conn->prepare("SELECT * FROM `establishments` ");
									$stmt->execute();
									$result = $stmt->get_result();
									$i = 1;
									while($row = $result->fetch_assoc()){
									
									$getAllMoney = mysqli_query($conn,"SELECT SUM(amount) FROM establisment_payments WHERE establishment = '".$row["establishments_name"]."' ");
									$fetch = mysqli_fetch_array($getAllMoney);

									if(mysqli_num_rows($getAllMoney) > 0){
										for($int = 0; count($fetch) < 0; $int++){
											// echo $int;
										}
									}
									echo '
									<tbody>
									<tr class="text-center">
										<td>'.$i++.'</td>
										<td>'.$row['establishments_name'].'</td>
										<td>'.$row['establishments_desc'].'</td>
										<td>'.$row['establishments_mobile'].'</td>
										<td>'.$row['establishment_payment_amout'].'</td>
										<td> <span class="badge bg-primary"> ₱ '.number_format($fetch[$int++],0,".",",").'  </span> </td>
										<td class="text-center">
											<div class="btn-group">
												<a class="btn btn-outline-dark" href="update_establishment.php?establishment_id='.$row['establishments_id'].'&&establishments_name='.$row['establishments_name'].'&&establishments_desc='.$row['establishments_desc'].'&&establishments_mobile='.$row['establishments_mobile'].'&&amount='.$row['establishment_payment_amout'].'">Update</a>
                                                <a class="btn btn-outline-danger" href="src/delete_establishment.php?establishment_id='.$row['establishments_id'].'">Delete</a>
											</div>
										</td>
										</tr>
									</tbody>
									';
									}

	
                                echo '</table>
									';	

							?>
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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.2/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/datatables.min.js"></script>
	<script>
	$(document).ready(function(){

		$('#myTable').DataTable({
			"paging":false,
            dom: 'Bfrtip',
			buttons: [
				'copy',
				'excel',
				'print',
				'pdf'
			],
		});

	});

	
	</script>
</body>

</html>