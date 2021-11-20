<?php
require_once '../../src/config.php';


if(isset($_POST['estab_id']) && isset($_POST['estab_name']) && isset($_POST['estab_mobile']) && isset($_POST['estab_desc']) && isset($_POST['estab_amount'])){
    
    //sanitize inputs
    $id       = mysqli_real_escape_string($conn, $_POST["estab_id"]);
    $name     = mysqli_real_escape_string($conn, $_POST["estab_name"]);
    $desc     = mysqli_real_escape_string($conn, $_POST["estab_desc"]);
    $mobile   = mysqli_real_escape_string($conn, $_POST["estab_mobile"]);
    $amount   = mysqli_real_escape_string($conn, $_POST["estab_amount"]);

    $stmt = $conn->prepare("UPDATE establishments SET establishments_name = ?, establishments_desc = ? , establishments_mobile = ? , establishment_payment_amout = ? WHERE establishments_id = ? LIMIT 1");
    $stmt->bind_param("sssss",$name,$desc,$mobile,$amount,$id);
    if($stmt->execute() == TRUE){
        header("location: ../establishments.php?message=Establishment has been updated.");
    }
    $stmt->close();
    $conn->close();


}

