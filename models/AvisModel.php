<?php
require_once("ConnexionModel.php");
class avisModel{



  //Tous Les avis 
    public function getAllavis($isMarque,$idEntity,$iduser){
        $obj = new connexion();
        $c = $obj->connect();
        $entity=$isMarque?'v.id_marque':'v.id_vehicule';
        $query = "SELECT v.*,u.nom,u.prenom,
        EXISTS(SELECT * from likeavis WHERE likeavis.id_user= :user AND likeavis.id_avis = v.idavis ) as userlike
        FROM avis v
        JOIN user u ON v.id_user = u.iduser 
        WHERE v.estmarque =:ismarque  AND $entity = :iden AND v.statut = :statu AND u.statutuser='Inscrit' ";
    
    
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

    //Ajouter un nouveau avis 
      
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


    //Si user et idavis existe déja 
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

    //Faire un like sur un avis 
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

    //Remove Like from un avis 
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

   // AVOIR les 3 avis Les plus apprécis
   // EXISTS C'est Pour avoir le statu lors de l'affichement des j'aime 
   // Si userlike 0 ca veut dire il n'a pas avis
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

     
}


?>