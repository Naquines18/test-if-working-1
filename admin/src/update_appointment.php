<?php
require_once '../../src/config.php';

if(isset($_POST['id']) && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['age']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['gender']) && isset($_POST['staff']) && isset($_POST['comment'])  && isset($_POST['date'])  && isset($_POST['time'])){

    $output = "";
    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    //sanitize inputs
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $email   =   mysqli_real_escape_string($conn, $_POST["email"]);
    $age     =   mysqli_real_escape_string($conn, $_POST["age"]);
    $address =  mysqli_real_escape_string($conn, $_POST["address"]);
    $phone   =   mysqli_real_escape_string($conn, $_POST["phone"]);
    $city    =   mysqli_real_escape_string($conn, $_POST["city"]);
    $gender  =   mysqli_real_escape_string($conn, $_POST["gender"]);
    $staff   = mysqli_real_escape_string($conn, $_POST["staff"]);
    $message = mysqli_real_escape_string($conn, $_POST["comment"]);

    $date   = mysqli_real_escape_string($conn, $_POST["date"]);
    $time = mysqli_real_escape_string($conn, $_POST["time"]);

    //Remove unwanted character in inputs
    $scan_id        = validate(ucfirst($id));
    $scan_fullname  = validate(ucfirst($fullname));
    $scan_email     = validate($email);
    $scan_age       = validate($age);
    $scan_address   = validate(ucfirst($address));
    $scan_phone     = validate($phone);
    $scan_gender    = validate($gender);
    $scan_staff     = validate($staff);
    $scan_message   = validate($message);
    $scan_city      = validate(ucfirst($city));

    $scan_date     = validate($date);
    $scan_time    = validate($time);


      
    $check_appointment = mysqli_query($conn,"SELECT * FROM appointments WHERE appointment_email = '$scan_email'");
    if(mysqli_num_rows($check_appointment) === 5){
        $output = array('result' => '1');
    }else if(!preg_match("/^[a-zA-Z-' ]*$/",$scan_fullname)){
        $output = array('result' => '2');
    }else if (!preg_match("/^[\.a-zA-Z0-9,!? ]*$/",$scan_message)) {
        $output = array('result' => '4');
    }else if (!preg_match("/^[0-9]*$/",$scan_phone)) {
        $output = array('result' => '3');
    }else if (strlen($scan_phone) > 11) {
        $output = array('result' => '001');
    }else if(!filter_var($scan_email,FILTER_VALIDATE_EMAIL)){
        $output = array('result' => '5');
    }else {
        $stmt = $conn->prepare("UPDATE `appointments` SET `appointment_fullname`= ?,`appointment_email`= ?,`age`= ?,`phone`= ?,`address`= ?,`city`= ?,`gender`= ?,`patient_comment`= ?,`patient_doctor`= ?,`appointment_created`= CURRENT_DATE(),date = ?,time = ?,`status`= 'Pending' WHERE appointment_id = ? LIMIT 1");

    $stmt->bind_param("ssssssssssss",$scan_fullname,$scan_email,$scan_age,$scan_phone,$scan_address,$scan_city,$scan_gender,$scan_message,$scan_staff,$scan_date,$scan_time,$scan_id);
    if($stmt->execute() == TRUE){
        $output = array('result' => 'success');
    }else {
        $output = array('result' => 'failed');
    }

    
    $stmt->close();
    $conn->close();
    }

    echo json_encode($output);

    



}


