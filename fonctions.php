<?php

  
    define("ENCRYPTION_KEY", "!@#$%^&*");
  
  function encrypt($pure_string, $encryption_key) {
      $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
      $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
      $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
      return $encrypted_string;
  }

  /**
   * Returns decrypted original string
   */
  function decrypt($encrypted_string, $encryption_key) {
      $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
      $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
      $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
      return $decrypted_string;
  }

  function checkActive($value){
    if(isset($_GET['action']) && $_GET['action']==$value){
      return true;
    }else{
      return false;
    }
  }
  function isVideo($text){
      $extensions_video = array('mp4','avi','wmv');
      if(in_array(explode('.', $text)[1], $extensions_video)){
         return true;
      }
      return false;
  }
  function strToHex($string){
    $hex = '';
    for ($i=0; $i<strlen($string); $i++){
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= substr('0'.$hexCode, -2);
    }
    return strToUpper($hex);
}
function hexToStr($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}
  function has_prefix($string, $prefix) {
     return ((substr($string, 0, strlen($prefix)) == $prefix) ? true : false);
  }
  function buildSlideBonjour(){
    global $BD;
    $getbonjour = $BD->query("SELECT * FROM slide_bonjour ORDER BY rand() LIMIT 7");
      $i =1;
      while ($getb = $getbonjour->fetch()) {
          if ($i == 1) {
            $active = "active";
          }else{
            $active = "";
          }
            echo '<div class="'.$active.' item">
                <h2 style="color: white">'.($getb["TRADUCTION"]).'</h2>
                <label style="font-size:10px;color:white;">'.($getb["LANGUE"]).'</label>
            </div>';
          $i++;
      }
  }


  function cmp($a, $b) {
      if ($a == $b) {
          return 0;
      }
      return ($a < $b) ? -1 : 1;
  }
  function getYouTubeVideoDuration($videoID){
     $apikey = "AIzaSyBY2sC1MQDEVAKrGzaKB41x7BsAmuY_hV4"; // Like this AIcvSyBsLA8znZn-i-aPLWFrsPOlWMkEyVaXAcv
     $dur = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$videoID&key=$apikey");
     $VidDuration =json_decode($dur, true);
     foreach ($VidDuration['items'] as $vidTime)
     {
         $VidDuration= $vidTime['contentDetails']['duration'];
     }
     preg_match_all('/(\d+)/',$VidDuration,$parts);
     if(count($parts[0])==1)
      return $parts[0][0];
     else if(count($parts[0])==2)
      return $parts[0][0].":".$parts[0][1];
     else
      return $parts[0][0].":".$parts[0][1].":".$parts[0][2]; // Return 1:11:46 (i.e) HH:MM:SS
  }
  function traduireSite($text){
    global $BD;
    global $translate;
 
      echo $text;
    //}

  }

  function getDayOfWeek($date){
      $days = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi','Jeudi','Vendredi', 'Samedi');
      echo $days[date('w', strtotime($date))];
  }
  function getrealip(){
     if (isset($_SERVER)){
    if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    if(strpos($ip,",")){
    $exp_ip = explode(",",$ip);
    $ip = $exp_ip[0];
    }
    }else if(isset($_SERVER["HTTP_CLIENT_IP"])){
    $ip = $_SERVER["HTTP_CLIENT_IP"];
    }else{
    $ip = $_SERVER["REMOTE_ADDR"];
    }
    }else{
    if(getenv('HTTP_X_FORWARDED_FOR')){
    $ip = getenv('HTTP_X_FORWARDED_FOR');
    if(strpos($ip,",")){
    $exp_ip=explode(",",$ip);
    $ip = $exp_ip[0];
    }
    }else if(getenv('HTTP_CLIENT_IP')){
    $ip = getenv('HTTP_CLIENT_IP');
    }else {
    $ip = getenv('REMOTE_ADDR');
    }
    }
    return $ip; 
  }


  function MakeUrls($str){
    $find=array('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','`((?<!//)(www\.\S+[[:alnum:]]/?))`si');

    $replace=array('<a href="$1" target="_blank">$1</a>', '<a href="http://$1" target="_blank">$1</a>');

    return preg_replace($find,$replace,$str);
  }

  function notifier($user_id, $id_element, $id_element2, $type, $type_element){
    global $BD;
    $R=$BD->prepare('INSERT INTO `notification`(`IdUtilisateur2`, `IdUtilisateur1`, `IdElement1`, `IdElement2`, `TYPE`, `TYPE_ELEMENT`) VALUES (?,?,?,?,?,?)');
      $R->execute(array($user_id,$_SESSION['iduserzarb'], $id_element, $id_element2, $type, $type_element));
  }

  function notif($BD,$id,$id2,$id_element,$action,$type_id2,$type_element){
    try{
      
      $IdGroupe = NULL; $IdCommunaute = NULL; $IdUtilisateur = NULL;
      
      switch($type_id2){ // type de cible concernee
        case 'groupe':
          $IdGroupe = $id2;
        break;
        case 'communaute':
          $IdCommunaute = $id2;
        break;
        case 'utilisateur':
          $IdUtilisateur = $id2;
        break;
      }
      
      $R=$BD->prepare('INSERT INTO `notification`(`IdUtilisateur1`, `IdUtilisateur2`, `IdGroupe`, `IdCommunaute`, `IdElement1`, `TYPE`, `TYPE_ELEMENT`, `DATENOTIFICATION`) VALUES (?,?,?,?,?,?,?,NOW())');
      $R->execute(array(i($id),i($IdUtilisateur),i($IdGroupe),i($IdCommunaute),i($id_element),a($action),a($type_element)));
      
    }catch(Exception $e){
      
      die('Erreur sur le systeme des Notifications : '.$e->getMessage());
      
    } 
  }

  function notif2($BD,$id,$id2,$id_element,$id_element2,$action,$type_id2,$type_element){
    try{
      
      $IdGroupe = NULL; $IdCommunaute = NULL; $IdUtilisateur = NULL;
      
      switch($type_id2){ // type de cible concernee
        case 'groupe':
          $IdGroupe = $id2;
        break;
        case 'communaute':
          $IdCommunaute = $id2;
        break;
        case 'utilisateur':
          $IdUtilisateur = $id2;
        break;
      }
      
      $R=$BD->prepare('INSERT INTO `notification`(`IdUtilisateur1`, `IdUtilisateur2`, `IdGroupe`, `IdCommunaute`, `IdElement1`, `IdElement2`, `TYPE`, `TYPE_ELEMENT`, `DATENOTIFICATION`) VALUES (?,?,?,?,?,?,?,?,NOW())');
      $R->execute(array(i($id),i($IdUtilisateur),i($IdGroupe),i($IdCommunaute),i($id_element),i($id_element2),a($action),a($type_element)));
      
    }catch(Exception $e){
      
      die('Erreur sur le systeme des Notifications : '.$e->getMessage());
      
    } 
  }
  function size($taille,$dim){if(str_word_count($taille)>$dim){$ref='...';}else{$ref='';}return $ref;}
  function pp($char,$size){return substr($char,0,$size).size($char,$size);}
  function s($tr){return str_replace("\'","'",htmlspecialchars($tr));}
  function sa($tr){return str_replace("'","\'",htmlspecialchars($tr));}
  function a($mot){return Addslashes($mot);}
  function i($chiff){return intval($chiff);}
  function r($a,$b,$char){return s(str_replace($a,$b,$char));}
  

  /**
  * [InsertSummerNote Enregistrement du text provenant du summernote pour eliminer les zones comme ]
  * @param [type] $string [description]
  */
  function InsertSummerNote($string){
    $array_notallowed = array('<script', '<style', '< script', '< style',  '<link',  '< link', '<html', '< html', '<head', '< head', '<title', '< title', '<meta', '< meta', '<base', '< base');
    $toreturn = $string;
    for ($i=0; $i < sizeof($array_notallowed); $i++) { 
      if (in_array($array_notallowed[$i], $toreturn)) {
          $toreturn = r($array_notallowed[$i], "<znone", $toreturn);
      }
    }
    return $toreturn;
  }

  function removehtmlTags($string){
    return s($string);
  }
  
  function format_date($date){
    $utc = new DateTime($date, new DateTimeZone('UTC'));
    $utc->setTimezone(new DateTimeZone('Africa/Douala'));
    return $utc->format('d-m-Y à H:i:s');}
    function format_dateLitteral($date){
    $utc = new DateTime($date, new DateTimeZone('UTC'));
    $utc->setTimezone(new DateTimeZone('Africa/Douala'));
    return $utc->format('l F Y');}
  function format_dateToTime($date){
    $utc = new DateTime($date, new DateTimeZone('UTC'));
    $utc->setTimezone(new DateTimeZone('Africa/Douala'));
    return $utc->format('H:i');}
  function customformat_date($date){
    $utc = new DateTime($date, new DateTimeZone('UTC'));
    $utc->setTimezone(new DateTimeZone('Africa/Douala'));
    return $utc->format('d-F-Y à H:i:s');}
  function format_dateDate($date){
    $utc = new DateTime($date, new DateTimeZone('UTC'));
    $utc->setTimezone(new DateTimeZone('Africa/Douala'));
    return $utc->format('d/m/Y');}
  function getConvertFileSize($path){
    $bytes = sprintf('%u', filesize($path));

    if ($bytes > 0)
    {
        $unit = intval(log($bytes, 1024));
        $units = array('B', 'KB', 'MB', 'GB');

        if (array_key_exists($unit, $units) === true)
        {
            return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
        }
    }

    return $bytes;
}
function getTagExpression( $str) {
    preg_match('/#(.*?)Z/', $str, $matches);
    return $matches;
}
function getTagValues($tag, $str) {
    $re = sprintf("/\{(%s)\}(.+?)\{\/\\1\}/", preg_quote($tag));
    preg_match_all($re, $str, $matches);
    return $matches[2];
}
function getRelativeTime($date) { //Mon incroyable Fonction de Date
   // Déduction de la date donnée à la date actuelle

  $utc = new DateTime($date, new DateTimeZone('Africa/Douala'));
  $utc->setTimezone(new DateTimeZone('Africa/Douala'));
  $date = $utc->format('Y-m-d H:i:s');
  
  $diff = time() - strtotime($date);
  if($diff == 0) {
      return 'maintenant';
  } elseif($diff > 0) {
      $day_diff = floor($diff / 86400);
      if($day_diff == 0) {
          if($diff < 60) return 'il y\'a un instant';
          if($diff < 120) return 'il y\'a une minute';
          if($diff < 3600) return 'il y\'a '.floor($diff / 60) . ' minutes';
          if($diff < 7200) return 'il y\'a une heure';
          if($diff < 86400) return 'il y\'a '.floor($diff / 3600) . ' heures';
      }
      if($day_diff == 1) { return 'Hier'; }
      if($day_diff < 7) { return 'il y\'a '.$day_diff . ' jours'; }
      if($day_diff < 31) { return 'il y\'a '.ceil($day_diff / 7) . ' semaines'; }
      if($day_diff < 60) { return 'le mois passé'; }
      return date('F Y', $ts);
  } else {
      $diff = abs($diff);
      $day_diff = floor($diff / 86400);
      if($day_diff == 0) {
          if($diff < 120) { return 'dans une minute'; }
          if($diff < 3600) { return 'dans ' . floor($diff / 60) . ' minutes'; }
          if($diff < 7200) { return 'dans une heure'; }
          if($diff < 86400) { return 'dans ' . floor($diff / 3600) . ' heures'; }
      }
      if($day_diff == 1) { return 'Demain'; }
      if($day_diff < 4) { return date('l', $ts); }
      if($day_diff < 7 + (7 - date('w'))) { return 'La semaine prochaine'; }
      if(ceil($day_diff / 7) < 4) { return 'dans ' . ceil($day_diff / 7) . ' semaines'; }
      if(date('n', $ts) == date('n') + 1) { return 'le mois prochain'; }
      return date('F Y', $ts);
  }

}

