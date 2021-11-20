<?php
error_reporting(0); 
require_once 'config.php';
require_once 'smtp.php';

require 'PHPMailer/PHPMailer-master/src/Exception.php';
require 'PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST['email'])){

function validate($data){
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);
    return $data;
}

$email = validate($_POST['email']);

$check_email = mysqli_query($conn, "SELECT client_email FROM client WHERE client_email = '$email' LIMIT 1");
if(mysqli_num_rows($check_email) == 0){
	echo "error_email";
}else{

$code = rand(123456,78901);
$charset = md5($code);
$activation = sha1('abcdefghijklmnopqrstuvwxyxABCDEFGHIJKLMNOPQRSTUVWXYZ12345678900987654321!@#$%^&*()');


$mail = new PHPMailer(true);

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
	    $mail->setFrom($smtp_email, 'Reset Password Link');
	    //RECEIVER
	    $mail->addAddress($email, $firstname.' '.$lastname);     //Add a recipient
	   

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = 'One Time Password Reset Link';
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
	                                                    Click the link to continue
	                                                </td>
	                                            </tr>
	                                            <tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
	                                                <td class="content-block" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
	                                                    Dear ,' .$email.'
	                                                    Please click the password reset link.
	                                                </td>
	                                            </tr>
	                                            <tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
	                                                <td class="content-block" itemprop="handler" itemscope="" itemtype="" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
	                                                    <a href="http://localhost/app/reset?code='.htmlspecialchars($code).'&&charset='.$charset.'&&activation='.$activation.'&&email='.htmlspecialchars($email).'" class="btn-primary" itemprop="url" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #f06292; margin: 0; border-color: #f06292; border-style: solid; border-width: 8px 16px;">Reset Password</a>
	                                                </td>
	                                            </tr>
	        
	                                            <tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
	                                                <td class="content-block" style="text-align: center;font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top">
	                                                &copy; 2021 MIST APPOINTMENT SYSTEM
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
	    $mail->AltBody = 'Dear ,' .$email.'
	    Please click the password reset link <a href="http://localhost/master/static/reset?code='.htmlspecialchars($code).'&&charset='.$charset.'&&activation='.$activation.'&&email='.htmlspecialchars($email).'">Verify</a>
	    ';

	    $mail->send();

	    echo "confirmed";

		 } catch (Exception $e) {
		    echo "failed";
		 }

	}
}
// check if the data is set
if(isset($_POST['change_email']) && isset($_POST['change_password'])){
	// validation function and return the value
	function validate_input($data){
		$data = htmlspecialchars($data);
		$data = stripslashes($data);
		$data = strip_tags($data);

		return $data;
	}
	// validate the given data using define function
	$email = validate_input($_POST['change_email']);
	$new   = validate_input($_POST['change_password']);

	$hashed_password = md5($new);

	// update password query
	$updatePassword = mysqli_query($conn,"UPDATE client SET client_password = '$hashed_password' WHERE client_email='$email' LIMIT 1");

	// check if true or false with the result of the query
	switch($updatePassword){
		case true:
			echo "success";
		break;
			
		case false:
			echo "failed";
		break;

		default;
			echo "no_action_made";
	}




}