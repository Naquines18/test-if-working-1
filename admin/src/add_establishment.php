<?php
require_once '../../src/config.php';


if(isset($_POST['estab_name']) && isset($_POST['estab_mobile']) && isset($_POST['estab_desc']) && isset($_POST['estab_amount'])){
    
    //sanitize inputs
    $name     = mysqli_real_escape_string($conn, $_POST["estab_name"]);
    $desc     = mysqli_real_escape_string($conn, $_POST["estab_desc"]);
    $mobile   = mysqli_real_escape_string($conn, $_POST["estab_mobile"]);
    $amount   = mysqli_real_escape_string($conn, $_POST["estab_amount"]);


    $stmt = $conn->prepare("INSERT INTO `establishments`(`establishments_name`, `establishments_desc`,`establishment_payment_amout`,`establishments_mobile`) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$name,$desc,$amount,$mobile);
    if($stmt->execute() == TRUE){
        header("location: ../establishments.php?message=Establishment has been added.");
    }
    $stmt->close();
    $conn->close();


}

