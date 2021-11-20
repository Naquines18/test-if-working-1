<?php
require_once '../../src/config.php';


if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['password']) ){


    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    
    //sanitize inputs
    $username  = mysqli_real_escape_string($conn, $_POST["username"]);
    $email     = mysqli_real_escape_string($conn, $_POST["email"]);
    $password  = mysqli_real_escape_string($conn, $_POST["password"]);
    $gender    = mysqli_real_escape_string($conn, $_POST["gender"]);


    //remove unwanted characters
    $scan_firstname = validate($username);
    $scan_email     = validate($email);
    $scan_gender    = validate($gender);
    $scan_password  = validate($password);


    $hashed_password        = md5($scan_password);

    //validate email 
    $check_email = mysqli_query($conn,"SELECT client_email FROM client WHERE client_email = '$scan_email' LIMIT 1");
    if(mysqli_num_rows($check_email) > 0){
        $output = array('result' => 'email_used');
        
    }else if(!preg_match("/^[a-zA-Z-' ]*$/",$scan_firstname)){
        $output = array('result' => 'failed_firstname');
        
    }else if(!filter_var($scan_email,FILTER_VALIDATE_EMAIL)){
        $output = array('result' => 'failed_email');

        
    }else if($scan_password == "Password"){
        $output = array('result' => 'failed_password');
        
    }elseif($scan_password == "123"){
        $output = array('result' => 'failed_password');
        
    }elseif($scan_password == "test123"){
        $output = array('result' => 'failed_password');
        
    }elseif($scan_password == "password123"){
        $output = array('result' => 'failed_password');

       
    }elseif($scan_password == "password"){
        $output = array('result' => 'failed_password');
       
    }else{
        $stmt = $conn->prepare("INSERT INTO `advance_user`(`advance_user_name`, `advance_user_email`, `gender`, `advance_user_role`, `advance_user_password`, `profile_image`, `verified`, `advance_user_created`) VALUES (?,?,?,'1',?,'images/default.png','1',CURRENT_DATE())");
        $stmt->bind_param("ssss",$scan_firstname,$scan_email,$scan_gender,$hashed_password);
        if($stmt->execute() == TRUE){
            $output = array('result' => 'success');
        }
        $stmt->close();
        $conn->close();

    }

    echo json_encode($output);
}


if(isset($_POST['id_appointment_delete'])){


    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    
    //sanitize inputs
    $id_appointment_delete    = mysqli_real_escape_string($conn, $_POST["id_appointment_delete"]);


    //remove unwanted characters
    $scan_id_appointment_delete = validate($id_appointment_delete);
 

    
    $stmt = $conn->prepare("DELETE FROM messages WHERE message_id = ? LIMIT 1");
    $stmt->bind_param("s",$scan_id_appointment_delete);
    if($stmt->execute() == TRUE){
        $output = "success";
    }
    $stmt->close();
    $conn->close();
    
    echo ($output);
}

if(isset($_POST['delete_admin'])){


    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    
    //sanitize inputs
    $delete_admin    = mysqli_real_escape_string($conn, $_POST["delete_admin"]);


    //remove unwanted characters
    $scan_delete_admin = validate($delete_admin);
 

    
    $stmt = $conn->prepare("DELETE FROM advance_user WHERE advance_user_id = ? AND advance_user_role = '1' LIMIT 1");
    $stmt->bind_param("s",$scan_delete_admin);
    if($stmt->execute() == TRUE){
        echo "success";
    }
    $stmt->close();
    $conn->close();
    
}