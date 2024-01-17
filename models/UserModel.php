<?php
require_once("ConnexionModel.php");
class userModel{

    //get user if exists 
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


    //Registration 
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

    //login 
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


    //Login Admin
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

    //Les Favoris d'un utilisateur 
    public function userFavoris($iduser,$idfavoris){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT *
        FROM favoris f
        WHERE f.id_user =?  AND f.id_vehicule = ?";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $iduser);
        $qtf->bindParam(2, $idfavoris);
        $qtf->execute();
        
        $obj->disconnect($c);
    
        return ($qtf->rowCount()>0); 
    }

    //Ajouter aux favoris une véhicule 
    public function addFavoris($iduser,$idfavoris){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "INSERT 
        INTO favoris (id_user,id_vehicule)
        VALUES(?,?)";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $iduser);
        $qtf->bindParam(2, $idfavoris);
        $r=$qtf->execute();
        
        $obj->disconnect($c);
    
        return $r; 
    }

    //Enlever from favoris un véhicule 
    public function removeFavoris($iduser,$idfavoris){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "DELETE 
        FROM favoris f
        WHERE f.id_user =?  AND f.id_vehicule = ?";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $iduser);
        $qtf->bindParam(2, $idfavoris);
        $r=$qtf->execute();
        
        $obj->disconnect($c);
    
        return $r; 
    }
 

    //Ajouter la note sur une entité , si enrg existe faire update 
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

//Total de la note et combien de personne a noter cette Marque 
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

//Avoir le Rate d'une entité 

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

//Favoris d'un user 
  public function getUserFavoris($iduser){
    $obj = new connexion();
    $c = $obj->connect();
    $query = "SELECT m.nom as marquen ,ve.nom as versionn ,i.url,mo.nom as modelen ,v.idvehicule
    FROM favoris f 
    JOIN vehicule v ON v.idvehicule=f.id_vehicule
    JOIN marque m ON m.idmarque=v.id_marque
    JOIN modele mo ON mo.idmodele=v.id_modele
    JOIN vers ve ON ve.idversion=v.id_version
    JOIN image_vehicule iv ON iv.id_vehicule=v.idvehicule
    JOIN image i ON iv.id_image = i.idimage
    WHERE f.id_user=?
    GROUP BY v.idvehicule ,m.nom,ve.nom,mo.nom";
    $qtf = $c->prepare($query);
    $qtf->bindParam(1, $iduser);
    $qtf->execute();
    $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
    $obj->disconnect($c);

    return $r;  
}

//Les informations d'un utilisateur 
public function getInfoUser($id){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT u.nom as Nom , u.prenom as Prenom, u.username as UserName ,u.sexe as Sexe ,u.date_nais as Date_Naissance
        FROM user u
        WHERE u.iduser=?";    
        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $id);
        $result= $qtf->execute();
        while ($row = $qtf->fetch(PDO::FETCH_ASSOC)){
            $enrg = array();
            foreach($row as $carac => $valeur){
            $enrg[] = ["col"=>$carac , "valeur" =>$valeur];}
        };
        $obj->disconnect($c);
        return $enrg; 
     
}


}

?>