<?php
require_once 'config.php';

if(isset($_POST['cancel_reservation'])){


function validate($data){
    $data = htmlspecialchars($data);
    $data = stripcslashes($data);
    $data = trim($data);

    return $data;
}

$cancel_reservation  = validate($_POST['cancel_reservation']);



if($cancel_reservation){
    $stmt = $conn->prepare("DELETE FROM `appointments` WHERE appointment_id = ? LIMIT 1");
    $stmt->bind_param("s",$cancel_reservation);
        if($stmt->execute()){
            echo 'success';
        }else{
            echo 'error';
        }
    $stmt->close();
    $conn->close();
}


}


