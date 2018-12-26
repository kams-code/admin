<?php

class Garage extends BaseModel {
   
    public function __construct(){
    	
    }

    
    public static function deleteGarage($id){
       
        global $BD;
        if ( $id===null ) { header("Location: index.php"); } 
               $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $sql = "DELETE FROM garage  WHERE idgarage = ?";
                  $q = $BD->prepare($sql);
                  $q->execute(array($id));
       
    }
    
   public static function listGarage(){
    global $BD;
    $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql =  "select * from garage ";
    $q = $BD->query($sql);
    
    return $q;
   
    }
    
    public static function listOneGarage($id){
        global $BD;
        $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql =  "SELECT utilisateur.prenom, utilisateur.nom, utilisateur.adresse, utilisateur.sexe,
       utilisateur.email,utilisateur.telephone,garage.nomGarage,garage.description
        FROM garage 
        INNER JOIN utilisateur ON garage.idutilisateur = utilisateur.idutilisateur where garage.idutilisateur = ?";
        $q = $BD->prepare($sql);
        $q->execute(array($id));

        return $q->fetchAll();
    }
}