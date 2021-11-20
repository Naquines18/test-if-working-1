<?php
session_start();
require_once 'config.php';
require_once 'token.php';

if(isset($_POST['client_id']) AND isset($_POST['fname']) AND isset($_POST['lname']) AND isset($_POST['email']) AND isset($_FILES['image_upload']) AND isset($_POST['gender'])){

    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    //sanitize inputs
    $id              = validate($_POST['client_id']);
    $fname           = ucfirst(validate(mysqli_real_escape_string($conn, $_POST["fname"])));
    $lname           = ucfirst(validate(mysqli_real_escape_string($conn, $_POST["lname"])));
    $email           = validate(mysqli_real_escape_string($conn, $_POST["email"]));
    $gender          = validate(mysqli_real_escape_string($conn, $_POST["gender"]));
    $file_temp_name  = $_FILES['image_upload']['tmp_name'];
    $file_name       = $_FILES['image_upload']['name'];
    $file_extension  = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    $file_size       = $_FILES['image_upload']['size'];
    //array of file extension that is valid or accepted
    $extension_array = ["jpeg","png","jpg","gif"];

    if(empty($_POST['fname'])){
        echo "Fullname is required";
    }elseif(!preg_match("/^[a-zA-Z' ]*$/",$_POST['fname'])){
        echo "Fullname required only text character.";
    }
    
    

    if(empty($_FILES['image_upload'])){
        echo 'Please choose your profile image. This field is required';
        die();
    }elseif(!in_array($file_extension,$extension_array)){
        echo 'Your file is invalid. Please try a another one';
        die();
    }elseif($file_size > 700000){
        echo 'Your profile image is exceeded to our file size limitation.';
        die();
    }else{
        $image = "../images/".$file_name;
        $location = "images/".$file_name;    
        if(move_uploaded_file($file_temp_name, $image)){
            $stmt = $conn->prepare("UPDATE client SET client_firstname = ?, client_lastname= ? , client_email = ?, client_gender = ?, client_image = ? WHERE client_id = ? LIMIT 1");
            $stmt->bind_param("sssssi",$fname,$lname,$email,$gender,$location,$id);
                if($stmt->execute() == TRUE){
                    echo "success";
                }
        }else{
            echo 'Image Upload Failed';
        }

       

        
    }  
        
}



if(isset($_POST['id']) AND isset($_POST['address']) AND isset($_POST['mobile']) AND isset($_POST['birthday'])){

    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    //sanitize inputs
    $id         = validate($_POST['id']);
    $address    = ucfirst(validate(mysqli_real_escape_string($conn, $_POST["address"])));
    $mobile     = ucfirst(validate(mysqli_real_escape_string($conn, $_POST["mobile"])));
    $birthday   = validate(mysqli_real_escape_string($conn, $_POST["birthday"]));
   

    $stmt = $conn->prepare("UPDATE `client_profile` SET `client_profile_address`= ?,`client_profile_birthday`= ?,`client_profile_phone`=? WHERE client_id = ? LIMIT 1");
    $stmt->bind_param("ssss",$address,$birthday,$mobile,$id);
        if($stmt->execute()){
            echo "success";
        }else{
            echo "error";
        }
    $stmt->close();
    $conn->close();

}


if(isset($_POST['add_id']) AND isset($_POST['add_address']) AND isset($_POST['add_mobile']) AND isset($_POST['add_birthday'])){

    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    //sanitize inputs
    $id         = validate($_POST['add_id']);
    $address    = ucfirst(validate(mysqli_real_escape_string($conn, $_POST["add_address"])));
    $mobile     = ucfirst(validate(mysqli_real_escape_string($conn, $_POST["add_mobile"])));
    $birthday   = validate(mysqli_real_escape_string($conn, $_POST["add_birthday"]));
   

    $stmt = $conn->prepare("INSERT INTO `client_profile`(`client_id`, `client_profile_address`, `client_profile_birthday`, `client_profile_phone`) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$id,$address,$birthday,$mobile);
        if($stmt->execute()){
            echo "success";
        }else{
            echo "error";
        }
    $stmt->close();
    $conn->close();

}













