<?php

	session_start();
	$_SESSION = array();
	session_destroy();
	unset($_SESSION);

	//echo "<script>alert('Vous �tes maintenant d�connectez');</script>";
	header('Location: home');
	exit();

?>