<?php
require_once('./models/NewsModel.php');
require_once('./views/NewsView.php');

class newsController{
  

  //Tous les News 
  public function getallNews(){
    $obj = new newsModel();
    $r = $obj->getallNews();
     return $r;
   }

  //Avoir le Détail d'un News 
  public function getNews($idnews){
    $obj= new newsModel();
    $r=$obj->getNews($idnews);
    return $r;
  }

  // Display La page News 
  public function showNews(){
    $obj = new newsView();
    $r = $obj->showNews();
     return $r;
  }

 // Display Détail d'un News 
  public function showNewsDetail($idnews){
    $obj = new newsView();
    $r = $obj->showNewsDetail($idnews);
     return $r;
  }
  
 }


?>