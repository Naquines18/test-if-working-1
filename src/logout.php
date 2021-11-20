<?php

// Pasabot ani kay if si logout_data is set then execute the script
 
if(isset($_POST['logout_data'])){
	session_start();
	session_unset();
	session_destroy();

	echo "success";
}