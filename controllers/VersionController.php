<?php


class versionsController{

  public function getVersions($modeleid,$year){
    include('./models/VersionModel.php');
    $obj = new versionModel();
    $r = $obj->getVersions($modeleid,$year);
     echo json_encode($r);
   }
 }


?>