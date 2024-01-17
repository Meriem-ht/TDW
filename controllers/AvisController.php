<?php
require_once("./models/AvisModel.php");
require_once("./views/AvisView.php");
class avisController{

    //Tous les avis 
    public function getAllAvis($isMarque,$idEntity){
       if( $isMarque !== null && $idEntity !== null ){
        $iduser=isset($_SESSION["userId"]) ? $_SESSION["userId"] : -1  ;
        $isMarque=filter_var($isMarque,FILTER_VALIDATE_BOOLEAN);
        $obj= new avisModel();
        $r=$obj->getAllAvis($isMarque,$idEntity,$iduser);
        echo json_encode(array("status"=>"success","data"=>$r));
        }
        else{ echo json_encode(array("status"=>"error","message"=>"ERROR"));}
    }


    //Ajouter un avis 
    public function  setAvis($comment,$isMarque,$idEntity){
        if( $isMarque !== null && $idEntity !== null ){
            $iduser=$_SESSION["userId"];
            $isMarque=filter_var($isMarque,FILTER_VALIDATE_BOOLEAN);
            $obj= new avisModel();
            $r=$obj->setAvis($comment,$isMarque,$idEntity,$iduser);
            echo json_encode(array("status"=>"success","data"=>$r));
            }
            else{ echo json_encode(array("status"=>"error","message"=>"ERROR"));}
     }
        // Ajouter like d'un avis par user 
        private function  userlikeavis($iduser,$idavis){
        $obj=new avisModel();
        $r=$obj-> userlikeavis($iduser,$idavis);
        return $r;
        }

        // Enlever like d'un avis par user 
        private function  unlikeavis($iduser, $idavis){
            $obj=new avisModel();
            $r=$obj-> unlikeavis($iduser, $idavis);
            return $r;
        }
        // Get  si user déja like un avis
        
        //Gestion de liker un avis 
        public function likeavis($idavis){
            if($idavis !== null ){
                if (isset($_SESSION["userId"])){
                $iduser=$_SESSION["userId"] ;
                $obj= new avisModel();
                $exist=$this->userlikeavis($iduser,$idavis);
                if ($exist) {
                    $r = $this->unlikeavis($iduser, $idavis);
                    echo json_encode(array("status" => "unlike"));
                } else {
                    $obj=new avisModel();
                    $r = $obj->likeavis($iduser, $idavis);
                    echo json_encode(array("status" => "like"));
                }
        }
            else{echo json_encode(array("status"=>"error","message"=>"Need to inscrire"));}
            }
            else{echo json_encode(array("status"=>"error","message"=>"ERROR"));}
        }


        //Les avis les plus appréciés     
        public function getBestReview($isMarque,$idEntity){
            if( $isMarque !== null && $idEntity !== null ){
            $iduser=isset($_SESSION["userId"]) ? $_SESSION["userId"] : -1  ;
            $isMarque=filter_var($isMarque,FILTER_VALIDATE_BOOLEAN);
            // var_dump($isMarque,$idEntity);
            $obj= new avisModel();
            $r=$obj->getBestReview($isMarque,$idEntity,$iduser);
            echo json_encode(array("status"=>"success","data"=>$r));
        }
        else{echo json_encode(array("status"=>"error","message"=>"ERROR"));}
        }


        //All marques pour un avis 
        public function showallmarques(){
        $obj=new avisView();
        $r=$obj->Marquesavis();
        return $r;
        }


        //Les avis d'une marque 
        public function showMarqueVehiculesAvis($idmarque){
            $obj= new avisView();
            $r=$obj->showMarqueVehiculesAvis($idmarque);
            return $r;
        }


        //Les avis d'un véhicule 
        public function showVehiculsAvis($idvehicule){
            $obj= new avisView();
            $r=$obj->showvehiculsavis($idvehicule);
            return $r; 
        }


}
?>