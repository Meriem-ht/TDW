
<?php
require_once("./controllers/NotFoundController.php");
require_once("CommonViews.php");

class notFoundView{


    public function notFound(){
        ob_start();
        $r=new commonViews();
        $r->script();
        ?>
            <div class="gestion">
                <h1>PAGE NOT FOUND</h1>
            </div>
            <?php
        
        $content = ob_get_clean();
        require("layout2.php"); 
    }

  
}
?>
