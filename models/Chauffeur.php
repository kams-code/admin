<?php

    Class Chauffeur extends BaseModel{

        public function __construct() {

        } 

        public static function ajouter()
        {
        	global $BD;

        	$result = array();

        	$getid = $BD->query("SELECT max(idchauffeur) as idchauffeur FROM chauffeur");
            if ($getid->rowCount() == 0) {
                $id=1;
            }
            else{
                $getiid = $getid->fetch();
                $id=$getiid["idchauffeur"]+1;
            }

        	if (isset($_FILES["filpermis"]) AND strlen($_FILES["filpermis"]["name"])>0) {

	    		$folder = 'images/chauffeur/';

	            $tmp_name = $_FILES["filpermis"]["tmp_name"];

	            $name = $_FILES["filpermis"]["name"];

	            $img = pathinfo($_FILES["filpermis"]['name']);

	            $permis = "permis".$id.'.'.$img["extension"];
	        	move_uploaded_file($tmp_name, $folder.$permis);
	        }

	        if (isset($_FILES["filecni"]) AND strlen($_FILES["filecni"]["name"])>0) {
				
				$folder = 'images/chauffeur/';

	            $tmp_name = $_FILES["filecni"]["tmp_name"];

	            $name = $_FILES["filecni"]["name"];

	            $img = pathinfo($_FILES["filecni"]['name']);

	            $cni = "cni".$id.'.'.$img["extension"];
	        	move_uploaded_file($tmp_name, $folder.$cni);
	        }

	        if (isset($_FILES["casier"]) AND strlen($_FILES["casier"]["name"])>0) {

	    		$folder = 'images/chauffeur/';

	            $tmp_name = $_FILES["casier"]["tmp_name"];

	            $name = $_FILES["casier"]["name"];

	            $img = pathinfo($_FILES["casier"]['name']);

	            $casier = "casier".$id.'.'.$img["extension"];
	        	move_uploaded_file($tmp_name, $folder.$casier);
	        }


	        $insert = $BD->prepare("INSERT INTO `chauffeur`(`idchauffeur`,`permisconduire`, `fichier_permis`, `cni`, `fichier_cni`, `casier`, `idutilisateur`) VALUES (?,?,?,?,?,?,?)");
            $insert->execute(array($id,$_REQUEST["numpermis"],$permis,$_REQUEST["numcni"],$cni,$casier,$_SESSION["iddrive"]));


            $result["status"] = "success";

            echo json_encode($result);
		}
		
		
		
		public static function  editChauffeur(){
			 $id = null; 
			 if ( !empty($_GET['id'])) { $id = $_REQUEST['id']; }
			 
			 if ( null==$id ) { header("Location: index.php"); } 
			 if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) 
			 { // on initialise nos erreurs $nameError = null; $firstnameError = null; $ageError = null; $telError = null; $emailError = null; $paysError = null; $commentError = null; $metierError = null; $urlError = null; // On assigne nos valeurs $name = $_POST['name']; $firstname = $_POST['firstname']; $age = $_POST['age']; $tel = $_POST['tel']; $email = $_POST['email']; $pays = $_POST['pays']; $comment = $_POST['comment']; $metier = $_POST['metier']; $url = $_POST['url']; // On verifie que les champs sont remplis $valid = true; if (empty($name)) { $nameError = 'Please enter Name'; $valid = false; } if (empty($firstname)) { $firstnameError = 'Please enter firstname'; $valid = false; } if (empty($email)) { $emailError = 'Please enter Email Address'; $valid = false; } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $emailError = 'Please enter a valid Email Address'; $valid = false; } if (empty($age)) { $ageError = 'Please enter your age'; $valid = false; } if (empty($tel)) { $telError = 'Please enter phone'; $valid = false; } if (!isset($pays)) { $paysError = 'Please select a country'; $valid = false; } if (empty($comment)) { $commentError = 'Please enter a description'; $valid = false; } if (!isset($metier)) { $metierError = 'Please select a job'; $valid = false; } if (empty($url)) { $urlError = 'Please enter website url'; $valid = false; } // mise à jour des donnés if ($valid) { $pdo = Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
				$sql = "UPDATE chauffeur SET nom = ?,prenom = ?,login = ?,password = ? WHERE idadministrateur = ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($nom,$prenom, $login, $password, $dateajout,$id));
				Database::disconnect();
				header("Location:listChauffeur.php");
			
			}else {
		
				 $pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "SELECT * FROM utilisateur where id = ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($id));
				$data = $q->fetch(PDO::FETCH_ASSOC);
				$nom = $data['nom'];
				$prenom = $data['prenom'];
				$login = $data['login'];
				$password = $data['password'];
			   
				Database::disconnect();
			}
		}
		
		public static function deleteChauffeur(){
			global $BD;
			if ( $id===null ) { header("Location: index.php"); } 
				   $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				   $sql = "DELETE FROM chauffeur  WHERE idchauffeur = ?";
					  $q = $BD->prepare($sql);
					  $q->execute(array($id));
		}
		
		public static function listChauffeur(){
			global $BD;
			$BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql =  "select * from chauffeur ";
			$q = $BD->query($sql);
			
			return $q;
		   
		}

		public static function listOneChauffeur($id){
            global $BD;
            $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $sql =  "SELECT utilisateur.prenom, utilisateur.nom, utilisateur.adresse, utilisateur.sexe,
           utilisateur.email,utilisateur.telephone,chauffeur.casier,chauffeur.cni,chauffeur.permisconduire,
           chauffeur.fichier_permis,chauffeur.fichier_cni,chauffeur.datechauffeur
            FROM chauffeur
            INNER JOIN utilisateur ON chauffeur.idutilisateur=utilisateur.idutilisateur where chauffeur.idchauffeur = ?";
            $q = $BD->prepare($sql);
            $q->execute(array($id));

            return $q->fetchAll();
		}
		
		public static function listNberCourse($id){
            global $BD;
            $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $sql =  "SELECT course.type, course.lieu_depart, course.lieu_arrive,course.datealler,
		   course.heurealler,course.prix,course.frequence,course.date_fin_frequence,course.nombre_place,
		   course.delai_confirmation,course.validation_express,course.bagage,course.description,
		   course.dateajout,chauffeur.casier,chauffeur.cni,chauffeur.permisconduire,
           chauffeur.fichier_permis,chauffeur.fichier_cni,chauffeur.datechauffeur
            FROM chauffeur
            INNER JOIN course ON chauffeur.idchauffeur=course.idchauffeur where chauffeur.idchauffeur = ?";
            $q = $BD->prepare($sql);
            $q->execute(array($id));

            return $q->fetchAll();
		}

		public static function listNberVehicule($id){
            global $BD;
            $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $sql =  "SELECT vehicule.nomvehicule,vehicule.couleurvehicule,chauffeur.casier,chauffeur.cni,chauffeur.permisconduire,
           chauffeur.fichier_permis,chauffeur.fichier_cni,chauffeur.datechauffeur
            FROM chauffeur
            INNER JOIN vehicule ON chauffeur.idchauffeur=vehicule.chauffeur_idchauffeur where chauffeur.idchauffeur = ?";
            $q = $BD->prepare($sql);
            $q->execute(array($id));

            return $q->fetchAll();
		}

}
?>