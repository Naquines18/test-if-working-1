<?php
	session_start();

	require_once 'src/token.php';
	require_once 'src/config.php';


	if($_SESSION['token'] != $token){
		header('location: index?error=You must login first.');
		session_destroy();
		exit();
	}elseif ($_SESSION['client_loggedin'] !== TRUE) {
		header('location: index?error=You must login first.');
		session_destroy();
		exit();
	}else if(empty($_SESSION['token']) AND empty($_SESSION['token']) AND empty($_SESSION['client_email']) AND empty($_SESSION['client_role']) ){
		header('location: index?error=You must login first.');
		session_destroy();
		exit();    
	}else{
		$id        = htmlspecialchars($_SESSION['client_id']); 
		$firstname = htmlspecialchars($_SESSION['client_firstname']); 
		$lastname  = htmlspecialchars($_SESSION['client_lastname']);
		$email     = htmlspecialchars($_SESSION['client_email']);
		$verified  = htmlspecialchars($_SESSION['client_verified']);

        if($verified == 0){
            echo '<script>window.location.href="verify?suggestion=Verify your account first."</script>';
            die();
            exit();
        }
	}
?>