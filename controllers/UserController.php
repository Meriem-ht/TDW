<?php
include('./models/UserModel.php');

class userController{
  private function userexist($data){
    $obj = new userModel();
    $r = $obj->userexist($data["username"]);
    return $r;
  }

  public function register($data){
    $obj = new userModel();
    $userexist=$this->userexist($data);
    if ($userexist){
        echo json_encode(array("status"=>"error","message"=>"Nom d'utilisateur existe déja"));
     }
     else {
     $result = $obj->register($data);
     if($result){
       echo json_encode(array("status"=>"success","message"=>"Registration avec succès"));
     }
     else{
        echo json_encode(array("status"=>"error","message"=>"Probléme lors de l'enregistrement"));
     }
    }
   }
   public function login($username,$password){
    $obj = new userModel();
    $login=$obj->login($username,$password);
    if($login){
        $_SESSION['userName']=$username;
        $_SESSION['userId']=$login['iduser'];
        echo json_encode(array("status"=>"success","message"=>"Bienvenue"));
      }
      else{
         echo json_encode(array("status"=>"error","message"=>"Nom d'utilisateur ou mot de passe invalide"));
      }
   }

    public function logout(){
      session_unset();
      session_destroy();
  }

  public function setFavoris($isFavorite,$idvehicule){
    $iduser=$_SESSION['userId'];
    $isFavorite=filter_var($isFavorite,FILTER_VALIDATE_BOOLEAN);
    $obj = new userModel();
    var_dump($isFavorite, $idvehicule, $iduser);
    if($isFavorite==false){
    $r1=$obj->addFavoris($iduser,$idvehicule);
    return $r1;
    }
    else{
      $r=$obj->removeFavoris($iduser,$idvehicule);
      return $r;
    }
  }

  public function setRate($note,$isMarque,$idEntity){
    $iduser=$_SESSION['userId'];
    $isMarque=filter_var($isMarque,FILTER_VALIDATE_BOOLEAN);
    // var_dump($note,$isMarque,$idEntity,$iduser);
    $obj = new userModel();
    $r = $obj->setRate($note,$isMarque,$idEntity,$iduser);
    $name="rate";
    $value=json_decode($r);
    setcookie($name,$value,time()+(24*60*60*30),"/");
    // var_dump($_COOKIE[$name]);
    echo json_decode($r);
  }
  public function getTotalRate($isMarque,$idEntity){
    $isMarque=filter_var($isMarque,FILTER_VALIDATE_BOOLEAN);
    $obj = new userModel();
    $r = $obj->getTotalRate($isMarque,$idEntity);   
    echo json_encode($r);
  }
  public function getRate($isMarque,$idEntity){
    $isMarque=filter_var($isMarque,FILTER_VALIDATE_BOOLEAN);
    $obj = new userModel();
    $r = $obj->getRate($isMarque,$idEntity);   
    echo json_encode($r);
  }


  public function loginAdmin($username,$password){
    $obj = new userModel();
    $loginad=$obj->loginAdmin($username,$password);
    if($loginad){
        $_SESSION['admin']=$username;
        echo json_encode(array("status"=>"success","message"=>"Bienvenue"));
      }
      else{
         echo json_encode(array("status"=>"error","message"=>"Nom d'utilisateur ou mot de passe invalide"));
      }
   }
   public function logoutAdmin(){
    session_unset();
    session_destroy();
}
   
  
 }


?>