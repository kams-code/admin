<?php
$cible = isset($_GET['cible'])? $_GET['cible'] : "load";
	
switch($cible){
    case 'listGarage':{
        Garage::listGarage();
        break;
    }

    case 'deleteGarage':{
        Garage::deleteGarage();
        break;
    }

    case 'listOneGarage':{
        Garage::listOneGarage();
        break; 
    }
}