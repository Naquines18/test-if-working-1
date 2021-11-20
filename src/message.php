<?php
require_once 'config.php';

if(isset($_POST['fullname']) && isset($_POST['from']) && isset($_POST['message']) && isset($_POST['subject']) ){


function validate($data){
    $data = htmlspecialchars($data);
    $data = stripcslashes($data);
    $data = trim($data);

    return $data;
}

$fullname  = validate($_POST['fullname']);
$from      = validate($_POST['from']);
$message   = validate($_POST['message']);
$subject   = validate($_POST['subject']);


if($fullname == TRUE or $from == TRUE or $message == TRUE or $subject == TRUE){
    $stmt = $conn->prepare("INSERT INTO `messages`(`fullname`, `body`, `from`, `receiver`, `subject`, `message_date`,`seen`) VALUES (?,?,?,'1',?,CURRENT_TIME(),'0')");
    $stmt->bind_param("ssss",$fullname,$message,$from,$subject);
        if($stmt->execute()){
            echo 'success';
        }else{
            echo 'error';
        }
    $stmt->close();
    $conn->close();
}


}


