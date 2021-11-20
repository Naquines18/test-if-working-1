<?php
session_start();
require_once '../../src/config.php';
include('../../src/phpqrcode-master/qrlib.php');

if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['age']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['gender']) && isset($_POST['staff']) && isset($_POST['comment']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['establishments'])){

    $output = "";
    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    //sanitize inputs
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
    $establishments = mysqli_real_escape_string($conn, $_POST["establishments"]);

    //Remove unwanted character in inputs
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

        // $output .= 'You already exceeded your appointment. For now just wait to finish the 5 current appointment. For you to have a appointment again';
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
        $stmt = $conn->prepare("INSERT INTO `appointments`( `appointment_fullname`, `appointment_email`, `age`, `phone`, `address`, `city`, `gender`, `patient_comment`, `patient_doctor`,`establishment`,`appointment_created`,date,time,`status`) VALUES (?,?,?,?,?,?,?,?,?,?,CURRENT_DATE(),?,?,'Pending')");

    $stmt->bind_param("ssssssssssss",$scan_fullname,$scan_email,$scan_age,$scan_phone,$scan_address,$scan_city,$scan_gender,$scan_message,$scan_staff,$establishments,$scan_date,$scan_time);
    if($stmt->execute() == TRUE){
        $codeContents = "";



        $main_digit = "456734";
        $last_digit = rand("098745","654345");

        $new_id = $main_digit.$last_digit;


        $tempDir = "../../qr_images/";
        $codeContents = $new_id;


        $fileName = ''.time().'_QRCODE_'.md5($codeContents).'.png';

        $pngAbsoluteFilePath = $tempDir.$fileName;
        $urlRelativeFilePath = $tempDir.$fileName;
        $NewUrlRelativeFilePath = "qr_images/".$fileName;

        // generating
        if (!file_exists($pngAbsoluteFilePath)) {
            QRcode::png($codeContents, $pngAbsoluteFilePath);
            $getid = mysqli_query($conn,"SELECT client_id FROM client WHERE client_email = '$scan_email' LIMIT 1");
            while ($id = mysqli_fetch_assoc($getid)) {
                $userid = $id['client_id'];
            }
            $save_qr = mysqli_query($conn,"INSERT INTO qrcodes (`id_no`,`qr_image`, `qr_user_id`) VALUES ('".$new_id."','".$NewUrlRelativeFilePath."','$userid') ");
            
            $output = array('result' => 'success');
            //header("location: ../dashboard.php");
            

        } else {
            $output = array('result'=> 'qr_failed');
        }
          
    }else {
        $output = array('result' => 'failed');
    }

    
    $stmt->close();
    $conn->close();
    }

    echo json_encode($output);

    



}


