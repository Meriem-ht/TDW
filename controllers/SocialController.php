<?php
require_once("./models/SocialModel.php");
class socialController{
    public function getSocial(){
        $obj= new socialModel();
        $r=$obj->getSocial();
        return $r;
    }

}



?>