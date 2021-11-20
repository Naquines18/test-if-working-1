<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Update Staff | MIST Appointment System</title>
	<link href="css/app.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<?php
    if(isset($_GET['doctor'])){
        function validate($data){
            $data = htmlspecialchars($data);
            $data = trim($data);
            $data = stripcslashes($data);

            return $data;
        }

        $scan_id = validate($_GET['doctor']);
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

                                $stmt = $conn->prepare("SELECT * FROM advance_user WHERE advance_user_id = ? LIMIT 1");
                                $stmt->bind_param("s",$scan_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result->num_rows === 1){
                                    while ($row = $result->fetch_assoc()) {
                                        echo '
                                        <form action="src/update_staff.php" method="post" enctype="multipart/form-data">

                                        
                                        <div class="form-group mb-2">
                                            <label for="username">Username</label>
                                            <input type="hidden" name="id" id="id" value="'.$row['advance_user_id'].'">
                                            <input class="form-control mb-3" type="text" name="username" id="username" placeholder="Enter Your Username" value="'.$row['advance_user_name'].'">
                                        </div>
                                            
        
                                        
                                        <div class="form-group mb-2">
                                            <label for="email">Email Address</label>
                                            <input class="form-control mb-3" type="text" name="email" id="email" placeholder="Enter Your Email Address" value="'.$row['advance_user_email'].'">
                                        </div>
                                            
        
                                        
        
                                        <div class="form-group mb-2">
                                        <label for="gender">Gender</label>
                                            <select name="gender" class="form-control" id="gender">';

                                            if($row['gender'] == "Male"){
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
                                            <div class="col-md-4">
                                                <img src="'.$row['profile_image'].'" class="thumbnail rounded-corner" name="image_upload" id="image_upload" alt="Profile Image" width="200">
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
			
			$(document).on('submit', '#update_staff', function(event) {
                event.preventDefault();
			    const update_staff = new FormData($(this)[0]);

                if($("#username").val() == ""){
                    Swal.fire(
                        'Error Message',
                        'Sorry, please enter your firstname',
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
                }else if($("#gender").val() == ""){
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
					url: "src/update_staff.php",
					method: "POST",
					data: update_staff,
                    cache: false,
                    contentType: false,
                    processData: false,
					success: function(data) {
						if(data == "success"){
                            Swal.fire(
                                'Good job!',
                                'Client information has been successfully updated',
                                'warning'
                            )

                            return true;
                        }else if(data == "error"){
                            Swal.fire(
                                'Error Message',
                                'Client information was not updated',
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