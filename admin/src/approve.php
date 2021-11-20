<?php
require_once '../../src/config.php';

if(isset($_POST['approve_appointment'])){
    $approve_appointment = mysqli_real_escape_string($conn, $_POST["approve_appointment"]);
    if($approve_appointment == TRUE){  
        $status = 'Approved';    
        $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE appointment_id = ? LIMIT 1");
        $stmt->bind_param("ss",$status,$approve_appointment);
        if($stmt->execute()){
            echo 'Appointment Approve';
        }else{
            echo 'Error';
        }
        $stmt->close();
        $conn->close();
    }

}


if(isset($_POST['disapprove_appointment'])){
    $disapprove_appointment = mysqli_real_escape_string($conn, $_POST["disapprove_appointment"]);
    if($disapprove_appointment == TRUE){  
        $status = 'Pending';    
        $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE appointment_id = ? LIMIT 1");
        $stmt->bind_param("ss",$status,$disapprove_appointment);
        if($stmt->execute()){
            echo 'Appointment Disapprove';
        }else{
            echo 'Error';
        }
        $stmt->close();
        $conn->close();
    }

}


if(isset($_POST['delete_id'])){
    $delete_id = mysqli_real_escape_string($conn, $_POST["delete_id"]);
    if($delete_id == TRUE){  
           
        $stmt = $conn->prepare("DELETE FROM `appointments` WHERE appointment_id = ? LIMIT 1");
        $stmt->bind_param("s",$delete_id);
        if($stmt->execute()){
            echo 'Appointment Deleted';
        }else{
            echo 'Error';
        }
        $stmt->close();
        $conn->close();
    }

}