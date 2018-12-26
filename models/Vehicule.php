<?php

    Class Vehicule extends BaseModel{

        public function __construct() {

        } 
    
		public static function deleteVehicule(){
			global $BD;
			if ( $id===null ) { header("Location: index.php"); } 
				   $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				   $sql = "DELETE FROM vehicule  WHERE idvehicule = ?";
					  $q = $BD->prepare($sql);
					  $q->execute(array($id));
		}
		
		public static function listVehicule(){
			global $BD;
			$BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql =  "select * from vehicule ";
			$q = $BD->query($sql);
			
			return $q;
		   
		}

		public static function listOneVehicule($id){
            global $BD;
            $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $sql =  "SELECT utilisateur.prenom, utilisateur.nom, utilisateur.adresse, utilisateur.sexe,
           utilisateur.email,utilisateur.telephone,vehicule.nomvehicule,vehicule.couleurvehicule
            FROM vehicule
            INNER JOIN utilisateur ON vehicule.idutilisateur=utilisateur.idutilisateur where vehicule.idvehicule = ?";
            $q = $BD->prepare($sql);
            $q->execute(array($id));

            return $q->fetchAll();
		}
}
?>