function formatDateAgo($value){
    $time = strtotime($value);
    $d = new \DateTime($value);

    $weekDays = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    $months = ['Janvier', 'Février', 'Mars', 'Avril',' Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

    /*if ($time > strtotime('-2 minutes'))
    {
        return 'Il y a quelques secondes';
    }
    elseif ($time > strtotime('-30 minutes'))
    {
        return 'Il y a ' . floor((strtotime('now') - $time)/60) . ' min';
    }*/
    if ($time > strtotime('-2 minutes'))
    {
        return $d->format('G:i');
    }
    elseif ($time > strtotime('-30 minutes'))
    {
        return $d->format('G:i');
    }
    elseif ($time > strtotime('today'))
    {
        return $d->format('G:i');
    }
    elseif ($time > strtotime('yesterday'))
    {
        return 'Hier, ' . $d->format('G:i');
    }
    elseif ($time > strtotime('this week'))
    {
        return $weekDays[$d->format('N') - 1] . ', ' . $d->format('G:i');
    }
    else
    {
        return $d->format('j') . ' ' . $months[$d->format('n') - 1] . ', ' . $d->format('G:i');
    }
}


function getRelativeDayes($date) { //Mon incroyable Fonction de Date
   // Déduction de la date donnée à la date actuelle

  $utc = new DateTime($date, new DateTimeZone('Africa/Douala'));
  $utc->setTimezone(new DateTimeZone('Africa/Douala'));
  $date = $utc->format('Y-m-d H:i:s');
  
  $diff = time() - strtotime($date);
  if($diff == 0) {
      return 'maintenant';
  } elseif($diff > 0) {
      $day_diff = floor($diff / 86400);
      if($day_diff == 0) {
          if($diff < 60) return 'il y\'a un instant';
          if($diff < 120) return 'il y\'a une minute';
          if($diff < 3600) return 'il y\'a '.floor($diff / 60) . ' minutes';
          if($diff < 7200) return 'il y\'a une heure';
          if($diff < 86400) return 'il y\'a '.floor($diff / 3600) . ' heures';
      }
      if($day_diff == 1) { return 'Hier'; }
      if($day_diff < 7) { return 'il y\'a '.$day_diff . ' jours'; }
      if($day_diff < 31) { return 'il y\'a '.ceil($day_diff / 7) . ' semaines'; }
      if($day_diff < 60) { return 'le mois passé'; }
      return date('F Y', strtotime($date));
  } else {
      $diff = abs($diff);
      $day_diff = floor($diff / 86400);
      if($day_diff == 0) {
          if($diff < 120) { return 'dans une minute'; }
          if($diff < 3600) { return 'dans ' . floor($diff / 60) . ' minutes'; }
          if($diff < 7200) { return 'dans une heure'; }
          if($diff < 86400) { return 'dans ' . floor($diff / 3600) . ' heures'; }
      }
      if($day_diff == 1) { return 'Demain'; }
      if($day_diff < 4) { return date('l', $ts); }
      if($day_diff < 7 + (7 - date('w'))) { return 'La semaine prochaine'; }
      if(ceil($day_diff / 7) < 4) { return 'dans ' . ceil($day_diff / 7) . ' semaines'; }
      if(date('n', $ts) == date('n') + 1) { return 'le mois prochain'; }
      return date('F Y', strtotime($date));
  }

}

  function format_date3($date){

    $date=explode('-',(explode(' ', $date)[0]));
    $annee=$date[0]; $jour=$date[2]; $mois=$date[1];
    $listemois= array('','Jan','Fev','Mars','Avr','Mai','Juin','Juil','Août','Sept','Oct','Nov','Dec');
    $newmois=$listemois[($mois+0)];
    return $jour." ".$newmois." ".$annee;

  }

  function format_dateHour($date1){

    $date=explode('-',(explode(' ', $date1)[0]));
    $heure=explode(' ', $date1)[1];
    $annee=$date[0]; $jour=$date[2]; $mois=$date[1];
    $listemois= array('','Jan','Fev','Mars','Avr','Mai','Juin','Juil','Août','Sept','Oct','Nov','Dec');
    $newmois=$listemois[($mois+0)];
    return $jour." ".$newmois." ".$annee." à ".$heure;

  }
  
  function getJourSemaine($i){
    switch ($i) {
      case '1':
        return 'Lundi';
        break;
      case '2':
        return 'Mardi';
        break;
      case '3':
        return 'Mercredi';
        break;
      case '4':
        return 'Jeudi';
        break;
      case '5':
        return 'Vendredi';
        break;
      case '6':
        return 'Samedi';
        break;
      case '7':
        return 'Dimanche';
        break;
      
      default:
        return '';
        break;
    }
  }

  function getBaseUrl(){
    $base_dir = __DIR__;

    // server protocol
    $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';

    // domain name
    $domain = $_SERVER['SERVER_NAME'];

    // server port
    $port = $_SERVER['SERVER_PORT'];
    $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";

    // put em all together to get the complete base URL
    $url = "${protocol}://${domain}${disp_port}".BASEURL;

    return $url;
  }

  function geEements($data){
    return $data;
  }


  function minimumQuatreChiffre($number){
    if(strlen($number)==1){
      return "000".$number;
    }
    else if(strlen($number)==2){
      return "00".$number;
    }
    else if(strlen($number)==3){
      return "0".$number;
    }
    else if(strlen($number)>3){
      return "".$number;
    }
    else {
      return "".$number;
    }
  }

  function format_money($number){
    $n = $number;
    /*if($_SESSION['lang']=='fr')
      $n = number_format($number, 0, ',', ' ');
    else
      $n = number_format($number);*/
    $n = number_format($number, 0);
      return str_replace(",", " ", $n);
  }
  function getUsersWithPrivilege($privilege){
    global $BD;
      $sql = $BD->prepare("SELECT ID_UTILISATEUR FROM direction_privilege, privilege, utilisateur_direction WHERE utilisateur_direction.ID_DIRECTION = direction_privilege.ID_DIRECTION AND direction_privilege.ID_PRIVILEGE = privilege.IDPRIVILEGE AND privilege.NAME = ?");
      $sql->execute(array($privilege));
      return $sql->fetch();
  }
  function getUsersReceiveNotification($privilege){
    global $BD;
      $sql = $BD->prepare("SELECT ID_UTILISATEUR FROM direction_notification, notification, utilisateur_direction WHERE utilisateur_direction.ID_DIRECTION = direction_notification.ID_DIRECTION AND direction_notification.IDNOTIFICATION = notification.IDNOTIFICATION AND notification.NAME = ?");
      $sql->execute(array($privilege));
      return $sql->fetch();
  }

  class Mail{
    
    public function __construct(){

    }

    public static function send_to_user($object, $message, $type, $id_type, $user){
      global $BD;
      $tchat = $BD->prepare("INSERT INTO `tchat`(`IDENVOI`, `IDRECOI`, `OBJET`, `MESSAGE`, `TYPE`,`ID_SUIVI`) VALUES (?,?,?,?,?,?)");
            $tchat->execute(array($_SESSION["iduser"],$user,utf8_decode($object),utf8_decode($message),$type,$id_type)); 
    }

  }
  //Mail::send_to_user('test', 'testons', '', '', 1);

  class Template {
      protected $file;
      protected $values = array();
    
      public function __construct($file) {
          $this->file = $file;
      }
      public function set($key, $value) {
        $this->values[$key] = $value;
    }
      
    public function output() {
        if (!file_exists($this->file)) {
            return "Error loading template file ($this->file).";
        }
        $output = file_get_contents($this->file);
      
        foreach ($this->values as $key => $value) {
            $tagToReplace = "[@$key]";
            $output = str_replace($tagToReplace, $value, $output);
        }
      
        return $output;
    }
  }

?>