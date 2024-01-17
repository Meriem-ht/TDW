<?php
include_once("./controllers/NewsController.php");
class newsView{


    public function showNews(){
        $r=new newsController();
        $news=$r->getallNews();
        ob_start();
        ?>
        <h1 class="heading">
          Actualité
        </h1>
        <div class="news-container">
            <?php
            foreach($news as $row){
             echo '<div class="news-box">
             <a href="index.php?router=NewsDetail&id='.$row["idnews"].'">
             <div class="img-container"> 
             <img src='.$row['url'].' alt="">
             </div>
             <div class="title-container">
             <h4>'.$row["titre"].'</h4>
             </div>
              </a>
             </div>';
            }
            ?>
        </div>
        <?php
        $content = ob_get_clean();
        require("layout.php");
    }

    
    public function showNewsDetail($idnews){
        $r=new newsController();
        $news=$r->getNews($idnews);
        ob_start();
        echo '<div class="news-detail">
        <h3>'.$news[0]['titre'].'</h3>
        <div class="img-box">
        <img src='.$news[0]['url'].'>
        </div>
        <p>'.$news[0]['texte'].'</p>
        </div>
        <div class="news-images">
        <div class="images">';
        foreach($news as $row){
            if($row !== $news[0]){
        echo '<div class="img-container"> 
             <img src='.$row['url'].' alt="">
             </div>';}}
        echo '</div>
        </div>';
        $content = ob_get_clean();
        require("layout.php");
    }
}





?>