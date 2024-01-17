 <?php
require_once("./controllers/MenuController.php");
require_once("./controllers/SocialController.php");
require_once("./controllers/MarqueController.php");
require_once("./controllers/ModeleController.php");
require_once("./controllers/TypevController.php");
require_once("./controllers/ContactController.php");

class commonViews{


    public function Social(){
        $r=new socialController();
        $socials=$r->getSocial(); 
        echo  '<ul class="media">';
        foreach ($socials as $social) {
            echo '<li><a href="' . $social['lien'] . '"><img src="./images/' . $social['nomsocial'] . '"/></a></li>';
        }
       echo '</ul>';
    }


    public function Navbar(){
        ?>
        <div class="navbar">
        <div class="logo">
            <img src="./images/logo.svg" alt="Logo">
        </div>
        <?php
         $this->Social();
         if(isset($_SESSION['userName'])){
         echo '<button><a href="index.php?router=UserProfile&id='.$_SESSION["userId"].'"><i class="fa-solid fa-user" style="color: #000000;"></i></a></button>';
         echo '<button class="logout"><a href="index.php?router=UserLogout"><i class="fa-solid fa-right-from-bracket" style="color: #000000;"></i></a></button>';
         } else{
          echo '<button id="connecter-btn">Se Connecter</button>';
        }
        ?>
        <div class="popup-login-bg">
         <div class="popup popup-login">
            <div class="heading-2-box">
            <h2 class="heading-2">Se Connecter à Vehicom</h2>
            <div class="close-btn"><i class="fa-solid fa-xmark" style="color: #000000;"></i></div>
            </div>
            <form method="post" class="form-login">
                <div class="form-item">
                <input type="text" name="usernamel" id='usernamel' placeholder="Entrer le nom d'utilisateur" required>     
                </div>
                <div class="form-item">
                 <input type="password" name="passwordl" id='passwordl' minlength=8 placeholder="Entrer le mot de passe" required>
                </div>
              <input type="submit" value="Se Connecter" class="submit-btn" >
              <div class="flex-center">
              <div class="inscrire">N'avez pas un Compte ? <button>S'inscrire</button>
              </div>
            </div>
            </form>
        </div>
        <div class="popup popup-signup">
            <div class="heading-2-box">
            <h2 class="heading-2">S'inscrire à Vehicom</h2>
            <div class="close-btn"><i class="fa-solid fa-xmark" style="color: #000000;"></i></div>
            </div>
            <form method="post" class="form-signup">
                <div class="form-item">
                <input type="text" name="nom" id='nom' placeholder="Entrer votre nom" required>     
                </div>
                <div class="form-item">
                <input type="text" name="prenom" id='prenom' placeholder="Entrer votre prénom" required>     
                </div>
                <div class="form-item">
                <input type="text" name="username" id='username' placeholder="Entrer le nom d'utilisateur" required>     
                </div>
                <div class="form-item">
                <input type="Date" name="date" id='date' placeholder="Entrer votre Date de naissance" required>     
                </div>
                <div class="form-item">
                <select type="text" name="sexe" id='sexe' placeholder="Choisir sexe" required>
                    <option selected disabled hidden value="">Choisir sexe</option>
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                </select>     
                </div>
                <div class="form-item">
                 <input type="password" name="password" id='password' minlength=8 placeholder="Entrer le mot de passe" required>
                </div>
              <input type="submit" value="S'inscrire" class="submit-btn" >
              <div class="flex-center">
                <div class="connecter">Déja avez un Compte ? <button>Se Connecter</button> 
                 </div>
              </div>
            </form>
        </div>
        </div>
    </div> 
    <?php
    }



    
public function NavbarAdmin(){
    ?>
<div class="navbar">
    <div class="logo">
        <img src="./images/logo.svg" alt="Logo">
    </div>
    <?php
     $this->Social();
     if(isset($_SESSION['admin'])){
     echo '<button class="logout"><a href="index.php?router=AdminLogout"><i class="fa-solid fa-right-from-bracket" style="color: #000000;"></i></a></button>';
     } else{
      echo '<button id="connecterad-btn">Se Connecter</button>';
    }
    ?>
    <div class="popup-loginad-bg">
     <div class="popup popup-loginad">
        <div class="heading-2-box">
        <h2 class="heading-2">Se Connecter à Vehicom</h2>
        <div class="close-btn"><i class="fa-solid fa-xmark" style="color: #000000;"></i></div>
        </div>
        <form method="post" class="form-loginad">
            <div class="form-item">
            <input type="text" name="usernamel" id='usernamea' placeholder="Entrer le nom d'utilisateur" required>     
            </div>
            <div class="form-item">
             <input type="password" name="passwordl" id='passworda' placeholder="Entrer le mot de passe" required>
            </div>
          <input type="submit" value="Se Connecter" class="submit-btn" >
        </div>
        </form>
    </div>
    </div>
    <?php

}

    public function Menu(){
        $r=new menuController();
        $menu=$r->getMenu();
        ?>
        <ul class="navlinks">
            <?php
        foreach ($menu as $row) {
            echo '<li><a href="index.php?router='. $row['valeur'] .'">'. $row['valeur'] .'</a> </li>';
        }
        ?>
        </ul>
        <?php
    }



    public function ComparSection(){
        $r1=new typevController();
        $types=$r1->getTypev();
        ?>
        <div class="popup-bg">
        <div class="popup popup-select">
            <div class="heading-2-box">
            <h2 class="heading-2">Choisir Véhicule</h2>
            <div class="close-btn"><i class="fa-solid fa-xmark" style="color: #000000;"></i></div>
            </div>
            <form method="post" class="form-compar ">
                <div class="form-item">
                <label>Marque</label>
                <select name="marquev" id='marquev'>     
                </select>
                </div>
                <div class="form-item">
                <label>Modèle</label>
                <select name="modelev" id='modelev' disabled >
                </select>
                </div>
                <div class="form-item">
                <label>Année</label>
                <select name="annv" id="annv" disabled>
                </select>
                </div>
                <div class="form-item">
                <label>Version</label>
                <select name="versionv" id="versionv" disabled>
                </select>
                </div>
              <input type="submit" value="Ajouter Véhicule" class="submit-btn" disabled>
            </form>
        </div>
        </div>
      
        <section class="comparaison mt-4">
        <form method="POST" class="comparer">
        <div class="heading-box">
           <h1 class="heading">Véhicule Comparaison</h1>
           <ul class="types">
            <?php
           foreach($types as $type){
                  echo'<li id="'.$type["idtype"].'">'.$type["nom"].'</li>';
                  }
                  ?>
           </ul>
        </div>
        <div class="compar-box">
       
        </div>
        <div class="flex-center">
           <input type="submit" disabled class="submit-btn comparer-btn" value="Comparer">
        </div>
      </form>
    </section>
        <?php
    }


