<?php
require_once("ConnexionModel.php");
class guideModel{

    
    public function getGuide(){
        $obj= new connexion();
        $c=$obj->connect();
        $qtf="SELECT g.*,i.url 
        FROM guide_marque g
        JOIN image i ON i.idimage=g.id_image";
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r;
      }
}


?>