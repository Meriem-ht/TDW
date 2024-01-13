<?php
require_once("ConnexionModel.php");
class acceuilModel{
    public function getDiapo(){
        $obj= new connexion();
        $c=$obj->connect();
        $qtf="SELECT d.*,i.url 
        FROM diaporama d
        INNER JOIN image_diapo  id ON d.iddiaporama=id.id_diapo
        INNER JOIN image i ON id.id_image=i.idimage";
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r;
      }
}


?>