    public function MarquePrincipale(){
        $r=new marqueController();
        $marques=$r->getMarquePrincipale();
         ?>
        <h1 class="heading">Marques Principales</h1>
        <div class="marques">
        <?php
        foreach ($marques as $marque) {
            echo '<div class="marque-box"><a href="index.php?router=Marque&id='. $marque['id_marque'] .'"><img src="'. $marque['url'] .'"/></a></div>';
        }
        ?>
        </div>

<?php
    }
    public function reviewrateuser($ismarque,$entity){
        if(isset($_SESSION["userId"])){?>
        <div class="review-rating">
        <h2 class="heading-2">Noter </h2>
        <div class="rating" >
            <input type="radio" value="1" name="starRate" id="star1" hidden>
            <label for="star1"><i class="fa-solid fa-star"></i></label>
            <input type="radio" value="2" name="starRate" id="star2" hidden>
            <label for="star2"><i class="fa-solid fa-star"></i></label>
            <input type="radio" value="3" name="starRate" id="star3" hidden>
            <label for="star3"><i class="fa-solid fa-star"></i></label>
            <input type="radio" value="4" name="starRate" id="star4" hidden>
            <label for="star4"><i class="fa-solid fa-star"></i></label>
            <input type="radio" value="5" name="starRate" id="star5" hidden>
            <label for="star5"><i class="fa-solid fa-star"></i></label>
        </div>
        <div class="review">
        <h2 class="heading-2">Ajouter un avis</h2>
        <form method="post" class="form-avis">
                <div class="form-item">
                <textarea name="comment" id="comment" placeholder="Ajouter votre avis ici" required></textarea>
                </div>
                <div class="flex-end">
              <input type="submit" value="Ajouter" class="submit-btn" >
              </div>
            </div>
            </form>
        </div>
        </div>
        <?php } 
    }


    public function allavis($ismarque,$entity){
        ?>
        <div class="tousavis-container" isMarque="<?php echo $ismarque; ?>" data-value-review="<?php echo $ismarque && isset($entity["idmarque"]) ? $entity["idmarque"] : $entity; ?>">
        <h2 class="heading-2 mb-1">Autre avis</h2>
        <div class="tousavis"></div>
        </div>
        <?php
    }




    public function avis($ismarque,$entity){
        ?>
    <div class="avis" isMarque="<?php echo $ismarque; ?>" data-value-review="<?php echo $ismarque && isset($entity["idmarque"]) ? $entity["idmarque"] : $entity; ?>">
        <?php
        if(isset($_SESSION["userId"])){
        echo '<h1 class="heading">Avis & Note  </h1>';
        } else {
            echo '<h1 class="heading">Avis  </h1>'; 
        }
        ?>
        <div class="avis-appr-container">
        <h2 class="heading-2 mb-1">Les avis appréciés</h2>
        <div class="avis-appr"></div>
        </div>
        <?php $this->reviewrateuser($ismarque,$entity);  
        ?>
       
        </div>

        <?php
    }



    public function Footer(){
        ?>

        <footer>
            <div class="left">
                <img src="./images/logo" alt="logo" width="300px">
                <p>&copy; 2023 All Rights Reserved. Privacy Policy</p>
            </div>
            <div class="right">
                <?php
                $this->Menu();
                $this->Social();
                ?>
            </div>
        </footer>

        <?php
    }




