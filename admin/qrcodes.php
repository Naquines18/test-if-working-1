<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "includes/meta.php"; ?>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>QR CODE IMAGES | Online Appointment System | Makilala Institute System and Information</title>

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
                    <h3>CLIENT QR CODE IMAGES</h3>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-bordered my-0" id="log_data">
                      <thead>
                        <tr class="text-center">
                          <th>No.</th>
                          <th>Fullname</th>
                          <th>ID No.</th>
                          <th>QR CODE IMAGE</th>
                          <th>USER ID</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $i = 1;
                        $getQR = $conn->prepare("SELECT * FROM qrcodes INNER JOIN client ON qrcodes.qr_user_id = client.client_id");
                        $getQR->execute();       
                        $result = $getQR->get_result();
                        
                          while($row = $result->fetch_assoc()){
                          echo '
                          <tr class="text-center">
                            <td>'.$i++.'.</td>
                            <td>'.$row['client_firstname'].' '.$row['client_lastname'].'</td>
                            <td>'.$row['id_no'].'</td>
                            <td class="text-center"><img src="../'.$row['qr_image'].'" class=""></td>
                            <td>'.$row['qr_user_id'].'</td>
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.2/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/datatables.min.js"></script>
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
                           window.location.href="index.php"; 
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
              dom: 'Bfrtip',
              buttons: [
                'pdf',
                'excel',
                'print'
              ],
              "paging":false,
            });


            $(document).on('click', '#print_report_data', function(event){
              event.preventDefault();

              const report = 'report';

              const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
              },
              buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
              title: 'Are you sure you want to print a report?',
              text: "You won't be able to revert this!",
              icon: 'info',
              showCancelButton: true,
              confirmButtonText: 'Yes, Print it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {

              if (result.isConfirmed) {

                $.ajax({
                    url: "src/print_data_report.php",
                    method: "POST",
                    data : {
                        'report': report,
                    },
                    success: function(event){
                        if(event == "success"){
                            if (result.isConfirmed) {
                                Swal.fire(
                                  'Success Message!',
                                  'Please wait while we setting up for you! Your browser will refresh after 3 seconds',
                                  'success'
                                )
                            }

                          setInterval(function(){
                           window.location.href="log?page=log_page"; 
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
    </script>
</body>

</html>