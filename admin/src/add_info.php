<?php
session_start();
require_once '../../src/config.php';
require_once '../../src/token.php';

if(isset($_POST['id']) && isset($_POST['bio']) && isset($_POST['address']) && isset($_POST['mobile']) && isset($_POST['bday']) && isset($_POST['city'])){

    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    //remove unwanted character inputs
    $id      = mysqli_real_escape_string($conn, $_POST['id']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $bio     = mysqli_real_escape_string($conn, $_POST['bio']);
    $birthday= mysqli_real_escape_string($conn, $_POST["bday"]);
    $mobile  = mysqli_real_escape_string($conn, $_POST["mobile"]);
    $city    = mysqli_real_escape_string($conn, $_POST["city"]);
   

    //sanitize input
    $scan_id      = validate($id);
    $scan_address = validate($address);
    $scan_bio     = validate($bio);
    $scan_birthday= validate($birthday);
    $scan_mobile  = validate($mobile);
    $scan_city    = validate($city);


    $stmt = $conn->prepare("INSERT INTO `advance_user_profile`(`admin_address`, `admin_bio`, `admin_mobile`,`admin_advance_user_id`, `city`, `specialization`) VALUES (?,?,?,?,?,'n/a')");
    $stmt->bind_param("sssss",$scan_address,$scan_bio,$scan_mobile,$scan_id,$scan_city);
    if($stmt->execute()){
        echo "1";
    }


    
    $stmt->close();
    $conn->close();      
        
}


if(isset($_POST['update_id']) && isset($_POST['update_bio']) && isset($_POST['update_address']) && isset($_POST['update_mobile']) && isset($_POST['update_bday']) && isset($_POST['update_city'])){

    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    //remove unwanted character inputs
    $id      = mysqli_real_escape_string($conn, $_POST['update_id']);
    $address = mysqli_real_escape_string($conn, $_POST['update_address']);
    $bio     = mysqli_real_escape_string($conn, $_POST['update_bio']);
    $birthday= mysqli_real_escape_string($conn, $_POST["update_bday"]);
    $mobile  = mysqli_real_escape_string($conn, $_POST["update_mobile"]);
    $city    = mysqli_real_escape_string($conn, $_POST["update_city"]);
   

    //sanitize input
    $scan_update_id      = validate($id);
    $scan_update_address = validate($address);
    $scan_update_bio     = validate($bio);
    $scan_update_birthday= validate($birthday);
    $scan_update_mobile  = validate($mobile);
    $scan_update_city    = validate($city);


    $stmt = $conn->prepare("UPDATE `advance_user_profile` SET `admin_address`= ? ,`admin_bio`= ? ,`birthdate`= ? ,`admin_mobile`= ? ,`city`= ? WHERE `admin_advance_user_id`= ? LIMIT 1");
    $stmt->bind_param("ssssss",$scan_update_address,$scan_update_bio,$scan_update_birthday,$scan_update_mobile,$scan_update_city,$scan_update_id);
    if($stmt->execute()){
        echo "1";
    }


    
    $stmt->close();
    $conn->close();      
        
}




if(isset($_POST['doc_add_id']) && isset($_POST['doc_add_address']) && isset($_POST['doc_add_mobile']) && isset($_POST['doc_add_bio']) && isset($_POST['doc_add_city']) && isset($_POST['doc_add_bday'])){

    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    //sanitize input
    $doc_id        = mysqli_real_escape_string($conn, $_POST["doc_add_id"]);
    $doc_address   = mysqli_real_escape_string($conn, $_POST["doc_add_address"]);
    $doc_bio       = mysqli_real_escape_string($conn, $_POST["doc_add_bio"]);
    $doc_birthday  = mysqli_real_escape_string($conn, $_POST["doc_add_bday"]);
    $doc_mobile    = mysqli_real_escape_string($conn, $_POST["doc_add_mobile"]);
    $doc_city      = mysqli_real_escape_string($conn, $_POST["doc_add_city"]);

    //remove unwanted characters
    $scan_doc_id        = validate($doc_id);
    $scan_doc_address   = validate($doc_address);
    $scan_doc_bio       = validate($doc_bio);
    $scan_doc_birthday  = validate($doc_birthday);
    $scan_doc_mobile    = validate($doc_mobile);
    $scan_doc_city      = validate($doc_city);
    

    $stmt = $conn->prepare("INSERT INTO `advance_user_profile`(`admin_address`, `admin_bio`,`admin_mobile`,`birthdate`,`admin_advance_user_id`, `city`, `specialization`) VALUES (?,?,?,?,?,?,'n/a')");
    $stmt->bind_param("ssssss",$scan_doc_address,$scan_doc_bio,$scan_doc_mobile,$scan_doc_birthday,$scan_doc_id,$scan_doc_city);
    if($stmt->execute() == TRUE){
        echo "1";
    }

    
    $stmt->close();
    $conn->close(); 
         
        
}



if(isset($_POST['update_doc_id']) && isset($_POST['update_doc_address']) && isset($_POST['update_doc_mobile']) && isset($_POST['update_doc_bio']) && isset($_POST['update_doc_city']) && isset($_POST['update_doc_bday'])){

    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    //remove unwanted character inputs
    $id      = mysqli_real_escape_string($conn, $_POST['update_doc_id']);
    $address = mysqli_real_escape_string($conn, $_POST['update_doc_address']);
    $bio     = mysqli_real_escape_string($conn, $_POST['update_doc_bio']);
    $birthday= mysqli_real_escape_string($conn, $_POST["update_doc_bday"]);
    $mobile  = mysqli_real_escape_string($conn, $_POST["update_doc_mobile"]);
    $city    = mysqli_real_escape_string($conn, $_POST["update_doc_city"]);
   

    //sanitize input
    $scan_update_id      = validate($id);
    $scan_update_address = validate($address);
    $scan_update_bio     = validate($bio);
    $scan_update_birthday= validate($birthday);
    $scan_update_mobile  = validate($mobile);
    $scan_update_city    = validate($city);


    $stmt = $conn->prepare("UPDATE `advance_user_profile` SET `admin_address`= ? ,`admin_bio`= ? ,`birthdate`= ? ,`admin_mobile`= ? ,`city`= ? WHERE `admin_advance_user_id`= ? LIMIT 1");
    $stmt->bind_param("ssssss",$scan_update_address,$scan_update_bio,$scan_update_birthday,$scan_update_mobile,$scan_update_city,$scan_update_id);
    if($stmt->execute()){
        echo "1";
    }


    
    $stmt->close();
    $conn->close();      
        
}








