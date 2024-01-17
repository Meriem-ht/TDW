<?php
require_once("./views/CategoriesView.php");
require_once("./models/CategoriesModel.php");
require_once("./models/NewsModel.php");
require_once("./models/TypevModel.php");
require_once("NewsController.php");


class categoriesController{

       //Les différents Catégorie à gérer 

        public function showCategories(){
            $obj = new categoriesView();
            $r = $obj->showCategories();
            return $r;
           }

    /*----------------------------GESTION MARQUE ---------------------------------------*/
        // Avoir le Tableau des Marques 
        public function getDataMarque(){
            $obj = new categoriesModel();
            $r=$obj->getDataMarque();
            echo json_encode($r);
        }


        //Delete Une marque 
        public function deleteMarque($id){
          $obj = new categoriesModel();
          $r=$obj->deleteMarque($id);
          if($r){
          header('Location: index.php?router=categories');
          exit();
          return $r;
        }
        }


        //Le formulaires pour l'ajout d'une marque 
        public function updateMarque($idmarque){
          $obj = new categoriesView();
          $r = $obj->showMarqueInfo($idmarque);
          return $r;
        }

        //Update data d'une marque 
        public function updateDataMarque($data){
          $obj = new categoriesModel();
          $r = $obj->updateDataMarque($data);
          return $r;
        }
        // Formulaire pour L'ajout d'une marque 
        public function addMarque(){
          $obj = new categoriesView();
          $r = $obj->showAddMarque();
          return $r;
        }

        //Ajouter une marque 
        public function addDataMarque($data){
          $obj = new categoriesModel();
          $r = $obj->addDataMarque($data);
          $idimage=$this->addMImg($data["img"]);
          var_dump($idimage);
          $s=$this->addImageMarque($idimage,$r);
          foreach($data["types"] as $type){
            $obj1=new typevModel();
            $obj1->inserttypemarque($r,$type);
          }
          return $r;
        }

        private function addMImg($data){
          $obj = new categoriesModel();
          $r= $obj->addVImg($data);
          return $r;
        }
        private function addImageMarque($idimage,$idmarque){
          $obj = new categoriesModel();
          $r= $obj->addImageMarque($idimage,$idmarque);
          return $r;
        }


   /*----------------------------GESTION News ---------------------------------------*/  
        //Avoir la table de News  
        public function getDataNews(){
          $obj = new categoriesModel();
          $r=$obj->getDataNews();
          echo json_encode($r);
        }

        //Supprimer News 
        public function deleteNews($id){
          $obj = new categoriesModel();
          $r=$obj->deleteNews($id);
          if($r){
          header('Location: index.php?router=categories');
          exit();
          return $r;
        }
        }
        // Afficher un News dans La page News 
        public function afficherNews($id){
          $obj = new categoriesModel();
          $r=$obj->afficherNews($id);
          if($r){
          header('Location: index.php?router=categories');
          exit();
          return $r;
        }
        }

        //Formulaire pour La modifications d'un news 
        public function updateNews($idnews){
          $obj = new categoriesView();
          $r = $obj->showNewsInfo($idnews);
          return $r;
        }

        // Avoir les informations d'un news qui existe 
        public function infoNews($idnews){
          $obj = new categoriesModel();
          $r = $obj->infoNews($idnews);
          return $r;
        }

        // Updater News 
        public function updateDataNews($id,$titre,$texte,$afficher,$statu){
          $obj = new categoriesModel();
          $r = $obj->updateDataNews($id,$titre,$texte,$afficher,$statu);
          return $r;
        }

        // Formulaire pour Ajout d'un News 
        public function addDataNews($titre,$texte,$afficher,$statu,$img){
          var_dump($titre,$texte,$afficher,$statu);
          $obj = new categoriesModel();
          $r = $obj->addDataNews($titre,$texte,$afficher,$statu);
          $idimage=$this->addNImg($img);
          $m=$this->addImageNews($idimage,$r);
          return $r;
        }
        
        //Nouveau News 
        public function addNews(){
          $obj = new categoriesView();
          $r = $obj->showAddNews();
          return $r;
        }

        private function addNImg($data){
          $obj = new categoriesModel();
          $r= $obj->addNImg($data);
          return $r;
        }
        private function addImageNews($idimage,$idnews){
          $obj = new categoriesModel();
          $r= $obj->addImageNews($idimage,$idnews);
          return $r;
        }


  /*----------------------------GESTION Avis  ---------------------------------------*/
        //Get Data d'avis 
        public function getDataAvis(){
          $obj = new categoriesModel();
          $r=$obj->getDataAvis();
          echo json_encode($r);
        }


        //Supprimer un avis 
        public function deleteAvis($id){
          $obj = new categoriesModel();
          $r=$obj->updateAvis($id,'Supprime');
          if($r){
            header('Location: index.php?router=categories');
            exit();
          }
        return $r;
        }

