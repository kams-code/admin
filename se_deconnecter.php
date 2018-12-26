<?php

	session_start();
	$_SESSION = array();
	session_destroy();
	unset($_SESSION);

	//echo "<script>alert('Vous êtes maintenant déconnectez');</script>";
	header('Location: home');
	exit();

?>