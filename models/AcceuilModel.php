<?php
require_once("ConnexionModel.php");
class acceuilModel{

    //Diaporama 
    public function getDiapo(){
        $obj= new connexion();
        $c=$obj->connect();
        $qtf="SELECT d.*,i.url 
        FROM diaporama d
        INNER JOIN image_diapo  id ON d.iddiaporama=id.id_diapo
        INNER JOIN image i ON id.id_image=i.idimage";
        $r=$obj->request($c,$qtf);
        $obj->disconnect($c);
        return $r;
      }


      //Popular comparaison selon le nombre de nbcompare 
      public function getPopCompar(){
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
          GROUP BY v.idvehicule,c.nbcompare 
          ORDER BY nbcompare DESC LIMIT 6;";    //6 pour avoir 3 comparaison 
      
          $qtf = $c->prepare($query);
          $qtf->execute();
          $r = $qtf->fetchAll(PDO::FETCH_ASSOC);
          $obj->disconnect($c);
      
          return $r; 
      }
}


?>