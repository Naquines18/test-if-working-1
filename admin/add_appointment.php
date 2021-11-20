<?php include "src/validation_loggedin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/meta.php"; ?>
	<title>Dashboard | Add Walk In Appointment | MIST Appointment System</title>

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
					<div class="row">
						
						<div class="col-xl-12 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h3>Fill up all the neccesary fields.</h3>
                                    <p>Please fill up all the fields with the correct information to avoid conflict in the feauture.</p>
								</div>
								<div class="card-body py-3">
                                <form id="add_appointment" method="post">
                                        <div class="form-group mb-3">
                                            <select name="fullname" id="fullname" class="form-control">
                                            <option value="" selected>--- Select Fullname ---</option>
                                            <?php
                                            $getclient = $conn->prepare("SELECT client_firstname,client_lastname  FROM client");
                                            $getclient->execute();
                                            $result = $getclient->get_result();
                                            while($client = $result->fetch_assoc()){
                                                echo'<option value="'.$client['client_firstname'].' '.$client['client_lastname'].'">'.$client['client_firstname'].' '.$client['client_lastname'].'</option>';                                                  
                                            }                                       
                                                
                                            
                                            ?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <select name="email" id="email" class="form-control">
                                            <option value="" selected>--- Select Email ---</option>
                                            <?php
                                            $getemail = $conn->prepare("SELECT client_email FROM client");
                                            $getemail->execute();
                                            $result = $getemail->get_result();
                                            while($email = $result->fetch_assoc()){
                                                echo'<option value="'.$email['client_email'].'">'.$email['client_email'].'</option>';                                                  
                                            }                                       
                                                
                                            
                                            ?>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="number" id="age" name="age" placeholder="Age">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="date" name="date" placeholder="What date you want to go?" id="date">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="time" name="time" placeholder="What date you want to go?" id="time">
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="number" id="phone" name="phone" placeholder="Your current mobile number">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <input class="form-control mb-3" type="city" id="city" name="city" placeholder="Your current city">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                    <input class="form-control mb-3"id="address" type="address" name="address" placeholder="Your current address">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <select class="form-control mb-3" id="gender" name="gender">
                                                        <option value="" selected>--- Select Gender ---</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                            <div class="form-group mb-4">
                                            <select name="staff" id="staff" class="form-control">
                                            <option value="" selected>--- Select Staff ---</option>
                                            <?php
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
                                                        echo'<option value="'.$doctor['advance_user_name'].'">'.$doctor['advance_user_name'].'</option>';
                                                    }
                                                }                                       
                                                
                                            }
                                            ?>
                                        </select>
                                        </div>
                                        </div>

                                        <div class="form-group mb-2">
                                            <select name="establishments" class="form-control" id="establishments" required>
                                            <?php
                                                $query = mysqli_query($conn,"SELECT * FROM establishments");
                                                echo '<option value="none" selected>Select Establishment</option>';
                                                foreach($query as $row){
                                                    echo '<option value="'.$row["establishments_id"].'">'.$row["establishments_name"].'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-2">
                                            <textarea class="form-control mb-3" type="text" id="comment" name="comment" rows="8" placeholder="Actual Message"></textarea>
                                        </div>

                                        <div class="form-group mb-2">
                                            <button type="submit" class="btn btn-dark">Submit Appointment</button>
                                        </div>


                                    </form>
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
        $(document).on('submit', '#add_appointment', function(event){
            event.preventDefault();

            const add_appointment_data = $(this).serialize();

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
                    url: "src/appointment.php",
                    method: "POST",
                    dataType: "json",
                    data: add_appointment_data,
                    success: function(data){
                        if(data.result == "1"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'You already exceeded your appointment. For now just wait to finish the 5 current appointment. For you to have a appointment again',
                            }) 
                        }else if(data.result == "2"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Fullname requires text only, please try again',
                            }) 
                        }else if(data.result == "4"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Comment/Message requires text only, please try again',
                            }) 
                        }else if(data.result == "3"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Mobile requires only numbers.',
                            }) 
                        }else if(data.result == "001"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Mobile number requires 11 digit numbers.',
                            }) 
                        }else if(data.result == "5"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Email Address requires "@" symbol, please try again',
                            }) 
                        }else if(data.result == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Success Message',
                                text: 'Horray!!! you have addedd a new walkin appointment.',
                            })
                            $("#add_appointment")[0].reset(); 
                        }else if(data.result == "qr_failed"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Sorry, but your QR CODE is already generated.',
                            }) 
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Message',
                                text: 'Something happen when you try to add a appointment,  please try again.',
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