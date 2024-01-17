<?php
require_once('./models/VehiculeModel.php');
require_once('./views/VehiculeView.php');

class vehiculeController{


  // Avoir une véhicule d'aprés le formulaire de comparaison
  public function getVehicule($typeid,$marqueid,$modeleid,$versionid){
    $obj = new vehiculeModel();
    $r = $obj->getVehicule($typeid,$marqueid,$modeleid,$versionid);
     echo json_encode($r);
   }

 //Display Tous les véhicules d"une Marque 
  public function showmarquevehicules($idmarque){
    $obj= new vehiculeView();
    $r=$obj->showmarquevehicules($idmarque);
    return $r;
  }
   
  //Les meilleurs comparaison avec une véhicule 
  public function getTopCompar($idvehicule){
    $obj= new vehiculeModel();
    $r=$obj->getTopCompar($idvehicule);
    return $r;
  }


  //Avoir une Véhicule par sa ID 
  public function getVehiculeById($idvehicule){
    $obj = new vehiculeModel();
    $r = $obj->getVehiculeById($idvehicule);
     return $r;
  }

  //Avoir Les caractéristiques d'une véhicule
  public function getVehiculecarac($idvehicule){
    $obj = new vehiculeModel();
    $r = $obj->getVehiculecarac($idvehicule);
     return $r; 
  }

  //Display la page Détail d'une véhicule 
  public function showVehiculeDetail($idvehicule){
    $obj = new vehiculeView();
    $r = $obj->vehiculeDetail($idvehicule);
     return $r;
  }
  
 }


?>