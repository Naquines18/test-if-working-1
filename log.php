<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "meta.php"; ?>


	<title>QR CODE Logs | Online Appointment System | Makilala Institute System and Information</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.2/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/datatables.min.css"/>



</head>
<style type="text/css">
    .hide{
        display: none;
    }
</style>
<body>
	<div class="wrapper">
	<?php include "includes/sidebar.php"; ?>

		<div class="main">
			<?php include "includes/navbar.php"; ?>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row">
						
						
            <div class="card">
                <div class="card-header">
                  <div class="card-title">
                    <h3>YOUR QR CODE LOGS</h3>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
              <table class="table table-bordered my-0" id="log_data">
                  <thead>
                    <tr class="text-center">
                      <th>No.</th>
                      <th>ID No.</th>
                      <th>Fullname</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Time In</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $i = 1;
                    $fullname = $_SESSION['client_firstname']." ".$_SESSION['client_lastname'];
                    $getLogs = $conn->prepare("SELECT * FROM log_qr WHERE fullname = ?");
                    $getLogs->bind_param("s",$fullname);
                    $getLogs->execute();       
                    $result = $getLogs->get_result();
                    
                      while($row = $result->fetch_assoc()){
                      echo '
                      <tr>
                        <td>'.$i++.'.</td>
                        <td>'.$row['id_no'].'</td>
                        <td>'.$row['fullname'].'</td>
                        <td>'.$row['address'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>'.$row['time_in'].'</td>
                        <td class="bg-dark text-light text-center">'.$row['status'].'</td>
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

    <script type="text/javascript">
        $(document).ready(function(){

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
            
        


            $("#log_data").DataTable({
              'paging': false,
            });
    
        });
    </script>
</body>

</html>