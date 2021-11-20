<?php
	session_start();

	require_once '../src/token.php';
	require_once '../src/config.php';


	if($_SESSION['token'] != $token){
		header('location: index?error=You must login first.');
		session_unset();
		session_destroy();
		exit();
	}elseif ($_SESSION['advance_user_loggedin'] !== TRUE) {
		header('location: index?error=You must login first.');
		session_unset();
		session_destroy();
		exit();
	}else if(empty($_SESSION['token']) AND empty($_SESSION['token']) AND empty($_SESSION['client_email']) AND empty($_SESSION['client_role']) ){
		header('location: index?error=You must login first.');
		session_unset();
		session_destroy();
		exit();    
	}else{
		$id         = htmlspecialchars($_SESSION['advance_user_id']); 
		$username   = htmlspecialchars($_SESSION['advance_user_name']); 
		$email  	= htmlspecialchars($_SESSION['advance_user_email']);
		$date_created     = htmlspecialchars($_SESSION['advance_user_created']);
		$role       = htmlspecialchars($_SESSION['advance_user_role']);

	}
?>