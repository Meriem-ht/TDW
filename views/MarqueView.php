<?php
require_once("./controllers/MarqueController.php");
require_once("CommonViews.php");
class marqueView{

    public function infoMarque($marque){
        ?>
        <div class="flex-center">
        <h2 class="heading-center">
        <?php echo $marque['nom'] ;?>
        </h2>
    </div>
    <div class="info-marque">
        <div class="logo-img">
            <img src="<?php echo $marque['url']?>" alt="logo-marque">
        </div>
        <ul class="general-info">
            <li><span>Pays d'origine :</span> <?php echo $marque['pays'] ?> </li>
            <li><span>Siége sociale :</span><?php echo $marque['siege_social'] ?></li>
            <li><span>Année création :</span><?php echo $marque['annee_creation'] ?></li>
            <li class="starsRating" id="marque-info" data-value='<?php echo $marque['idmarque'] ?>'></li>
        </ul>
    </div>
    <?php
    }


    public function title(){
        echo '<h1 class="heading">Tous Les Marques</h1>';
     } 
     public function allmarques(){
        $r=new marqueController();
        $marques=$r->getMarques();
         ?>
             <div class="marques">
             <?php
             foreach ($marques as $marque) {
             
                 echo '<div class="marque-item">
                     <div class="marque-logo">
                         <a href="index.php?router=Marque&id='. $marque['id_marque'] .'">
                         <img src="'. $marque['url'] .'"/></a>
                     </div>
                     <p>'. $marque['nom'] .'</p>
                 </div>';
             }
         
         echo '</div>';
     }
     //Display Page of all marques 
     public function Marques(){
        ob_start();
        $this->title();
        $this->allmarques();
        $content = ob_get_clean();
        require("layout.php");
     } 

    public function MarqueDetail($idmarque){
        $common=new commonViews();
        $r=new marqueController();
        $marque=$r->getMarqueDetail($idmarque)[0];
        $vehicules=$r->getPrincipaleVehicule($idmarque);
         if(!isset($vehicules)){
            $vehicules=null;
        } 
         $common->script();  
        ob_start();
        $this->infoMarque($marque);
        ?>
        
        <div class="v-principale">
            <?php if($vehicules !== null){?>
            <h1 class="heading">Véhicules Principales</h1>
            <div class="vehicule-list">
            <?php foreach($vehicules as $vehicule ) {?>
             <div class="boxv">
                <div class="img-v">
                    <?php if (isset($_SESSION["userName"])){
                       echo'<i class="fa-regular fa-bookmark favoris-icon" data-value="'.$vehicule['idvehicule'].'"></i>';
                    }?>
                    <div class="logo-box">
                    <?php echo '<a href="index.php?router=Vehicule&id='. $vehicule['idvehicule'] .'">
                     <img src=" '.$vehicule['url'].' " alt=""></a>'; ?>
                  </div>
                </div>
                <div class="info-v">
                    <p><?php echo $vehicule['marquen'].' '.$vehicule['modelen'] ; ?></p>
                    <p><?php echo $vehicule['versionn'] ?></p>
                </div>
             </div>
             <?php }?>
             <button class="previous scroll-btn"><i class="fa-solid fa-chevron-left" style="color: #ffffff;"></i></button>
             <button class="next scroll-btn"><i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></button>
            </div>
            <div class="flex-end">
                <a class="vplus-vehicule" href="index.php?router=marqueVehicules&id=<?php echo $idmarque ;?>" >Voir tous les véhicules <i class="fa-solid fa-chevron-right"></i> </a>
             </div>
             <div class="vehicule-container" data-value="<?php echo $idmarque;?>">      
        </div>
            <?php } ?>
        </div>
     
        <?php 

        $common->avis("true",$marque);
        $common->allavis("true",$marque);
  
        $content = ob_get_clean();
        include_once("layout.php");

?>
   <?php } 


}

?>