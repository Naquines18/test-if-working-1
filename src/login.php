<?php
session_start();
require_once 'token.php';
require_once 'config.php';
require_once "../admin/src/user_agent.php";



if(isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['remember_me'])){

function validate($data){
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);
    return $data;
}
//sanitize inputs
$output = "";
$email  = validate(mysqli_real_escape_string($conn, $_POST["email"]));
$password = validate(mysqli_real_escape_string($conn, $_POST["password"]));
$hashed_password = md5($password);


$check_email = mysqli_query($conn,"SELECT client_email FROM client WHERE client_email = '".$email."' LIMIT 1");
if(mysqli_num_rows($check_email) > 0){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $output = array("result" => "2");
    }else{
        $stmt = $conn->prepare("SELECT * FROM client WHERE client_email = ? AND client_password = ? LIMIT 1");
        $stmt->bind_param("ss",$email,$hashed_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['client_id']        = htmlspecialchars($row['client_id']);
                $_SESSION['client_firstname'] = htmlspecialchars($row['client_firstname']);
                $_SESSION['client_lastname']  = htmlspecialchars($row['client_lastname']);
                $_SESSION['client_email']     = htmlspecialchars($row['client_email']);
                $_SESSION['client_role']      = htmlspecialchars($row['role']);
                $_SESSION['client_verified']  = htmlspecialchars($row['verified']);
                $_SESSION['client_loggedin']  = TRUE;
                $_SESSION['token']            = $token;


                if ($row['verified'] == "1") { //verified

                    $browser = UserInfo::get_browser();
                    $os = UserInfo::get_os();
                    $ip = UserInfo::get_ip();
                    $device = UserInfo::get_device();

                    $stmt = $conn->prepare("INSERT INTO `browser_logs`(`browser`, `platform`, `device`, `ip`, `client_id`,`loggedin_date`) VALUES (?,?,?,?,?,CURRENT_DATE())");
                        $stmt->bind_param("sssss",$browser,$os,$device,$ip,$_SESSION['client_id']);
                        
                        if($stmt->execute()){
                            $output = array("result" => "5");
                        }else{
                            echo $browser;
                            echo "<br>";
                            echo $os;
                            echo "<br>";
                            echo $ip;
                            echo "<br>";
                            echo $device;
                            echo "<br>";
                            echo $client_id;
                            echo "<br>";
                            $output = "Error";
                        }

                    $output = array("result" => "5");
                } else { //not verified
                    $output = array("result" => "4");
                }
                
            }
        } else {
            $output = array("result" => "3");
        }
        
    }
}else{
    $output = array("result" => "1");
}

echo json_encode($output);

}



