<?php
require_once("ConnexionModel.php");
class comparateurModel{

  
      //Selon les deux ids on faire soit l'insertion soit update de nbcompare 
      public function addcompar($v1,$v2){
        $obj= new connexion();
        $c=$obj->connect();
        $query="INSERT INTO comparaison (`vehicule1_id`, `vehicule2_id`, `nbcompare`)
        VALUES (:id1, :id2,1)
        ON DUPLICATE KEY UPDATE nbcompare = nbcompare +1";
        $qtf = $c->prepare($query);
        $qtf->bindValue(':id1', intval($v1), PDO::PARAM_INT);
        $qtf->bindValue(':id2', intval($v2), PDO::PARAM_INT);
        $qtf->execute();
        $r = $qtf->fetch(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
      }
}


?>