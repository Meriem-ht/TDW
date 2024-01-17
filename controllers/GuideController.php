<?php
require_once("./models/GuideModel.php");
require_once("./views/GuideView.php");
class guideController{

    public function getGuide(){
        $obj= new guideModel();
        $r=$obj->getGuide();
        return $r;
    }

    
    public function showGuide(){
        $obj= new guideView();
        $r=$obj->showGuide();
        return $r;
    }

}



?>