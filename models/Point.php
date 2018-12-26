<?php

    Class Point extends BaseModel{

        public function __construct() {

        } 

        public static function arret()
        {
        	global $BD;

        	foreach (TrajetPoint::q()->where("point_idpoint1=? AND point_idpoint2=?",$_REQUEST["point1"],$_REQUEST["point2"])->execute() as $point) {
        		echo "<label class='ispoint col-md-2' id='ispoint".$point->idtrajetpoint."' data-id='".$point->idtrajetpoint."'>".Point::get($point->point_idpoint)->nompoint."</label>";
        	}
        }

}

Class TrajetPoint extends BaseModel{

	public static $tableName ="trajetpoint";

        public function __construct() {

        } 

}
?>