 public function script(){  
    ?>
    <script src="./jquery-3.6.0.js"></script>
    <script src="./jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(() => { 
    let vehiculesmarque=$(".vehicules-container").attr("data-value");
    let avisvehicules=$(".vehicules-container").attr("avis");
    let marquerating=$("#marque-info");
    getmarqueVehicules(vehiculesmarque,avisvehicules);
    getBestReview();// les avis appréciés
    getallavis();//tous les avis  
    getNote("true",marquerating.attr("data-value"),marquerating);
    getRate();//GET RATE OF AN USER ;
    getDiapo();



    /* --------------------------------Login& Sign up---------------------------------------- */
    const conBtn=$("#connecter-btn");
    const seconnecter=$(".connecter button");
    const inscrire=$(".inscrire button");
    let registermessage=$("<div></div>");
    let loginmessage=$("<div></div>");
    $(".form-signup").prepend(registermessage);
    $(".form-login").prepend(loginmessage);
    $(".form-loginad").prepend(loginmessage);


    //Gestion de POPUP
    conBtn.click(()=>{
        $(".popup-login").show();
        $(".popup-login-bg").show();
    })
    $("#connecterad-btn").click(()=>{
        $(".popup-loginad").show();
        $(".popup-loginad-bg").show();
    })
    seconnecter.click(()=>{
        $(".popup-signup").hide();
        $(".popup-login").show();
    })
    inscrire.click(()=>{
        $(".popup-login").hide();
        $(".popup-signup").show();
    })
    
$(".close-btn").click(() => {
    $(".popup-select").hide();
    $(".popup-login").hide();
    $(".popup-signup").hide();
    $(".popup-login-bg").hide();
    $(".popup-loginad-bg").hide();
    $(".popup-loginad").hide();
    $(".popup-bg").hide();

});

    //REQUEST SIGN UP 
    $(".form-signup").submit((e)=>{
        e.preventDefault();
      const data={
        nom:$("#nom").val(),
        prenom:$("#prenom").val(),
        username:$("#username").val(),
        date:$("#date").val(),
        sexe:$("#sexe").val(),
        password:$("#password").val(),  
      }
        $.ajax({
            url: "index.php?router=UserRegister",
            method: "POST",
            data: data,
            dataType: "json",
            success: (res) => {
                const mes=$('<p>'+res.message+'</p>');
                registermessage.empty();
                registermessage.append(mes);
                if(res.status=="success"){
                  registermessage.css({'color':'green','font-weight':'bold'});
                  registermessage.fadeIn(function(){
                   registermessage.delay(2000).fadeOut(()=>{
                    $(".popup-signup").hide();
                    $(".popup-login-bg").hide();
                   }); 
                 });
                }else {
                    registermessage.css({'color':'red','font-weight':'bold'});
                    registermessage.fadeIn(function(){
                     registermessage.delay(2000).fadeOut(); 
                     $("#nom").val('');
                    $("#prenom").val('');
                    $("#username").val('');
                    $("#date").val('');
                    $("#sexe").val('');
                    $("#password").val(''); 
                    });
                }
                },
            error: function(error) {
                  console.log(error.message);
                }
     
        });
    });


    //REQUEST LOGIN 
    $(".form-login").submit((e)=>{
        e.preventDefault();
        $.ajax({
        url: "index.php?router=UserLogin",
        method: "POST",
        data:{username:$("#usernamel").val(),
        password:$("#passwordl").val(),
         } ,
        dataType: "json",
        success: (res) => {
            const mes=$('<p>'+res.message+'</p>');
            loginmessage.empty();
            loginmessage.append(mes);
            if(res.status=="success"){
            location.reload();
            }else {
               loginmessage.css({'color':'red','font-weight':'bold'});
                loginmessage.fadeIn(function(){
                 loginmessage.delay(2000).fadeOut(); 
                });
            }
            },
        error: function(error) {
              console.log(error.message);
            }  
        });
});



//REQUEST LOGIN ADMIN 
$(".form-loginad").submit((e)=>{
        e.preventDefault();
        $.ajax({
        url: "index.php?router=AdminLogin",
        method: "POST",
        data:{username:$("#usernamea").val(),
        password:$("#passworda").val(),
         } ,
        success: (res) => {
           data=JSON.parse(res);
            const message=$('<p>'+data.message+'</p>');
            loginmessage.empty();
            loginmessage.append(message);
            if(data.status=="success"){
            location.replace("index.php?router=categories");
            }else {
               loginmessage.css({'color':'red','font-weight':'bold'});
                loginmessage.fadeIn(function(){
                 loginmessage.delay(1000).fadeOut(); 
                });
            }
            },
        error: function(error) {
              console.log(error);
            }  
        });
});


/* --------------------------------END Login& Sign up---------------------------------------- */

/* --------------------------------Comparaison---------------------------------------- */
   
    let typeid=1;
    var selectedBox=0;
    let selectedIDs=[];
    let selectedTypes=[];
    const marqueSelect = $("#marquev");
    const modeleSelect = $("#modelev");
    const annvSelect = $("#annv");
    const versionSelect = $("#versionv");

  //Fonction qui permet de comparer entre les élements d'un tableau 
    function equalArrayEle(table) {
    for (let i=0; i <table.length; i++) {
        for (let j=i+1; j< table.length; j++) {
            if(table[i]===table[j]) return true;
        }
    }
    return false;
}
        // Get from local Storage a vehicule 
        let selectedVehicule=JSON.parse(localStorage.getItem('selectedVehicule'));
        if (!selectedVehicule){
        //If not selected then display 4 véhicules 
        for(i=0;i<4;i++){
        let comparV=$('<div class="compar-v" data="'+i+'"></div>');
        let comparContainer=$('<div class="compar-container"> </div>');
        let addVehicule;
        if(i==0){
            addVehicule=$('<div class="add"> + </div>');}
            else{
            addVehicule=$('<div class="add disabled"> + </div>');
            }
        let choisirVehicule=$('<p >  </p>').text("Choisir Véhicule");
        comparContainer.append(addVehicule);
        comparContainer.append(choisirVehicule);
        comparV.append(comparContainer);
        $(".compar-box").append(comparV);}
        }else{

            //Display the selected vehicule and 3 boxes 
            selectedIDs[0]=selectedVehicule.id;
            selectedTypes[0]=selectedVehicule.idtype;
            var boxv1=$('<div class="boxv"></div>');
            var imgv1=$('<div class="img-v"><img src="'+selectedVehicule.url+'"/></div>');
            var cmprv=$('<div class="compar-v" data="'+0+'"></div>');
            var info1=$('<div class="info-v"></div>');
            var marquemodele1=$('<p>'+selectedVehicule.marque+' '+selectedVehicule.modele+'</p>');
            var version1=$('<p>'+selectedVehicule.version+'</p>');
            selectedBox++;

            $(".popup-select").hide();
            $(".popup-bg").hide();
            info1.append(marquemodele1);
            info1.append(version1);
            boxv1.append(imgv1);
            boxv1.append(info1);
            cmprv.append(boxv1);
            $(".compar-box").append(boxv1);

            

        for(i=1;i<4;i++){
        let comparV=$('<div class="compar-v" data="'+i+'" ></div>');
        let comparContainer=$('<div class="compar-container"> </div>');
        let addVehicule;
        if(i==1){
            addVehicule=$('<div class="add" > + </div>');}
            else{
            addVehicule=$('<div class="add disabled" > + </div>');
            }
        let choisirVehicule=$('<p >  </p>').text("Choisir Véhicule");
        comparContainer.append(addVehicule);
        comparContainer.append(choisirVehicule);
        comparV.append(comparContainer);
        $(".compar-box").append(comparV);}
        localStorage.removeItem('selectedVehicule');  
        }
        //Le type choisi par defaut c'est vehicule  
            $(".types li:first-child").addClass("selected");
        //Choisir un type et le mettre dans variable typeid 
            $(".types li").click((e)=>{

                $(".types li").removeClass("selected");
                $(e.target).addClass("selected");
                typeid= $(e.target).attr('id') ;
            })


     //Lister les marques selon le choix de la type de véhicule 
     $(".add").click((e) => {
        selectedBox = $(".add").index(e.target);
        if (!$(e.target).hasClass("disabled")) {
        $(".popup-select").show();
        $(".popup-bg").show();   
            $.ajax({
                url: "index.php?router=Marquesall",
                method: "POST",
                data: {typeid: typeid},
                success: (data) => {
                    try{
                var marques = JSON.parse(data);
                //Cà en cas ou il choisir marque modele ensuite il refaire le choix de marque 
                marqueSelect.empty();
                marqueSelect.append('<option selected disabled>Choisir</option>');
                modeleSelect.empty();
                modeleSelect.append('<option selected disabled>Choisir</option>');
                modeleSelect.attr("disabled","disabled");
                annvSelect.empty();
                annvSelect.append('<option selected disabled>Choisir</option>');
                annvSelect.attr("disabled","disabled");
                versionSelect.empty();
                versionSelect.append('<option selected disabled>Choisir</option>');
                versionSelect.attr("disabled","disabled");
                    $.each(marques, (index, marque) => {
                        marqueSelect.append('<option value="'+marque.id_marque+'">'+marque.nom+'</option>');
                    })
                }
            catch(e){
                console.log(e.message);
            }}
            });
        }
    });


    //Lister les modeles selon le choix de la marque 
marqueSelect.change(() => {
    $.ajax({
        url: "index.php?router=Modeles",
        method: "POST",
        data: {marqueid: marqueSelect.val() },
        success: (data) => {
            try{
            modeleSelect.removeAttr("disabled");
           var modeles = JSON.parse(data);
           modeleSelect.empty();
           modeleSelect.append('<option selected disabled>Choisir</option>');
           annvSelect.empty();
           annvSelect.append('<option selected disabled>Choisir</option>');
           annvSelect.attr("disabled","disabled");
           versionSelect.empty();
           versionSelect.append('<option selected disabled>Choisir</option>');
           versionSelect.attr("disabled","disabled");
            $.each(modeles, (index, modele) => {
                modeleSelect.append('<option value="'+modele.idmodele+'">'+modele.nom+'</option>');
            })
        }
        catch(e){
                console.log(e.message);
            }
        }
    });
});

  //Lister les années des véhicules disponible  selon le choix du modéle
modeleSelect.change(() => {
    $.ajax({
        url: "index.php?router=Years",
        method: "POST",
        data: {modeleid: modeleSelect.val() },
        success: (data) => {
            try{
          annvSelect.removeAttr("disabled");
          //years récupere les années début et fin des versions de modéle choisi 
           var years = JSON.parse(data);
           // ce tableau va contenir tous les années entre début et fin 
           var tous=[];
           for(var i=years[0].year;i<=years[years.length -1].year;i++){
            tous.push(i);
           }
           annvSelect.empty();
           annvSelect.append('<option selected disabled>Choisir</option>');
           versionSelect.empty();
           versionSelect.append('<option selected disabled>Choisir</option>');
           versionSelect.attr("disabled","disabled");
            $.each(tous, (index, year) => {
                //ajouter les options 
                 annvSelect.append('<option >'+year+'</option>');
             });
                }
                catch(e){
                console.log(e.message);
            }    //Aprés qu'on choisir une année on va lister les versions disponibles dans cette année
        }
    });     
});

//Les versions selon l'année choisi
annvSelect.change(() => {
    $.ajax({
        url: "index.php?router=Versions",
        method: "POST",
        data: {modeleid: modeleSelect.val() , year:annvSelect.val() },
        success: (data) => {
            versionSelect.removeAttr("disabled");
           var versions = JSON.parse(data);
           versionSelect.empty();
           versionSelect.append('<option selected disabled>Choisir</option>');
            $.each(versions, (index, version) => {
                versionSelect.append('<option value="'+version.idversion+'">'+version.nom+'</option>');
            })
        }
    });    
});
//Lorsque il choisir marque ,modele,version ,année on enleve disabled from button submit 
versionSelect.change(() => {
        $('.form-compar input[type="submit"]').removeAttr("disabled");
});


$(".form-compar").submit((e)=>{
  e.preventDefault();
  $.ajax({
                url: "index.php?router=Vehicules",
                method: "POST",
                data: {typeid: typeid,
                marqueid: marqueSelect.val(),
                modeleid: modeleSelect.val(),
                versionid: versionSelect.val()
                },
                success: (data) => {
                try{
                var vehicule = JSON.parse(data)[0];
                selectedIDs[selectedBox]=vehicule.idvehicule;//Enregister dans cette tables les ids pour faire la comparaison
                selectedTypes[selectedBox]=vehicule.id_type;//Enregister dans cette tables les types pour faire la comparaison

                //Création et append de box qui va contenir l'img +info de véhicule
                var boxv=$('<div class="boxv"></div>');
                var imgv='<div class="img-v"><img src="'+vehicule.url+'"/></div>';
                var info=$('<div class="info-v"></div>');
                var marquemodele=$('<p>'+vehicule.marquen+' '+vehicule.modelen+'</p>');
                var version=$('<p>'+vehicule.versionn+'</p>');
                $(".popup-select").hide();
                $(".popup-bg").hide();
                $(".compar-container").eq(selectedBox).hide();
                info.append(marquemodele);
                info.append(version);
                boxv.append(imgv);
                boxv.append(info);
                $(".compar-v:eq("+selectedBox+")").append(boxv);
                $(".add").eq(selectedBox+1).removeClass("disabled");//Enlevez disabled from next box 
                //Si 2 choisi et pas égaux donc on peut faire la comparaison
                if (selectedIDs.length>=2 && equalArrayEle(selectedTypes) && !equalArrayEle(selectedIDs)){
                    $('.comparer input[type="submit"]').removeAttr("disabled");
                }
                // selectedBox++;
                }
                catch(error){
                console.log(error.message);
            }
            },
            });
})
$(".comparer").submit((e)=>{
//Toujours en commence par la vérification de ids et types 
 if(equalArrayEle(selectedTypes) && !equalArrayEle(selectedIDs)){ 
  e.preventDefault();
  $.ajax({
                url: "index.php?router=addCompar",
                method: "POST",
                data: {
                vehiculesIds:selectedIDs,
                },
                success: (data) => {
                    try{
                tableContainer=$(".table-compar");
                 resdata=JSON.parse(data);
                const table=$('<table  border="1"> </table>');
                const thead=$('<thead> </thead>');
                const tr=$('<tr> </tr>');
                tr.append('<td>Caract/Véhicule</td>')
                const tbody=$('<tbody> </tbody>');
                $.each(resdata, (index, row) => {
                let th=$("<th></th>");
                let ahref=$('<a href="index.php?router=Vehicule&id='+row[0].idvehicule+'"> </a>');
                let img=$('<img src='+row[0].url+'>');
                ahref.append(img);
                th.append(ahref);
                tr.append(th);
                thead.append(tr);
               });
                $.each(resdata[0],(i,caract)=>{
                    let tr = $("<tr></tr>");
                    let nomcarac=caract.nom;
                    let td=$("<th></th>").text(nomcarac);
                    tr.append(td);
                    $.each(resdata, (index, row) => {
                    let valeur = row[i].valeur;
                    td = $("<td></td>").text(valeur);
                    tr.append(td);
                 });
                 tbody.append(tr);

                });
                table.append(thead);
                table.append(tbody);
                tableContainer.append(table);
            }catch(err){
                console.log(err.message);
            }
        }
        });}

else{
   e.preventDefault(); 
   alert("Choisir différents véhicles pour comparison");
}})




/* --------Ajouter un avis sur une entité (Marque ou véhicule )--------*/
$(".form-avis").submit((e)=>{
    e.preventDefault();
    $.ajax({
    url: "index.php?router=SetAvis",//url pour appellation de controlleur pour ajouter un avis 
    method: "POST",
    data:{
        comment:$("#comment").val(),//le commentaire 
        isMarque:$(".avis").attr("isMarque"),
        idEntity:$(".avis").attr("data-value-review"),
     } ,
    dataType: "json",
    success: (res) => {
        $("#comment").val('');
        },
    error: function(error) {
          console.log(error.message);
        }  
   });
});

        // Afficher heart rempli ou vide selon la click de user 
        //passer id de l'avis et liked boolean pour savoir si c'est like ou unlike 
        function updateiconlike(idavis,liked){
        //Sélectionner l'icon de avis précis (selon idavis )
        const icon=$('.likebtn[data-value='+idavis+'] i');
        if(liked == '1' && idavis !="null"){
            icon.removeClass("fa-regular");//regular sa veut dire empty 
            icon.addClass("fa-solid");//solid heart rempli 
        }
        else if(liked == '0' && idavis !="null"){
            icon.removeClass("fa-solid");
            icon.addClass("fa-regular");
        }
        }


function getBestReview(){

    let globalcontainer=$(".avis-appr");
    $.ajax({
        url: "index.php?router=BestReview",
        method: "POST",
        data: {
            isMarque:$(".avis").attr("isMarque"),
            idEntity:$(".avis").attr("data-value-review"),
        },
        success: (res) => {
            if(res.trim() !== ""){
            $result=JSON.parse(res);
            if($result.status == "success"){
                var avisall=$result.data;
                createcontaineravis(avisall,globalcontainer);
                }
               }} , 
            error:(error)=>{
                console.log(error.message);
            } ,   
        }); 
}

    function createcontaineravis($avislist,$globalcontainer){
        var id=<?php if(isset($_SESSION['userId'])){echo $_SESSION['userId'];} else{echo "0";} ?>;
        if($avislist.length==0){
                    let nocomment=$('<div></div>').text("Y'a pas des avis pour le moment");
                    $globalcontainer.empty();
                    $globalcontainer.append(nocomment);
        }else{
            let containeravis = $('<div class="container-avis"></div>');
            $.each($avislist,(index, avis) => {
            let boxavis=$('<div class="box-avis"></div>');
            let infoavis=$('<div class="info-avis"></div>');
            let dateavis=$('<p></p>').text(avis.date);
            let useravis=$('<p></p>').text(avis.nom +' '+ avis.prenom);
            let commentavis=$('<div class="comment"></div>').text(avis.commentaire);
            let center=$('<div class="flex-end"></div>')
            //selon si user actuelle (ce qui est connecté ) si userlike donc heart déja rempli sinon heart vide 
            if(avis.userlike =='1' && id !== 0 ){
                likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-solid fa-heart" ></i></div>');
            }
            else
            if(avis.userlike =='0' && id !== 0){
            likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-regular fa-heart" ></i></div>');
            }
            else {
                likebtn=$('<div class="likebtn" data-value="' + null + '" ><i class="fa-regular fa-heart" ></i></div>');
            }
            
            //si on click sur le button on va updater database par les changements de like unlike 
            likebtn.click(()=>{
            handlelike(avis.idavis);});
            //append les élements de l'avis pour les affichers (dynamiquement )
            infoavis.append(dateavis);
            infoavis.append(useravis);
            boxavis.append(infoavis);
            boxavis.append(commentavis);
            center.append(likebtn);
            boxavis.append(center);
            containeravis.append(boxavis);//container contient tous les avis 
            });
            $globalcontainer.empty();
            $globalcontainer.append(containeravis);
        }      
    }


    function handlelike(idavis) {
    if (idavis !== null) {
        $.ajax({
            url: "index.php?router=Like",
            method: "POST",
            data: {
            idavis: idavis,
            },
            success: (res) => {
                if(res.trim() !== ""){
                $result = JSON.parse(res);
                if ($result.status == "like") {
                    updateiconlike(idavis, true);
                } else if ($result.status == "unlike") {
                updateiconlike(idavis, false);
                }
            }},
            error: (error) => {
            console.log(error.message);
            },
        });
    } else {
        $(".popup-login").show();
        $(".popup-login-bg").show();
    }
}
function getallavis(){
var globalcontainer=$(".tousavis")
// Avoir toute les avis d'une entité (marque ou véhicule )
$.ajax({
    url: "index.php?router=AllAvis",
    method: "POST",
    data: {
        isMarque:$(".tousavis-container").attr("isMarque"),//pour savoir si c'est marque ou véhicule 
        idEntity:$(".tousavis-container").attr("data-value-review"),
    },
    success: (res) => {
        if(res.trim() !== ""){
        $result=JSON.parse(res);
        if($result.status == "success"){// Si success on va créer le container pour afficher tout les avis 
            var avisall=$result.data;
            function renderavis(debut){
                const fin =debut +5;
                const avistoshow=avisall.slice(debut,fin)
                createcontaineravis(avistoshow,globalcontainer) 
                } 
                let prev=$('<button  class="voirplus-btn avis-btn ml-5">Previous</button>');
                let next=$('<button  class="voirplus-btn  avis-btn">Next</button>');
                $(".tousavis-container").append(prev);
                $(".tousavis-container").append(next);
                renderavis(0);
                let debut= 5 ; 
                next.click(()=>{
                    renderavis(debut);
                    debut +=5;
                    if(debut>=avisall.length){debut=0}
                    })
                prev.click(()=>{
                renderavis(debut);
                debut -=5;
                if(debut<0){debut=0}
                })
                }}}, 
        error:(error)=>{
            console.log(error.message);//si error en affiche l'erreur 
        } ,   
    }); 
}    
      
//Input pour rating (radio )
var ratinginput=$(".rating input");     
//Selon la note on colorer les icons 
function updateRating($rate){
        $(".rating  label ").css("color","black");
        for($i=0;$i<$rate;$i++){
        $(".rating  label").eq($i).css("color","red");
        }
 } 
//Lors de chargement de document on get current rate d'un user 
function getRate(){
    $.ajax({
                url: "index.php?router=getUserRate",
                method: "POST",
                data: {
                    isMarque:$(".avis").attr("isMarque"),
                    idEntity:$(".avis").attr("data-value-review"),
                },
                success: (res) => {
                if(res.trim() !== ""){
                resdata=JSON.parse(res);
                updateRating(resdata.notevalue);
                }  }     
            });  
}
//Click pour changer ou mettre rate 
        ratinginput.click(()=>{
            $.ajax({
                url: "index.php?router=Rate",
                method: "POST",
                data: {
                    note:$(".rating input:checked").val(),
                    isMarque:$(".avis").attr("isMarque"),
                    idEntity:$(".avis").attr("data-value-review"),
                },
                success: (res) => {
                if(res.trim() !== ""){
                updateRating(res);
                }  }     
            });
        });

// Affichage des véhicules avec next et previous (Caresoul)---------
    const vehiculeList=$(".vehicule-list");
    const boxv=$(".boxv")
    const next=$(".next");
    const previous=$(".previous");
    let position = 0;
    previous.click(() => {
    //boxv.ouderWidth ca veut dire déplacement selon le width de box véhicule 
     position -= boxv.outerWidth();
     vehiculeList.animate({ scrollLeft: position }, 'slow');
    });

    next.click(() => {
      position += boxv.outerWidth();
      vehiculeList.animate({ scrollLeft: position }, 'slow');
    });
// ---------------------------------------------------------------

//Function pour avoir et display la note d'une entite 
function getNote(ismarque,identity,containernote){
    $.ajax({
            url: "index.php?router=getRate",
            method: "POST",
            data: {
                isMarque:ismarque,
                idEntity:identity,
            },
            success: (res) => {
            if(res.trim() !== ""){
              let inforate;
             const result=JSON.parse(res);
             if(result.avg !== undefined){
                inforate=$('<p> <span> &#9733; '+result.avg+' /5 | '+result.raters+' note </span> </p>');}
                else{inforate=$('<p> <span> &#9733; O/5 | 0 notes </span> </p>');}
                containernote.empty();
                containernote.append(inforate);
            } },     
        }); 
}
// ---------------------------------------------------------------

/* ----------------------Avoir tous les véhicules d'une marque --------*/
function getmarqueVehicules($idmarque,$avis){
    $.ajax({
    url: "index.php?router=allVehicules",//url pour appellation de controlleur pour avoir les véhicules d'une marque 
    method: "POST",
    data:{
        idmarque:$idmarque,
     } ,
    success: (res) => {
        if(res.trim() !== ""){
       const vehicules=JSON.parse(res);
       let containervehicule = $('<div class="container-vehicule"></div>');
        $.each(vehicules,(index, vehicule) => {
/*----------------------------Création de box de véhicule  ------------------------------*/
       let vehiculebox=$('<div class="vehicule-box"> </div>');
       let imagecontainer=$('<div class="image-container"> <div>');
       let atag;
       if($avis=="true"){
        atag=$('<a  href="index.php?router=Vehiculeavis&id='+vehicule.idvehicule+'"></a>');}
       else{
        atag=$('<a  href="index.php?router=Vehicule&id='+vehicule.idvehicule+'"></a>');
       }
       let img=$('<img src="'+vehicule.url+'" alt=""/>');
       let infocontainer=$('<div class="info-container"></div>');
       let marque=$('<p> </p>').html(vehicule.marquen+' '+vehicule.modelen);
       let version=$('<p> </p>').html(vehicule.versionn);
       let rate=$('<div> </div>');
       let fav=$('<div class="favoris-icon" data-value="'+vehicule.idvehicule+'"> </div>');
       let favicon=null;
       let id =vehicule.idvehicule;
        <?php if(isset($_SESSION["userName"])){ ?>
            if(vehicule.userfavoris =='1' && id !== 0 ){
            favicon = $('<i class="fa-solid fa-bookmark " data-value="'+vehicule.idvehicule+'"></i>');
        }
        else
        if(vehicule.userfavoris =='0' && id !== 0){
            favicon = $('<i class="fa-regular fa-bookmark" data-value="'+vehicule.idvehicule+'"></i>');
        }      
        <?php } ?>
       favicon.click(()=>handleFavoris(vehicule.idvehicule));
       getNote("false",id,rate);
       atag.append(img);
       imagecontainer.append(atag);
       infocontainer.append(marque);
       infocontainer.append(version);
       vehiculebox.append(imagecontainer);
       vehiculebox.append(infocontainer);
       vehiculebox.append(rate);
       fav.append(favicon);
       vehiculebox.append(fav);
       containervehicule.append(vehiculebox);
/*-------------------------------------- ------------------------------*/
        });
       $(".vehicules-container").append(containervehicule);
        }},
    error: function(error) {
          console.log(error.message);
        }  
   });
}
/*------------------- Gestion de favoris (Handle click sur icon favoris )-----------*/
function updateiconfavoris(idfavoris,added){
    console.log(added);
    console.log(idfavoris);
    //Sélectionner l'icon de  précis (selon idfavoris)
    const icon=$('.favoris-icon[data-value='+idfavoris+'] i');
    if(added == '1' && idfavoris !="null"){
        icon.removeClass("fa-regular");//regular sa veut dire empty 
        icon.addClass("fa-solid");//solid  rempli 
    }
    else if(added == '0' && idfavoris !="null"){
        icon.removeClass("fa-solid");
        icon.addClass("fa-regular");
    }
}
   
    $(".vehicule-list .boxv").mouseover((e)=>{
    $(".favoris-icon").show();});
    $(".vehicule-list .boxv").mouseout((e)=>{
    $(".favoris-icon").hide();});
    //Function pour handler favoris 
    function handleFavoris(idvehicule){
    $.ajax({
    url: "index.php?router=Favoris",
    method: "POST",
    data: {
        vehiculeid:idvehicule,
    },
    success: (res) => {
        result=JSON.parse(res);
        //Get statut , pour displayer the correct icon (rempli ou vide )
        if(result.status=="added"){
            updateiconfavoris(idvehicule,true);
         }
         else{ updateiconfavoris(idvehicule,false);}
    } ,      
    });
}

/* --------Diapo  ---------------------------------------------------------------*/
function getDiapo(){
    $.ajax({
    url: "index.php?router=getDiapo",
    method: "GET",
    data: {},
    success: (res) => {
        if(res.trim() !== ""){
        $result=JSON.parse(res);
        if($result !== undefined){
            var alldiapo=$result;
            //Diapo chaque 5s 
            function renderdiapo(debut){
                const fin =debut + 1;
                const diapotoshow=alldiapo.slice(debut,fin);
                const diapoContainer = $(".diapo-container");
                let cover=$('<div class="diapo-img"></div>').css("background-image", `url(${diapotoshow[0].url})`);
                let title=$('<h1 class="diapo-title"></h1>').text(diapotoshow[0].title);
                let img=$(`<img src='${diapotoshow[0].url}' >`);
                let link;
                if (diapotoshow[0].id_news !== null){
                    link=$(`<a href="index.php?router=NewsDetail&id=${diapotoshow[0].id_news}"> </a>`);
                }else{
                    link=$(`<a href="${diapotoshow[0].href}"> </a>`);
                }
                diapoContainer.empty();
                cover.append(title);
                link.append(cover);
                diapoContainer.append(link);
                } //Commence par le premier 
                renderdiapo(0);
                let debut= 1 ; 
                //chaque 5s on ajoute 1 , si ==length en remet à 0 
                setInterval(()=>{
                    renderdiapo(debut);
                    debut +=1;
                    if(debut>=alldiapo.length){debut=0}
                    },5000)
                }}}, 
        error:(error)=>{
            console.log(error.message);//si error en affiche l'erreur 
        } ,   
    }); 
}

/*----------------------------------------------------------------------*/
//Updater les données d'un news 
$("#form-news").submit((e)=>{
  e.preventDefault();
  $.ajax({
                url: "index.php?router=updateDatanews",
                method: "POST",
                data: {
                idnews: $("#idnews").val(),
                tnews:$("#titrenews").val(),
                textenews: $("#textenews").val(),
                affichernews:$("#affichernews").val(),
                statunews:$("#statunews").val(),
                },
                success: (data) => {
                    location.replace("index.php?router=categories");
                },
            });
})
//Ajouter News
$("#form-news-add").submit((e)=>{
  e.preventDefault();
  $.ajax({
                url: "index.php?router=addDataNews",
                method: "POST",
                data: {
                tnews:$("#titrenewsadd").val(),
                textenews: $("#textenewsadd").val(),
                affichernews:$("#affichernewsadd").val(),
                statunews:$("#statunewsadd").val(),
                img:$("#imgnews").val(),
                },
                success: (data) => {
                    location.replace("index.php?router=categories");
                },
            });
})
/*----------------------------------------------------------------------*/
/*--------------------------MARQUE------------------------------------------*/
//Update Marque
$("#form-marque").submit((e)=>{
  e.preventDefault();
  const data={
        idmarque:$("#idmarque").val(),
        nommarque:$("#nommarque").val(),
        statu:$("#statumarque").val(),
        pop:$("#pop").val(),
        pays:$("#pays").val(),
        sg:$("#sg").val(),
        creation:$("#creation").val(),  
      }
  $.ajax({
                url: "index.php?router=updateDatamarque",
                method: "POST",
                data: data,
                success: (res) => {
                     location.replace("index.php?router=categories");
                },
            });
})
//Ajouter Marque 
$("#form-marque-add").submit((e)=>{
  e.preventDefault();
  let types=[];
  $("input[name='typev[]']:checked").each(function() { 
    types.push($(this).val());
   });
  const data={
        idmarque:$("#idmarqueadd").val(),
        nommarque:$("#nommarqueadd").val(),
        statu:$("#statumarqueadd").val(),
        pop:$("#popadd").val(),
        pays:$("#paysadd").val(),
        sg:$("#sgadd").val(),
        creation:$("#creationadd").val(), 
        types:types, 
        img:$("#imgmarque").val(),
      }
  $.ajax({
                url: "index.php?router=addDataMarque",
                method: "POST",
                data: data,
                success: (res) => {
                 location.replace("index.php?router=categories");
                },
            });
})
/*----------------------------------------------------------------------*/
/*------------------------Véhicule ---------------------------------*/
var modeleadd=false;//boolean pour savoir si click sur ajouter nouveau ou pas 
var versionadd=false;
$(".modeleadd").click((e)=>{
    modeleadd=true});
$(".versionadd").click((e)=>{
    versionadd=true});
//Ajouter véhicule 
$("#form-vehicule-add").submit((e)=>{
    let caract = [];
$("input[name='caracvehicule[]']").each(function () {
    caract.push({
        idcarac: $(this).data("value"),
        valeur: $(this).val()
    });
});
  e.preventDefault();
  //Les données récupérer from form 
  const data={
        idmarque:$("#marquevadd").val(),
        nommodele:$("#modelevadd").val(),
        nomversion:$("#versionvadd").val(),
        datedebut:$("#datedebut").val(),
        datefin:$("#datefin").val(),
        pop:$("#popvadd").val(),
        types:$("input[name='typevehicule']").val(), 
        versionadd:versionadd,
        modeleadd:modeleadd,
        caract:caract,
        // img:$("#imgv"),
      }
  $.ajax({
                url: "index.php?router=addDataVehicule",
                method: "POST",
                data: data,
                success: (res) => {
                     location.replace("index.php?router=categories");
                },
            });
})
/*----------------------------------------------------------------------*/
/*------------------------Set Item Local Storage----------------------------------*/
});
function setItem(id,marque,modele,version,url,idtype){
    const selectedVehicule={
        id,
        marque,
        modele,
        version,
        url,
        idtype,
    }
    localStorage.setItem('selectedVehicule',JSON.stringify(selectedVehicule));
}


