<?php
require_once("./controllers/AcceuilController.php");
require_once("CommonViews.php");
class acceuilAdminView{

    public function showAcceuilAdmin(){
            ob_start();
            $r=new commonViews();
            $r->script();
    
             ?>
             <div class="gestion">
             <h1>Gestion du Site Vehicom </h1>
            </div>
             <?php
              ?>
           
            <?php
            $content = ob_get_clean();
            require("layout2.php"); 
        }
       


}





?>