<?php


class yearsController{

  public function getYears($modeleid){
    include('./models/YearsModel.php');
    $obj = new yearsModel();
    $r = $obj->getYears($modeleid);
     echo json_encode($r);
   }
 }


?>