<?php
$cible = isset($_GET['cible'])? $_GET['cible'] : "load";
	
switch($cible){
    case 'login':{
        Utilisateur::ajouterUser();
        break;
    }

    case 'listUser':{
        Utilisateur::listUser();
        break;
    }

    case 'listOneUser':{
        Utilisateur::listOneUser();
        break; 
    }
}
