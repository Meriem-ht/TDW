<?php
require_once("ConnexionModel.php");
class menuModel{
    public function getMenu(){
        $obj= new connexion();
        $c=$obj->connect();
        $qtf="SELECT * 
        FROM menu";
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r;
      }
}


?>