<?php
require_once '../../src/config.php';


if(isset($_POST['id']) && isset($_POST['username']) &&  isset($_POST['gender']) && isset($_POST['email']) && isset($_FILES['profile_image'])){


    function validate($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data);

        return $data;
    }
    $username  = mysqli_real_escape_string($conn, $_POST['username']);  
    $gender    = mysqli_real_escape_string($conn, $_POST['gender']); 
    $email     = mysqli_real_escape_string($conn, $_POST['email']);   
    $filename  = $_FILES['profile_image']['name'];
    $size      = $_FILES['profile_image']['size'];
    $tmp       = $_FILES['profile_image']['tmp_name'];
    $path      = pathinfo($_FILES['profile_image']['name']);
    $id        = mysqli_real_escape_string($conn, $_POST['id']);
    
    $extension = ['png','jpg', 'jpeg','gif'];
    if(!in_array($path['extension'], $extension)){
        header("location: ../staff?page=staff_page&invalid_extension&empty_field");
    }else if($size > 1000000){
        header("location: ../staff?page=staff_page&file_size_to_big&failed");
    }else{
    //image location

    $name = "images/";

    $newlocation = $name.$filename;


    if(move_uploaded_file($tmp,"../images/".$filename)){
        $scan_id = validate($id);
        $scan_username = validate($username);
        $scan_email = validate($email);
        $scan_gender = validate($gender);

        $stmt = $conn->prepare("UPDATE advance_user SET `advance_user_name`=? ,`advance_user_email`=? ,`gender`=? ,`profile_image` = ?  WHERE `advance_user_id` = ? LIMIT 1");
        $stmt->bind_param("sssss",$scan_username,$scan_email,$scan_gender,$newlocation,$scan_id);
        if($stmt->execute()){
            header("location: ../staff?page=staff_page&success");
        }else{
            header("location: ../staff?page=staff_page&failed");
        }
    
        $stmt->close();
        $conn->close();

    }else {
        header("location: ../staff?page=staff_page&error_in_uploading_images&failed");
    }

}

    

}


