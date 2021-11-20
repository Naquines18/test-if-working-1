<?php
error_reporting(0); 
require 'config.php';
require 'smtp.php';
require 'Date.php';

require 'PHPMailer/PHPMailer-master/src/Exception.php';
require 'PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['firstname']) AND isset($_POST['lastname']) AND isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['gender'])){

    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    
    //sanitize inputs
    $firstname = ucfirst(validate(mysqli_real_escape_string($conn, $_POST["firstname"])));
    $lastname  = ucfirst(validate(mysqli_real_escape_string($conn, $_POST["lastname"])));
    $email     = validate(mysqli_real_escape_string($conn, $_POST["email"]));
    $gender    = validate(mysqli_real_escape_string($conn, $_POST["gender"]));
    $password  = validate(mysqli_real_escape_string($conn, $_POST["password"]));

    $hashed_password = md5($password);

    //validate email 
    $check_email = mysqli_query($conn,"SELECT client_email FROM client WHERE client_email = '$email' ");
    if(mysqli_num_rows($check_email) > 0){
        echo "0";
    }elseif(!preg_match("/^[a-zA-Z-' ]*$/",$firstname)){
        echo "1";
    }elseif (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
        echo "2";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "3";
    }elseif($password == "Password"){
        echo "4";
    }elseif($password == "123"){
        echo "4";
    }elseif($password == "test123"){
        echo "4";
    }elseif($password == "password123"){
        echo "4";
    }elseif($password == "password"){
        echo "4";
    }elseif($firstname == TRUE or $lastname == TRUE or $email == TRUE or $password == TRUE or $gender == TRUE){

        $stmt = $conn->prepare("INSERT INTO `client`(`client_firstname`, `client_lastname`, `client_email`, `client_password`,`client_gender`,`client_image`,`account_created`,`role`,`verified`) VALUES (?,?,?,?,?,'images/default.png',CURRENT_DATE(),'0','0')");
        $stmt->bind_param("sssss",$firstname,$lastname,$email,$hashed_password,$gender);
            if($stmt->execute() == TRUE){

                $code = rand(123456,78901);
                $charset = md5($code);
                $activation = sha1('abcdefghijklmnopqrstuvwxyxABCDEFGHIJKLMNOPQRSTUVWXYZ12345678900987654321!@#$%^&*()');
                //Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);
                    $object = new Year();

                    try {
                        //Server settings
                        $mail->SMTPDebug = 0;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = $smtp_email;                     //SMTP username
                        $mail->Password   = $smtp_password;                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                        $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
                        //SENDER
                        $mail->setFrom($smtp_email, 'System Administrator');
                        //RECEIVER
                        $mail->addAddress($email, $firstname.' '.$lastname);     //Add a recipient
                       

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'One Time Email Verification';
                        $mail->Body    = '
                                <style>body{margin-top:20px;}</style>
                                <body>
                                <table class="body-wrap" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
                                <tbody>
                                    <tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                        <td style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                                        <td class="container" width="600" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                                            <div class="content" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                                                <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope="" itemtype="" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; margin: 0; border: none;">
                                                    <tbody><tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                        <td class="content-wrap" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;padding: 30px;border: 3px solid #67a8e4;border-radius: 7px; background-color: #fff;" valign="top">
                                                            <meta itemprop="name" content="Confirm Email" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <table width="100%" cellpadding="0" cellspacing="0" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                <tbody><tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                    <td class="content-block" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                        Please confirm your email address by clicking the link below.
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                    <td class="content-block" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                        Dear ,' .$firstname.' '.$lastname.'
                                                                        Please click the verification link.
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                    <td class="content-block" itemprop="handler" itemscope="" itemtype="" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                        <a href="http://localhost/app/login?code='.htmlspecialchars($code).'&&charset='.$charset.'&&activation='.$activation.'&&firstname='.htmlspecialchars($firstname).'&&lastname='.htmlspecialchars($lastname).'" class="btn-primary" itemprop="url" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #f06292; margin: 0; border-color: #f06292; border-style: solid; border-width: 8px 16px;">Verify Email Address</a>
                                                                    </td>
                                                                </tr>
                            
                                                                <tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                    <td class="content-block" style="text-align: center;font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top">
                                                                    &copy; 2021 NEW ISRAEL RESERVATION SYSTEM
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </body>'; 
                        '
                        ';
                        $mail->AltBody = 'Dear ,' .$firstname.' '.$lastname.'
                        Please click the verification link <a href="http://localhost/app/login?code='.htmlspecialchars($code).'&&charset='.$charset.'&&activation='.$activation.'&&firstname='.htmlspecialchars($firstname).'&&lastname='.htmlspecialchars($lastname).'">Verify</a>
                        ';

                        $mail->send();
                        $month = $object->get_month(date("M"));
                    
                        $update_0 = mysqli_query($conn,"UPDATE monthly_client SET no_client = no_client+1 WHERE month = '$month' ");
                        if($update_0){
                            echo "5";
                        }
                        
                        
                    } catch (Exception $e) {
                            $month = $object->get_month(date("M"));
                            $update_1 = mysqli_query($conn,"UPDATE monthly_client SET no_client = no_client+1 WHERE month = '$month' ");
                            if($update_1){
                                echo "6";
                            }
                    }
                  
            }
        $stmt->close();
        $conn->close();
    }

}


