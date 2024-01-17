<?php
require_once("./views/404.php");
class notFoundController{

    public function notFound(){
        $obj= new notFoundView();
        $r=$obj->notFound();
        return $r;
    }

}



?>