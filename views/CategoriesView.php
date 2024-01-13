
<?php
require_once("./controllers/CategoriesController.php");
require_once("./controllers/MarqueController.php");
require_once("./controllers/TypevController.php");
require_once("CommonViews.php");

class categoriesView{

    public function showCategories(){
        ob_start();
        $r=new commonViews();
        $r->script();
        
        if(isset($_SESSION['admin'])){
            ?>
            <h1 class="heading mt-1">Gestion du Site Vehicom </h1>
            <div class="categories">
                <div class="category category-1"  onclick='createtable("marque")' >
                   <i class="fa-solid fa-car"></i>
                   <h3>Gestion des véhicules</h3> 
                 </div>
                 <div class="category category-2"   onclick='createtable("avis")'>
                 <i class="fa-solid fa-comment"></i>
                 <h3>Gestion des Avis</h3>
                 </div>
                 <div class="category category-3"   onclick='createtable("news")'>
                 <i class="fa-solid fa-newspaper"></i>
                 <h3>Gestion des  News</h3>
                 </div>
                 <div class="category category-4"  onclick='createtable("users")'>
                 <i class="fa-solid fa-user"></i>
                 <h3>Gestion des Utilisateurs</h3>
                 </div>
                 <div class="category category-5"  onclick='createtable("param")'>
                 <i class="fa-solid fa-gear"></i>
                 <h3>Gestion des Paramétres</h3>
                 </div>
            </div>
            <div class="gestion-table">

            </div>
            <?php
        } else {
            ?>
            <div class="gestion">
                <h1>PAGE NOT FOUND</h1>
            </div>
            <?php
        }

        $content = ob_get_clean();
        require("layout2.php"); 
    }


    public function showNewsInfo($idnews){
        ob_start();
        $r=new commonViews();
        $r->script();
        
        if(isset($_SESSION['admin'])){
            $news=new categoriesController();
            $newsdetail=$news->infoNews($idnews);
            ?>
            <h1 class="heading mt-1">Modifier News </h1>
            <form id="form-news" class="form-style"> 
            <div class="form-item">
            <input type="text" id="idnews" hidden value="<?php echo $idnews ?>"/>
            <input type="text" name="titrenews" id='titrenews' value="<?php echo $newsdetail[0]['titre']; ?>" required>     
            </div>
            <div class="form-item">
            <textarea type="text" name="textenews" id='textenews' required>
            <?php echo $newsdetail[0]['texte']; ?>  
            </textarea>    
            </div>
            <div class="form-item">
            <select  name="affichernews" id='affichernews' required> 
            <option value='1' <?php if ($newsdetail[0]['afficher'] == 1) echo 'selected'; ?>>Afficher dans news</option>
            <option value='0' <?php if ($newsdetail[0]['afficher'] == 0) echo 'selected'; ?>>Ne pas afficher</option>
            </select> 
        </div>
            <div>  
            <select  name="statunews" id='statunews'  required> 
            <option value='1' <?php if ($newsdetail[0]['statutnews'] == 1) echo 'selected'; ?>>Existe</option>
           <option value='0' <?php if ($newsdetail[0]['statutnews'] == 0) echo 'selected'; ?>>Supprimer</option>
            </select>     
            </div>
            <div class="flex-end">
             <input type="submit" value="Modifier" class="submit-btn" >
             </div>
            </form> 
            <?php
        } else {
            ?>
            <div class="gestion">
                <h1>PAGE NOT FOUND</h1>
            </div>
            <?php
        }

        $content = ob_get_clean();
        require("layout2.php"); 
    }



    public function showAddNews(){
        ob_start();
        $r=new commonViews();
        $r->script();
        
        if(isset($_SESSION['admin'])){
      
            ?>
            <h1 class="heading mt-1">Ajouter News </h1>
            <form id="form-news-add" class="form-style">
            <div class="form-item">
            <label for="titrenewsadd">Titre</label>
            <input type="text" name="titrenews" id='titrenewsadd'  required>     
            </div>
            <div class="form-item">
            <label for="textnewsadd">Texte</label>
            <textarea type="text" name="textenews" id='textenewsadd' required>
            </textarea>    
            </div>
            <div class="form-item">
            <label for="affichernewsadd">Afficher News</label>
            <select  name="affichernews" id='affichernewsadd' required> 
            <option value='1' >Afficher dans news</option>
            <option value='0' >Ne pas afficher</option>
            </select> 
        </div>
            <div>  
            <label for="statunewsadd">Statut</label>
            <select  name="statunews" id='statunewsadd'  required> 
            <option value='1' >Existe</option>
           <option value='0' >Supprimer</option>
            </select>     
            </div>
            <div class="flex-end">
             <input type="submit" value="Ajouter" class="submit-btn" >
             </div>
            </form> 
            <?php
        } else {
            ?>
            <div class="gestion">
                <h1>PAGE NOT FOUND</h1>
            </div>
            <?php
        }

        $content = ob_get_clean();
        require("layout2.php"); 
    }


