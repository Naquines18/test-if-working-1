<?php
session_start();
require_once 'config.php';
require_once 'token.php';

if(isset($_POST['pass_id']) && isset($_POST['new_password']) && $_POST['current_password']){

    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    //sanitize inputs
    $current_password    = validate(mysqli_real_escape_string($conn, $_POST["current_password"]));
    $hashed_current_password = md5($current_password);

    $id              = validate($_POST['pass_id']);
    $new_password    = validate(mysqli_real_escape_string($conn, $_POST["new_password"]));
    $hashed_password = md5($new_password);
   
    if($new_password && $current_password){

        $check_password = $conn->prepare("SELECT client_password FROM client WHERE client_id = ? LIMIT 1");
        $check_password->bind_param("i",$id);
        $check_password->execute();
        $result = $check_password->get_result();

       
        while ($a = $result->fetch_assoc()) {
            if($a['client_password'] == $hashed_current_password){
                $stmt = $conn->prepare("UPDATE client SET client_password = ? WHERE client_id = ? LIMIT 1");
                $stmt->bind_param("si",$hashed_password,$id);
                    if($stmt->execute() == TRUE){
                        echo "success";
                    }
                $stmt->close();
                $conn->close();
            }else{
                echo "error";
            }
        }   
        
   
    }

   
   
    
        
}






