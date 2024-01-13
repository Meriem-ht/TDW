<?php
require_once("ConnexionModel.php");
class modeleModel{

    public function getModeles($marqueid) {
        $obj = new connexion();
        $c = $obj->connect();
        $query = "SELECT *
                FROM modele m
                WHERE m.id_marque =?
                ORDER BY m.nom";

        $qtf = $c->prepare($query);
        $qtf->bindParam(1, $marqueid);
        $qtf->execute();
        $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
        $obj->disconnect($c);
        return $r;
}
}

?>