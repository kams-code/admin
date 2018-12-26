<?php

class Auth extends BaseModel {
   
    public function __construct(){
    	
    }


    public static function Login()
    {
    	global $BD;

    	$result = array();
    	$res = $BD->prepare("SELECT * FROM administrateur WHERE login=? AND password=?");
    	$res->execute(array($_REQUEST["login"],$_REQUEST["pass"]));
    	if ($res->rowCount() ==0) {
    		header('Location: ../pagelogin?error=Email ou mot de passe incorrect');
    	}
    	else{
    		$list = $res->fetch();
    		$_SESSION["idadmin"] = $list["idadministrateur"];
    		$_SESSION["nom"] = $list["nom"];
    		$_SESSION["prenom"] = $list["prenom"];
    		header("Location:  ../home");
    	}

    	//echo json_encode($result);
    }

}