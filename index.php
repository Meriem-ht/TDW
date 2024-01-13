<?php
session_start();
require_once("controllers/MarqueController.php");
require_once("controllers/UserController.php");
require_once("controllers/MarqueController.php");
require_once("controllers/ModeleController.php");
require_once("controllers/YearController.php");
require_once("controllers/VersionController.php");
require_once("controllers/VehiculeController.php");
require_once("controllers/AvisController.php");
include_once("./controllers/NewsController.php");
include_once("./controllers/AcceuilController.php");
include_once("./controllers/ComparateurController.php");
include_once("./controllers/CategoriesController.php");
require_once("views/CommonViews.php");
$result=null;
if (isset($_GET['router'])){
    $action = $_GET['router'];
    switch ($action){
        case 'Page d\'acceuil' :
            $r=new acceuilController();
            $r->showAcceuil();
            break;
        case 'getDiapo':
            $r=new acceuilController();
            $r->getDiapo();
            break;
        case 'UserRegister' :
            $r=new userController();
            $r->register($_POST);
            break;
        
        case 'UserLogin' :
            if(isset($_POST["username"]) && isset($_POST["password"])){
            $r=new userController();
            $r->login($_POST['username'],$_POST['password']);}
            break;
        case 'UserLogout' :
            $r=new userController();
            $r->logout();
            header('Location: index.php');
            exit();
            break;
        case 'Favoris':
            if(isset($_POST["isFavorite"]) && isset($_POST["vehiculeid"])){
            $r=new userController();
            $r->setFavoris($_POST["isFavorite"],$_POST["vehiculeid"]);}
            break;
        case 'Rate':
            if(isset($_POST["isMarque"]) && isset($_POST["idEntity"]) && isset($_POST["note"])  ){
            $r=new userController();
            $r->setRate($_POST["note"],$_POST["isMarque"],$_POST["idEntity"]);}
            break;
        case 'getRate':
            if(isset($_POST["isMarque"]) && isset($_POST["idEntity"])){
            $r=new userController();
            $r->getTotalRate($_POST["isMarque"],$_POST["idEntity"]);}
            break;
        case 'getUserRate':
            if(isset($_POST["isMarque"]) && isset($_POST["idEntity"])){
            $r=new userController();
            $r->getRate($_POST["isMarque"],$_POST["idEntity"]);}
            break;
        case 'BestReview':
            if(isset($_POST["isMarque"]) && isset($_POST["idEntity"])){
            $r=new avisController();
            $r->getBestReview($_POST["isMarque"],$_POST["idEntity"]);
           }
            break;
        case 'Like':
            if(isset($_POST["idavis"])){
            $r=new avisController();
            $r->likeavis($_POST["idavis"]);}
            break;
        case 'SetAvis':
            if(isset($_POST["comment"]) && isset($_POST["idEntity"]) &&isset($_POST["isMarque"]) ){
            $r=new avisController();
            $r->setAvis($_POST["comment"],$_POST["isMarque"],$_POST["idEntity"]);}
            break;
        case 'AllAvis':
            if(isset($_POST["isMarque"]) && isset($_POST["idEntity"])){
            $r=new avisController();
            $r->getAllAvis($_POST['isMarque'],$_POST['idEntity']);}
            break;
        case 'Marques' :
        $r=new marqueController();
        $r->showMarque();
        break;
        case 'Marque' :
            $r=new marqueController();
            $r->showMarqueDetail($_GET['id']);
            break;
        case 'Vehicule' :
            $r=new vehiculeController();
            $r->showVehiculeDetail($_GET['id']);
            break;
        case 'NewsDetail' :
            $r=new newsController();
            $r->showNewsDetail($_GET['id']);
            break;
        case 'News' :
            $r=new newsController();
            $r->showNews();
            break;
        case 'Avis' :
            $r=new avisController();
            $r->showallmarques();
            break;
        case 'marqueVehiculeavis':
            if(isset($_GET['id'])){
                $r=new avisController();
                $r->showmarquevehiculesavis($_GET['id']);}
                break;
        case 'Vehiculeavis':
            $r=new avisController();
            $r->showvehiculsavis($_GET['id']);
            break;
        case 'Marquesall' :
            $r=new marqueController();
            $r->getMarquesByType($_POST["typeid"]);
            break;
        case 'marqueVehicules' :
            if(isset($_GET['id'])){
            $r=new vehiculeController();
            $r->showmarquevehicules($_GET['id']);}
            break;
        case 'allVehicules' :
            if(isset($_POST['idmarque'])){
            $r=new marqueController();
            $r->getVehicules($_POST['idmarque']);}
            break;
        case 'Modeles' :
            if(isset($_POST["marqueid"])){
            $r=new modeleController();
            $r->getModele($_POST["marqueid"]);}
            break;
        case 'Years' :
            if(isset($_POST["modeleid"])){
            $r=new yearsController();
            $r->getYears($_POST["modeleid"]);}
            break;
        case 'Versions' :
            if(isset($_POST["modeleid"]) && isset($_POST["year"])){
            $r=new versionsController();
            $r->getVersions($_POST["modeleid"],$_POST["year"]);}
            break;
        case 'Vehicules' :
            if(isset($_POST["typeid"]) && isset($_POST["marqueid"]) && isset($_POST["modeleid"]) && isset($_POST["versionid"])){
            $r=new vehiculeController();
            $r->getVehicule($_POST["typeid"],$_POST["marqueid"],$_POST["modeleid"],$_POST["versionid"]);}
            break;
        case 'Comparateur':
            $r=new comparateurController();
            $r->showComparateur();
            break;
        case 'addCompar':
            $r=new comparateurController();
            $r->handleCompar($_POST['vehiculesIds']);  
            break;
        case 'AcceuilAdmin':
            $r=new acceuilController();
            $r->showAcceuilAdmin();
            break;
        case 'AdminLogin' :
            if(isset($_POST["username"]) && isset($_POST["password"])){
            $r=new userController();
            $r->loginAdmin($_POST['username'],$_POST['password']);}
            break;
        case 'AdminLogout' :
            $r=new userController();
            $r->logoutAdmin();
            header('Location: index.php?router=AcceuilAdmin');
            exit();
            break;
        case 'categories':
           $r=new categoriesController();
           $r->showCategories();
           break;
        case 'getdatamarque':
                $r=new categoriesController();
                $r->getDataMarque();
                break;
        case 'getdatanews':
            $r=new categoriesController();
            $r->getDataNews();
            break;
        case 'getdataavis':
            $r=new categoriesController();
            $r->getDataAvis();
            break;
        case 'getdataparam':
            $r=new categoriesController();
            $r->getDataParam();
            break;
        case 'getdatausers':
            $r=new categoriesController();
            $r->getDataUsers();
            break;
        case 'deletenews':
            $r=new categoriesController();
            $r->deleteNews($_GET["id"]);
            break;
        case 'affichernews':
            $r=new categoriesController();
            $r->updateNews($_GET["id"]);
            break;
        // case 'updatenews':
        //     $r=new categoriesController();
        //     $r->updateNews($_GET["id"]);
        //     break;
        case 'updateDatanews':
            $r=new categoriesController();
            $r->updateDataNews($_POST["idnews"],$_POST["tnews"],$_POST["textenews"],$_POST["affichernews"],$_POST["statunews"]);
            break;
        case 'addDataNews':
            $r=new categoriesController();
            $r->addDataNews($_POST["tnews"],$_POST["textenews"],$_POST["affichernews"],$_POST["statunews"]);
            break;
        case 'addnews':
            $r=new categoriesController();
            $r->addNews();
            break;
        case 'deleteusers':
            $r=new categoriesController();
            $r->deleteUser($_GET["id"]);
            break;
        case 'deleteavis':
            $r=new categoriesController();
            $r->deleteAvis($_GET["id"]);
            break;
        case 'validerusers':
            $r=new categoriesController();
            $r->validerUser($_GET["id"]);
            break;
        case 'bloqueruser':
            $r=new categoriesController();
            $r->bloquerUser($_GET["id"]);
            break;
        case 'valideravis':
            $r=new categoriesController();
            $r->validerAvis($_GET["id"]);
            break;
        case 'rejeteravis':
            $r=new categoriesController();
            $r->rejeterAvis($_GET["id"]);
            break;
        case 'deleteavis':
            $r=new categoriesController();
            $r->deleteAvis($_GET["id"]);
            break;
        case 'deletemarque':
            $r=new categoriesController();
            $r->deleteMarque($_GET["id"]);
            break;
        case 'updatemarque':
            $r=new categoriesController();
            $r->updateMarque($_GET["id"]);
            break;
        case 'updateDatamarque':
            $r=new categoriesController();
            $r->updateDataMarque($_POST);
            break;
           case 'addDataMarque':
            $r=new categoriesController();
            $r->addDataMarque($_POST);
            break;
        case 'addmarque':
            $r=new categoriesController();
            $r->addMarque();
            break;
        case 'getdatavehicule':
            $r=new categoriesController();
            $r->getDataVehicule($_GET["id"]);
            break;
        case 'deletevehicule':
            $r=new categoriesController();
            $r->deleteVehicule($_GET["id"]);
            break;
            
        
    default:
        echo 'not found';
        break;
    }


}
else{    
    $r=new acceuilController();
$r->showAcceuil();
}

?>
