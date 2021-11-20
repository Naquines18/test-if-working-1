<?php
session_start();
require_once 'config.php';
include('phpqrcode-master/qrlib.php');


if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['age']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['city']) && isset($_POST['gender']) && isset($_POST['staff']) && isset($_POST['comment']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['establishments'])){

    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    //sanitize inputs
    $fullname   = ucfirst(mysqli_real_escape_string($conn, $_POST["fullname"]));
    $email      = mysqli_real_escape_string($conn, $_POST["email"]);
    $age        = mysqli_real_escape_string($conn, $_POST["age"]);
    $address    = mysqli_real_escape_string($conn, $_POST["address"]);
    $phone      = mysqli_real_escape_string($conn, $_POST["phone"]);
    $city       = mysqli_real_escape_string($conn, $_POST["city"]);
    $gender     = mysqli_real_escape_string($conn, $_POST["gender"]);
    $staff      = mysqli_real_escape_string($conn, $_POST["staff"]);
    $comment    = mysqli_real_escape_string($conn, $_POST["comment"]);
    $date       = mysqli_real_escape_string($conn, $_POST["date"]);
    $time       = mysqli_real_escape_string($conn, $_POST["time"]);
    $establishments       = mysqli_real_escape_string($conn, $_POST["establishments"]);


    $check_appointment = mysqli_query($conn,"SELECT * FROM appointments WHERE appointment_email = '$email'");
    if(mysqli_num_rows($check_appointment) === 5){
        $output = array('result' => 'exceeded');
    }
   
    if(!preg_match("/^[a-zA-Z-' ]*$/",$fullname)){
        $output = array('result' => 'char_error');
    }else if (!preg_match("/^[a-zA-Z-' ]*$/",$comment)) {
        $output = array('result' => 'char_error_3');
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $output = array('result' => 'email_error');
    }
    
    $scan_fullname = validate(ucfirst($fullname));
    $scan_email    = validate($email);
    $scan_age      = validate($age);
    $scan_phone    = validate($phone);
    $scan_address  = validate($address);
    $scan_city     = validate($city);
    $scan_gender   = validate($gender);
    $scan_staff    = validate($staff);
    $scan_comment  = validate(ucfirst($comment));
    $scan_date     = validate($date);
    $scan_time     = validate($time);


    $stmt = $conn->prepare("INSERT INTO `appointments`( `appointment_fullname`, `appointment_email`, `age`, `phone`, `address`, `city`, `gender`, `patient_comment`, `patient_doctor`,`establishment`,`appointment_created`, `date`,`time`,`status`) VALUES (?,?,?,?,?,?,?,?,?,?,NOW(),?,?,'Pending')");

    $stmt->bind_param("ssssssssssss",$scan_fullname,$scan_email,$scan_age,$scan_phone,$scan_address,$scan_city,$scan_gender,$scan_comment,$scan_staff,$establishments,$scan_date,$scan_time);
    if($stmt->execute() == TRUE){
        $codeContents = "";


        $main_digit = "456734";
        $last_digit = rand("098745","654345");

        $new_id = $main_digit.$last_digit;


        $tempDir = "../qr_images/";
        $codeContents = $new_id;

        $fileName = ''.time().'_QRCODE_'.md5($codeContents).'.png';

        $pngAbsoluteFilePath = $tempDir.$fileName;
        $urlRelativeFilePath = $tempDir.$fileName;
        $NewUrlRelativeFilePath = "qr_images/".$fileName;

        // generating
        if (!file_exists($pngAbsoluteFilePath)) {
            QRcode::png($codeContents, $pngAbsoluteFilePath);

            $save_qr = mysqli_query($conn,"INSERT INTO qrcodes (`id_no`,`qr_image`, `qr_user_id`) VALUES ('".$new_id."','".$NewUrlRelativeFilePath."','".$_SESSION['client_id']."') ");
            
            $output = array('result' => 'success');
            

        } else {
            $output = array('result' => 'qr_failed');
        }
          
    }else {
        $output = array('result' => 'failed');
    }

    echo json_encode($output);


    $stmt->close();
    $conn->close();
    

    

}


