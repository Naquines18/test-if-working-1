<?php
require_once '../../src/token.php';
require_once '../../src/config.php';
session_start();

if(isset($_POST['update_id']) AND isset($_POST['email']) AND isset($_POST['username']) AND isset($_POST['gender']) AND isset($_FILES['image_upload'])){
    $output = "";
    function sanitized($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    //sanitized
    $id       = sanitized($_POST["update_id"]);
    $email    = sanitized($_POST["email"]);
    $username = sanitized($_POST["username"]);
    $gender   = sanitized($_POST["gender"]);

    //escape unwanted characters
    $scan_id       = mysqli_real_escape_string($conn, $id);
    $scan_email    = mysqli_real_escape_string($conn, $email);
    $scan_username = mysqli_real_escape_string($conn, $username);
    $scan_gender   = mysqli_real_escape_string($conn, $gender);

    //image
     $file_temp_name  = $_FILES['image_upload']['tmp_name'];
     $file_name       = $_FILES['image_upload']['name'];
     $file_extension  = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
     $file_size       = $_FILES['image_upload']['size'];
 
    //array of file extension that is valid or accepted
     $extension_array = ["jpeg","png","jpg","gif"];
   

    //validate user inputs
    if(!filter_var($scan_email,FILTER_VALIDATE_EMAIL)){
       echo "1";
    }else if(!in_array($file_extension,$extension_array)){
        echo "2";
    }else if($file_size > 700000){
        echo "3";
    }else{
        $image = "../images/".$file_name;
        $location = "images/".$file_name; 

        if(move_uploaded_file($file_temp_name, $image)){
            $update_info = $conn->prepare("UPDATE advance_user SET advance_user_name = ? , advance_user_email = ? , gender = ? , profile_image = ? WHERE advance_user_id = ? LIMIT 1");
            $update_info->bind_param("sssss", $scan_username,$scan_email,$scan_gender,$location,$id);
            if($update_info->execute()){
                echo "6";
            }else{
                echo "7";
            }
            $update_info->close();
            $conn->close();
        }else{
            echo "8";
        }
    }



}



if(isset($_POST['doc_id']) AND isset($_POST['doc_email']) AND isset($_POST['doc_username']) AND isset($_POST['doc_gender']) AND isset($_FILES['doc_image_upload'])){
    $output = "";
    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    //sanitized input
    $id       = validate($_POST["doc_id"]);
    $email    = validate($_POST["doc_email"]);
    $username = validate($_POST["doc_username"]);
    $gender   = validate($_POST["doc_gender"]);

    //escape unwanted characters
    $scan_id       = mysqli_real_escape_string($conn, $id);
    $scan_email    = mysqli_real_escape_string($conn, $email);
    $scan_username = mysqli_real_escape_string($conn, $username);
    $scan_gender   = mysqli_real_escape_string($conn, $gender);

    //image
     $file_temp_name  = $_FILES['doc_image_upload']['tmp_name'];
     $file_name       = $_FILES['doc_image_upload']['name'];
     $file_extension  = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
     $file_size       = $_FILES['doc_image_upload']['size'];
 
    //array of file extension that is valid or accepted
     $extension_array = ["jpeg","png","jpg","gif"];
   

    //validate user inputs
    if(!filter_var($scan_email,FILTER_VALIDATE_EMAIL)){
       echo "1";
    }else if(!in_array($file_extension,$extension_array)){
        echo "2";
    }else if($file_size > 700000){
        echo "3";
    }else if(!preg_match("/^[a-zA-Z' ]*$/",$scan_gender)){
        echo "5";
    }else{
        $image = "../images/".$file_name;
        $location = "images/".$file_name; 

        if(move_uploaded_file($file_temp_name, $image)){
            $update_info = $conn->prepare("UPDATE advance_user SET advance_user_name = ? , advance_user_email = ? , gender = ? , profile_image = ? WHERE advance_user_id = ? LIMIT 1");
            $update_info->bind_param("sssss", $scan_username,$scan_email,$scan_gender,$location,$id);
            if($update_info->execute()){
                echo "6";
            }else{
                echo "7";
            }
            $update_info->close();
            $conn->close();
        }else{
            echo "8";
        }
    }



}

