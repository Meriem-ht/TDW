<?php
require_once("./controllers/UserController.php");
require_once("CommonViews.php");
class userView{

    

    public function showProfile($id){
        $common=new commonViews();
        $r=new userController();
        $vehicules=$r->getUserFavoris($id);
        $users=$r->getInfoUser($id);
         if(!isset($vehicules)){
            $vehicules=null;
        } 
        $common->script();  
        ob_start();
        ?>
        <h1 class="heading">Informations utilisateurs</h1>
        <div class="info-user">
            <?php foreach ($users as $user) {
                echo '<div class="info">
                    <h3>'.$user["col"].' </h3>
                    <p>'.$user["valeur"].'</p>
                </div>';
            }?>
         </div>

        
        <div class="v-principale favoris-section">
            <?php if($vehicules !== null){?>
            <h1 class="heading">Véhicules favoris</h1>
            <div class="vehicule-list">
            <?php foreach($vehicules as $vehicule ) {?>
             <div class="boxv">
                <div class="img-v">
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
        </div>
            <?php } ?>
        </div>
     
        <?php 

  
        $content = ob_get_clean();
        include_once("layout.php");

?>
   <?php } 


}

?>