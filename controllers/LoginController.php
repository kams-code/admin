<?php
	$cible = isset($_GET['cible'])? $_GET['cible'] : "load";
	
	switch($cible){
		case 'login':{
			Auth::Login();
			break;
		}
	}

?>