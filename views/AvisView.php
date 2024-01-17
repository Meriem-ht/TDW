<?php
require_once("./controllers/MarqueController.php");
require_once("./controllers/VehiculeController.php");
require_once("CommonViews.php");
class avisView{
    public function title(){
        echo '<h1 class="heading">Choisir une marque</h1>';
     } 
     
     public function allmarquesavis(){
        $r=new marqueController();
        $marques=$r->getMarques();
         ?>
             <div class="marques">
             <?php
             foreach ($marques as $marque) {
             
                 echo '<div class="marque-item">
                     <div class="marque-logo">
                         <a href="index.php?router=marqueVehiculeavis&id='. $marque['id_marque'] .'">
                         <img src="'. $marque['url'] .'"/></a>
                     </div>
                     <p>'. $marque['nom'] .'</p>
                 </div>';
             }
         
         echo '</div>';
     }
     
     //Display Page of all marques for choose avis 
     public function Marquesavis(){
        ob_start();
        $this->title();
        $this->allmarquesavis();
        $content = ob_get_clean();
        require("layout.php");
     } 



     public function showmarquevehiculesavis($idmarque){
        ob_start();
        $r=new commonViews();
        $r->script();
        ?>
        <h1 class="heading">
         Les vehicules de cette marque 
        </h1>
         <div class="vehicules-container" data-value="<?php echo $idmarque;?>" avis="true">
                <!-- Container is displayed by request ajax  -->
        </div>
        <?php
        $content = ob_get_clean();
        require("layout.php");
    }


    public function showvehiculsavis($idvehicule){
        $v=new vehiculeController();
        $vehicule=$v->getVehiculeById($idvehicule);
        ob_start();
        $r=new commonViews();
        $r->script();
        if($vehicule[0]!==null){
            echo '<div class="v-allavis">
                  <div class="v-img-allavis">
                  <a href="index.php?router=Vehicule&id='.$idvehicule.'">
                  <img src='.$vehicule[0]['url'].' alt="image-vehicule"/> </a>
                   </div> 
                   <div class="v-info"> 
                   <h1>'.$vehicule[0]['marquen'].' '.$vehicule[0]['modelen'].' </h1>
                   <h3>'.$vehicule[0]['versionn'].'</h3>
                   </div>
                   </div>';
        }
        ?>
        
        <h1 class="heading">
         Avis véhicule
        </h1>
       
        <?php
        $r->allavis("false",$idvehicule);
        $content = ob_get_clean();
        require("layout.php"); 
    }



}

?>