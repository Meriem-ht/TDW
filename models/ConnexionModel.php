<?php
class connexion{
    private $dbname="tdw";
    private $host="127.0.0.1";
    private $user="root";
    private $password="";

    public function connect (){
        $dsn = "mysql:dbname=$this->dbname;host=$this->host;";
        try {
            $c = new PDO($dsn, $this->user, $this->password);
        } catch (PDOException $ex) {
            printf("Erreur de connexion à la base de données : %s", $ex->getMessage());
            exit();
        }
        return $c;
    }
    public function disconnect(&$c){
        $c=null;
    }
    public function request($c,$qtf){
        $c= $c->prepare($qtf);
        $c->execute();
        return $c->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>