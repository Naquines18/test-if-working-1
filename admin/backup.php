<?php include "src/validation_loggedin.php"; ?>
<?php 
$message = '';
if(isset($_POST["import"]))
{
 if($_FILES["sql_file"]["name"] != '')
 {
  $array = explode(".", $_FILES["sql_file"]["name"]);
  $extension = end($array);
  if($extension == 'sql')
  {
    include "../src/config.php";
   $output = '';
   $count = 0;
   $file_data = file($_FILES["sql_file"]["tmp_name"]);
   foreach($file_data as $row)
   {
    $start_character = substr(trim($row), 0, 2);
    if($start_character != '--' || $start_character != '/*' || $start_character != '//' || $row != '')
    {
     $output = $output . $row;
     $end_character = substr(trim($row), -1, 1);
     if($end_character == ';')
     {
      if(!mysqli_query($conn, $output))
      {
       $count++;
      }
      $output = '';
     }
    }
   }
   if($count > 0)
   {
    $message = '<label class="text-danger">There is an error in Database Import</label>';
   }
   else
   {
    $message = '<label class="text-success">Database Successfully Imported</label>';
   }
  }
  else
  {
   $message = '<label class="text-danger">Invalid File</label>';
  }
 }
 else
 {
  $message = '<label class="text-danger">Please Select Sql File</label>';
 }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "includes/meta.php"; ?>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Database Management | Online Appointment System | Makilala Institute System and Information</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.2/r-2.2.9/datatables.min.css"/>



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
                                <h3>MANAGE DATABASE DATA</h3>
                                <p class="text-muted">Take note! making a backup of your data is important!</p>

                                <div align="right" class="mb-2">
                                    <a class="btn btn-primary" href="src/backup.php" id="print_report_data">Backup My Database</a>
                                </div>
                            </div>
                            </div>
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                <table class="table table-bordered mb-0" id="tables">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Table Name</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                        include "../src/config.php";

                                        $showtables = mysqli_query($conn,"SHOW TABLES");
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($showtables)) {
                                            echo '
                                                <tr>
                                                    <th scope="row">'.$i++.'</th>
                                                    <td>'.$row['Tables_in_barangaydb'].'</td>
                                                    <td><button id="drop_table" class="btn btn-danger" data-table_name="'.$row['Tables_in_barangaydb'].'">Delete</button></td>
                                                </tr>';
                                        }
                                ?>
                                </tbody>
                                </table>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="h3">Upload Your SQL file.</div>
                                            <small class="text-danger">Make sure you already cleaned up / remove all the table in your database before uploading this file to server.</small>
                                            <small class="text-danger mt-3">Take note! This action will be use if you migrate to another hosting provider.</small>
                                        </div>
                                        <div class="card-body">
                                            
                                            
                                            <form action="backup.php" method="post" class="mt-2" enctype="multipart/form-data">
                                                <input type="file" name="sql_file" id="sql_file">
                                                <?php echo $message; ?>
                                                <div align="right">
                                                    <button type="submit" class="btn btn-primary mt-2" name="import">Import SQL file</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
            
            $("#tables").DataTable({
              "paging":false,
            });
        
            $(document).on('click', '#drop_table', function(event){
            event.preventDefault();
            const data = $(this).data('table_name');


            const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
              },
              buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
              title: 'Are you sure you want to delete this ' + $(this).data('table_name') + ' table?',
              text: "Your system will be mess after this.",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {

              if (result.isConfirmed) {

                $.ajax({
                    url: "src/drop_table.php",
                    method: "POST",
                    data : {
                        'data': data,
                    },
                    success: function(event){
                        if(event == "success"){
                            if (result.isConfirmed) {
                                Swal.fire(
                                  'Success Message!',
                                  'You successfuly deleted the table',
                                  'success'
                                )
                            }

                          setInterval(function(){
                           window.location.href="backup"; 
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

        });
    </script>
</body>

</html>