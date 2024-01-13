<?php
require_once("ConnexionModel.php");
class vehiculeModel{

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

public function getVehiculeById($idvehicule){
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT DISTINCT m.nom as marquen ,ve.nom as versionn ,i.url,mo.nom as modelen
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

}

?>