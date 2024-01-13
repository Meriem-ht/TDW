<?php
require_once('./models/VehiculeModel.php');
require_once('./views/VehiculeView.php');

class vehiculeController{

  public function getVehicule($typeid,$marqueid,$modeleid,$versionid){
    $obj = new vehiculeModel();
    $r = $obj->getVehicule($typeid,$marqueid,$modeleid,$versionid);
     echo json_encode($r);
   }
  public function showmarquevehicules($idmarque){
    $obj= new vehiculeView();
    $r=$obj->showmarquevehicules($idmarque);
    return $r;
  }
  public function getVehiculeById($idvehicule){
    $obj = new vehiculeModel();
    $r = $obj->getVehiculeById($idvehicule);
     return $r;
  }
  public function getVehiculecarac($idvehicule){
    $obj = new vehiculeModel();
    $r = $obj->getVehiculecarac($idvehicule);
     return $r; 
  }
  public function showVehiculeDetail($idvehicule){
    $obj = new vehiculeView();
    $r = $obj->vehiculeDetail($idvehicule);
     return $r;
  }
  
 }


?>