        //Rejeter un avis 
        public function rejeterAvis($id){
          $obj = new categoriesModel();
          $r=$obj->updateAvis($id,'Rejete');
          if($r){
            header('Location: index.php?router=categories');
            exit();
          }
        return $r;
        }

        //Valider un avis 
        public function validerAvis($id){
          $obj = new categoriesModel();
          $r=$obj->updateAvis($id,'Valide');
          if($r){
            header('Location: index.php?router=categories');
            exit();
          }
        return $r;
        }
  /*----------------------------GESTION Users ---------------------------------------*/
       // Get les Users 
        public function getDataUsers(){
          $obj = new categoriesModel();
          $r=$obj->getDataUsers();
          echo json_encode($r);
        }

       // Delete un user 
        public function deleteUser($id){
          $obj = new categoriesModel();
          $r=$obj->updateUser($id,'Supprime');
          if($r){
            header('Location: index.php?router=categories');
            exit();
          }
        return $r;
        }

       //Valider l'inscription d'un user 
        public function validerUser($id){
          $obj = new categoriesModel();
          $r=$obj->updateUser($id,'Inscrit');
          if($r){
            header('Location: index.php?router=categories');
            exit();
          }
        return $r;
        }

        //Bloquer un utilisateur 
        public function bloquerUser($id){
          $obj = new categoriesModel();
          $r=$obj->updateUser($id,'Bloque');
          if($r){
            header('Location: index.php?router=categories');
            exit();
          }
        return $r;
        }
  /*----------------------------GESTION Paramétres  ---------------------------------------*/
       //Avoir les Infos de Paramétres
        public function getDataParam(){
          $obj = new categoriesModel();
          $r=$obj->getDataParam();
          echo json_encode($r);
        }
    
  /*----------------------------GESTION Vehicule  ---------------------------------------*/      
       
        // Le tableau de données d'un véhicule 
        public function getDataVehicule($idmarque){
          $obj = new categoriesModel();
          $r = $obj->getDataVehicule($idmarque);
          echo json_encode($r); 
        }
        //DELETE 
        public function deleteVehicule($id){
          $obj = new categoriesModel();
          $r=$obj->deleteVehicule($id);
          if($r){
          header('Location: index.php?router=categories');
          exit();
          return $r;
        }
        }
        //LE FORMULAIRE Pour ajout d'un véhicule 
        public function addVehicule($idmarque){
          $obj = new categoriesView();
          $r = $obj->showAddVehicule($idmarque);
          return $r;
        }

        //Les caractéristiques d'un véhicule 
        public function getcarac(){
          $obj = new categoriesModel();
          $r = $obj->getcarac();
          return $r;
        }
        //Ajouter un nouveau Modele
        private function addModele($modele,$idmarque){
          $obj = new categoriesModel();
          $r= $obj->addModele($modele,$idmarque);
          return $r;
        }
        //Si modele existe get son ID
        private function getModele($modele,$idmarque){
          $obj = new categoriesModel();
          $r= $obj->getModele($modele,$idmarque);
          return $r;
        }

        //Ajouter nouvelle version 
        private function addVersion($version,$idmodele,$dated,$datef){
          $obj = new categoriesModel();
          $r= $obj->addVersion($version,$idmodele,$dated,$datef);
          return $r;
        }

       //Si version existe avoir sa ID 
        private function getVersion($version,$modele){
          $obj = new categoriesModel();
          $r= $obj->getVersion($version,$modele);
          return $r;
        }

        //Ajouter une véhicule 
        private function addDVehicule($data,$modele,$version){
          $obj = new categoriesModel();
          $r= $obj->addDVehicule($data,$modele,$version);
          return $r;
        }

      

        //Ajouter les caractéristiques de cette véhicule 
        private function addCaracV($idv,$idcarac,$valeur){
          $obj = new categoriesModel();
          $r= $obj->addCaracV($idv,$idcarac,$valeur);
          return $r;
        }


        // Handle l'ajout d'un véhicule 

        public function addDataVehicule($data){
          $obj = new categoriesModel();
          $modele;
          $version;
          //Si click sur button add (boolean)
          if($data["modeleadd"]=="true"){
            //Ajouter ce Modele

            $modele= $this->addModele($data["nommodele"],$data["idmarque"]);
          }else{
            //Sinon avoir son IDs 

            $modele=$this->getModele($data["nommodele"],$data["idmarque"]);
          }
          if($data["versionadd"]=="true"){
            //La méme choses pour version 
            $version= $this->addVersion($data["nomversion"],$modele,$data["datedebut"],$data["datefin"]);
          }else{
            $version=$this->getVersion($data["nomversion"],$modele);
          }
          // $idimage=$this->addVImg($data["img"]);
          $r = $this->addDVehicule($data,$modele,$version);
          // $m=$this->addImageVehicule($idimage,$r);
          foreach($data["caract"] as $carac){
            if($carac["valeur"]!==''){
            $this->addCaracV($r,$carac["idcarac"],$carac["valeur"]);}
          }
          echo $r;
        }



 }


?>