//Creation de la table de vehicule selon la marque 
function createtablevehicule(id){
    $.ajax({
    url: `index.php?router=getdatavehicule`,
    method: "GET",
    data: {id:id},
    success: (res) => {
        let addBtn;
        tableContainer=$(".gestion-table");
                resdata=JSON.parse(res);
                const table=$('<table  border="1"> </table>');
                const thead=$('<thead> </thead>');
                const tr=$('<tr> </tr>');
                const tbody=$('<tbody> </tbody>');
                $.each(resdata[0],(i,caract)=>{
                    let nomcol=caract.col;
                    let td=$("<th></th>").text(nomcol);
                    tr.append(td);
                });
                let th = $("<th></th>").text("Option");
                tr.append(th);
                thead.append(tr);
                $.each(resdata, (index, row) => {
                    let tr=$('<tr> </tr>');
                    $.each(row,(i,col)=>{
                    let valeur = col.valeur;
                    let td;
                       if(valeur !==null){
                        td = $("<td></td>").text(valeur);
                    }
                    else if (category=="vehicule"){
                        td = $("<td></td>").text("Non Dispo");
                    }
                    else {
                        td = $("<td></td>").text("/");
                    }
                    tr.append(td);});
                    let td = $('<td class="option"></td>');
                    let deleteBtn = $('<a href="index.php?router=deletevehicule&id=' + row[0].valeur + '">Delete</a>');
                    let caracBtn = $('<a href="index.php?router=Vehicule&id=' + row[0].valeur + '">Voir caractéristiques</a>');
                    addBtn=$('<a href="index.php?router=addvehicule&id=' + row[1].valeur + '">Ajouter  Véhicule</a>'); 
                    td.append(deleteBtn);
                    td.append(caracBtn);
                    tr.append(td);
                    tbody.append(tr);
                 });
               table.append(thead);
                 table.append(tbody);
                 tableContainer.empty();
                 tableContainer.append(table);
                let tabledata = new DataTable(table);
                let end=$('<div class="flex-end add-btn"></div>');
                tableContainer.append(tabledata);
                end.append(addBtn);
                tableContainer.append(end);
      }, 
        error:(error)=>{
            console.log(error.message);//si error en affiche l'erreur 
        } ,   
    }); 
}



