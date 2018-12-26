<?php
    header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
    header("Cache-Control: post-check=0, pre-check=0", false); 
    header("Cache-Control: private");
    header("Pragma: no-cache");
    header('Content-Type:text/html; Charset=UTF-8');
	
	ob_start();

	session_start();

	define("BASEURL", "/admin/");

	setlocale (LC_TIME, 'fr_FR.utf8','fra');

	require("db.php");
	include 'models/classes.php';
	$query = array();
	$parts = parse_url($_SERVER["REQUEST_URI"]);
	if(isset($parts['query'])){
		parse_str($parts['query'], $query);
		if(isset($query) && count($query)>0){
			foreach ($query as $key => $value) {
				$_REQUEST[$key] = $value;
			}
		}
	}
	$crtl = "accueil"; // Page de connexion par défaut
	
	$defautColor = "#61b47c";
	// Par défaut on affiche le TABLEAU DE BORD
	if(isset($_REQUEST['page']) ){
		$ctrl = $_REQUEST['page'];
	}
	require_once("fonctions.php");  
	if (isset($_SESSION["idadmin"])) {
		switch($ctrl){	
			case 'home':{ 
				$page_title = "Accueil";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/home.php");
				include("views/footer.php");
				break;
			}
			
            case 'utilisateur':{
				include("controllers/Utilisateur.php");
				break;
			}
			case 'ajouterUser':{
				$page_title = "ajouter un utilisateur";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/ajouterUser.php");
				include("views/footer.php");
				break;
			}
			
			case 'listUser':{
				$page_title = "lister les utilisateurs";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/listUser.php");
				include("views/footer.php");
				break;
			}

			case 'listOneUser':{
				$page_title = "lister les utilisateurs";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/listOneUser.php");
				include("views/footer.php");
				break;
			}
			 
			case 'user':{
				$page_title = "profil utilisateur";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/user.php");
				include("views/footer.php");
				break;
			}

            case 'chauffeur':{
				
				include("controllers/ChauffeurController.php");
				break;
			}

			case 'listChauffeur':{
				$page_title = "lister les chauffeurs";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/listChauffeur.php");
				include("views/footer.php");
				break;
			}

			case 'listOneChauffeur':{
				$page_title = "lister les utilisateurs";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/listOneChauffeur.php");
				include("views/footer.php");
				break;
			}

			case 'deleteChauffeur':{
				$page_title = "lister les utilisateurs";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/deleteChauffeur.php");
				include("views/footer.php");
				break;
			}

			case 'administrateur':{
				
				include("controllers/AdministrateurController.php");
				break;
			}
			case 'ajouterAdministrateur':{
				$page_title = "Ajouter un administrateur";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/ajouterAdministrateur.php");
				include("views/footer.php");
				break;
			}
			case 'listAdministrateur':{
				$page_title = "Ajouter un administrateur";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/listAdministrateur.php");
				include("views/footer.php");
				break;
			}

			case 'deleteAdministrateur':{
				$page_title = "Ajouter un administrateur";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/deleteAdministrateur.php");
				include("views/footer.php");
				break;
			}

			case 'editAdministrateur':{
				$page_title = "mettre a jour un administrateur";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/editAdministrateur.php");
				include("views/footer.php");
				break;
			}

			case 'garage':{
				
				include("controllers/GarageController.php");
				break;
			}

			case 'listGarage':{
				$page_title = "lister les garages";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/listGarage.php");
				include("views/footer.php");
				break;
			}

			case 'deleteGarage':{
				$page_title = "supprimer garage";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/deleteGarage.php");
				include("views/footer.php");
				break;
			}

			case 'listOneGarage':{
				$page_title = "supprimer garage";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/listOneGarage.php");
				include("views/footer.php");
				break;
			}


			
			case 'vehicule':{
				
				include("controllers/VehiculeController.php");
				break;
			}

			case 'listVehicule':{
				$page_title = "lister les garages";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/listVehicule.php");
				include("views/footer.php");
				break;
			}

			case 'deleteVehicule':{
				$page_title = "supprimer garage";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/deleteVehicule.php");
				include("views/footer.php");
				break;
			}

			case 'listOneVehicule':{
				$page_title = "supprimer garage";
				include("views/header.php");
				include("views/menu.php");
				include("views/top.php");
				include("views/listOneVehicule.php");
				include("views/footer.php");
				break;
			}

			case 'logout':{ 
				header("Location:se_deconnecter.php");
				break;
			}
			default:{
				header("Location:home");
			}
		}
	}
	else{
		$cible = isset($_GET['page'])? $_GET['page'] : "login";
	    switch($cible){ 
		      case 'pagelogin':{ 
		        $page_title = 'Connexion';
		        include 'views/header.php';
		        include("views/login.php");
		        include 'views/footer.php';
		        break;
			  }
			  case "loginController":{
				  include 'controllers/LoginController.php';
				  break;
			  }
			  default:{
			  	$page_title = 'Connexion';
		        include 'views/header.php';
		        include("views/login.php");
		        include 'views/footer.php';
		        break;
			  }
	    }
	}
	
	ob_end_flush();
?>