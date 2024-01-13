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
      public function gestionNews(){
        $obj = new connexion();
        $c = $obj->connect();
        $qtf = "SELECT *
        FROM news";    
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r; 
      }
      public function validernews($idnews){
        $obj = new connexion();
        $c = $obj->connect();
        $qtf = "UPDATE news
        SET  news.statut=true
        WHERE news.idnews=$idnews";    
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r; 
      }
      public function deletenews($idnews){
        $obj = new connexion();
        $c = $obj->connect();
        $qtf = "UPDATE news
        SET  news.statut=false
        WHERE news.idnews=$idnews";    
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r; 
      }
      public function createnews($titre,$text,$statut){
        $obj = new connexion();
        $c = $obj->connect();
        $qtf = "INSERT INTO  news(titre,text,date,statutnews) VALUES(?,?,NOW(),?)";    
        $qtf->bindParam(1, $titre);
        $qtf->bindParam(2, $text);
        $qtf->bindParam(3, $statut);
        $r=$qtf->execute();
        $obj->disconnect($c);
        return $r; 
      }
      public function updatenews($titre,$text,$statut,$idnews){
        $obj = new connexion();
        $c = $obj->connect();
        $qtf = "UPDATE news SET news.titre=? news.text=? news.statut=?
        WHERE news.idnews= ?";    
        $qtf->bindParam(1, $titre);
        $qtf->bindParam(2, $text);
        $qtf->bindParam(3, $statut);
        $qtf->bindParam(4,$idnews);
        $r=$qtf->execute();
        $obj->disconnect($c);
        return $r; 
      }




      public function deleteMarque($idmarque){
        $obj = new connexion();
        $c = $obj->connect();
        $qtf = "UPDATE news
        SET  news.statut=false
        WHERE news.idnews=$idnews";    
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r; 
      }
}



?>