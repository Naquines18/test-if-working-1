<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Update Client | MIST Appointment System</title>
	<link href="css/app.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<?php
    if(isset($_GET['profile'])){
        function validate($data){
            $data = htmlspecialchars($data);
            $data = trim($data);
            $data = stripcslashes($data);

            return $data;
        }

        $scan_id = validate($_GET['profile']);
    }
?>
<body>
	<div class="wrapper">
		<?php include "includes/sidebar.php"; ?>
		<div class="main">
		<?php include "includes/navbar.php"; ?>	

			<main class="content">
				<div class="container-fluid">

					<div class="card">

                        <div class="card-body py-3">
                            <?php

                                $stmt = $conn->prepare("SELECT * FROM client WHERE client_id = ? LIMIT 1");
                                $stmt->bind_param("s",$scan_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result->num_rows === 1){
                                    while ($row = $result->fetch_assoc()) {
                                        echo '
                                        <form id="update_client" method="post">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <label for="firstname">Firstname</label>
                                                    <input class="form-control mb-3" type="hidden" name="id" id="id" value="'.$row['client_id'].'">
                                                    <input class="form-control mb-3" type="text" name="firstname" id="firstname" placeholder="Enter Your Firstname" value="'.$row['client_firstname'].'">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                <label for="lastname">Lastname</label>
                                                    <input class="form-control mb-3" type="text" name="lastname" id="lastname" placeholder="Enter Your Lastname" value="'.$row['client_lastname'].'">
                                                </div>
                                            </div>
                                        </div>
        
                                        
                                        <div class="form-group mb-2">
                                        <label for="email">Email Address</label>
                                            <input class="form-control mb-3" type="text" name="email" id="email" placeholder="Enter Your Email Address" value="'.$row['client_email'].'">
                                        </div>
                                            
        
                                        
        
                                        <div class="form-group mb-2">
                                        <label for="gender">Gender</label>
                                            <select name="gender" class="form-control" id="gender">';

                                            if($_GET['gender']){
                                                echo '
                                                <option value="" readonly disabled>Select your gender</option>
                                                <option value="Male" selected>Male</option>
                                                <option value="Female">Female</option>
                                                
                                                ';
                                            }else{
                                                echo '
                                                <option value="" readonly disabled>Select your gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female" selected>Female</option>
                                                
                                                ';
                                            }
                                                
                                            echo '</select>
                                        </div>
        
                                       <div class="row">
                                            <div class="col-md-8">
                                                <div class="from-group">
                                                <label for="profile_image">Upload profile image</label>
                                                    <input type="file" name="profile_image" class="form-control" id="profile_image" onchange="PreviewImage(this,$(this))">
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-center mt-3">
                                                <img src="../'.$row['client_image'].'" class="rounded-circle img-thumbnail img-fluid" name="image_upload" id="image_upload" alt="Profile Image" width="220">
                                            </div>
                                       </div>
        
                                        <div class="form-group mt-5">
                                            <button type="submit" class="btn btn-success">Update Changes</button>
                                        </div>
        
        
                                    </form>
                                        ';
                                    }
                                    $stmt->close();
                                    $conn->close();
                                }else{
                                    echo ('<script>window.location.href="clients.php"</script>');
                                }

                            ?>  
                        </div>
                        
                    </div>

				</div>
				
			</main>

			<?php include "includes/footer.php"; ?>		
		</div>
	</div>

	<?php include "includes/script.php"; ?>
    <script>    
     function PreviewImage(input, _this) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
	</script>
	<script>

       

		$(document).ready(function(){
			
			$(document).on('submit', '#update_client', function(event) {
                event.preventDefault();
			    const update_form = new FormData($(this)[0]);

                if($("#firstname").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Sorry, please enter your firstname',
                        'error'
                    )
                    return false;
                }else if($("#lastname").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Sorry, please enter your lastname',
                        'error'
                    )
                    return false;
                }else if($("#email").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Sorry, please enter your email address',
                        'error'
                    )
                    return false;
                }else if($("select[name=gender]").val() == 0){
                    Swal.fire(
                        'Error Message',
                        'Sorry, please select your gender',
                        'error'
                    )
                    return false;
                }else if($("#profie_image").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Sorry, please upload your profile image',
                        'error'
                    )
                    return false;
                }else{
                    $.ajax({
                        url: "src/update_client.php",
                        method: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: update_form,
                        success: function(data) {
						if(data == "success"){
                            Swal.fire(
                                'Good job!',
                                'Client information has been successfully updated',
                                'success'
                            )

                            return true;
                        }else if(data == "error"){
                            Swal.fire(
                                'Error Message',
                                'Client information was not updated',
                                'error'
                            )

                            return false;
                        }else if(data == "1"){
                            Swal.fire(
                                'Error Message',
                                'Sorry, file extension is not allowed!',
                                'error'
                            )

                            return false;
                        }else if(data == "2"){
                            Swal.fire(
                                'Error Message',
                                'Sorry, file size exceeded to our limit, please choose different image with low bytes!',
                                'error'
                            )

                            return false;
                        }
                        
					    }
                    
				    });
                }
				
			});

		
		});

	</script>

</body>

</html>