<?php

include "../../src/config.php";


if(isset($_POST['data'])){
    $sql = "DROP TABLE ".$_POST['data']."";

    $run = mysqli_query($conn,$sql);

    if($run == true){
        echo "success";
    }
}