//Creation de tous les tables selon category 
function createtable(category,id){
    $.ajax({
    url: `index.php?router=getdata${category}`,
    method: "GET",
    data: {id:id},
    success: (res) => {
        tableContainer=$(".gestion-table");
                resdata=JSON.parse(res);
                const table=$('<table  border="1"> </table>');
                const thead=$('<thead> </thead>');
                const tr=$('<tr> </tr>');
                const tbody=$('<tbody> </tbody>');
                $.each(resdata[0],(i,caract)=>{
                    let nomcol=caract.col;
                    let td=$("<th></th>").text(nomcol);
                    tr.append(td);
                });
                let th = $("<th></th>").text("Option");
                tr.append(th);
                thead.append(tr);
                $.each(resdata, (index, row) => {
                    let tr=$('<tr> </tr>');
                    $.each(row,(i,col)=>{
                    let valeur = col.valeur;
                    let td;
                    if(category=="news" && i==2){
                    let value = col.valeur.substring(0, 200);
                    let showmore=$('<button class="voirplus-btn"> show more </button>');
                    td=$('<td> </td>').text(value);
                    td.append(showmore);

                    showmore.click(()=>{
                        td.empty();
                        td.text(valeur);
                        let showless=$('<button class="voirplus-btn"> show less </button>');
                           showless.click(()=>{
                            td.empty();
                            td.text(value);
                            td.append(showmore);
                           })
                          td.append(showless);
                    })}
                     else 
                    if(valeur !==null){
                        td = $("<td></td>").text(valeur);
                    }
                    else if (category=="vehicule"){
                        td = $("<td></td>").text("Non Dispo");
                    }
                    else {
                        td = $("<td></td>").text("/");
                    }
                    tr.append(td);});
                    let addBtn=$('<a href="index.php?router=add${category}"> </a>');
                    let td = $('<td class="option"></td>');
                    let deleteBtn = $('<a href="index.php?router=delete' + category + '&id=' + row[0].valeur + '">Delete</a>');
                    let afficherBtn = $('<a href="index.php?router=afficher' + category + '&id=' + row[0].valeur + '">Afficher</a>');
                    let bloquerBtn ;
                    let rejeterBtn = $('<a href="index.php?router=rejeteravis&id=' + row[0].valeur + '">Rejeter</a>');
                    let validerBtn = $('<a href="index.php?router=valider' + category + '&id=' + row[0].valeur + '">Valider</a>');
                    let profileBtn = $('<a href="index.php?router=UserProfile&id=' + row[0].valeur + '">Profile</a>');
                    let updateBtn=$('<a href="index.php?router=update' + category + '&id=' + row[0].valeur + '">Update</a>');
                    let vehiculeBtn=$('<button class="voirplus-btn">Voir Véhicules</button>');
                    vehiculeBtn.click(()=>{
                        createtablevehicule(row[0].valeur);
                    })
                    td.append(deleteBtn);
                    if(category=="news"){
                    td.append(afficherBtn)
                    td.append(updateBtn)}
                    if(category=="marque"){
                    td.append(updateBtn)
                    td.append(vehiculeBtn)}
                    if(category=="users"){
                    bloquerBtn=$('<a href="index.php?router=bloqueruser&id=' + row[0].valeur + '">Bloquer</a>');
                    td.append(bloquerBtn)
                    td.append(validerBtn)
                    td.append(profileBtn)}
                    if(category=="avis"){
                    bloquerBtn=$('<a href="index.php?router=bloqueruser&id=' + row[1].valeur + '">Bloquer user</a>');
                    td.append(validerBtn);
                    td.append(rejeterBtn);
                    td.append(bloquerBtn);
                    }
                    tr.append(td);
                    tbody.append(tr);
                 });
               table.append(thead);
                 table.append(tbody);
                 tableContainer.empty();
                 tableContainer.append(table);
                let tabledata = new DataTable(table);
                let end=$('<div class="flex-end add-btn"> </div>');
                let addBtn ;
                if (category == "news" || category == "marque") {
                   addBtn = $('<a href="index.php?router=add' + category + '">Ajouter ' + category + '</a>');
                }
                tableContainer.append(tabledata);
                end.append(addBtn);
                tableContainer.append(end);
      }, 
        error:(error)=>{
            console.log(error.message);//si error en affiche l'erreur 
        } ,   
    }); 
}

    </script>
    <?php
}

}


?>