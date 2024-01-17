<?php
require_once("ConnexionModel.php");
class vehiculeModel{
   


    //Véhicule selon les données d'un formulaire 
    public function getVehicule($typeid,$marqueid,$modeleid,$versionid) {
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT DISTINCT m.nom as marquen ,ve.nom as versionn ,i.url,mo.nom as modelen ,v.idvehicule,v.id_type 
        FROM vehicule v 
        INNER JOIN typevehicule tv ON v.id_type=tv.idtype 
        INNER JOIN marque m ON v.id_marque=m.idmarque 
        INNER JOIN modele mo ON v.id_modele=mo.idmodele
        INNER JOIN vers ve ON v.id_version=ve.idversion 
        INNER JOIN image_vehicule iv ON v.idvehicule=iv.id_vehicule 
        INNER JOIN image i ON iv.id_image = i.idimage
        WHERE tv.idtype=? AND m.idmarque=? AND mo.idmodele= ? AND ve.idversion=?
                ";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $typeid);
        $qtf->bindParam(2, $marqueid);
        $qtf->bindParam(3, $modeleid);
        $qtf->bindParam(4, $versionid);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
}

       //Get les caractéristiques d'une véhicule 
       public function getVehiculecarac($idvehicule) {
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT DISTINCT t.nom,cv.valeur,v.idvehicule ,i.url 
        FROM vehicule v 
        INNER JOIN caract_vehicule cv ON v.idvehicule=cv.id_vehicule
        INNER JOIN caract t ON cv.id_caract = t.idcaract 
        INNER JOIN image_vehicule iv ON v.idvehicule=iv.id_vehicule 
        INNER JOIN image i ON iv.id_image = i.idimage 
        WHERE v.idvehicule=?
        GROUP BY t.nom;";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $idvehicule);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
}


     //Get Vehicule On utilisant L'ID 

      public function getVehiculeById($idvehicule){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT DISTINCT m.nom as marquen ,ve.nom as versionn , ve.datedebut ,ve.datefin ,i.url,mo.nom as modelen , v.id_type as idtype
        FROM vehicule v 
        INNER JOIN marque m ON v.id_marque=m.idmarque 
        INNER JOIN modele mo ON v.id_modele=mo.idmodele
        INNER JOIN vers ve ON v.id_version=ve.idversion 
        INNER JOIN image_vehicule iv ON v.idvehicule=iv.id_vehicule 
        INNER JOIN image i ON iv.id_image = i.idimage
        WHERE v.idvehicule= ?
                ";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $idvehicule);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
}

       //Les comparaisons Populaires 
        public function getTopCompar($idvehicule){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT v.* ,c.nbcompare,i.url ,m.nom as marquen ,ve.nom as versionn ,i.url,mo.nom as modelen
        FROM comparaison c 
        LEFT JOIN vehicule v ON v.idvehicule=c.vehicule1_id OR v.idvehicule=c.vehicule2_id
        JOIN marque m ON m.idmarque=v.id_marque
        JOIN modele mo ON mo.idmodele=v.id_modele
        JOIN vers ve ON ve.idversion=v.id_version
        JOIN image_vehicule iv ON iv.id_vehicule=v.idvehicule
        LEFT JOIN image i ON i.idimage =iv.id_image
        WHERE c.vehicule1_id=$idvehicule OR c.vehicule2_id=$idvehicule
        GROUP BY v.idvehicule,c.nbcompare
        ORDER BY nbcompare DESC LIMIT 4;";    
    
        $qtf = $c->prepare($query);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
    
        return $r; 
    }

}

?>