<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Visit Profile Information | MIST Appointment System</title>
	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
	<div class="wrapper">
		<?php include "includes/sidebar.php"; ?>

		<div class="main">
		<?php include "includes/navbar.php"; ?>

			<main class="content">
				<div class="container-fluid p-0">

					<?php
					if(isset($_GET['profile_id'])){
					
                    $profile_id = htmlspecialchars($_GET['profile_id']);    
						
					
                    $getinformation = $conn->prepare("SELECT * FROM advance_user INNER JOIN advance_user_profile ON advance_user.advance_user_id = advance_user_profile.admin_advance_user_id  WHERE advance_user.advance_user_id = ? LIMIT 1");

                    $getinformation->bind_param("s", $profile_id);
                    $getinformation->execute();
                    $result = $getinformation->get_result();

                    if($result->num_rows === 1){
                            while ($row = $result->fetch_assoc()) {
                                echo '
                                    <h1 class="h3 mb-3">Profile</h1>
        
                                    <div class="row">
                                        <div class="col-md-4 col-xl-3">
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">About Details</h5>
                                                </div>
                                                <div class="card-body text-center">
                                                    <img src="'.$row['profile_image'].'" alt="'.$row['advance_user_name'].'" class="img-fluid rounded mb-2" width="128" height="128" />
                                                    <h5 class="card-title mb-0">'.$row['advance_user_name'].' </h5>
                                                    <div class="text-muted mb-2">';
                                                    if($row['verified'] == "1"){
                                                        echo '<small>Account Verified</small>';
                                                    }else{
                                                        echo '<small>Account Not Verified</small>';
                                                    }
                                                    echo '</div>
                
                                                    <div>
                                                        <a href="settings.php" class="btn btn-dark btn-sm">Update Info</a>         
                                                    </div>
                                                </div>
                                                <hr class="my-0" />
                                                <div class="card-body">
                                                    <h5 class="h6 card-title">About</h5>
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#">'.$row['admin_address'].'</a></li>
                
                                                        <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Account type<a href="#"> Client</a></li>
                                                        <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> Gender <a href="#">'.$row['gender'].'</a></li>
                                                    </ul>
                                                </div>
                                                <hr class="my-0" />
                                            </div>
                                        </div>
                
                                        <div class="col-md-8 col-xl-9">
                                            <div class="card mt-2">
                                                <div class="card-header">
                                                    <h3 class="card-title mb-0">Informations</h3>
                                                </div>
                
                                            <div class="card-body h-100">							
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                    <h6 class="mb-0">Firstname: </h6>
                                                    </div>
                                                    <div class="col-sm-8 text-secondary">
                                                    '.$row['advance_user_name'].'
                                                    </div>
                                                </div>
                                                <hr>
                                            
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                    <h6 class="mb-0">Email Address: </h6>
                                                    </div>
                                                    <div class="col-sm-8 text-secondary">
                                                    '.$row['advance_user_email'].'
                                                    </div>
                                                </div>
                                            
                                            <hr>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                    <h6 class="mb-0">Address: </h6>
                                                    </div>
                                                    <div class="col-sm-8 text-secondary">
                                                    '.$row['admin_address'].'
                                                    </div>
                                                </div>
                                            
                                            <hr>
        
                                            
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                    <h6 class="mb-0">Mobile No: </h6>
                                                    </div>
                                                    <div class="col-sm-8 text-secondary">
                                                    '.$row['admin_mobile'].'
                                                    </div>
                                                </div>
                                            <hr>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                    <h6 class="mb-0">Account Created: </h6>
                                                    </div>
                                                    <div class="col-sm-8 text-secondary">
                                                    '.$row['advance_user_created'].'
                                                    </div>
                                                </div>
                                            <hr>	
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                    <h6 class="mb-0">Account Type: </h6>
                                                    </div>
                                                    <div class="col-sm-8 text-secondary">
                                                    Client
                                                    </div>
                                                </div>    
                                                <hr>  
            
                                                
            
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                ';
                            
        
                            
        
                            
                        $getinformation->close();
                        $conn->close();
                        }
                    }else{
                        echo "This person dont have a profile yet";
                    }
                
            }else{
                echo "HAHAHAHA";
            }

			?>

				</div>
			</main>

			<?php include "includes/footer.php"; ?>
		</div>
	</div>

	<?php include "includes/script.php"; ?>       
</body>

</html>