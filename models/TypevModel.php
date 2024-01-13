<?php
require_once("ConnexionModel.php");
class typevModel{
    public function getTypev(){
        $obj= new connexion();
        $c=$obj->connect();
        $qtf="SELECT *
        FROM typevehicule";
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r;
      }
      public function inserttypemarque($idmarque,$idtype){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "INSERT INTO  marque_type(id_marque,id_type) VALUES (?,?)";   
        $qtf = $c->prepare($query);
        $qtf->bindParam(1,$idmarque);
        $qtf->bindParam(2,$idtype);
        $r =   $qtf->execute();
        $obj->disconnect($c);
        return $r; 
      }
}


?>