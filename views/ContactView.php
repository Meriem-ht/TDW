<?php
require_once("./controllers/ContactController.php");
require_once("CommonViews.php");
class contactView{
  
     
    public function showContact(){
        ob_start();
        $r=new commonViews();
        $r->script();
        $m=new contactController();
        $contacts=$m->getContact();
        ?>
         <h1 class="heading">
    Contacter Nous
</h1>
<div class="contact">
  <?php foreach($contacts as $contact){
      echo '<div class="contact-us"> 
      <i  class="'.$contact["icon"].'"> </i>
      <p>'.$contact["valeur"].'</p>
      </div>';
      }?>
</div>
     
       
        <?php
         $content = ob_get_clean();
        require("layout.php"); 
    }



}

?>
