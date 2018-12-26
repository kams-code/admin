<?php

    Class Utilisateur extends BaseModel{

        public function __construct() {

        } 


       /*public static function ajoutUser(){
           global $BD;
            if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){
                $sql = "INSERT INTO utilisateur (nom,prenom,email,telephone,adresse,password,sex,image,isactif,datecreation) values(?, ?, ?, ? , ? , ? , ? , ?, ?,date.now())";
                     $q = $BD->prepare($sql);
                     $q->execute(array($nom,$prenom, $email, $telephone, $adresse,$password,$sex, $image, $isactif,$datecreation));
                     Database::disconnect();
                     header("Location: listUser.php");
         }
       }*/
        
        
        public static function  editUser(){
        
             $id = null; 
             if ( !empty($_GET['id'])) { $id = $_REQUEST['id']; }
             
             if ( null==$id ) { header("Location: index.php"); } 
             if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) 
             { // on initialise nos erreurs $nameError = null; $firstnameError = null; $ageError = null; $telError = null; $emailError = null; $paysError = null; $commentError = null; $metierError = null; $urlError = null; // On assigne nos valeurs $name = $_POST['name']; $firstname = $_POST['firstname']; $age = $_POST['age']; $tel = $_POST['tel']; $email = $_POST['email']; $pays = $_POST['pays']; $comment = $_POST['comment']; $metier = $_POST['metier']; $url = $_POST['url']; // On verifie que les champs sont remplis $valid = true; if (empty($name)) { $nameError = 'Please enter Name'; $valid = false; } if (empty($firstname)) { $firstnameError = 'Please enter firstname'; $valid = false; } if (empty($email)) { $emailError = 'Please enter Email Address'; $valid = false; } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $emailError = 'Please enter a valid Email Address'; $valid = false; } if (empty($age)) { $ageError = 'Please enter your age'; $valid = false; } if (empty($tel)) { $telError = 'Please enter phone'; $valid = false; } if (!isset($pays)) { $paysError = 'Please select a country'; $valid = false; } if (empty($comment)) { $commentError = 'Please enter a description'; $valid = false; } if (!isset($metier)) { $metierError = 'Please select a job'; $valid = false; } if (empty($url)) { $urlError = 'Please enter website url'; $valid = false; } // mise à jour des donnés if ($valid) { $pdo = Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                     
                $sql = "UPDATE utilisateur SET nom = '?',prenom = ?,email = ?,telephone = ?,adresse=?, password = ?, sex = ?, image = ?, isactif = ? WHERE id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($nom,$prenom, $email, $telephone, $adresse,$password,$sex, $image, $isactif,$id));
                Database::disconnect();
                header("Location: listUser.php");
            
             }/*else {
        
                 //$pdo = Database::connect();
                $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM utilisateur where id = ?";
                $q = $BD->prepare($sql);
                $q->execute(array($id));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $nom = $data['nom'];
                $prenom = $data['prenom'];
                $email = $data['email'];
                $telephone = $data['telephone'];
                $password = $data['password'];
                $sex = $data['sex'];
                $image = $data['image'];
                $isactif = $data['isactif'];
                $adresse = $data['adresse'];
               // Database::disconnect();
            }*/
        }
        
        public static function deleteChauffeur(){
            $id=0; 
            if(!empty($_GET['id'])){ $id=$_REQUEST['id']; } 
            if(!empty($_POST)){ $id= $_POST['id']; 
                $pdo=Database::connect(); 
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "DELETE FROM utilisateur  WHERE id = '?'";
                   $q = $pdo->prepare($sql);
                   $q->execute(array($id));
                   Database::disconnect();
                   header("Location: listUser.php");
            }
        }
        
       public static function listUser(){
        global $BD;
        $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql =  "select * from utilisateur ";
        $q = $BD->query($sql);
        
        return $q;
       
        }
        
        public static function listOneUser($id){
            global $BD;
            $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $sql =  "SELECT utilisateur.prenom, utilisateur.nom, utilisateur.adresse, utilisateur.sexe,
           utilisateur.email,utilisateur.telephone,chauffeur.casier,chauffeur.cni,chauffeur.permisconduire,
           chauffeur.fichier_permis,chauffeur.fichier_cni,chauffeur.datechauffeur
            FROM utilisateur 
            INNER JOIN chauffeur ON utilisateur.idutilisateur = chauffeur.idutilisateur where utilisateur.idutilisateur = ?";
            $q = $BD->prepare($sql);
            $q->execute(array($id));

            return $q->fetchAll();
        }
}
