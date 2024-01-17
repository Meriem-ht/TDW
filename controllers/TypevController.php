<?php
require_once("./models/TypevModel.php");
class typevController{

   // Types de Véhicules 
    public function getTypev(){
        $obj= new TypevModel();
        $r=$obj->getTypev();
        return $r;
    }

}



?>