<?php
require_once("./models/ContactModel.php");
require_once("./views/ContactView.php");
class contactController{

    public function getContact(){
        $obj= new contactModel();
        $r=$obj->getContact();
        return $r;
    }

    
    public function showContact(){
        $obj= new contactView();
        $r=$obj->showContact();
        return $r;
    }

}



?>