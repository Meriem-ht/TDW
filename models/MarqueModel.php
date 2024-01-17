<?php
require_once("ConnexionModel.php");
class marqueModel{

   //Les marques principales 
    public function getMarquePrincipale(){
        $obj= new connexion();
        $c=$obj->connect();
        $qtf="SELECT i.url ,im.id_marque
        FROM image i
        JOIN image_marque im ON im.id_image=i.idimage
        JOIN marque m ON im.id_marque=m.idmarque
        WHERE m.estpopulaire=true 
        Limit 10 ";
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r;
      }

      //Tout les marques 
      public function getMarques(){
        $obj= new connexion();
        $c=$obj->connect();
        $qtf="SELECT i.url,m.nom,im.id_marque
        FROM image i
        JOIN image_marque im ON im.id_image=i.idimage
        JOIN marque m ON im.id_marque=m.idmarque;";
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r;
      }

      //Detail D'une Marque 
      public function getMarqueDetail($idmarque){
        $obj= new connexion();
        $c=$obj->connect();
        $query="SELECT m.*,i.url
        FROM marque m
        JOIN image_marque im ON im.id_marque=m.idmarque
        JOIN image i ON   im.id_image=i.idimage
        WHERE m.idmarque= ? ";
        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $idmarque);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
      }
      public function getPrincipaleVehicule($idmarque){
        $obj= new connexion();
        $c=$obj->connect();
        $query="SELECT m.nom as marquen ,ve.nom as versionn ,i.url,mo.nom as modelen ,v.idvehicule
        FROM vehicule v
        JOIN marque m ON m.idmarque=v.id_marque
        JOIN modele mo ON mo.idmodele=v.id_modele
        JOIN vers ve ON ve.idversion=v.id_version
        JOIN image_vehicule iv ON iv.id_vehicule=v.idvehicule
        JOIN image i ON iv.id_image = i.idimage
        WHERE v.id_marque= ? AND v.estprincipale=true
        GROUP BY v.idvehicule ,m.nom ";
        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $idmarque);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
      }

      //get all vehicules d'une marque , $iduser c'est pour get au méme temps si user à mis une véhicule à son favoris 
      public function getVehicules($idmarque,$iduser){
        $obj= new connexion();
        $c=$obj->connect();
        $query="SELECT m.nom as marquen ,ve.nom as versionn ,i.url,mo.nom as modelen ,v.idvehicule,  
        EXISTS(SELECT * from favoris f WHERE f.id_user= ? AND f.id_vehicule = v.idvehicule ) as userfavoris
        FROM vehicule v
        JOIN marque m ON m.idmarque=v.id_marque
        JOIN modele mo ON mo.idmodele=v.id_modele
        JOIN vers ve ON ve.idversion=v.id_version
        JOIN image_vehicule iv ON iv.id_vehicule=v.idvehicule
        JOIN image i ON iv.id_image = i.idimage
        WHERE v.id_marque= ?
        GROUP BY v.idvehicule ,m.nom,ve.nom,mo.nom ";
        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $iduser);
        $qtf->bindParam(2, $idmarque);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
      }

      //Les marques d'un type de véhicule 

      public function getMarquesByType($typeid) {
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT mt.id_marque , m.nom
                FROM marque_type mt
                JOIN marque m ON m.idmarque=mt.id_marque
                WHERE mt.id_type = ? 
                ORDER BY m.nom;";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1,$typeid);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
}
}


?>