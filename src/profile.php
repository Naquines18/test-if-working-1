<?php
session_start();
require_once 'config.php';
require_once 'token.php';

if(isset($_POST['add_profile'])){

    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    //sanitize inputs
    $id = validate($_SESSION['client_id']);
    $address    = ucfirst(validate(mysqli_real_escape_string($conn, $_POST["address"])));
    $birthday   = ucfirst(validate(mysqli_real_escape_string($conn, $_POST["birthday"])));
    $mobile     = validate(mysqli_real_escape_string($conn, $_POST["mobile"]));
    

    if(empty($_POST['address'])){
        header('location: ../settings?token='.$token_url.'&&error=Address is mandatory.&&token="'.$token_url.'"');
    }elseif(!preg_match("/^[a-zA-Z' ]*$/",$address)){
        header('location: ../settings?token='.$token_url.'&&error=Sorry address requires a text.');
    } 

    
    $stmt = $conn->prepare("INSERT INTO `client_profile`(`client_id`, `client_profile_address`, `client_profile_birthday`, `client_profile_phone`) VALUES (?,?,?,?)");
    $stmt->bind_param("isss",$id,$address,$birthday,$mobile);
        if($stmt->execute() == TRUE){
            header('location: ../profile?token='.$token_url.'&&v1='.$v1.'&&message=You have successfully add your information.');
            die();
        }
    $stmt->close();
    $conn->close();

        
}





