<?php
require_once("ConnexionModel.php");
class categoriesModel{
  public function infoNews($idnews){
    $obj= new connexion();
    $c=$obj->connect();
    $query="SELECT * 
    FROM news n
    WHERE n.idnews=? ";
     $qtf = $c->prepare($query);
     $qtf->bindParam(1, $idnews);
     $qtf->execute();
     $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
    $obj->disconnect($c);
    return $r;
  }

    public function getDataUsers(){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT u.iduser,u.nom,u.prenom,u.username,u.sexe,u.date_nais ,u.statutuser as statut
        FROM user u";    
        $qtf = $c->prepare($query);
        $result= $qtf->execute();
        $data = array();
        while ($row = $qtf->fetch(PDO::FETCH_ASSOC)){
            $enrg = array();
            foreach($row as $carac => $valeur){
            $enrg[] = ["col"=>$carac , "valeur" =>$valeur];}
            $data[] = $enrg;
        };
        $obj->disconnect($c);
        return $data; 
      }
      //DELETE UPDATE BLOQUE AND VALIDE
      public function updateUser($id, $statut){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "UPDATE user
                  SET user.statutuser = :statut
                  WHERE user.iduser = :id";    
        $qtf = $c->prepare($query);
        $qtf->bindParam(':statut', $statut);
        $qtf->bindParam(':id', $id);
        $r = $qtf->execute();
        $obj->disconnect($c);
        return $r ; 
    }
      public function getDataNews(){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT *
        FROM news";    
        $qtf = $c->prepare($query);
        $result= $qtf->execute();
        $data = array();
        while ($row = $qtf->fetch(PDO::FETCH_ASSOC)){
            $enrg = array();
            foreach($row as $carac => $valeur){
            $enrg[] = ["col"=>$carac , "valeur" =>$valeur];}
            $data[] = $enrg;
        };
        $obj->disconnect($c);
        return $data;  
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
      public function deleteNews($id){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "UPDATE news
        SET  news.statutnews=false
        WHERE news.idnews=:id";   
        $qtf = $c->prepare($query);
        $qtf->bindParam(':id', $id);
        $r =   $qtf->execute();
        $obj->disconnect($c);
        return $r; 
      }
      public function afficherNews($id){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "UPDATE news
        SET  news.afficher=true
        WHERE news.idnews=:id";   
        $qtf = $c->prepare($query);
        $qtf->bindParam(':id', $id);
        $r =   $qtf->execute();
        $obj->disconnect($c);
        return $r; 
      }
    
      public function addDataNews($titre,$texte,$afficher,$statu){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "INSERT INTO  news (titre,texte,date,statutnews,afficher) VALUES(?,?,NOW(),?,?)";  
        $qtf = $c->prepare($query);  
        $qtf->bindParam(1, $titre);
        $qtf->bindParam(2, $texte);
        $qtf->bindParam(3, $statu);
        $qtf->bindParam(4, $afficher);
        $r=$qtf->execute();
        $obj->disconnect($c);
        return $r; 
      }
      
      public function updateDataNews($id,$titre,$texte,$afficher,$statu){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "UPDATE news SET titre=?, texte=?, statutnews=?, afficher=?
        WHERE idnews= ?"; 
        $qtf = $c->prepare($query);   
        $qtf->bindParam(1, $titre);
        $qtf->bindParam(2, $texte);
        $qtf->bindParam(3, $statu);
        $qtf->bindParam(4,$afficher);
        $qtf->bindParam(5,$id);
        $r=$qtf->execute();
        $obj->disconnect($c);
        return $r; 
      }
     

      public function getDataAvis(){

        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT a.idavis as Id_Avis ,u.iduser as Id_User,a.commentaire as commentaire,a.statut as statut, a.estmarque as Est_Marque , u.nom as Nom_User ,m.nom as Nom_Marque,vers.nom as Vehicule_version
        FROM avis a
        LEFT JOIN user u ON a.id_user =u.iduser
        LEFT JOIN vehicule v ON a.id_vehicule=v.idvehicule
        LEFT JOIN vers vers ON v.id_version=vers.idversion
        LEFT JOIN marque m ON a.id_marque=m.idmarque";    
         $qtf = $c->prepare($query);
         $result= $qtf->execute();
         $data = array();
         while ($row = $qtf->fetch(PDO::FETCH_ASSOC)){
             $enrg = array();
             foreach($row as $carac => $valeur){
             $enrg[] = ["col"=>$carac , "valeur" =>$valeur];}
             $data[] = $enrg;
         };
         $obj->disconnect($c);
         return $data; ; 
      }

      public function updateAvis($id, $statut){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "UPDATE avis
                  SET avis.statut = :statut
                  WHERE avis.idavis = :id";    
        $qtf = $c->prepare($query);
        $qtf->bindParam(':statut', $statut);
        $qtf->bindParam(':id', $id);
        $r = $qtf->execute();
        $obj->disconnect($c);
        return $r ; 
    }


    public function getDataMarque(){

      $obj = new connexion();
      $c = $obj->connect();
      $query = "SELECT * from marque";    
       $qtf = $c->prepare($query);
       $result= $qtf->execute();
       $data = array();
       while ($row = $qtf->fetch(PDO::FETCH_ASSOC)){
           $enrg = array();
           foreach($row as $carac => $valeur){
           $enrg[] = ["col"=>$carac , "valeur" =>$valeur];}
           $data[] = $enrg;
       };
       $obj->disconnect($c);
       return $data;  
    }


    public function deleteMarque($id){
      $obj = new connexion();
      $c = $obj->connect();
      $query = "UPDATE marque m
      SET  m.statutmarque=false
      WHERE m.idmarque=:id";   
      $qtf = $c->prepare($query);
      $qtf->bindParam(':id', $id);
      $r =   $qtf->execute();
      $obj->disconnect($c);
      return $r; 
    }

    public function updateDataMarque($data){
      $obj = new connexion();
      $c = $obj->connect();
      $query = "UPDATE marque SET nom=?, statutmarque=?, estpopulaire=?, pays=?,siege_social=?,annee_creation=?
      WHERE idmarque= ?"; 
      $qtf = $c->prepare($query);   
      $qtf->bindParam(1, $data["nommarque"]);
      $qtf->bindParam(2, $data["statu"]);
      $qtf->bindParam(3, $data["pop"]);
      $qtf->bindParam(4,$data["pays"]);
      $qtf->bindParam(5,$data["sg"]);
      $qtf->bindParam(6,$data["creation"]);
      $qtf->bindParam(7,$data["idmarque"]);
      $r=$qtf->execute();
      $obj->disconnect($c);
      var_dump($r);
      return $r; 
    }
    public function addDataMarque($data){
      $obj = new connexion();
      $c = $obj->connect();
      $query = "INSERT INTO  marque (nom,statutmarque,estpopulaire,pays,siege_social,annee_creation) VALUES(?,?,?,?,?,?)";  
      $qtf = $c->prepare($query);  
      $qtf->bindParam(1, $data["nommarque"]);
      $qtf->bindParam(2, $data["statu"]);
      $qtf->bindParam(3, $data["pop"]);
      $qtf->bindParam(4,$data["pays"]);
      $qtf->bindParam(5,$data["sg"]);
      $qtf->bindParam(6,$data["creation"]);
      $r=$qtf->execute();
      $lastid = $c->lastInsertId();
      $obj->disconnect($c);
      return $lastid; 
   }
   public function getDataVehicule($idmarque){
    $obj= new connexion();
    $c=$obj->connect();
    $query="SELECT v.idvehicule ,m.idmarque as Id_Marque ,m.nom as marque ,ve.nom as version ,mo.nom as modele ,ve.datedebut as Année_Début , ve.datefin as Date_Fin ,v.statutvehicule as Statut,v.estprincipale as Principale 
    FROM vehicule v
    JOIN marque m ON m.idmarque=v.id_marque
    JOIN modele mo ON mo.idmodele=v.id_modele
    JOIN vers ve ON ve.idversion=v.id_version
    WHERE v.id_marque= ? ";
    $qtf = $c->prepare($query);  
    $qtf->bindParam(1, $idmarque);
    $qtf->execute();
    $data = array();
       while ($row = $qtf->fetch(PDO::FETCH_ASSOC)){
           $enrg = array();
           foreach($row as $carac => $valeur){
           $enrg[] = ["col"=>$carac , "valeur" =>$valeur];}
           $data[] = $enrg;
       };
       $obj->disconnect($c);
       return $data;
  }

  public function deleteVehicule($id){
    $obj = new connexion();
    $c = $obj->connect();
    $query = "UPDATE vehicule v
    SET  v.statutvehicule=false
    WHERE v.idvehicule=:id";   
    $qtf = $c->prepare($query);
    $qtf->bindParam(':id', $id);
    $r =   $qtf->execute();
    $obj->disconnect($c);
    return $r; 
  }
  public function getcarac(){
    $obj = new connexion();
    $c = $obj->connect();
    $query = "SELECT * from caract";   
    $qtf = $c->prepare($query);
    $qtf->execute();
    $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
    $obj->disconnect($c);
    return $r; 
  }
  public function addDVehicule($data,$idmodele,$idversion){
    $obj = new connexion();
    $c = $obj->connect();
    $query = "INSERT INTO  vehicule (estprincipale,id_marque,id_modele,id_version,id_type) VALUES(?,?,?,?,?)";  
    $qtf = $c->prepare($query);  
    $qtf->bindParam(1, $data["pop"]);
    $qtf->bindParam(2, $data["idmarque"]);
    $qtf->bindParam(3, $idmodele);
    $qtf->bindParam(4, $idversion);
    $qtf->bindParam(5,$data["types"]);
    $qtf->execute();
    $lastid = $c->lastInsertId();
    $obj->disconnect($c);
    return $lastid; 
 }
 public function addModele($nom,$idmarque){
  $obj = new connexion();
  $c = $obj->connect();
  $query = "INSERT INTO  modele (nom,id_marque) VALUES(?,?)";  
  $qtf = $c->prepare($query);  
  $qtf->bindParam(1,$nom);
  $qtf->bindParam(2,$idmarque);
  $r=$qtf->execute();
  $lastid = $c->lastInsertId();
  $obj->disconnect($c);
  return $lastid; 
 }
 public function addVersion($nom,$idmodele,$debut,$fin){
  $obj = new connexion();
  $c = $obj->connect();
  $query = "INSERT INTO  vers (nom,datedebut,datefin,id_modele) VALUES(?,?,?,?)";  
  $qtf = $c->prepare($query);  
  $qtf->bindParam(1,$nom);
  $qtf->bindParam(2,$idmodele);
  $qtf->bindParam(3,$debut);
  $qtf->bindParam(4,$fin);
  $r=$qtf->execute();
  $lastid = $c->lastInsertId();
  $obj->disconnect($c);
  return $lastid; 
 }
 public function getModele($nom,$idmarque){
  var_dump($nom,$idmarque);
  $obj = new connexion();
  $c = $obj->connect();
  $query = "SELECT idmodele FROM  modele WHERE nom=? AND id_marque= ?";  
  $qtf = $c->prepare($query);  
  $qtf->bindParam(1,$nom);
  $qtf->bindParam(2,$idmarque);
  $qtf->execute();
  $r = $qtf->fetch(PDO::FETCH_ASSOC);
  $obj->disconnect($c);
  if($r) {return $r['idmodele'];}
  else {return false;}
 }
 public function getVersion($nom,$idmodele){
  $obj = new connexion();
  $c = $obj->connect();
  $query = "SELECT idversion FROM  vers WHERE nom=? AND id_modele= ?";  
  $qtf = $c->prepare($query);  
  $qtf->bindParam(1,$nom);
  $qtf->bindParam(2,$idmodele);
  $qtf->execute();
  $r = $qtf->fetch(PDO::FETCH_ASSOC);
  $obj->disconnect($c);
  if($r) {return $r['idversion'];}
  else {return false;}
 }

 public function addCaracV($idv,$idcarac,$valeur){
  $obj = new connexion();
  $c = $obj->connect();
  $query = "INSERT INTO caract_vehicule (id_vehicule,id_caract,valeur) VALUES(?,?,?)";  
  $qtf = $c->prepare($query);  
  $qtf->bindParam(1,$idv);
  $qtf->bindParam(2,$idcarac);
  $qtf->bindParam(3,$valeur);
  $r=$qtf->execute();
  $obj->disconnect($c);
  return $r; 
 }


}


?>