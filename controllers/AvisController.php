<?php
require_once("./models/AvisModel.php");
require_once("./views/AvisView.php");
class avisController{

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

    // public function likestate($idavis){
    //     if($idavis !== null ){
    //     $iduser=$_SESSION["userId"];
    //     $obj= new avisModel();
    //         $exist=$obj-> userlikeavis($iduser,$idavis);
    //         if ($exist) {
    //                echo json_encode(array("status" => $exist ? "like" : "unlike"));          
    //             }
    //    }
    //     else{echo json_encode(array("status"=>"error","message"=>"ERROR"));}
    //     }


    public function likeavis($idavis){
        if($idavis !== null ){
            if (isset($_SESSION["userId"])){
             $iduser=$_SESSION["userId"] ;
             $obj= new avisModel();
            $exist=$obj-> userlikeavis($iduser,$idavis);
            if ($exist) {
                $r = $obj->unlikeavis($iduser, $idavis);
                echo json_encode(array("status" => "unlike"));
            } else {
                $r = $obj->likeavis($iduser, $idavis);
                echo json_encode(array("status" => "like"));
            }
       }
        else{echo json_encode(array("status"=>"error","message"=>"Need to inscrire"));}
    }
        else{echo json_encode(array("status"=>"error","message"=>"ERROR"));}
        }

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
    public function showallmarques(){
     $obj=new avisView();
     $r=$obj->Marquesavis();
     return $r;
    }
    public function showmarquevehiculesavis($idmarque){
        $obj= new avisView();
        $r=$obj->showmarquevehiculesavis($idmarque);
        return $r;
      }
    public function showvehiculsavis($idvehicule){
        $obj= new avisView();
        $r=$obj->showvehiculsavis($idvehicule);
        return $r; 
    }


}
?>