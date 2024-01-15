<?php
require_once("./controllers/VehiculeController.php");
require_once("CommonViews.php");
class vehiculeView{
    public function showmarquevehicules($idmarque){
        ob_start();
        $r=new commonViews();
        $r->script();
        ?>
        <h1 class="heading">
         Les vehicules de cette marque 
        </h1>
         <div class="vehicules-container" data-value="<?php echo $idmarque;?>" avis="false">
                <!-- Container is displayed by request ajax  -->
        </div>
        <?php
        $content = ob_get_clean();
        require("layout.php");
    }
    public function vehiculeDetail($idvehicule){
        $common=new commonViews();
        $common->script();
        $r=new vehiculeController();
        $vehicule=$r->getVehiculeById($idvehicule);
        $caracts=$r->getVehiculecarac($idvehicule);
        ob_start();
        ?>
        <h2 class="heading">
         <?php echo $vehicule[0]['marquen'].' '.$vehicule[0]['modelen'].' '.$vehicule[0]['versionn'] ;?>
        </h2>
        <div class="images mb-1">
            <h2 class="heading-2">Images</h2>
            <div class="list-images">
            <?php foreach($vehicule as $pic){
            echo '<div class="imagev-container"> 
            <img src='.$pic['url'].' alt="">
            </div>';
           }
            ?>
            </div>
        </div>
        <div class="caract">
            <h2 class="heading-2 mb-1">Spécifications</h2>
            <div class="list-spec mb-1">
            <div class="spec-container"> 
                <?php
                echo '<h5>Marque</h5>
                    <p> '.$vehicule[0]['marquen'].'</p>
                    </div>
                    <div class="spec-container"> 
                    <h5>Modele</h5>
                    <p>'.$vehicule[0]['modelen'].'</p>
                    </div>
                    <div class="spec-container"> 
                    <h5>Version & Année</h5>
                    <p>'.$vehicule[0]['versionn'].'</p>
                    </div>';
                    foreach($caracts as $carac){
                echo' <div class="spec-container"> 
                    <h5>'.$carac["nom"].'</h5>
                    <p>'.$carac["valeur"].'</p>
                    </div>';
                    }
                 ?>
            <div class="flex-end">
            <a href="index.php?router=Comparateur" click='setItem(v1,<?php echo $idvehicule ?>)' >Comparer avec d'autre véhicule<i class="fa-solid fa-chevron-right"></i></a>

            </div>
            </div>
        </div>

        <?php
         $common->avis("false",$idvehicule);
        $content = ob_get_clean();
        require("layout.php");
    }
}





?>