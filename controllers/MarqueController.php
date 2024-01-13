<?php
require_once("./models/MarqueModel.php");
require_once("./views/MarqueView.php");

class marqueController{

    public function getMarquePrincipale(){
        $obj= new marqueModel();
        $r=$obj->getMarquePrincipale();
        return $r;
    }
    public function getMarques(){
        $obj= new marqueModel();
        $r=$obj->getMarques();
        return $r;
    }
    public function getMarqueDetail($idmarque){
        $obj= new marqueModel();
        $r=$obj->getMarqueDetail($idmarque);
        return $r;
    }
    public function getPrincipaleVehicule($idmarque){
        $obj= new marqueModel();
        $r=$obj->getPrincipaleVehicule($idmarque);
        return $r;
    }
    public function getVehicules($idmarque){
        $obj= new marqueModel();
        $r=$obj->getVehicules($idmarque);
        echo json_encode($r);
    }
    public function getMarquesByType($typeid){
        $obj = new marqueModel();
        $r = $obj->getMarquesByType($typeid);
         echo json_encode($r);
       }
    public function showMarque(){
        $obj=new marqueView();
        $r=$obj->Marques();
        return $r;
    }
    public function showMarqueDetail($idmarque){
        $obj=new marqueView();
        $r=$obj->MarqueDetail($idmarque);
        return $r;
    }

}
?>