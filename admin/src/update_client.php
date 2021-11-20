<?php
require_once '../../src/config.php';


if(isset($_POST['id']) && isset($_POST['firstname']) && isset($_POST['lastname']) &&  isset($_POST['gender']) && isset($_POST['email']) && isset($_FILES['profile_image'])){


    function validate($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data);

        return $data;
    }
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);   
    $lastname  = mysqli_real_escape_string($conn, $_POST['lastname']);  
    $gender  = mysqli_real_escape_string($conn, $_POST['gender']); 
    $email     = mysqli_real_escape_string($conn, $_POST['email']);   
    $filename  = $_FILES['profile_image']['name'];
    $size      = $_FILES['profile_image']['size'];
    $tmp       = $_FILES['profile_image']['tmp_name'];
    $path      = pathinfo($_FILES['profile_image']['name']);
    $id        = mysqli_real_escape_string($conn, $_POST['id']);
    
    $extension = ['png','jpg', 'jpeg','gif'];
    if(!in_array($path['extension'], $extension)){
        echo "1";
    }else if($size > 1000000){
        echo "2";
    }else{
    //image location

    $name = "images/";

    $newlocation = $name.$filename;


    if(move_uploaded_file($tmp,"../../images/".$filename)){
        $scan_id = validate($id);
        $scan_lastname = validate($lastname);
        $scan_firstname = validate($firstname);
        $scan_email = validate($email);
        $scan_gender = validate($gender);

        $stmt = $conn->prepare("UPDATE client SET `client_firstname`=? ,`client_lastname`=? ,`client_email`=? ,`client_gender` = ? ,`client_image`=?  WHERE client_id = ?");
        $stmt->bind_param("ssssss",$scan_firstname,$scan_lastname,$scan_email,$scan_gender,$newlocation,$scan_id);
        if($stmt->execute()){
            echo 'success';
        }else{
            echo 'failed';
        }
    
        $stmt->close();
        $conn->close();

    }else {
        echo "3";
    }

}

    

}


