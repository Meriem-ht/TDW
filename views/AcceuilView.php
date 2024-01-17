<?php
include_once("./controllers/AcceuilController.php");
include_once("./controllers/ContactController.php");
class acceuilView{
    
    public function resultCompar(){
      ?>
      <div class="table-compar">
      </div>
      <?php
    }
    public function populaireComparaison(){
      $res=new acceuilController();
      $vehicules=$res->getPopCompar();
      ?>
     <h1 class="heading mt-4">Comparaison Populaire</h1>
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
         <div class="vehicule-list-container">
         <div class="vehicule-list-box">
           <div class="boxv">
             <div class="img-v">
                 <div class="logo-box">
                 <?php echo '<a href="index.php?router=Vehicule&id='. $vehicules[4]['idvehicule'] .'">
                   <img src=" '.$vehicules[4]['url'].' " alt=""></a>'; ?>
               </div>
             </div>
             <div class="info-v">
                 <p><?php echo $vehicules[4]['marquen'].' '.$vehicules[4]['modelen'] ; ?></p>
                 <p><?php echo $vehicules[4]['versionn'] ?></p>
             </div>
           </div>
           <div class="boxv">
             <div class="img-v">
                 <div class="logo-box">
                 <?php echo '<a href="index.php?router=Vehicule&id='. $vehicules[5]['idvehicule'] .'">
                   <img src=" '.$vehicules[5]['url'].' " alt=""></a>'; ?>
               </div>
             </div>
             <div class="info-v">
                 <p><?php echo $vehicules[5]['marquen'].' '.$vehicules[5]['modelen'] ; ?></p>
                 <p><?php echo $vehicules[5]['versionn'] ?></p>
             </div>
           </div>

         
         </div>
         <!-- <button class="submit-btn">COMPARER</button> -->
         </div>
       </div>
     </div>
     <div class="flex-end mt-4">
       <a href="index.php?router=Guide d'achat">Voir guide d'achat <i class="fa-solid fa-chevron-right"></i></a>
     </div>
     <?php

    }
    public function diapo(){
    ?>
    <div class="diapo-container">

    </div>
     <?php  
    }

    public function showAcceuil(){
        require_once("CommonViews.php");
        $r=new commonViews();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Vehicom</title>
            <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
        <script src="./jquery-3.6.0.js"></script>
            <script src="./jquery-3.6.0.min.js"></script>
            <script src="https://kit.fontawesome.com/356c3beb3c.js" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="./style.css">
        </head>
        <body>
        <?php
        
        $r->script();
        $r->Navbar();
        $this->diapo();
                ?>
            <div class="container">
            <div class="navLinks" >
              <?php
                $r->Menu();
              ?>
            </div>

            <?php
            $r->MarquePrincipale();
            $r->ComparSection();
            $this->resultCompar();
            $this->populaireComparaison();
             ?>
           
             <?php
            $r->Footer();
            ?>
        </body>
        
        </html>
        <?php }
    
}





?>