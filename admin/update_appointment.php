<?php include "src/validation_loggedin.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Update Appointment | MIST Appointment System</title>
	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<?php
    if(isset($_GET['appointment'])){

        function validate($data){
            $data = trim($data);
            $data = htmlspecialchars($data);
            $data = stripcslashes($data);

            return $data;
        }

        $scan_id = validate($_GET['appointment']);
        $scan_fullname = validate($_GET['fullname']);
        $scan_email = validate($_GET['email']);
        $scan_gender = validate($_GET['gender']);
    }else{

    }
?>
<body>
	<div class="wrapper">
	<?php include "includes/sidebar.php"; ?>

		<div class="main">
			<?php include "includes/navbar.php"; ?>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row">
						
						<div class="col-xl-12 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h3>Fill up all the neccesary fields.</h3>
                                    <p>Please fill up all the fields with the correct information to avoid conflict in the future.</p>
								</div>
								<div class="card-body py-3">
                                <?php
                                
                                $stmt = $conn->prepare("SELECT * FROM appointments WHERE appointment_id = ? LIMIT 1");
                                $stmt->bind_param("i", $scan_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result->num_rows === 1){
                                    while ($row = $result->fetch_assoc()) {
                                        echo '

                                        <form id="appointment_update" method="post">
                                        <div class="form-group mb-3">
                                        <input class="form-control mb-3" type="hidden" id="id" name="id" value="'.$row['appointment_id'].'">
                                            <select name="fullname" id="fullname" class="form-control">';
                                            echo '<option value="" selected>-- Select Fullname --</option>';
                                            $getclient = $conn->prepare("SELECT client_firstname,client_lastname  FROM client");
                                            $getclient->execute();
                                            $result = $getclient->get_result();
                                            while($client = $result->fetch_assoc()){
                                                if($scan_fullname == $client['client_firstname'].' '.$client['client_lastname']){

                                                    echo'<option value="'.$client['client_firstname'].' '.$client['client_lastname'].'" selected>'.$client['client_firstname'].' '.$client['client_lastname'].'</option>'; 
                                                }else{
                                                    echo'<option value="'.$client['client_firstname'].' '.$client['client_lastname'].'">'.$client['client_firstname'].' '.$client['client_lastname'].'</option>'; 
                                                }                                              
                                            }                                       
                                                
                                            
                                            
                                            echo '</select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <select name="email" id="email" class="form-control">';
                                            echo'<option value="">-- Select Email Address --</option>';

                                            $getemail = $conn->prepare("SELECT client_email FROM client");
                                            $getemail->execute();
                                            $result = $getemail->get_result();
                                            while($email = $result->fetch_assoc()){
                                                if($scan_email == $email['client_email']){
                                                    echo'<option value="'.$email['client_email'].'" selected>'.$email['client_email'].'</option>';  
                                                }else{
                                                    echo'<option value="'.$email['client_email'].'" selected>'.$email['client_email'].'</option>'; 
                                                }
                                                                                                
                                            }                                       
                                                
                                            
                                        
                                            echo '</select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="number" id="age" name="age" placeholder="Age" value="'.$row['age'].'">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="date" name="date" placeholder="What date you want to go?" id="date" value="'.$row['date'].'">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="time" name="time" placeholder="What date you want to go?" id="time" value="'.$row['time'].'">
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="number" id="phone" name="phone" placeholder="Your current mobile number" value="'.$row['phone'].'">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="city" id="city" name="city" placeholder="Your current city" value="'.$row['city'].'">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="address" id="address" name="address" placeholder="Your current address" value="'.$row['address'].'">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <select class="form-control mb-3" name="gender" id="gender">';
                                                    if($scan_gender == "Male"){
                                                        echo '<option value="Male" selected>Male</option>';
                                                        echo '<option value="Female">Female</option>'; 
                                                    }else{
                                                        echo '<option value="Male">Male</option>';
                                                        echo '<option value="Female" selected>Female</option>';
                                                    }
                                                    echo '</select>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                            <div class="form-group mb-4">
                                            <select name="staff" id="staff" class="form-control">
                                            <option value="" selected>--- Select Staff ---</option>';
                                            
                                            $getdoctor = $conn->prepare("SELECT advance_user_name FROM advance_user WHERE advance_user_role = 2");
                                            $getdoctor->execute();
                                            $result = $getdoctor->get_result();
                                            while($doctor = $result->fetch_assoc()){
                                                
                                            $doc = $doctor['advance_user_name'];
                                            $query = mysqli_query($conn,'SELECT * FROM appointments WHERE patient_doctor = "'.$doc.'"  AND appointment_email = "'.$email.'" ');     
                                                if($query){
                                                    if(mysqli_num_rows($query) === 1){
                                                        echo'<option value="" disabled>Not Available '.$doctor['advance_user_name'].'</option>';
                                                    }else{
                                                        if($doc == $_GET['staff']){
                                                            echo'<option value="'.$doctor['advance_user_name'].'">'.$doctor['advance_user_name'].'</option>';
                                                        }
                                                    }
                                                }                                       
                                                
                                            }
                                        
                                        echo '</select>
                                        </div>
                                        </div>

                                        <div class="form-group mb-2">
                                            <textarea class="form-control mb-3" type="text" name="comment" id="comment" rows="8" placeholder="Actual Message">'.$row['patient_comment'].'</textarea>
                                        </div>

                                        <div class="form-group mb-2">
                                            <button type="submit" class="btn btn-success">Submit Changes</button>
                                        </div>


                                    </form>                                        
                                        ';
                                    }
                                }else{
                                    echo 'No data presented';
                                    die();
                                }
                                $stmt->close();
                                $conn->close();

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
    <script>
        $(document).ready(function(){
        $(document).on('submit', '#appointment_update', function(event){
            event.preventDefault();

            const update_appointment_data = $(this).serialize();

            if($("select[name=fullname]").val() == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Sorry, please select your fullname above.',
                    footer: '<a href>Why do I have this issue?</a>'
                })    
            }else if($("select[name=email]").val() == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Sorry, please select your email above.',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else if($("#age").val() == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Sorry, please enter your age.',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else if($("#city").val() == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Sorry, please enter your city.',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else if($("#address").val() == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Sorry, please enter your address.',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else if($("#phone").val() == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Sorry, please enter your phone number.',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else if($("#date").val() == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Sorry, please enter the date you want to go.',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else if($("#time").val() == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Sorry, please enter the time you want to go.',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else if($("select[name=gender]").val() == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Sorry, please enter your gender.',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else if($("select[name=staff]").val() == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Sorry, please select staff.',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else if($("#comment").val() == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Sorry, please enter your comment/message.',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else{
                $.ajax({
                    url: "src/update_appointment.php",
                    method: "POST",
                    dataType: "json",
                    data: update_appointment_data,
                    success: function(data){
                        if(data.result == "1"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'You already exceeded your 5 consicutive appointment.',
                                footer: '<a href>Why do I have this issue?</a>'
                            }) 
                        }else if(data.result == "2"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Fullname requires text only, please try again',
                                footer: '<a href>Why do I have this issue?</a>'
                            }) 
                        }else if(data.result == "4"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Comment/Message requires text only, please try again',
                                footer: '<a href>Why do I have this issue?</a>'
                            }) 
                        }else if(data.result == "3"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Mobile requires only numbers.',
                                footer: '<a href>Why do I have this issue?</a>'
                            }) 
                        }else if(data.result == "001"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Mobile number requires 11 digit numbers.',
                                footer: '<a href>Why do I have this issue?</a>'
                            }) 
                        }else if(data.result == "5"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Email Address requires "@" symbol, please try again',
                                footer: '<a href>Why do I have this issue?</a>'
                            }) 
                        }else if(data.result == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Success Message',
                                text: 'Horray!!! you have updated a client appointment.',
                                footer: '<a href>Congratulations new data added!</a>'
                            })
                            setInterval(function(){
                                window.location.href="appointments.php"; 
                            }, 2000)
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Something happen when you try to add a appointment,  please try again.',
                                footer: '<a href>Why do I have this issue?</a>'
                            }) 
                        }
                        
                    }

                });
            }
        });

        
        });
    </script>
</body>

</html>