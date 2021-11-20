<?php

require "config.php";

if(isset($_POST['finished_reservation'])){
	$id = $_POST['finished_reservation'];
	$status = "Finished";


	$update_status = $conn->prepare("UPDATE appointments SET status = ? WHERE appointment_id = ? LIMIT 1");
	$update_status->bind_param("ss",$status,$id);
	$update_status->execute();

	echo "success";
}