<?php
require_once '../../src/token.php';
require_once '../../src/config.php';
require 'user_agent.php';
session_start();



if(isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['role'])){
    $output = "";

    $browser = UserInfo::get_browser();
    $os      = UserInfo::get_os();
    $ip      = UserInfo::get_ip();
    $device  = UserInfo::get_device();

    function sanitized($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    //sanitized
    $email    = sanitized($_POST["email"]);
    $password = sanitized($_POST["password"]);

    //escape unwanted characters
    $scan_email    = mysqli_real_escape_string($conn, $_POST["email"]);
    $scan_password = mysqli_real_escape_string($conn, $_POST["password"]);

    //hash password
    $hashed_password = md5($password);



    //validate email with procedural programming
    if(!filter_var($scan_email,FILTER_VALIDATE_EMAIL)){

        $output = array('result' => '1');

    }else if($scan_email == TRUE or $scan_password == TRUE){
        
        $stmt = $conn->prepare("SELECT advance_user_email,advance_user_password FROM advance_user WHERE advance_user_email = ? AND advance_user_password = ? LIMIT 1");

        $stmt->bind_param("ss",$scan_email,$hashed_password);

        $stmt->execute();

        $stmt->store_result();

            if($stmt->num_rows === 1){
                $information = $conn->prepare("SELECT * FROM advance_user WHERE advance_user_email = ? ");
                $information->bind_param("s",$scan_email);
                $information->execute();
                $result = $information->get_result();
                while($row = $result->fetch_assoc()){
                    $client_id = htmlspecialchars($row['advance_user_id']);
                    $_SESSION['advance_user_id'] = htmlspecialchars($row['advance_user_id']);
                    $_SESSION['advance_user_name'] = htmlspecialchars($row['advance_user_name']);
                    $_SESSION['advance_user_email'] = htmlspecialchars($row['advance_user_email']);
                    $_SESSION['advance_user_created'] = htmlspecialchars($row['advance_user_created']);
                    $_SESSION['advance_user_loggedin'] = TRUE;
                    $_SESSION['token'] = $token;
                    $_SESSION['advance_user_role'] = $row['advance_user_role'];

                   if($_POST['role'] !== $row['advance_user_role']){
                        $output = array('result' => '2');
                   }else{
                        $stmt = $conn->prepare("INSERT INTO `browser_logs`(`browser`, `platform`, `device`, `ip`, `client_id`,`loggedin_date`) VALUES (?,?,?,?,?,CURRENT_DATE())");
                        $stmt->bind_param("sssss",$browser,$os,$device,$ip,$client_id);
                        
                        if($stmt->execute()){
                            $output = array('result' => '3');
                        }else{
                            $output = "Error";
                        }
                        

                        
                   }

                }

            }else{
                $output = array('result' => '4');
            }

            echo json_encode($output);

           

        $stmt->close();
        $conn->close();
    }


}


