<?php
$cible = isset($_GET['cible'])? $_GET['cible'] : "load";
	
switch($cible){
   
    case 'listVehicule':{
        Vehicule::listVehicule();
        break;
    }

    case 'listOneVehicule':{
        Vehicule::listOneVehicule();
        break; 
    }

    case 'deleteVehicule':{
        Vehicule::deleteVehicule();
        break;
    }
}