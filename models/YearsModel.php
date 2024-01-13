<?php
require_once("ConnexionModel.php");
class yearsModel{

    public function getYears($modeleid) {
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT DISTINCT YEAR(datedebut) as year
        FROM vers WHERE id_modele = ?
        UNION
        SELECT DISTINCT YEAR(datefin) FROM vers WHERE id_modele = ?
        ORDER BY year";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $modeleid);
        $qtf->bindParam(2, $modeleid);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
}
}

?>