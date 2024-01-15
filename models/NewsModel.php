<?php
require_once("ConnexionModel.php");
class newsModel{
    public function getallNews(){
        $obj= new connexion();
        $c=$obj->connect();
        $query="SELECT DISTINCT * 
        FROM news n
        LEFT JOIN image_news inews ON n.idnews=inews.id_news
        LEFT JOIN image i ON i.idimage=inews.id_image
        WHERE n.afficher=? AND n.statutnews=?
        GROUP BY n.idnews
        ";
          $qtf = $c->prepare($query);

          $qtf->bindValue(1,true);
          $qtf->bindValue(2,true);
          $qtf->execute();
          $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
      }
      public function getNews($idnews){
        $obj= new connexion();
        $c=$obj->connect();
        $query="SELECT * 
        FROM news n
        LEFT JOIN image_news inews ON n.idnews=inews.id_news
        LEFT JOIN image i ON inews.id_image=i.idimage
        WHERE n.idnews=? AND  n.afficher=? AND n.statutnews=?";
         $qtf = $c->prepare($query);
         $qtf->bindParam(1, $idnews);
         $qtf->bindValue(2,true);
         $qtf->bindValue(3,true);
         $qtf->execute();
         $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
      }
  
}



?>