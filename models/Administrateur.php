<?php

    Class Administrateur extends BaseModel{

        public function __construct() {

        } 

        public static function ajouterAdministrateur(){
            global $BD;
            $nom = $_REQUEST['nom'];
            $prenom = $_REQUEST['prenom'];
            $login = $_REQUEST['login'];
            $password = $_REQUEST['password'];
            $password = sha1($password);
            if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){
                $sql = "INSERT INTO administrateur (nom,prenom,login,password) values(?, ?, ?, ?)";
                     $q = $BD->prepare($sql);
                     $q->execute(array($nom,$prenom, $login, $password));
                     //Database::disconnect();
                     header("Location: ../listAdministrateur");
         }
        }


        public static function  editAdministrateur($id,$nom,$prenom,$login){
         
            
            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) 
            { // on initialise nos erreurs $nameError = null; $firstnameError = null; $ageError = null; $telError = null; $emailError = null; $paysError = null; $commentError = null; $metierError = null; $urlError = null; // On assigne nos valeurs $name = $_POST['name']; $firstname = $_POST['firstname']; $age = $_POST['age']; $tel = $_POST['tel']; $email = $_POST['email']; $pays = $_POST['pays']; $comment = $_POST['comment']; $metier = $_POST['metier']; $url = $_POST['url']; // On verifie que les champs sont remplis $valid = true; if (empty($name)) { $nameError = 'Please enter Name'; $valid = false; } if (empty($firstname)) { $firstnameError = 'Please enter firstname'; $valid = false; } if (empty($email)) { $emailError = 'Please enter Email Address'; $valid = false; } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $emailError = 'Please enter a valid Email Address'; $valid = false; } if (empty($age)) { $ageError = 'Please enter your age'; $valid = false; } if (empty($tel)) { $telError = 'Please enter phone'; $valid = false; } if (!isset($pays)) { $paysError = 'Please select a country'; $valid = false; } if (empty($comment)) { $commentError = 'Please enter a description'; $valid = false; } if (!isset($metier)) { $metierError = 'Please select a job'; $valid = false; } if (empty($url)) { $urlError = 'Please enter website url'; $valid = false; } // mise à jour des donnés if ($valid) { $pdo = Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
               $sql = "UPDATE Administrateur SET nom = '?',prenom = ?,login = ?WHERE id = ?";
               $q = $pdo->prepare($sql);
               $q->execute(array($nom,$prenom, $login,$id));
               //Database::disconnect();
               header("Location: ../listAdministrateur");
           
            }
       }
       
       public static function deleteAdministrateur($id){
            global $BD;
        if ( $id===null ) { header("Location: index.php"); } 
               $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $sql = "DELETE FROM administrateur  WHERE idadministrateur = ?";
                  $q = $BD->prepare($sql);
                  $q->execute(array($id));
                  //Database::disconnect();
                  //header("Location: ../listAdministrateur");
           
       }
        
        public static function listAdministrateur(){
        global $BD;
         $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql =  "select * from administrateur ";
         $q = $BD->query($sql);
         
         return $q;
        
        }

}
?>