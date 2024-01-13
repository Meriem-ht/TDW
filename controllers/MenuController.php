<?php
require_once("./models/MenuModel.php");
class menuController{

    public function getMenu(){
        $obj= new menuModel();
        $r=$obj->getMenu();
        return $r;
    }

}



?>