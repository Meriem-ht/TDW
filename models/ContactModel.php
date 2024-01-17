<?php
require_once("ConnexionModel.php");
class contactModel{

    
    public function getContact(){
        $obj= new connexion();
        $c=$obj->connect();
        $qtf="SELECT * 
        FROM contact";
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r;
      }
}


?>