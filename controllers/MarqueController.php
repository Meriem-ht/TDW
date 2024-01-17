<?php
require_once("./models/MarqueModel.php");
require_once("./views/MarqueView.php");

class marqueController{
    
    //Les marques principale 
    public function getMarquePrincipale(){
        $obj= new marqueModel();
        $r=$obj->getMarquePrincipale();
        return $r;
    }

  //get Tous Les Marques 
    public function getMarques(){
        $obj= new marqueModel();
        $r=$obj->getMarques();
        return $r;
    }

    //Avoir les détails D'une marque 
    public function getMarqueDetail($idmarque){
        $obj= new marqueModel();
        $r=$obj->getMarqueDetail($idmarque);
        return $r;
    }

    //Les véhicules Principale d'une marque 
    public function getPrincipaleVehicule($idmarque){
        $obj= new marqueModel();
        $r=$obj->getPrincipaleVehicule($idmarque);
        return $r;
    }

    // Les véhicules d"une marque 
    public function getVehicules($idmarque){
        if (isset($_SESSION["userId"])){
            $iduser=$_SESSION["userId"] ;}else{$iduser=-1;}
        //User pour avoir l'état de Favoris , si il est connecté dans y'a Un UserId Sinon -1
        $obj= new marqueModel();
        $r=$obj->getVehicules($idmarque,$iduser);
        echo json_encode($r);
    }

    //Les Marques d'un Types Spécifique 
    public function getMarquesByType($typeid){
        $obj = new marqueModel();
        $r = $obj->getMarquesByType($typeid);
         echo json_encode($r);
       }

    // Display la page Marque 
    public function showMarque(){
        $obj=new marqueView();
        $r=$obj->Marques();
        return $r;
    }

    // Display Page Détails d'une marque 
    public function showMarqueDetail($idmarque){
        $obj=new marqueView();
        $r=$obj->MarqueDetail($idmarque);
        return $r;
    }

}
?>