<?php
include('./models/UserModel.php');
require_once('./views/UserProfileView.php');

class userController{

  // Si User Existe Déja Dans bdd
  private function userexist($data){
    $obj = new userModel();
    $r = $obj->userexist($data["username"]);
    return $r;
  }

  // Registrer 
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

  //LOGIN 
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


  //Logout 
    public function logout(){
      session_unset();
      session_destroy();
  }
  // Boolean pour savoir si déja user mettre favoris 
  public function userFavoris($iduser,$idfavoris){
    $obj=new userModel();
    $r=$obj->userFavoris($iduser, $idfavoris);
    return $r;
  }
  // Ajouter une véhicule à favoris d'un user 
  public function addFavoris($iduser,$idfavoris){
    $obj=new userModel();
    $r=$obj->addFavoris($iduser, $idfavoris);
    return $r;
  }
 // Remove une véhicule à favoris d'un user 
  public function removeFavoris($iduser, $idfavoris){
    $obj=new userModel();
    $r=$obj->removeFavoris($iduser, $idfavoris);
    return $r;
  }
 // Handle Favoris 
  public function setFavoris($idfavoris){
    if($idfavoris !== null ){
        if (isset($_SESSION["userId"])){
         $iduser=$_SESSION["userId"] ;
        $exist=$this-> userFavoris($iduser,$idfavoris);
        if ($exist) {
            $r = $this->removeFavoris($iduser, $idfavoris);
            echo json_encode(array("status" => "removed"));
        } else {
            $r = $this->addFavoris($iduser, $idfavoris);
            echo json_encode(array("status" => "added"));
        }
     }
    else{echo json_encode(array("status"=>"error","message"=>"Need to inscrire"));}
     }
    else{echo json_encode(array("status"=>"error","message"=>"ERROR"));}
}




  //Ajouter Rate 
  public function setRate($note,$isMarque,$idEntity){
    $iduser=$_SESSION['userId'];
    $isMarque=filter_var($isMarque,FILTER_VALIDATE_BOOLEAN);
    $obj = new userModel();
    $r = $obj->setRate($note,$isMarque,$idEntity,$iduser);
 
    echo json_decode($r);
  }


 //Total Rate d'une entité (véhicule ou marque)
  public function getTotalRate($isMarque,$idEntity){
    $isMarque=filter_var($isMarque,FILTER_VALIDATE_BOOLEAN);
    $obj = new userModel();
    $r = $obj->getTotalRate($isMarque,$idEntity);   
    echo json_encode($r);
  }



//Get the current rate 
  public function getRate($isMarque,$idEntity){
    $isMarque=filter_var($isMarque,FILTER_VALIDATE_BOOLEAN);
    $obj = new userModel();
    $r = $obj->getRate($isMarque,$idEntity);   
    echo json_encode($r);
  }




//Login Admin 
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

// Logout Admin 
public function logoutAdmin(){
    session_unset();
    session_destroy();
}


//Les favoris d'un user 
public function getUserFavoris($iduser){
    $obj= new userModel();
    $r=$obj->getUserFavoris($iduser);
    return $r;
}


//Info user
public function getInfoUser($id){
  $obj= new userModel();
  $r=$obj->getInfoUser($id);
  return $r;
}


//Display Profil 
public function showProfile($id){
  $obj =new userView();
  $r= $obj->showProfile($id);
  return $r;
}
   
  
 }


?>