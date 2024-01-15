<?php
require_once("./models/ComparateurModel.php");
require_once("./views/ComparateurView.php");
class comparateurController{
    public function showComparateur(){
        $obj= new comparateurView();
        $r=$obj->showComparateur();
        return $r;
    }
    public function handleCompar($vehiculesIds){
        $result=[];
        $r=new comparateurModel();
        $vc=new vehiculeModel();
        $possiblepairs=$this->pairstocompare($vehiculesIds);
        foreach($possiblepairs as $pair){
        $r->addcompar($pair[0],$pair[1]);
        };
        foreach($vehiculesIds as $vehiculeid){
            $result[]=$vc->getVehiculecarac($vehiculeid);
        };
       echo json_encode($result);
    }


    public function pairstocompare($ids){
        $pairs=[];
        $vehicules=count($ids);
        for($i=0;$i<$vehicules;$i++){
            for($j=$i+1;$j<$vehicules;$j++){ 
                $pairs[]=[$ids[$i],$ids[$j]];
            }
        }
        return $pairs;
    }


}



?>