<?php

include 'config.php';
session_start();

if(isset($_POST['result_scan'])){
    $result_scan = $_POST['result_scan'];


    $getdata = mysqli_query($conn,"SELECT id_no,qr_user_id FROM qrcodes WHERE id_no = ".$result_scan." LIMIT 1");
	
	foreach ($getdata as $result) {
		$id_number = $result['id_no'];
		$qr_user_id   = $result['qr_user_id'];

		$getData = mysqli_query($conn,"SELECT * FROM client_profile INNER JOIN client ON client_profile.client_id = client.client_id WHERE client_profile.client_id = '$qr_user_id' AND client.client_id = '$qr_user_id' LIMIT 1 ");

		while ($row = mysqli_fetch_assoc($getData)) {
			$fullname = $row['client_firstname']." ".$row['client_lastname'];
			$address = $row['address'];
			$phone = $row['phone'];

			$query   = mysqli_query($conn, "INSERT INTO log_qr(`id_no`, `fullname`, `address`, `phone`, `time_in`, `status`) VALUES ('$id_number','$fullname','$address','$phone','NOW()','Arrived') ");

			if ($query) {
				header("location: ../scan.php?success=Scanning of QR CODE is successfully finished.");
			} else {
				header("location: ../scan.php?success=Failed to scan the QR CODE");
			}
		}

	   
	    
	}    

    

 
}



