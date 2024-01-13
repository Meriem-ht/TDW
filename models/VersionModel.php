<?php
require_once("ConnexionModel.php");
class versionModel{

    public function getVersions($modeleid,$year) {
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT *
                FROM vers v
                WHERE v.id_modele = ? AND ? BETWEEN YEAR(v.datedebut) AND YEAR(v.datefin)
                ORDER BY v.nom ";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1,$modeleid);
        $qtf->bindParam(2,$year);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
}
}

?>