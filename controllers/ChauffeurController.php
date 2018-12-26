<?php

$cible = isset($_GET['cible'])? $_GET['cible'] : "load";
	
switch($cible){
    
    case 'listChauffeur':{
        Chauffeur::listChauffeur();
        break;
    }

    case 'deleteChauffeur':{
        Chauffeur::deleteChauffeur();
        break;
    }

	
	case 'listOneChauffeur':{
		Chauffeur::listOneChauffeur($id);
		break;
	}

}

?>