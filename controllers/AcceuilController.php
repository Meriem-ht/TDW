<?php
require_once("./models/AcceuilModel.php");
require_once("./views/AcceuilAdmin.php");
require_once("./views/AcceuilView.php");
class acceuilController{

    public function getDiapo(){
        $obj= new acceuilModel();
        $r=$obj->getDiapo();
        echo json_encode($r);
    }
    public function showAcceuil(){
        $obj= new acceuilView();
        $r=$obj->showAcceuil();
        return $r;
    }

    public function showAcceuilAdmin(){
        $obj= new acceuilAdminView();
        $r=$obj->showAcceuilAdmin();
        return $r;
    }





}



?>