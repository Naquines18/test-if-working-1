<?php

session_start();

require "config.php";

if(isset($_POST['data'])){
	if($_POST['data'] == "delete_account"){
		$getAccountData = $conn->prepare('SELECT * FROM client WHERE client_id = ? LIMIT 1');
		$getAccountData->bind_param('s',$_SESSION['client_id']);
		$getAccountData->execute();

		$result = $getAccountData->get_result();


		while ($row = $result->fetch_assoc()) {
			$deleteAccountData = $conn->prepare('DELETE FROM `appointments` WHERE appointment_email = ?');
			$deleteAccountData->bind_param('s',$row['client_email']);
			if($deleteAccountData->execute()){
				$deleteProfileData12 = $conn->prepare('DELETE FROM `client_profile` WHERE client_id = ?');
			    $deleteProfileData12->bind_param('s',$_SESSION['client_id']);

			    if($deleteProfileData12->execute()){
			    	$deleteAccountData12 = $conn->prepare('DELETE FROM `client` WHERE client_id = ?');
			        $deleteAccountData12->bind_param('s',$_SESSION['client_id']);
			        if($deleteAccountData12->execute()){
			        	echo "success";
			        }
			    }
			}
		}
	}
}