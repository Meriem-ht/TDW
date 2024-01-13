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
    // public function showNewsDetail($idnews){
    //     $r=new newsController();
    //     $news=$r->getNews($idnews);
    //     ob_start();
    //     echo '<div class="news-detail">
    //     <h3>'.$news[0]['titre'].'</h3>
    //     <div class="img-box">
    //     <img src='.$news[0]['url'].'>
    //     </div>
    //     <p>'.$news[0]['texte'].'</p>
    //     </div>
    //     <div class="news-images">
    //     <div class="images">';
    //     foreach($news as $row){
    //         if($row !== $news[0]){
    //     echo '<div class="img-container"> 
    //          <img src='.$row['url'].' alt="">
    //          </div>';}}
    //     echo '</div>
    //     </div>';
    //     $content = ob_get_clean();
    //     require("layout.php");
    // }
}





?>