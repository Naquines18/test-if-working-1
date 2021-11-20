<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Users Messages List | MIST Appointment System</title>

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

						<h3>Users Messages List</h3>
							
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
                                            <th>Fullname</th>
                                            <th>Message</th>
                                            <th>From</th>
											<th>Reciever</th>
											<th>Subject</th>
                                            <th>Date Sent</th>
                                        </tr>
                                    </thead>';
                                    $stmt = $conn->prepare("SELECT * FROM `messages` ");
									$stmt->execute();
									$result = $stmt->get_result();
									$i = 1;
									while($row = $result->fetch_assoc()){
									
									echo '
									<tbody>
                                        <tr class="text-center">
                                            <td>'.$i++.'</td>
                                            <td>'.$row['fullname'].'</td>
                                            <td>'.$row['body'].'</td>
                                            <td>'.$row['from'].'</td>
                                            <td><span class="badge bg-info">Administrator</span></td>
                                            <td>'.$row['subject'].'</td>
                                            <td>'.$row['message_date'].'</td>
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