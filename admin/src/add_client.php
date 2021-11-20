<?php
require_once '../../src/config.php';

if(isset($_POST['gender']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) ){


    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    
    //sanitize inputs
    $walk_in_firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $walk_in_lastname  = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $walk_in_email     = mysqli_real_escape_string($conn, $_POST["email"]);
    $walk_in_password  = mysqli_real_escape_string($conn, $_POST["password"]);
    $walk_in_gender    = mysqli_real_escape_string($conn, $_POST["gender"]);


    //remove unwanted characters
    $scan_walk_in_firstname = validate($walk_in_firstname);
    $scan_walk_in_lastname  = validate($walk_in_lastname);
    $scan_walk_in_email     = $walk_in_email;
    $scan_walk_in_gender    = validate($walk_in_gender);
    $scan_walk_in_password  = validate($walk_in_password);


    $hashed_password        = md5($scan_walk_in_password);

    //validate email 
    $check_email = mysqli_query($conn,"SELECT client_email FROM client WHERE client_email = '$scan_walk_in_email' ");
    if(mysqli_num_rows($check_email) > 0){
        $output = array('result' => 'email_used');
        
    }else if(!preg_match("/^[a-zA-Z-' ]*$/",$scan_walk_in_firstname)){
        $output = array('result' => 'failed_firstname');
        
    }else if (!preg_match("/^[a-zA-Z-' ]*$/",$scan_walk_in_lastname)) {
        $output = array('result' => 'failed_lastname');
        
    }else if(!filter_var($scan_walk_in_email,FILTER_VALIDATE_EMAIL)){
        $output = array('result' => 'failed_email');

        
    }else if($scan_walk_in_password == "Password"){
        $output = array('result' => 'failed_password');
        
    }elseif($scan_walk_in_password == "123"){
        $output = array('result' => 'failed_password');
        
    }elseif($scan_walk_in_password == "test123"){
        $output = array('result' => 'failed_password');
        
    }elseif($scan_walk_in_password == "password123"){
        $output = array('result' => 'failed_password');

       
    }elseif($scan_walk_in_password == "password"){
        $output = array('result' => 'failed_password');
       
    }else{
        $stmt = $conn->prepare("INSERT INTO `client`( `client_firstname`, `client_lastname`, `client_email`, `client_password`, `client_gender`, `client_image`, `account_created`, `role`, `verified`) VALUES (?,?,?,?,?,'images/default.png',CURRENT_DATE(),'0','1')");
        $stmt->bind_param("sssss",$scan_walk_in_firstname,$scan_walk_in_lastname,$scan_walk_in_email,$hashed_password,$scan_walk_in_gender);
        if($stmt->execute() == TRUE){
            $output = array('result' => 'success');
        }
        $stmt->close();
        $conn->close();

    }

    echo json_encode($output);
}


if(isset($_POST['delete_id'])){
    $delete_id = mysqli_real_escape_string($conn, $_POST["delete_id"]);
        if($delete_id == TRUE){  
            
            $stmt = $conn->prepare("DELETE FROM client WHERE client_id = ? LIMIT 1");
            $stmt->bind_param("s",$delete_id);
            if($stmt->execute()){
                echo 'Account Deleted';
            }else{
                echo 'Error';
            }
            $stmt->close();
            $conn->close();
        }

}



if(isset($_POST['update_id'])){
    $update_id = mysqli_real_escape_string($conn, $_POST["update_id"]);
        if($update_id == TRUE){  
            
            $stmt = $conn->prepare("SELECT * FROM client WHERE client_id = ? LIMIT 1");
            $stmt->bind_param("s",$update_id);
            if($stmt->execute()){
                if($result = $stmt->get_result()){
                    while ($a = $result->fetch_assoc()) {
                        echo 'Success';
                    }
                }else{
                    echo 'Could not fetch data please try again';
                }
            }else{
                echo 'Cound not execute the script please try again.';
            }
            $stmt->close();
            $conn->close();
        }

}
