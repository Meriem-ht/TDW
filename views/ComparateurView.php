<?php
require_once("./controllers/ComparateurController.php");
require_once("CommonViews.php");
class comparateurView{


    public function showComparateur(){
      $r=new commonViews();
      $r->script();
        ob_start();
        ?>
        <h1 class="heading">
          Comparateur
        </h1>
        <?php
         $r->ComparSection();
         $this->resultCompar();
        $content = ob_get_clean();
        require("layout.php");
    }



    public function resultCompar(){
      ?>
      <div class="table-compar">
      </div>


    <?php
     
    }

}





?>