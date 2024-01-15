<?php
require_once("ConnexionModel.php");
class avisModel{
    public function getAllavis($isMarque,$idEntity,$iduser){
        $obj = new connexion();
        $c = $obj->connect();
        $entity=$isMarque?'v.id_marque':'v.id_vehicule';
        $query = "SELECT v.*,u.nom,u.prenom,
        EXISTS(SELECT * from likeavis WHERE likeavis.id_user= :user AND likeavis.id_avis = v.idavis ) as userlike
        FROM avis v
        JOIN user u ON v.id_user = u.iduser 
        WHERE v.estmarque =:ismarque  AND $entity = :iden AND v.statut = :statu ";
    
    
        $qtf = $c->prepare($query);
        $qtf->bindParam(':user', $iduser);
        $qtf->bindParam(':ismarque', $isMarque);
        $qtf->bindParam(':iden', $idEntity);
        $qtf->bindValue(':statu', 'Valide');
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
    
        return $r; 
      }
      
    public function setAvis($comment,$isMarque,$idEntity,$iduser){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "INSERT INTO avis (`commentaire`,`estmarque`,`id_user`,`id_marque`,`id_vehicule`,`date`)
        VALUES(?,?,?,?,?,NOW())";
            $id_vehicule = $isMarque ? 'null' : $idEntity;
            $id_marque = $isMarque ? $idEntity : 'null';
            date_default_timezone_set('Europe/Paris');
        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $comment);
        $qtf->bindParam(2, $isMarque);
        $qtf->bindParam(3, $iduser);
        $qtf->bindParam(4, $id_marque);
        $qtf->bindParam(5, $id_vehicule);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
    }

    public function userlikeavis($iduser,$idavis){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT *
        FROM likeavis l
        WHERE l.id_user =?  AND l.id_avis = ?";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $iduser);
        $qtf->bindParam(2, $idavis);
        $qtf->execute();
        
        $obj->disconnect($c);
    
        return ($qtf->rowCount()>0); 
    }
    public function likeavis($iduser,$idavis){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "INSERT 
        INTO likeavis  (id_user, id_avis)
        VALUES(?,?)";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $iduser);
        $qtf->bindParam(2, $idavis);
        $r=$qtf->execute();
        
        $obj->disconnect($c);
    
        return $r; 
    }
    public function unlikeavis($iduser,$idavis){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "DELETE 
        FROM likeavis l
        WHERE l.id_user =?  AND l.id_avis = ?";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $iduser);
        $qtf->bindParam(2, $idavis);
        $r=$qtf->execute();
        
        $obj->disconnect($c);
    
        return $r; 
    }


    public function getBestReview($isMarque,$idEntity,$iduser){
        $obj = new connexion();
        $c = $obj->connect();
        $entity=$isMarque?'v.id_marque':'v.id_vehicule';
        $query = "SELECT v.* , COUNT(l.id_user) as nblike , u.nom ,u.prenom ,
        EXISTS(SELECT * from likeavis WHERE likeavis.id_user= :user AND likeavis.id_avis=v.idavis ) as userlike
        FROM avis v
        LEFT JOIN likeavis l ON v.idavis=l.id_avis
        LEFT JOIN user u ON v.id_user =u.iduser
        WHERE v.estmarque =:ismarque  AND $entity = :iden AND v.statut =:statu AND u.statutuser='Inscrit'
        GROUP BY v.idavis
        ORDER BY nblike DESC
        LIMIT 3";    
    
        $qtf = $c->prepare($query);
        $qtf->bindParam(':user', $iduser);
        $qtf->bindParam(':ismarque', $isMarque);
        $qtf->bindParam(':iden', $idEntity);
        $qtf->bindValue(':statu', 'Valide');
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
    
        return $r; 
      } 

      public function gestionAvis(){

        $obj = new connexion();
        $c = $obj->connect();
        $qtf = "SELECT a.idavis as idavis,a.commentaire as commentaire,a.statut as statut , u.nom as nomuser ,m.nom as marquen,vers.nom as versionn
        FROM avis a
        LEFT JOIN user u ON a.id_user =u.iduser
        LEFT JOIN vehicule v ON a.id_vehicule=v.idvehicule
        LEFT JOIN vers vers ON v.id_version=vers.idversion
        LEFT JOIN marque m ON a.id_marque=m.idmarque";    
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r; 
      }
      public function refuseAvis($idavis){
        $obj = new connexion();
        $c = $obj->connect();
        $qtf = "UPDATE avis
        SET  avis.statut=false
        WHERE avis.idavis=$idavis";    
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r; 
      }
}


?>