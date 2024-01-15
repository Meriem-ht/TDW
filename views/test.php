<?php
require_once("./controllers/MenuController.php");
class commonViews{
    public function Menu(){
        $r=new menuController();
        $c=$r->getMenu();
        ob_start();
        ?>
        <ul>
            <?php
        foreach ($c as $item) {
            echo '<li>' . $item['valeur'] . '</li>';
        }
        ?>
        </ul>
        <?php
        $content = ob_get_clean();
        require("layout.php");

    }
}


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>


if (isset($_POST['marque'])) {
    include('../models/ModeleModel.php');
    $modeleModel = new modeleModel();
    $data = $modeleModel->getModeles($_POST['marque']);
    echo json_encode($data);
} else {
    echo 'false';
}
 // function getlikestate(idavis){
        //     $.ajax({
        //         url: "index.php?router=LikeState",
        //         method: "POST",
        //         data: {
        //             idavis:idavis,
        //         },
        //         success: (res) => {
        //             console.log(res);
        //             $result=JSON.parse(res);
        //              if($result.status == "like"){
        //               updateiconlike(idavis,true);
        //                 }
        //             else if($result.status == "unlike"){
        //               updateiconlike(idavis,false);
        //                  }
        //             } , 
        //             error:(error)=>{
        //                 console.log(error.message);
        //             } ,   
        //         }); 
        // }



        $(".rating label").click(()=>{
              
        });       
?>



<?php
require_once("./controllers/MarqueController.php");
class marqueView{


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
                <li class="starsRating"></li>
            </ul>
        </div>
        <?php
     } 
     public function reviewrate($id,$ismarque){
        
        if(isset($_SESSION["userId"])){?>

        <div class="review-rating">
        <div class="rating" isMarque="<?php echo $ismarque ;?>" data-value="<?php echo $id;?>">
            <input type="radio" value="1" name="starRate" id="star1" hidden>
            <label for="star1"><i class="fa-solid fa-star"></i></label>
            <input type="radio" value="2" name="starRate" id="star2" hidden>
            <label for="star2"><i class="fa-solid fa-star"></i></label>
            <input type="radio" value="3" name="starRate" id="star3" hidden>
            <label for="star3"><i class="fa-solid fa-star"></i></label>
            <input type="radio" value="4" name="starRate" id="star4" hidden>
            <label for="star4"><i class="fa-solid fa-star"></i></label>
            <input type="radio" value="5" name="starRate" id="star5" hidden>
            <label for="star5"><i class="fa-solid fa-star"></i></label>
        </div>
        <?php }?>
        <div class="review" isMarque="<?php echo $ismarque ;?>" data-value-review="<?php echo $id;?>">
        <form method="post" class="form-avis">
                <div class="form-item">
                <textarea name="comment" id="comment" placeholder="Ajouter votre avis ici" required></textarea>
                </div>
              <input type="submit" value="Ajouter" class="submit-btn" >
            </div>
            </form>
        </div>
        </div>
        <?php 
    }
    public function MarqueDetail($idmarque){
        $r=new marqueController();
        $marque=$r->getMarqueDetail($idmarque)[0];
        $vehicules=$r->getPrincipaleVehicule($idmarque);
        $this->infoMarque($marque);
         if(isset($vehicules[0])){
             $vehicule=$vehicules[0];
        }else{
            $vehicule=null;
        }
        ?>
    
        <div class="v-principale">
            <?php if($vehicule !== null){?>
            <h1 class="heading">Véhicule Principale</h1>
            <div class="vehicule-list">
             <div class="boxv">
                <div class="img-v">
                    <?php if (isset($_SESSION["userName"])){
                       echo'<i class="fa-regular fa-bookmark favoris-icon" data-value="'.$vehicule['idvehicule'].'"></i>';
                    }?>
                    <img src="<?php echo $vehicule['url'] ?>" alt="">
                </div>
                <div class="info-v">
                    <p><?php echo $vehicule['marquen'], $vehicule['modelen'] ; ?></p>
                    <p><?php echo $vehicule['versionn'] ?></p>
                </div>
             </div>
             <div class="boxv">
                <div class="img-v">
                    <img src="<?php echo $vehicule['url'] ?>" alt="">
                </div>
                <div class="info-v">
                    <p><?php echo $vehicule['marquen'], $vehicule['modelen'] ; ?></p>
                    <p><?php echo $vehicule['versionn'] ?></p>
                </div>
             </div>
             <div class="boxv">
                <div class="img-v">
                    <img src="<?php echo $vehicule['url'] ?>" alt="">
                </div>
                <div class="info-v">
                    <p><?php echo $vehicule['marquen'], $vehicule['modelen'] ; ?></p>
                    <p><?php echo $vehicule['versionn'] ?></p>
                </div>
             </div>
             <div class="boxv">
                <div class="img-v">
                    <img src="<?php echo $vehicule['url'] ?>" alt="">
                </div>
                <div class="info-v">
                    <p><?php echo $vehicule['marquen'], $vehicule['modelen'] ; ?></p>
                    <p><?php echo $vehicule['versionn'] ?></p>
                </div>
             </div>
             <div class="boxv">
                <div class="img-v">
                    <img src="<?php echo $vehicule['url'] ?>" alt="">
                </div>
                <div class="info-v">
                    <p><?php echo $vehicule['marquen'], $vehicule['modelen'] ; ?></p>
                    <p><?php echo $vehicule['versionn'] ?></p>
                </div>
             </div>
             <button class="previous scroll-btn"><i class="fa-solid fa-chevron-left" style="color: #ffffff;"></i></button>
             <button class="next scroll-btn"><i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></button>
            </div>
            <?php } ?>
        </div>
     
        <?php 

        $this->reviewrate($idmarque,"true");
                }

    public function Marques(){
        ob_start();
        $this->title();
        $this->allmarques();
        $this->MarqueDetail($idmarque);
        
        $content = ob_get_clean();
        require("layout.php");
  
}
}
?>