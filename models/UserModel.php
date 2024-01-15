<?php
require_once("ConnexionModel.php");
class userModel{

    public function userexist($username){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT *
                FROM user u
                WHERE u.username =?";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $username);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return ($qtf->rowCount()>0);
    }
    public function register($data) {
        $obj = new connexion();
        $c = $obj->connect();
        $passwordhash=password_hash($data["password"], PASSWORD_DEFAULT);
        $query = "INSERT INTO user (nom,prenom,username,sexe,date_nais,motpasse)
                VALUES(?,?,?,?,?,?)";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $data["nom"]);
        $qtf->bindParam(2, $data["prenom"]);
        $qtf->bindParam(3, $data["username"]);
        $qtf->bindParam(4, $data["sexe"]);
        $qtf->bindParam(5, $data["date"]);
        $qtf->bindParam(6,$passwordhash);
        $qtf->execute();
        $obj->disconnect($c);
        return ($qtf->rowCount() >0);   
}
    public function login($username,$password){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT u.motpasse,u.iduser
                FROM user u
                WHERE u.username =? AND u.statutuser='Inscrit'";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $username);
        $qtf->execute();
        $r = $qtf->fetch(PDO::FETCH_ASSOC);
        if($r !==false){
        $passwordhash=$r['motpasse'];
        if(password_verify($password,$passwordhash)){
        $obj->disconnect($c);
        return $r;}
    }  
        $obj->disconnect($c);
        return false;
    }
    public function loginAdmin($username,$password){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT a.motpasse,a.username
                FROM admin a
                WHERE a.username =? AND a.motpasse=? ";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $username);
        $qtf->bindParam(2, $password);
        $qtf->execute();
        $r = $qtf->fetch(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return ($qtf->rowCount() >0);
    }
 
    public function addFavoris($iduser,$idvehicule) {
        $obj = new connexion();
        $c = $obj->connect();
        $query = "INSERT INTO favoris (id_user,id_vehicule)
                VALUES(?,?)";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $iduser);
        $qtf->bindParam(2, $idvehicule);
        $qtf->execute();
        $obj->disconnect($c);
        return ($qtf->rowCount() >0);   
}
        public function removeFavoris($iduser,$idvehicule) {
         $obj = new connexion();
         $c = $obj->connect();
         $query = "DELETE FROM  favoris f
         WHERE f.id_user=? AND f.id_vehicule=?";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $iduser);
        $qtf->bindParam(2, $idvehicule);
        $qtf->execute();
        $obj->disconnect($c);
        return ($qtf->rowCount() >0);   
}

    public function setRate($note, $isMarque, $idEntity, $iduser)
{
    $obj = new connexion();
    $c = $obj->connect();

    $query = "INSERT INTO note (`notevalue`, `estmarque`, `id_user`, `id_vehicule`, `id_marque`)
              VALUES (:note, :ismarque, :iduser, :idvehicule, :idmarque)
              ON DUPLICATE KEY UPDATE notevalue = :note";

    $id_vehicule = $isMarque ? 'null' : $idEntity;
    $id_marque = $isMarque ? $idEntity : 'null';

    $qtf = $c->prepare($query);
    $qtf->bindParam(':note', $note);
    $qtf->bindParam(':ismarque', $isMarque);
    $qtf->bindParam(':iduser', $iduser);
    $qtf->bindParam(':idvehicule', $id_vehicule);
    $qtf->bindParam(':idmarque', $id_marque);

    $qtf->execute();

    $obj->disconnect($c);

    return $note;
}
public function getTotalRate($isMarque,$idEntity){
    $obj = new connexion();
    $c = $obj->connect();
    $entity=$isMarque?'n.id_marque':'n.id_vehicule';
    $query = "SELECT COUNT(n.id_user) as raters, AVG(n.notevalue) as avg
    FROM note n 
    WHERE n.estmarque=:ismarque  AND $entity= :iden
    GROUP BY $entity";


    $qtf = $c->prepare($query);
    $qtf->bindParam(':ismarque', $isMarque);
    $qtf->bindParam(':iden', $idEntity);
    $qtf->execute();
    $r = $qtf->fetch(PDO::FETCH_ASSOC);
    $obj->disconnect($c);

    return $r;  
}
public function getRate($isMarque,$idEntity){
    $obj = new connexion();
    $c = $obj->connect();
    $entity=$isMarque?'n.id_marque':'n.id_vehicule';
    $query = "SELECT n.notevalue 
    FROM note n 
    WHERE n.estmarque=:ismarque  AND $entity= :iden";


    $qtf = $c->prepare($query);
    $qtf->bindParam(':ismarque', $isMarque);
    $qtf->bindParam(':iden', $idEntity);
    $qtf->execute();
    $r = $qtf->fetch(PDO::FETCH_ASSOC);
    $obj->disconnect($c);

    return $r;  
}

public function gestionUsers(){
    $obj = new connexion();
    $c = $obj->connect();
    $qtf = "SELECT u.iduser,u.nom,u.prenom,u.username,u.sexe,u.date_nais ,u.statutuser as statut
    FROM user u";    
    $r=$obj->request($c,$qtf);
    $obj->disconnect($c);
    return $r; 
  }
  //DELETE UPDATE BLOQUE AND VALIDE
  public function updateuser($iduser,$statut){
    $obj = new connexion();
    $c = $obj->connect();
    $qtf = "UPDATE user
    SET  user.statutuser=$statut
    WHERE user.iduser=$iduser";    
    $r=$obj->request($c,$qtf);
    $obj->disconnect($c);
    return $r; 
  }
}

?>