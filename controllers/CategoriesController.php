<?php
require_once("./views/CategoriesView.php");
require_once("./models/CategoriesModel.php");
require_once("./models/NewsModel.php");
require_once("./models/TypevModel.php");
require_once("NewsController.php");


class categoriesController{

  public function showCategories(){
    $obj = new categoriesView();
    $r = $obj->showCategories();
    return $r;
   }
   public function getDataMarque(){
    $obj = new categoriesModel();
    $r=$obj->getDataMarque();
    echo json_encode($r);
 }
 public function getDataNews(){
  $obj = new categoriesModel();
  $r=$obj->getDataNews();
  echo json_encode($r);
}
public function getDataAvis(){
  $obj = new categoriesModel();
  $r=$obj->getDataAvis();
  echo json_encode($r);
}
public function getDataUsers(){
  $obj = new categoriesModel();
  $r=$obj->getDataUsers();
  echo json_encode($r);
}
public function getDataParam(){
  $obj = new categoriesModel();
  $r=$obj->getDataParam();
  echo json_encode($r);
}
public function deleteNews($id){
  $obj = new categoriesModel();
  $r=$obj->deleteNews($id);
  if($r){
  header('Location: index.php?router=categories');
  exit();
  return $r;
}
}
public function afficherNews($id){
  $obj = new categoriesModel();
  $r=$obj->afficherNews($id);
  if($r){
  header('Location: index.php?router=categories');
  exit();
  return $r;
}
}
public function deleteUser($id){
  $obj = new categoriesModel();
  $r=$obj->updateUser($id,'Supprime');
  if($r){
    header('Location: index.php?router=categories');
    exit();
  }
 return $r;
}
public function validerUser($id){
  $obj = new categoriesModel();
  $r=$obj->updateUser($id,'Inscrit');
  if($r){
    header('Location: index.php?router=categories');
    exit();
  }
 return $r;
}
public function bloquerUser($id){
  $obj = new categoriesModel();
  $r=$obj->updateUser($id,'Bloque');
  if($r){
    header('Location: index.php?router=categories');
    exit();
  }
 return $r;
}
public function deleteAvis($id){
  $obj = new categoriesModel();
  $r=$obj->updateAvis($id,'Supprime');
  if($r){
    header('Location: index.php?router=categories');
    exit();
  }
 return $r;
}
public function rejeterAvis($id){
  $obj = new categoriesModel();
  $r=$obj->updateAvis($id,'Rejete');
  if($r){
    header('Location: index.php?router=categories');
    exit();
  }
 return $r;
}
public function validerAvis($id){
  $obj = new categoriesModel();
  $r=$obj->updateAvis($id,'Valide');
  if($r){
    header('Location: index.php?router=categories');
    exit();
  }
 return $r;
}
public function updateNews($idnews){
  $obj = new categoriesView();
  $r = $obj->showNewsInfo($idnews);
  return $r;
}
public function infoNews($idnews){
  $obj = new categoriesModel();
  $r = $obj->infoNews($idnews);
  return $r;
}

public function updateDataNews($id,$titre,$texte,$afficher,$statu){
  var_dump($id,$titre,$texte,$afficher,$statu);
  $obj = new categoriesModel();
  $r = $obj->updateDataNews($id,$titre,$texte,$afficher,$statu);
  return $r;
}
public function addDataNews($titre,$texte,$afficher,$statu){
  var_dump($titre,$texte,$afficher,$statu);
  $obj = new categoriesModel();
  $r = $obj->addDataNews($titre,$texte,$afficher,$statu);
  echo 'add'.$r;
  return $r;
}
public function addNews(){
  $obj = new categoriesView();
  $r = $obj->showAddNews();
  return $r;
}



public function deleteMarque($id){
  $obj = new categoriesModel();
  $r=$obj->deleteMarque($id);
  if($r){
  header('Location: index.php?router=categories');
  exit();
  return $r;
}
}

public function updateMarque($idmarque){
  $obj = new categoriesView();
  $r = $obj->showMarqueInfo($idmarque);
  return $r;
}

public function updateDataMarque($data){
  $obj = new categoriesModel();
  $r = $obj->updateDataMarque($data);
  return $r;
}

public function addMarque(){
  $obj = new categoriesView();
  $r = $obj->showAddMarque();
  return $r;
}
public function addDataMarque($data){
  $obj = new categoriesModel();
  $r = $obj->addDataMarque($data);
  foreach($data["types"] as $type){
    $obj1=new typevModel();
    $obj1->inserttypemarque($r,$type);
  }
  return $r;
}

public function getDataVehicule($idmarque){
  $obj = new categoriesModel();
  $r = $obj->getDataVehicule($idmarque);
  echo json_encode($r); 
}

public function deleteVehicule($id){
  $obj = new categoriesModel();
  $r=$obj->deleteVehicule($id);
  if($r){
  header('Location: index.php?router=categories');
  exit();
  return $r;
}
}






 }


?>