    public function showMarqueInfo($idmarque){
        ob_start();
        $r=new commonViews();
        $r->script();
        
        if(isset($_SESSION['admin'])){
            $marque=new marqueController();
            $marquedetail=$marque->getMarqueDetail($idmarque);
            ?>
            <h1 class="heading mt-1">Modifier Marque </h1>
            <form id="form-marque" class="form-style"> 
            <div class="form-item">
            <label for="nommarque">Nom</label>
            <input type="text" id="idmarque" hidden value="<?php echo $idmarque ?>"/>
            <input type="text" name="nommarque" id='nommarque' value="<?php echo $marquedetail[0]['nom']; ?>" required>     
            </div>
            <div class="form-item">
            <label for="estpopulaire">Populaire</label>
            <select  name="pop" id='pop' required> 
            <option value='1' <?php if ($marquedetail[0]['estpopulaire'] == 1) echo 'selected'; ?>>Marque populaire</option>
            <option value='0' <?php if ($marquedetail[0]['estpopulaire'] == 0) echo 'selected'; ?>>Marque non populaire</option>
            </select> 
            </div>
            <div>  
            <select  name="statumarque" id='statumarque'  required> 
            <label for="nommarque">Statut</label>
            <option value='1' <?php if ($marquedetail[0]['statutmarque'] == 1) echo 'selected'; ?>>Existe</option>
            <option value='0' <?php if ($marquedetail[0]['statutmarque'] == 0) echo 'selected'; ?>>Supprimer</option>
            </select>     
            </div>
            <div class="form-item">
            <label for="pays">Pays</label>
            <input type="text" name="pays" id='pays' value="<?php echo $marquedetail[0]['pays']; ?>" required>     
            </div>
            <div class="form-item">
            <label for="sg">Siége Social</label>
            <input type="text" name="sg" id='sg' value="<?php echo $marquedetail[0]['siege_social']; ?>" required>     
            </div>
            <div class="form-item">
            <label for="creation">Année Création</label>
            <input type="date" name="creation" id='creation' value="<?php echo $marquedetail[0]['annee_creation']; ?>" required>     
            </div>
            <div class="flex-end">
             <input type="submit" value="Modifier" class="submit-btn" >
             </div>
            </form> 
            <?php
        } else {
            ?>
            <div class="gestion">
                <h1>PAGE NOT FOUND</h1>
            </div>
            <?php
        }

        $content = ob_get_clean();
        require("layout2.php"); 
    }
    public function showAddMarque(){
        ob_start();
        $r=new commonViews();
        $qtf=new typevController();
        $types=$qtf->getTypev();
        $r->script();
        
        if(isset($_SESSION['admin'])){

            ?>
            <h1 class="heading mt-1">Ajouter Marque </h1>
            <form id="form-marque-add" class="form-style"> 
            <div class="form-item">
            <label for="nommarqueadd">Nom</label>
            <input type="text" name="nommarqueadd" id='nommarqueadd' required>     
            </div>
            <div class="form-item">
            <label for="popadd">Populaire</label>
            <select  name="popadd" id='popadd' required> 
            <option value='1' >Marque populaire</option>
            <option value='0' >Marque non populaire</option>
            </select> 
            </div>
            <div> 
            <label for="statumarqueadd">Statut</label> 
            <select  name="statumarqueadd" id='statumarqueadd'  required> 
            <option value='1' >Existe</option>
            <option value='0' >Supprimer</option>
            </select>     
            </div>
            <div class="form-item">
            <label for="paysadd">Pays</label>
            <input type="text" name="paysadd" id='paysadd'  required>     
            </div>
            <div class="form-item">
            <label for="sgadd">Siége Social</label>
            <input type="text" name="sgadd" id='sgadd'  required>     
            </div>
            <div class="form-item">
            <label for="creationadd">Année Création</label>
            <input type="date" name="creationadd" id='creationadd'  required>     
            </div>
            <div class="form-item">
            <label for="typev">Les types véhicules </label>
            <div class="checkbox">
            <?php
            foreach($types as $type){
                echo '<input type="checkbox" name="typev[]"  value='.$type["idtype"].' >'.$type["nom"].'';  } ?> 
            </div>
            </div>
            <div class="flex-end">
             <input type="submit" value="Ajouter" class="submit-btn" >
             </div>
            </form> 
            <?php
        } else {
            ?>
            <div class="gestion">
                <h1>PAGE NOT FOUND</h1>
            </div>
            <?php
        }

        $content = ob_get_clean();
        require("layout2.php"); 
    }
}
?>
