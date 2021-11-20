<?php
require_once '../../src/config.php';


if(isset($_GET['establishment_id'])){
    
    //sanitize inputs
    $id       = mysqli_real_escape_string($conn, $_GET["establishment_id"]);

    $stmt = $conn->prepare("DELETE FROM establishments WHERE establishments_id = ? LIMIT 1");
    $stmt->bind_param("s",$id);
    if($stmt->execute() == TRUE){
        header("location: ../establishments.php?message=Establishment has been deleted.");
    }
    $stmt->close();
    $conn->close();


}

