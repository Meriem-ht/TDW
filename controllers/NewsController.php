<?php
require_once('./models/NewsModel.php');
require_once('./views/NewsView.php');

class newsController{

  public function getallNews(){
    $obj = new newsModel();
    $r = $obj->getallNews();
     return $r;
   }
  public function getNews($idnews){
    $obj= new newsModel();
    $r=$obj->getNews($idnews);
    return $r;
  }
  public function showNews(){
    $obj = new newsView();
    $r = $obj->showNews();
     return $r;
  }


  public function showNewsDetail($idnews){
    $obj = new newsView();
    $r = $obj->showNewsDetail($idnews);
     return $r;
  }
  
 }


?>