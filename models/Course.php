<?php
    Class CourseTrajet extends BaseModel{

        public static $tableName = "coursetrajet";

        public function __construct() {

        } 
    }

    Class CourseHoraire extends BaseModel{

        public static $tableName = "coursehoraire";

        public function __construct() {

        } 
    }

    Class CourseOption extends BaseModel{

        public static $tableName = "course_option";

        public function __construct() {

        } 
    }

    Class OptionCourse extends BaseModel{

        public static $tableName = "option_course";

        public function __construct() {

        } 
    }

    Class Course extends BaseModel{

        public function __construct() {

        } 

        public function getplaceprise()
        {
            global $BD;

            $nombreplace = $BD->query("SELECT COALESCE(sum(nombre_place),0) as place from reservation where course_idcourse=".$this->idcourse);
            $nbp = $nombreplace->fetch();
            return $nbp["place"];
        }

        public static function reserver()
        {
            global $BD;

            $result = array();

            $trajet = Course::get($_REQUEST["course"]);
            $nombrereservation = Reservation::q()->where("course_idcourse=?",$_REQUEST["course"])->count();
            $place ="";$trajeta="";

            $getid = $BD->query("SELECT max(idreservation) as idreservation FROM reservation");
            if ($getid->rowCount() == 0) {
                $id=1;
            }
            else{
                $getiid = $getid->fetch();
                $id=$getiid["idreservation"]+1;
            }

            if ($trajet->nombre_place != $nombrereservation) {
                if ($trajet->type == "express") {
                    $addreservation = $BD->prepare('INSERT INTO `reservation`(`idreservation`,`idvalider`, `course_idcourse`, `utilisateur_idutilisateur`, `nombre_place`) VALUES (?,?,?,?,?)');
                    $addreservation->execute(array($id,1,$_REQUEST["course"],$_SESSION["iddrive"],$_REQUEST["nbplace"]));
                }
                else{
                    $addreservation = $BD->prepare('INSERT INTO `reservation`(`idreservation`, `course_idcourse`, `utilisateur_idutilisateur`, `nombre_place`) VALUES (?,?,?,?)');
                    $addreservation->execute(array($id,$_REQUEST["course"],$_SESSION["iddrive"],$_REQUEST["nbplace"]));
                }
            }
            
            for ($i=1; $i <= $nombrereservation ; $i++) { 
                $place .='<span class="Booking-seatAvailable active" title="Place prise"></span>';
            }

            if ($nombrereservation == 0) {
                $nombrereservation = 1;
            }

            for ($i=$nombrereservation; $i <= $trajet->nombre_place ; $i++) { 
                $place .='<span class="Booking-seatAvailable" title="Place disponible"></span>';
            }

            for ($i=1; $i <= ($trajet->nombre_place-$nombrereservation) ; $i++) { 
                $trajeta .='<option value="'.$i.'">'.$i.' place'.($i<=1 ? '' : 's').'</option>';
            }

            $result["place"] = $place;
            $result["nombreplace"] = $trajeta;

            echo json_encode($result);
        }

        public static function save()
        {
        	global $BD;

            $result = array();

            $getid = $BD->query("SELECT max(idcourse) as idcourse FROM course");
            if ($getid->rowCount() == 0) {
                $id=1;
            }
            else{
                $getiid = $getid->fetch();
                $id=$getiid["idcourse"]+1;
            }

            if ($_REQUEST["frequence"] == "unique") {
                $datealler = "";
                $heurealler ="";
            }
            else{
                $datealler = date("Y-m-d",strtotime($_REQUEST["datedepart"]));
                $heurealler =$_REQUEST["heuredepart"];
            }

            $course = $BD->prepare('INSERT INTO `course`(`idcourse`, `idchauffeur`, `type`, `lieu_depart`, `lieu_arrive`, `datealler`, `heurealler`, `prix`, `frequence`, `point_idpoint`, `point_idpoint1`, `nombre_place`, `validation_express`, `bagage`, `description`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $course->execute(array($id,Chauffeur::q()->where("idutilisateur =?",$_SESSION["iddrive"])->execute()[0]->idchauffeur,$_REQUEST["reservation"],$_REQUEST["lieudepart"],$_REQUEST["lieuarrivee"],$datealler,$heurealler,$_REQUEST["prixtrajet"],$_REQUEST["frequence"],$_REQUEST["depart"],$_REQUEST["arrive"],$_REQUEST["nbpassager"],$_REQUEST["reservation"],$_REQUEST["bagage"],$_REQUEST["details"]));

            $listeo = explode(",", $_REQUEST["optionliste"]);
            for ($i=0; $i <count($liste) ; $i++) { 
                if (strlen($listeo[$i]) != 0) {
                    $course_option = $BD->prepare('INSERT INTO `course_option`(`idcourse`, `idoption`) VALUES (?,?)');
                    $course_option->execute(array($id,$listeo[$i]));
                }
            }

            for ($i=1; $i <=$_REQUEST["nbetape"] ; $i++) { 

                $getid = $BD->query("SELECT max(idcourset) as idcourset FROM coursetrajet");
                if ($getid->rowCount() == 0) {
                    $idt=1;
                }
                else{
                    $getiid = $getid->fetch();
                    $idt=$getiid["idcourset"]+1;
                }

                $coursetrajet = $BD->prepare('INSERT INTO `coursetrajet`(`idcoursetrajet`, `prix`, `course_idcourse`, `nompoint`) VALUES (?,?,?,?)');
                $coursetrajet->execute(array($idt,$_REQUEST["prixtrajet".$i],$id,$_REQUEST["arret".$i]));
            }

            if ($_REQUEST["frequence"]=="reguliere")
            {
                $listejjouraller = explode(",", $_REQUEST["listaller"]);
                $listejjourretour = explode(",", $_REQUEST["listretour"]);
                if ($_REQUEST["typehoraire"] == "fixe") {
                    $heuredepart = $_REQUEST["heuredepart"];
                    $heure_retour = $_REQUEST["heurearrivee"];

                    for ($i=0; $i <count($listejjouraller) ; $i++) { 
                        if (strlen($listejjouraller[$i]) != 0) {
                            $getid = $BD->query("SELECT max(idcoursehoraire) as idcoursehoraire FROM coursehoraire");
                            if ($getid->rowCount() == 0) {
                                $idh=1;
                            }
                            else{
                                $getiid = $getid->fetch();
                                $idh=$getiid["idcoursehoraire"]+1;
                            }
                            $jour = explode("~", $listejjouraller[$i])[0];
                            $coursehoraire = $BD->prepare('INSERT INTO `coursehoraire`(`idcoursehoraire`, `jour`, `heure_depart`, `heure_retour`, `course_idcourse`) VALUES (?,?,?,?,?)');
                            $coursehoraire->execute(array($idh,$jour,$heuredepart,'',$id));
                        }
                    }
                    for ($i=0; $i <count($listejjourretour) ; $i++) { 
                        if (strlen($listejjourretour[$i]) != 0) {
                            $getid = $BD->query("SELECT max(idcoursehoraire) as idcoursehoraire FROM coursehoraire");
                            if ($getid->rowCount() == 0) {
                                $idh=1;
                            }
                            else{
                                $getiid = $getid->fetch();
                                $idh=$getiid["idcoursehoraire"]+1;
                            }
                            $jour = explode("~", $listejjourretour[$i])[0];
                            $coursehoraire = $BD->prepare('INSERT INTO `coursehoraire`(`idcoursehoraire`, `jour`, `heure_depart`, `heure_retour`, `course_idcourse`) VALUES (?,?,?,?,?)');
                            $coursehoraire->execute(array($idh,$jour,'',$heure_retour,$id));
                        }
                    }

                }
                if ($_REQUEST["typehoraire"] == "variable") {
                    for ($i=0; $i <count($listejjouraller) ; $i++) { 
                        if (strlen($listejjouraller[$i]) != 0) {
                            $getid = $BD->query("SELECT max(idcoursehoraire) as idcoursehoraire FROM coursehoraire");
                            if ($getid->rowCount() == 0) {
                                $idh=1;
                            }
                            else{
                                $getiid = $getid->fetch();
                                $idh=$getiid["idcoursehoraire"]+1;
                            }
                            $jour = explode("~", $listejjouraller[$i])[0];
                            $heure = explode("~", $listejjouraller[$i])[1];
                            $coursehoraire = $BD->prepare('INSERT INTO `coursehoraire`(`idcoursehoraire`, `jour`, `heure_depart`, `heure_retour`, `course_idcourse`) VALUES (?,?,?,?,?)');
                            $coursehoraire->execute(array($idh,$jour,$heure,'',$id));
                        }
                    }
                    for ($i=0; $i <count($listejjourretour) ; $i++) { 
                        if (strlen($listejjourretour[$i]) != 0) {
                            $getid = $BD->query("SELECT max(idcoursehoraire) as idcoursehoraire FROM coursehoraire");
                            if ($getid->rowCount() == 0) {
                                $idh=1;
                            }
                            else{
                                $getiid = $getid->fetch();
                                $idh=$getiid["idcoursehoraire"]+1;
                            }
                            $jour = explode("~", $listejjourretour[$i])[0];
                            $heure = explode("~", $listejjourretour[$i])[1];
                            $coursehoraire = $BD->prepare('INSERT INTO `coursehoraire`(`idcoursehoraire`, `jour`, `heure_depart`, `heure_retour`, `course_idcourse`) VALUES (?,?,?,?,?)');
                            $coursehoraire->execute(array($idh,$jour,'',$heure,$id));
                        }
                    }
                }
            }

            $result["status"] = 'success';
            $result["id"] = $id;

            echo json_encode($result);

        }

        public function Build()
        {
            global $BD;

            $nombretotal = Avis::q()->where("type='Chauffeur to Client' AND course_idcourse=?",$this->idcourse)->count();

            $getnote = $BD->query("SELECT COALESCE(sum(note),0) as soen from rating where type='Chauffeur to Client' AND course_idcourse=".$this->idcourse);
            $getn = $getnote->fetch();
            if ($nombretotal == 0) {
                $note = 0;
            }
            else{
                $note = $getn["soen"] / $nombretotal;
            }

            $nombrearret = CourseTrajet::q()->where("course_idcourse=?",$this->idcourse)->count();


            
        	?>
        		<div class="col-md-12 lignetrajet" style="padding: 10px 0px;cursor: pointer" onclick="window.location='trajet/<?=$this->idcourse?>'">
        			<div class="row" style="margin: 0">
        				<div class="col-md-3" style="display: flex;    border-right: 1px solid #ccc;padding-left: 0px">
        					<div class="col-md-12" style="padding: 0px;text-align: center;">
        						<center><img style="width: 60px;height: 60px;border-radius: 50%" src="<?=strlen(Utilisateur::get(Chauffeur::get($this->idchauffeur)->idutilisateur)->image) == 0 ? 'assets/images/uploads/profile.jpg' : 'images/utilisateur/'.Utilisateur::get(Chauffeur::get($this->idchauffeur)->idutilisateur)->image ?>"></center>
                                <h6 style="margin-bottom: 0px;    font-size: 19px; font-weight: bold; color: rgb(51, 51, 51);margin:0.5em 0px; "><?=Utilisateur::get(Chauffeur::get($this->idchauffeur)->idutilisateur)->nom?></h6>
                                <div class="row" style="margin: 0;">
                                    <div class="col-md-4">
                                        <i class="fa fa-list-alt" <?=Chauffeur::get($this->idchauffeur)->ispermis == 0 ? 'title="Permis de conduire non vérifié"' : 'title="Permis de conduire vérifié" style="color:green"'?>></i>
                                    </div>
                                    <div class="col-md-4">
                                        <i class="fa fa-credit-card" <?=Chauffeur::get($this->idchauffeur)->iscni == 0 ? 'title="Piece d\'identité non vérifiée"' : 'title="Piece d\'identité vérifiée" style="color:green"'?>></i>
                                    </div>
                                    <div class="col-md-4">
                                        <i class="fa fa-file" <?=Chauffeur::get($this->idchauffeur)->iscni == 0 ? 'title="Casier judiciaire non vérifié"' : 'title="Casier judiciaire vérifié" style="color:green"'?>></i>
                                    </div>
                                </div>
                                <label style="margin:0.8em 0px;margin-bottom: 0px !important"><i class="fa fa-star" style="color:#00a0e1"></i>&nbsp;&nbsp;<span><?=$note?> / 5</span> - <span><?=$nombretotal?> avis</span></label>
        					</div>
        				</div>
        				<div class="col-md-9" style="padding: 0px">
        					<div class="row" style="margin: 0">
                                <div class="col-md-2" style="color: #00a0e1;font-weight: 600;font-size: 15px;flex: 0 0 12.666667%;max-width:12.666667%;padding-right: 0px">
                                    <?=substr($this->heurealler, 0,2)." H ".substr($this->heurealler, 3,2)?>
                                </div>
                                <div class="col-md-6" style="padding-left: 5px">
                                    <span style="font-size: 0.9em; margin: 0px 0.2em; padding: 5px;background-color: #000!important;color: white;border-radius: 3px;font-weight: 600"><?=format_dateLitteral($this->datealler)?></span>
                                </div>
                                <div class="col-md-4 spaceregulier" style="padding-right: 0px;flex: 0 0 37%;max-width: 37%;<?=$this->frequence == 'regulier' ? 'display: none' : 'display: block'?>">
                                    <table style="margin-bottom: 0px">
                                        <tr style="border:1px solid #ccc"> 
                                            <td style="    background: #00a0e1;border: 1px solid #00a0e1;">
                                                <i class="fa fa-car"></i>
                                            </td>
                                            <td <?=CourseHoraire::q()->where("course_idcourse=? AND jour=1",$this->idcourse)->count() == 0 ? '' :  'style="color:#00a0e1"'?>>
                                                L
                                            </td>
                                            <td <?=CourseHoraire::q()->where("course_idcourse=? AND jour=2",$this->idcourse)->count() == 0 ? '' :  'style="color:#00a0e1"'?>>
                                                M
                                            </td>
                                            <td <?=CourseHoraire::q()->where("course_idcourse=? AND jour=3",$this->idcourse)->count() == 0 ? '' :  'style="color:#00a0e1"'?>>
                                                M
                                            </td>
                                            <td <?=CourseHoraire::q()->where("course_idcourse=? AND jour=4",$this->idcourse)->count() == 0 ? '' :  'style="color:#00a0e1"'?>>
                                                J
                                            </td>
                                            <td <?=CourseHoraire::q()->where("course_idcourse=? AND jour=5",$this->idcourse)->count() == 0 ? '' :  'style="color:#00a0e1"'?>>
                                                V
                                            </td>
                                            <td <?=CourseHoraire::q()->where("course_idcourse=? AND jour=6",$this->idcourse)->count() == 0 ? '' :  'style="color:#00a0e1"'?>>
                                                S
                                            </td>
                                            <td <?=CourseHoraire::q()->where("course_idcourse=? AND jour=7",$this->idcourse)->count() == 0 ? '' :  'style="color:#00a0e1"'?>>
                                                D
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="margin: 0">
                                <div class="col-md-1" style="color: rgb(107, 107, 107);padding: 15px;display: flex;">
                                    <img src="assets/images/option/location-pin.png">
                                </div>
                                <div class="col-md-11" style="display: flex; justify-content: left; align-items: center; padding-left: 0px;"> 
                                    <label style="margin-bottom: 0px"><?=Point::get($this->point_idpoint)->nompoint?>, <?=strlen($this->lieu_depart) == 0 ? '' : $this->lieu_depart ?></label>
                                </div>
                                <div class="col-md-1" style="color: rgb(107, 107, 107);padding: 15px;display: flex;padding-top: 0px;padding-bottom: 0px">
                                    <img src="assets/images/option/right-arrow.png">
                                </div>
                                <div class="col-md-11" style="padding-left: 0px">
                                    <label style="margin-bottom: 0px"><?=Point::get($this->point_idpoint1)->nompoint?>, <?=strlen($this->lieu_arrive) == 0 ? '' : $this->lieu_arrive ?></label>
                                </div>
                                <div class="col-md-12" style="text-align: right;padding-right: 0px">
                                    <label><?=$nombrearret == 0 ? 'Ligne direct' : $nombrearret.' point arret'?></label>
                                </div>
                                <div class="row" style="border-top: 1px solid #ccc;margin: 0;width: 100%;">
                                    <div class="col-md-2" style="text-align: left;height: 40px;display: flex;justify-content: left;vertical-align: middle;align-items: center;">
                                        <label style="margin-bottom: 0px"><?=$this->nombre_place?> place<?=$this->nombre_place <=1 ? '' : 's'?></label>
                                    </div>
                                    <div class="col-md-7" style="text-align: left;height: 40px;display: flex;justify-content: flex-end;vertical-align: middle;align-items: center;padding-right: 0px">
                                        <?php
                                            foreach (CourseOption::q()->where("idcourse=?",$this->idcourse)->execute() as $option) {
                                                ?>
                                                    &nbsp;&nbsp;&nbsp;<img title="<?=OptionCourse::get($option->idoption)->intitule?>" src="assets/images/option/<?=OptionCourse::get($option->idoption)->icon?>" style="">
                                                <?php
                                            }
                                        ?>  
                                    </div>
                                    <div class="col-md-3" style="text-align: right;height: 40px;display: flex;justify-content: flex-end;vertical-align: middle;align-items: center;padding: 0px">
                                        <label style="margin-bottom: 0px;font-size: 1.5em;;color: #000;font-weight: 600"><?=format_money($this->prix)." ".$_SESSION["monnaie"]?></label>
                                    </div>
                                </div>
                            </div>
        				</div>
        			</div>
        		</div>
        	<?php
        }

}
?>