<?php
require_once("./controllers/GuideController.php");
require_once("CommonViews.php");
class guideView{

    public function title(){
        echo '<h1 class="heading">Guide d\'achat</h1>';
     } 
     
    public function showGuide(){
        ob_start();
        $r=new commonViews();
        $r->script();
        $m=new guideController();
        $guide=$m->getGuide();
        $this->title();
        ?>
        <div class="guide">
         <p><?php echo $guide[0]["texte"];?></p>
         <img src="<?php echo $guide[0]["url"];?>">
        </div>
       
        <?php
         $content = ob_get_clean();
        require("layout.php"); 
    }



}

?>