<?php

$cible = isset($_GET['cible'])? $_GET['cible'] : "load";
	
switch($cible){
    case 'ajouterAdministrateur':{
        Administrateur::ajouterAdministrateur();
        break;
    }

    case 'listAdministrateur':{
        Administrateur::listAdministrateur();
        break;
    }

    case 'deleteAdministrateur':{
        Administrateur::deleteAdministrateur();
        break;
    }

    case 'editAdministrateur':{
        Administrateur::editAdministrateur($id,$nom,$prenom,$login);
        break;
    }

}

?>