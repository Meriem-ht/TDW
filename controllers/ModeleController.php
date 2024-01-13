<?php
 require_once('./models/ModeleModel.php');

class modeleController{

  public function getModele($marqueid){
   
    $obj = new modeleModel();
    $r = $obj->getModeles($marqueid);
     echo json_encode($r);
   }
 }


?>