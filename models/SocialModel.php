<?php
require_once("ConnexionModel.php");
class socialModel{
    public function getSocial(){
        $obj= new connexion();
        $c=$obj->connect();
        $qtf="SELECT * 
        FROM socialmedia";
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r;
      }
}


?>