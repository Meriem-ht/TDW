<?php
require_once("./controllers/VehiculeController.php");
require_once("CommonViews.php");
class vehiculeView{

    public function populaireComparaison(){
        $ve= new vehiculeController();
        $vehicules=$ve->getTopCompar($idvehicule);
     ?>
        <h1 class="heading">Comparaison populaire</h1>
        <?php if(count($vehicules)!== 0){?>
        <div class="populaire-compare">
              <div class="vehicule-list">
                <div class="vehicule-list-container">
                <div class="vehicule-list-box">
                  <div class="boxv">
                    <div class="img-v">
                        <div class="logo-box">
                        <?php echo '<a href="index.php?router=Vehicule&id='. $vehicules[0]['idvehicule'] .'">
                          <img src=" '.$vehicules[0]['url'].' " alt=""></a>'; ?>
                      </div>
                    </div>
                    <div class="info-v">
                        <p><?php echo $vehicules[0]['marquen'].' '.$vehicules[0]['modelen'] ; ?></p>
                        <p><?php echo $vehicules[0]['versionn'] ?></p>
                    </div>
                  </div>
                  <div class="boxv">
                    <div class="img-v">
                        <div class="logo-box">
                        <?php echo '<a href="index.php?router=Vehicule&id='. $vehicules[1]['idvehicule'] .'">
                          <img src=" '.$vehicules[1]['url'].' " alt=""></a>'; ?>
                      </div>
                    </div>
                    <div class="info-v">
                        <p><?php echo $vehicules[1]['marquen'].' '.$vehicules[1]['modelen'] ; ?></p>
                        <p><?php echo $vehicules[1]['versionn'] ?></p>
                    </div>
                </div>               
                </div>
                <!-- <button class="submit-btn">COMPARER</button> -->
                </div>
                <div class="vehicule-list-container">
                <div class="vehicule-list-box">
                  <div class="boxv">
                    <div class="img-v">
                        <div class="logo-box">
                        <?php echo '<a href="index.php?router=Vehicule&id='. $vehicules[2]['idvehicule'] .'">
                          <img src=" '.$vehicules[2]['url'].' " alt=""></a>'; ?>
                      </div>
                    </div>
                    <div class="info-v">
                        <p><?php echo $vehicules[2]['marquen'].' '.$vehicules[2]['modelen'] ; ?></p>
                        <p><?php echo $vehicules[2]['versionn'] ?></p>
                    </div>
                  </div>
                  <div class="boxv">
                    <div class="img-v">
                        <div class="logo-box">
                        <?php echo '<a href="index.php?router=Vehicule&id='. $vehicules[3]['idvehicule'] .'">
                          <img src=" '.$vehicules[3]['url'].' " alt=""></a>'; ?>
                      </div>
                    </div>
                    <div class="info-v">
                        <p><?php echo $vehicules[3]['marquen'].' '.$vehicules[3]['modelen'] ; ?></p>
                        <p><?php echo $vehicules[3]['versionn'] ?></p>
                    </div>
                  </div>

                
                </div>
                <!-- <button class="submit-btn">COMPARER</button> -->
                </div>
              </div>
            </div>
        </div>
        <?php
        }else{
            echo '<h2 class="mb-4"> Y\'a pas de comparaisons pour le moment</h2>';
        }
    }
    public function infogeneral($vehicule){?>
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
          }?>
          </div>
      </div>
       <?php
    }



    public function caracteristiques($caracts,$idvehicule,$vehicule){?>
           
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
                    <p>'.$vehicule[0]['versionn'].' '.' '.'['.$vehicule[0]['datedebut'].'/'.$vehicule[0]['datefin'].']'.'</p>
                    </div>';
                    foreach($caracts as $carac){
                echo' <div class="spec-container"> 
                    <h5>'.$carac["nom"].'</h5>
                    <p>'.$carac["valeur"].'</p>
                    </div>';
                    }
                 ?>
            <div class="flex-end">
            <?php
            //  echo '<a href="index.php?router=Comparateur" onclick="setItem('.$idvehicule.', \''. $vehicule[0]['marquen'].'\',\''. $vehicule[0]['modelen'].'\', \''.$vehicule[0]['versionn']. '\', \'' .$vehicule[0]['url'] . '\',\'' .$vehicule[0]['idtype'] . '\')">
            // Comparer avec d\'autres véhicules<i class="fa-solid fa-chevron-right"></i>
            // </a>';
            ?>
            </div>
            </div>
        </div>
        <?php
    }
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
        $this->infogeneral($vehicule);
        $this->caracteristiques($caracts,$idvehicule,$vehicule);    
        $common->avis("false",$idvehicule);
        $content = ob_get_clean();
        require("layout.php");
    }
}





?>