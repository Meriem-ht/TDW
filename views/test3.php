<!-- <?php
require_once("./controllers/MarqueController.php");
//class marqueView{
    public function Marques(){
        $r=new marqueController();
        $marques=$r->getMarques();
        ob_start();
        ?>
        <h1 class="heading">Tous Les Marques</h1>
         <div class="marques">
        <?php
        foreach ($marques as $marque) {
        
            echo '<div class="marque-item">
                <div class="marque-logo">
                    <a href="index.php?router=Marque&id='. $marque['id_marque'] .'">
                    <img src="'. $marque['url'] .'"/></a>
                </div>
                <p>'. $marque['nom'] .'</p>
            </div>';
        }
        ?>
        </div>

        <?php
        $content = ob_get_clean();
        require("layout.php");
    } 
    public function reviewrate($id,$ismarque){
        
        if(isset($_SESSION["userId"])){?>

        <div class="review-rating">
        <div class="rating" isMarque="<?php echo $ismarque ;?>" data-value="<?php echo $id;?>">
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
        <?php }?>
        <div class="review" isMarque="<?php echo $ismarque ;?>" data-value-review="<?php echo $id;?>">
        <form method="post" class="form-avis">
                <div class="form-item">
                <textarea name="comment" id="comment" placeholder="Ajouter votre avis ici" required></textarea>
                </div>
              <input type="submit" value="Ajouter" class="submit-btn" >
            </div>
            </form>
        </div>
        </div>
        <?php 


    }
    public function MarqueDetail($idmarque){
        $r=new marqueController();
        $marque=$r->getMarqueDetail($idmarque)[0];
        $vehicules=$r->getPrincipaleVehicule($idmarque);
         if(isset($vehicules[0])){
             $vehicule=$vehicules[0];
        }else{
            $vehicule=null;
        }
       
        ob_start();
        ?>
        <div class="flex-center">
            <h2 class="heading-center">
            <?php echo $marque['nom'] ;?>
            </h2>
        </div>
        <div class="info-marque">
            <div class="logo-img">
                <img src="<?php echo $marque['url']?>" alt="logo-marque">
            </div>
            <ul class="general-info">
                <li><span>Pays d'origine :</span> <?php echo $marque['pays'] ?> </li>
                <li><span>Siége sociale :</span><?php echo $marque['siege_social'] ?></li>
                <li><span>Année création :</span><?php echo $marque['annee_creation'] ?></li>
                <li class="starsRating"></li>
            </ul>
        </div>
        <div class="v-principale">
            <?php if($vehicule !== null){?>
            <h1 class="heading">Véhicule Principale</h1>
            <div class="vehicule-list">
             <div class="boxv">
                <div class="img-v">
                    <?php if (isset($_SESSION["userName"])){
                       echo'<i class="fa-regular fa-bookmark favoris-icon" data-value="'.$vehicule['idvehicule'].'"></i>';
                    }?>
                    <img src="<?php echo $vehicule['url'] ?>" alt="">
                </div>
                <div class="info-v">
                    <p><?php echo $vehicule['marquen'], $vehicule['modelen'] ; ?></p>
                    <p><?php echo $vehicule['versionn'] ?></p>
                </div>
             </div>
             <div class="boxv">
                <div class="img-v">
                    <img src="<?php echo $vehicule['url'] ?>" alt="">
                </div>
                <div class="info-v">
                    <p><?php echo $vehicule['marquen'], $vehicule['modelen'] ; ?></p>
                    <p><?php echo $vehicule['versionn'] ?></p>
                </div>
             </div>
             <div class="boxv">
                <div class="img-v">
                    <img src="<?php echo $vehicule['url'] ?>" alt="">
                </div>
                <div class="info-v">
                    <p><?php echo $vehicule['marquen'], $vehicule['modelen'] ; ?></p>
                    <p><?php echo $vehicule['versionn'] ?></p>
                </div>
             </div>
             <div class="boxv">
                <div class="img-v">
                    <img src="<?php echo $vehicule['url'] ?>" alt="">
                </div>
                <div class="info-v">
                    <p><?php echo $vehicule['marquen'], $vehicule['modelen'] ; ?></p>
                    <p><?php echo $vehicule['versionn'] ?></p>
                </div>
             </div>
             <div class="boxv">
                <div class="img-v">
                    <img src="<?php echo $vehicule['url'] ?>" alt="">
                </div>
                <div class="info-v">
                    <p><?php echo $vehicule['marquen'], $vehicule['modelen'] ; ?></p>
                    <p><?php echo $vehicule['versionn'] ?></p>
                </div>
             </div>
             <button class="previous scroll-btn"><i class="fa-solid fa-chevron-left" style="color: #ffffff;"></i></button>
             <button class="next scroll-btn"><i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></button>
            </div>
            <?php } ?>
        </div>
     
        <?php 

        $this->reviewrate($idmarque,"true");
  
        $content = ob_get_clean();
        require("layout.php");

?>
        <script>
    $(document).ready(()=>{

        // Afficher heart rempli ou vide selon la click de user 
        //passer id de l'avis et liked boolean pour savoir si c'est like ou unlike 
        function updateiconlike(idavis,liked){
            console.log(liked);
            //Sélectionner l'icon de avis précis (selon idavis )
            const icon=$('.likebtn[data-value='+idavis+'] i');
            if(liked == '1'){
                icon.removeClass("fa-regular");//regular sa veut dire empty 
                icon.addClass("fa-solid");//solid heart rempli 
            }
            else{
                icon.removeClass("fa-solid");
                icon.addClass("fa-regular");
            }
        }
       
        // getBestReview();
        function getBestReview(){
            $.ajax({
                url: "index.php?router=BestReview",
                method: "POST",
                data: {
                    isMarque:$(".review").attr("isMarque"),
                    idEntity:$(".review").attr("data-value-review"),
                },
                success: (res) => {
                    console.log(res);
                    $result=JSON.parse(res);
                    if($result.status == "success"){
                        var avisall=$result.data;
                        let containeravis = $('<div class="container-avis"></div>');
                        $.each(avisall,(index, avis) => {
                            let boxavis=$('<div class="box-avis"></div>');
                            let infoavis=$('<div class="info-avis"></div>');
                            let dateavis=$('<p></p>').text(avis.date);
                            let useravis=$('<p></p>').text(avis.nom+avis.prenom);
                            let commentavis=$('<div class="comment"></div>').text(avis.commentaire);
                            let likebtn;
                            if(avis.userlike =='1'){
                             likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-solid fa-heart" ></i></div>');
                            }
                            else{
                            likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-regular fa-heart" ></i></div>');
                            }
                            likebtn.click(()=>{console.log("this is for "+avis.idavis)
                            handlelike(avis.idavis);});
                            infoavis.append(dateavis);
                            infoavis.append(useravis);
                            boxavis.append(infoavis);
                            boxavis.append(commentavis);
                            boxavis.append(likebtn);
                          
                            containeravis.append(boxavis);
                                })
                                $(".rating").append(containeravis);
                            
                                }
                            
                            } , 
                    error:(error)=>{
                        console.log(error.message);
                    } ,   
                }); 
        }
        function handlelike(idavis){
            $.ajax({
                url: "index.php?router=Like",
                method: "POST",
                data: {
                    idavis:idavis,
                },
                success: (res) => {
                    $result=JSON.parse(res);
                     if($result.status == "like"){
                      updateiconlike(idavis,true);
                        }
                    else if($result.status == "unlike"){
                      updateiconlike(idavis,false);
                         }
                    } , 
                    error:(error)=>{
                        console.log(error.message);
                    } ,   
                }); 
        }
        // Avoir toute les avis d'une entité (marque ou véhicule )
        $.ajax({
                url: "index.php?router=AllAvis",
                method: "POST",
                data: {
                    isMarque:$(".review").attr("isMarque"),//pour savoir si c'est marque ou véhicule 
                    idEntity:$(".review").attr("data-value-review"),
                },
                success: (res) => {
                    console.log(res);
                    $result=JSON.parse(res);
                    if($result.status == "success"){// Si success on va créer le container pour afficher tout les avis 
                        var avisall=$result.data;
                        let containeravis = $('<div class="container-avis"></div>');
                        $.each(avisall,(index, avis) => {
                            let boxavis=$('<div class="box-avis"></div>');
                            let infoavis=$('<div class="info-avis"></div>');
                            let dateavis=$('<p></p>').text(avis.date);
                            let useravis=$('<p></p>').text(avis.nom+avis.prenom);
                            let commentavis=$('<div class="comment"></div>').text(avis.commentaire);
                            //selon si user actuelle (ce qui est connecté ) si userlike donc heart déja rempli sinon heart vide 
                            if(avis.userlike =='1'){
                             likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-solid fa-heart" ></i></div>');
                            }
                            else{
                            likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-regular fa-heart" ></i></div>');
                            }
                            //si on click sur le button on va updater database par les changements de like unlike 
                            likebtn.click(()=>{
                            handlelike(avis.idavis);});
                            //append les élements de l'avis pour les affichers (dynamiquement )
                            infoavis.append(dateavis);
                            infoavis.append(useravis);
                            boxavis.append(infoavis);
                            boxavis.append(commentavis);
                            boxavis.append(likebtn);
                            containeravis.append(boxavis);//container contient tous les avis 
                                })
                                $(".rating").append(containeravis);// append to element HTML qui ca afficher les avis 
                            
                                }
                            
                            } , 
                    error:(error)=>{
                        console.log(error.message);//si error en affiche l'erreur 
                    } ,   
                }); 
       
        
       
        // setInterval(() => {
        //     $.ajax({
        //     url: "index.php?router=getRate",
        //     method: "POST",
        //     data: {
        //         isMarque:$(".rating").attr("isMarque"),
        //         idEntity:$(".rating").attr("data-value"),
        //     },
        //     success: (res) => {
        //         console.log(res);
        //         const result=JSON.parse(res);
        //          const inforate=$('<p> <span> &#9733; '+result.avg+' /5 | '+result.raters+' note </span> </p>');
        //          $(".starsRating").empty();
        //        $(".starsRating").append(inforate);
        //     } ,     
        // }); 
        // }, 5000);

        var ratinginput=$(".rating input");
         var rate=<?php if(isset($_COOKIE['rate'])){echo $_COOKIE['rate'];} else{echo "0";} ?>; 
        // console.log(rate);
         updateRating(rate);
         function updateRating($rate){
            $(".rating  label ").css("color","black");
            console.log("hello");
           for($i=0;$i<$rate;$i++){
                 $(".rating  label").eq($i).css("color","red");
              }
         }
        ratinginput.click(()=>{
            $.ajax({
                url: "index.php?router=Rate",
                method: "POST",
                data: {
                    note:$(".rating input:checked").val(),
                    isMarque:$(".rating").attr("isMarque"),
                    idEntity:$(".rating").attr("data-value"),
                },
                success: (res) => {
                updateRating(res);
                }       
            });
        });

// Affichage des véhicules avec next et previous (Caresoul)
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



    //Gestion de favoris (Handle click sur icon favoris )
    let favoris=$(".vehicule-list .boxv .favoris-icon");
        $(".vehicule-list .boxv").mouseover(()=>{
         favoris.show();});
        $(".vehicule-list .boxv").mouseout(()=>{
        favoris.hide();});
        favoris.click(()=>{
            let isFavorite=favoris.hasClass("isFavorite");
            console.log(isFavorite);
                $.ajax({
                url: "index.php?router=Favoris",
                method: "POST",
                data: {
                    vehiculeid:favoris.attr("data-value"),
                    isFavorite:isFavorite,
                },
                success: (res) => {
                    if(!isFavorite){
                        favoris.addClass('fa-solid');
                        favoris.removeClass('fa-regular');
                    }else{
                        favoris.removeClass('fa-solid');
                        favoris.addClass('fa-regular');
                    }
                    favoris.toggleClass("isFavorite");
                } ,      
            });

        });

  function Rating(average){
    const starRating=$(".starsRating");
    starRating.empty();
    const filled=Math.round(average);
    for($i=0;$i<5;$i++){
        const star=$("<span></span>");
        if($i<filled){
           star.html('&#9733;');
           star.css({"color":"#ffc700","margin-right":"2px","font-size": "30px"});
        }else{
            star.html('&#9734;');
            star.css({"color":"#ccc","margin-right":"2px","font-size": "30px"});
        }
        starRating.append(star);
    }
  }
    Rating(2);



// Ajouter un avis sur une entité (Marque ou véhicule )
    $(".form-avis").submit((e)=>{
    e.preventDefault();
    $.ajax({
    url: "index.php?router=SetAvis",
    method: "POST",
    data:{
        comment:$("#comment").val(),
        isMarque:$(".review").attr("isMarque"),
        idEntity:$(".review").attr("data-value-review"),
     } ,
    dataType: "json",
    success: (res) => {
        $("textarea").empty();
        },
    error: function(error) {
          console.log(error.message);
        }  
});
});



    });
</script>
   <?php } 



 // Afficher heart rempli ou vide selon la click de user 
        //passer id de l'avis et liked boolean pour savoir si c'est like ou unlike 
        function updateiconlike(idavis,liked){
            console.log(liked);
            //Sélectionner l'icon de avis précis (selon idavis )
            const icon=$('.likebtn[data-value='+idavis+'] i');
            if(liked == '1'){
                icon.removeClass("fa-regular");//regular sa veut dire empty 
                icon.addClass("fa-solid");//solid heart rempli 
            }
            else{
                icon.removeClass("fa-solid");
                icon.addClass("fa-regular");
            }
        }
       
        // getBestReview();
        function getBestReview(){
            $.ajax({
                url: "index.php?router=BestReview",
                method: "POST",
                data: {
                    isMarque:$(".review").attr("isMarque"),
                    idEntity:$(".review").attr("data-value-review"),
                },
                success: (res) => {
                    console.log(res);
                    $result=JSON.parse(res);
                    if($result.status == "success"){
                        var avisall=$result.data;
                        let containeravis = $('<div class="container-avis"></div>');
                        $.each(avisall,(index, avis) => {
                            let boxavis=$('<div class="box-avis"></div>');
                            let infoavis=$('<div class="info-avis"></div>');
                            let dateavis=$('<p></p>').text(avis.date);
                            let useravis=$('<p></p>').text(avis.nom+avis.prenom);
                            let commentavis=$('<div class="comment"></div>').text(avis.commentaire);
                            let likebtn;
                            if(avis.userlike =='1'){
                             likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-solid fa-heart" ></i></div>');
                            }
                            else{
                            likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-regular fa-heart" ></i></div>');
                            }
                            likebtn.click(()=>{console.log("this is for "+avis.idavis)
                            handlelike(avis.idavis);});
                            infoavis.append(dateavis);
                            infoavis.append(useravis);
                            boxavis.append(infoavis);
                            boxavis.append(commentavis);
                            boxavis.append(likebtn);
                          
                            containeravis.append(boxavis);
                                })
                                $(".rating").append(containeravis);
                            
                                }
                            
                            } , 
                    error:(error)=>{
                        console.log(error.message);
                    } ,   
                }); 
        }
        function handlelike(idavis){
            $.ajax({
                url: "index.php?router=Like",
                method: "POST",
                data: {
                    idavis:idavis,
                },
                success: (res) => {
                    $result=JSON.parse(res);
                     if($result.status == "like"){
                      updateiconlike(idavis,true);
                        }
                    else if($result.status == "unlike"){
                      updateiconlike(idavis,false);
                         }
                    } , 
                    error:(error)=>{
                        console.log(error.message);
                    } ,   
                }); 
        }
        // Avoir toute les avis d'une entité (marque ou véhicule )
        $.ajax({
                url: "index.php?router=AllAvis",
                method: "POST",
                data: {
                    isMarque:$(".review").attr("isMarque"),//pour savoir si c'est marque ou véhicule 
                    idEntity:$(".review").attr("data-value-review"),
                },
                success: (res) => {
                    console.log(res);
                    $result=JSON.parse(res);
                    if($result.status == "success"){// Si success on va créer le container pour afficher tout les avis 
                        var avisall=$result.data;
                        let containeravis = $('<div class="container-avis"></div>');
                        $.each(avisall,(index, avis) => {
                            let boxavis=$('<div class="box-avis"></div>');
                            let infoavis=$('<div class="info-avis"></div>');
                            let dateavis=$('<p></p>').text(avis.date);
                            let useravis=$('<p></p>').text(avis.nom+avis.prenom);
                            let commentavis=$('<div class="comment"></div>').text(avis.commentaire);
                            //selon si user actuelle (ce qui est connecté ) si userlike donc heart déja rempli sinon heart vide 
                            if(avis.userlike =='1'){
                             likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-solid fa-heart" ></i></div>');
                            }
                            else{
                            likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-regular fa-heart" ></i></div>');
                            }
                            //si on click sur le button on va updater database par les changements de like unlike 
                            likebtn.click(()=>{
                            handlelike(avis.idavis);});
                            //append les élements de l'avis pour les affichers (dynamiquement )
                            infoavis.append(dateavis);
                            infoavis.append(useravis);
                            boxavis.append(infoavis);
                            boxavis.append(commentavis);
                            boxavis.append(likebtn);
                            containeravis.append(boxavis);//container contient tous les avis 
                                })
                                $(".rating").append(containeravis);// append to element HTML qui ca afficher les avis 
                            
                                }
                            
                            } , 
                    error:(error)=>{
                        console.log(error.message);//si error en affiche l'erreur 
                    } ,   
                }); 
       
        
       
        // setInterval(() => {
        //     $.ajax({
        //     url: "index.php?router=getRate",
        //     method: "POST",
        //     data: {
        //         isMarque:$(".rating").attr("isMarque"),
        //         idEntity:$(".rating").attr("data-value"),
        //     },
        //     success: (res) => {
        //         console.log(res);
        //         const result=JSON.parse(res);
        //          const inforate=$('<p> <span> &#9733; '+result.avg+' /5 | '+result.raters+' note </span> </p>');
        //          $(".starsRating").empty();
        //        $(".starsRating").append(inforate);
        //     } ,     
        // }); 
        // }, 5000);

//         var ratinginput=$(".rating input");
//    //      var rate=<?php if(isset($_COOKIE['rate'])){echo $_COOKIE['rate'];} else{echo "0";} ?>; 
//         // console.log(rate);
//          updateRating(rate);
//          function updateRating($rate){
//             $(".rating  label ").css("color","black");
//             console.log("hello");
//            for($i=0;$i<$rate;$i++){
//                  $(".rating  label").eq($i).css("color","red");
//               }
//          }
//         ratinginput.click(()=>{
//             $.ajax({
//                 url: "index.php?router=Rate",
//                 method: "POST",
//                 data: {
//                     note:$(".rating input:checked").val(),
//                     isMarque:$(".rating").attr("isMarque"),
//                     idEntity:$(".rating").attr("data-value"),
//                 },
//                 success: (res) => {
//                 updateRating(res);
//                 }       
//             });
//         });

// Affichage des véhicules avec next et previous (Caresoul)
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



    //Gestion de favoris (Handle click sur icon favoris )
    let favoris=$(".vehicule-list .boxv .favoris-icon");
        $(".vehicule-list .boxv").mouseover(()=>{
         favoris.show();});
        $(".vehicule-list .boxv").mouseout(()=>{
        favoris.hide();});
        favoris.click(()=>{
            let isFavorite=favoris.hasClass("isFavorite");
            console.log(isFavorite);
                $.ajax({
                url: "index.php?router=Favoris",
                method: "POST",
                data: {
                    vehiculeid:favoris.attr("data-value"),
                    isFavorite:isFavorite,
                },
                success: (res) => {
                    if(!isFavorite){
                        favoris.addClass('fa-solid');
                        favoris.removeClass('fa-regular');
                    }else{
                        favoris.removeClass('fa-solid');
                        favoris.addClass('fa-regular');
                    }
                    favoris.toggleClass("isFavorite");
                } ,      
            });

        });

  function Rating(average){
    const starRating=$(".starsRating");
    starRating.empty();
    const filled=Math.round(average);
    for($i=0;$i<5;$i++){
        const star=$("<span></span>");
        if($i<filled){
           star.html('&#9733;');
           star.css({"color":"#ffc700","margin-right":"2px","font-size": "30px"});
        }else{
            star.html('&#9734;');
            star.css({"color":"#ccc","margin-right":"2px","font-size": "30px"});
        }
        starRating.append(star);
    }
  }
    Rating(2);



// Ajouter un avis sur une entité (Marque ou véhicule )
    $(".form-avis").submit((e)=>{
    e.preventDefault();
    $.ajax({
    url: "index.php?router=SetAvis",
    method: "POST",
    data:{
        comment:$("#comment").val(),
        isMarque:$(".review").attr("isMarque"),
        idEntity:$(".review").attr("data-value-review"),
     } ,
    dataType: "json",
    success: (res) => {
        $("textarea").empty();
        },
    error: function(error) {
          console.log(error.message);
        }  
});
});



}

?> -->


<script>
    // $(document).ready(()=>{

//         // Afficher heart rempli ou vide selon la click de user 
//         //passer id de l'avis et liked boolean pour savoir si c'est like ou unlike 
//         function updateiconlike(idavis,liked){
//             console.log(liked);
//             //Sélectionner l'icon de avis précis (selon idavis )
//             const icon=$('.likebtn[data-value='+idavis+'] i');
//             if(liked == '1'){
//                 icon.removeClass("fa-regular");//regular sa veut dire empty 
//                 icon.addClass("fa-solid");//solid heart rempli 
//             }
//             else{
//                 icon.removeClass("fa-solid");
//                 icon.addClass("fa-regular");
//             }
//         }
       
//         getBestReview();
//         function getBestReview(){
//             $.ajax({
//                 url: "index.php?router=BestReview",
//                 method: "POST",
//                 data: {
//                     isMarque:$(".review").attr("isMarque"),
//                     idEntity:$(".review").attr("data-value-review"),
//                 },
//                 success: (res) => {
//                     console.log(res);
//                     $result=JSON.parse(res);
//                     if($result.status == "success"){
//                         var avisall=$result.data;
//                        createcontaineravis(avisall);
//                                 }
                            
//                             } , 
//                     error:(error)=>{
//                         console.log(error.message);
//                     } ,   
//                 }); 
//         }
//         function createcontaineravis($avislist){
//             let containeravis = $('<div class="container-avis"></div>');
//                     $.each($avislist,(index, avis) => {
//                     let boxavis=$('<div class="box-avis"></div>');
//                     let infoavis=$('<div class="info-avis"></div>');
//                     let dateavis=$('<p></p>').text(avis.date);
//                     let useravis=$('<p></p>').text(avis.nom+avis.prenom);
//                     let commentavis=$('<div class="comment"></div>').text(avis.commentaire);
//                     //selon si user actuelle (ce qui est connecté ) si userlike donc heart déja rempli sinon heart vide 
//                     if(avis.userlike =='1'){
//                         likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-solid fa-heart" ></i></div>');
//                     }
//                     else{
//                     likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-regular fa-heart" ></i></div>');
//                     }
//                     //si on click sur le button on va updater database par les changements de like unlike 
//                     likebtn.click(()=>{
//                     handlelike(avis.idavis);});
//                     //append les élements de l'avis pour les affichers (dynamiquement )
//                     infoavis.append(dateavis);
//                     infoavis.append(useravis);
//                     boxavis.append(infoavis);
//                     boxavis.append(commentavis);
//                     boxavis.append(likebtn);
//                     containeravis.append(boxavis);//container contient tous les avis 
//                     });
//                     $(".rating").empty();
//                     $(".rating").append(containeravis);
//         }
//         function handlelike(idavis){
//             $.ajax({
//                 url: "index.php?router=Like",
//                 method: "POST",
//                 data: {
//                     idavis:idavis,
//                 },
//                 success: (res) => {
//                     $result=JSON.parse(res);
//                      if($result.status == "like"){
//                       updateiconlike(idavis,true);
//                         }
//                     else if($result.status == "unlike"){
//                       updateiconlike(idavis,false);
//                          }
//                     } , 
//                     error:(error)=>{
//                         console.log(error.message);
//                     } ,   
//                 }); 
//         }
//         // Avoir toute les avis d'une entité (marque ou véhicule )
//         //  $.ajax({
//         //         url: "index.php?router=AllAvis",
//         //         method: "POST",
//         //         data: {
//         //             isMarque:$(".review").attr("isMarque"),//pour savoir si c'est marque ou véhicule 
//         //             idEntity:$(".review").attr("data-value-review"),
//         //         },
//         //         success: (res) => {
//         //             $result=JSON.parse(res);
//         //             if($result.status == "success"){// Si success on va créer le container pour afficher tout les avis 
//         //                 var avisall=$result.data;
//         //                 function renderavis(debut){
//         //                     const fin =debut +5;
//         //                     const avistoshow=avisall.slice(debut,fin)
//         //                     createcontaineravis(avistoshow)

//                         // let containeravis = $('<div class="container-avis"></div>');
//                         //     $.each(avistoshow,(index, avis) => {
//                         //     let boxavis=$('<div class="box-avis"></div>');
//                         //     let infoavis=$('<div class="info-avis"></div>');
//                         //     let dateavis=$('<p></p>').text(avis.date);
//                         //     let useravis=$('<p></p>').text(avis.nom+avis.prenom);
//                         //     let commentavis=$('<div class="comment"></div>').text(avis.commentaire);
//                         //     //selon si user actuelle (ce qui est connecté ) si userlike donc heart déja rempli sinon heart vide 
//                         //     if(avis.userlike =='1'){
//                         //      likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-solid fa-heart" ></i></div>');
//                         //     }
//                         //     else{
//                         //     likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-regular fa-heart" ></i></div>');
//                         //     }
//                         //     //si on click sur le button on va updater database par les changements de like unlike 
//                         //     likebtn.click(()=>{
//                         //     handlelike(avis.idavis);});
//                         //     //append les élements de l'avis pour les affichers (dynamiquement )
//                         //     infoavis.append(dateavis);
//                         //     infoavis.append(useravis);
//                         //     boxavis.append(infoavis);
//                         //     boxavis.append(commentavis);
//                         //     boxavis.append(likebtn);
//                         //     containeravis.append(boxavis);//container contient tous les avis 
//                         //         })
//                                // append to element HTML qui ca afficher les avis 
                            
//                 //             } 
//                 //             renderavis(0);
//                 //             let debut= 5 ; 
//                 //             setInterval(()=>{
//                 //                 renderavis(debut);
//                 //                 debut +=5;
//                 //                if(debut>=avisall.length){debut=0}
//                 //                 },1000)
//                 //             }} , 
//                 //     error:(error)=>{
//                 //         console.log(error.message);//si error en affiche l'erreur 
//                 //     } ,   
//                 // }); 
       
        
       
//         // setInterval(() => {
//         //     $.ajax({
//         //     url: "index.php?router=getRate",
//         //     method: "POST",
//         //     data: {
//         //         isMarque:$(".rating").attr("isMarque"),
//         //         idEntity:$(".rating").attr("data-value"),
//         //     },
//         //     success: (res) => {
//         //         console.log(res);
//         //         const result=JSON.parse(res);
//         //          const inforate=$('<p> <span> &#9733; '+result.avg+' /5 | '+result.raters+' note </span> </p>');
//         //          $(".starsRating").empty();
//         //        $(".starsRating").append(inforate);
//         //     } ,     
//         // }); 
//         // }, 5000);

//         var ratinginput=$(".rating input");
//          var rate=<?php if(isset($_COOKIE['rate'])){echo $_COOKIE['rate'];} else{echo "0";} ?>; 
//         // console.log(rate);
//          updateRating(rate);
//          function updateRating($rate){
//             $(".rating  label ").css("color","black");
//             console.log("hello");
//            for($i=0;$i<$rate;$i++){
//                  $(".rating  label").eq($i).css("color","red");
//               }
//          }
//         ratinginput.click(()=>{
//             $.ajax({
//                 url: "index.php?router=Rate",
//                 method: "POST",
//                 data: {
//                     note:$(".rating input:checked").val(),
//                     isMarque:$(".rating").attr("isMarque"),
//                     idEntity:$(".rating").attr("data-value"),
//                 },
//                 success: (res) => {
//                 updateRating(res);
//                 }       
//             });
//         });

// // Affichage des véhicules avec next et previous (Caresoul)---------
//     const vehiculeList=$(".vehicule-list");
//     const boxv=$(".boxv")
//     const next=$(".next");
//     const previous=$(".previous");
//     let position = 0;
//     previous.click(() => {
//     //boxv.ouderWidth ca veut dire déplacement selon le width de box véhicule 
//      position -= boxv.outerWidth();
//      vehiculeList.animate({ scrollLeft: position }, 'slow');
//     });

//     next.click(() => {
//       position += boxv.outerWidth();
//       vehiculeList.animate({ scrollLeft: position }, 'slow');
//     });
// // ---------------------------------------------------------------


// /*--------- Gestion de favoris (Handle click sur icon favoris )-----------*/
//     let favoris=$(".vehicule-list .boxv .favoris-icon");
//     $(".vehicule-list .boxv").mouseover(()=>{
//     favoris.show();});
//     $(".vehicule-list .boxv").mouseout(()=>{
//     favoris.hide();});
//     favoris.click(()=>{
//     let isFavorite=favoris.hasClass("isFavorite");
//     console.log(isFavorite);
//     $.ajax({
//     url: "index.php?router=Favoris",
//     method: "POST",
//     data: {
//         vehiculeid:favoris.attr("data-value"),
//         isFavorite:isFavorite,
//     },
//     success: (res) => {
//         if(!isFavorite){
//             favoris.addClass('fa-solid');
//             favoris.removeClass('fa-regular');
//         }else{
//             favoris.removeClass('fa-solid');
//             favoris.addClass('fa-regular');
//         }
//         favoris.toggleClass("isFavorite");
//     } ,      
//     });
// });
// /*---------------------------------------------------------------- */

// //   function Rating(average){
// //     const starRating=$(".starsRating");
// //     starRating.empty();
// //     const filled=Math.round(average);
// //     for($i=0;$i<5;$i++){
// //         const star=$("<span></span>");
// //         if($i<filled){
// //            star.html('&#9733;');
// //            star.css({"color":"#ffc700","margin-right":"2px","font-size": "30px"});
// //         }else{
// //             star.html('&#9734;');
// //             star.css({"color":"#ccc","margin-right":"2px","font-size": "30px"});
// //         }
// //         starRating.append(star);
// //     }
// //   }
// //     Rating(2);



// // /* --------Ajouter un avis sur une entité (Marque ou véhicule )--------*/
// //     $(".form-avis").submit((e)=>{
// //     e.preventDefault();
// //     $.ajax({
// //     url: "index.php?router=SetAvis",//url pour appellation de controlleur pour ajouter un avis 
// //     method: "POST",
// //     data:{
// //         comment:$("#comment").val(),//le commentaire 
// //         isMarque:$(".review").attr("isMarque"),
// //         idEntity:$(".review").attr("data-value-review"),
// //      } ,
// //     dataType: "json",
// //     success: (res) => {
// //         $("#comment").val('');
// //         },
// //     error: function(error) {
// //           console.log(error.message);
// //         }  
// // });
// // });
// // /*----------------------------------------------------------------------*/


//     });


  // let containeravis = $('<div class="container-avis"></div>');
                        //     $.each(avistoshow,(index, avis) => {
                        //     let boxavis=$('<div class="box-avis"></div>');
                        //     let infoavis=$('<div class="info-avis"></div>');
                        //     let dateavis=$('<p></p>').text(avis.date);
                        //     let useravis=$('<p></p>').text(avis.nom+avis.prenom);
                        //     let commentavis=$('<div class="comment"></div>').text(avis.commentaire);
                        //     //selon si user actuelle (ce qui est connecté ) si userlike donc heart déja rempli sinon heart vide 
                        //     if(avis.userlike =='1'){
                        //      likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-solid fa-heart" ></i></div>');
                        //     }
                        //     else{
                        //     likebtn=$('<div class="likebtn" data-value='+avis.idavis+'><i class="fa-regular fa-heart" ></i></div>');
                        //     }
                        //     //si on click sur le button on va updater database par les changements de like unlike 
                        //     likebtn.click(()=>{
                        //     handlelike(avis.idavis);});
                        //     //append les élements de l'avis pour les affichers (dynamiquement )
                        //     infoavis.append(dateavis);
                        //     infoavis.append(useravis);
                        //     boxavis.append(infoavis);
                        //     boxavis.append(commentavis);
                        //     boxavis.append(likebtn);
                        //     containeravis.append(boxavis);//container contient tous les avis 
                        //         })


                        <?php foreach($vehicules as $vehicule){?>
            <div class="vehicule-box"> 
                <div class="image-container">
                <div>
                    <a href="index.php?router=Vehicule&id=<?php echo $vehicule['idvehicule'] ;?>">
                    <img src="<?php echo $vehicule['url']  ;?>" alt=""/></a>
                </div>
                </div>
                <div class="info-container">
                <p> <?php echo $vehicule['marquen'].' '.$vehicule['modelen']  ;?></p>
                <p><?php echo $vehicule['versionn']  ;?> </p>
                </div>
                <div class="note-vehicule" data-value="<?php echo $vehicule['idvehicule'] ;?>">
                </div>
            </div>
         <?php }?>
         tableContainer=$(".table-compar");
                 resdata=JSON.parse(data);
                console.log(resdata);
                const table=$('<table> </table>');
                const thead=$('<thead><tr> </tr> </thead>');
                $.each(resdata, (index, row) => {
                let td=$("<td> </td>");
                console.log(row[0].idvehicule);
                let ahref=$('<a href='+row[0].idvehicule+'> </a>');
                let img=$('<a src='+row[0].url+'>');
                ahref.append(td);
                td.append(thead);
                });
                thead.append(table);
                tableContainer.append(table);

    // public function reviewrateuser($ismarque,$entity){
    //     if(isset($_SESSION["userId"])){?>
    //     <div class="review-rating">
    //     <h2 class="heading-2">Noter <?php echo $entity["nom"] ;?></h2>
    //     <div class="rating" >
    //         <input type="radio" value="1" name="starRate" id="star1" hidden>
    //         <label for="star1"><i class="fa-solid fa-star"></i></label>
    //         <input type="radio" value="2" name="starRate" id="star2" hidden>
    //         <label for="star2"><i class="fa-solid fa-star"></i></label>
    //         <input type="radio" value="3" name="starRate" id="star3" hidden>
    //         <label for="star3"><i class="fa-solid fa-star"></i></label>
    //         <input type="radio" value="4" name="starRate" id="star4" hidden>
    //         <label for="star4"><i class="fa-solid fa-star"></i></label>
    //         <input type="radio" value="5" name="starRate" id="star5" hidden>
    //         <label for="star5"><i class="fa-solid fa-star"></i></label>
    //     </div>
    //     <div class="review">
    //     <h2 class="heading-2">Ajouter un avis sur  <?php echo $entity["nom"] ;?></h2>
    //     <form method="post" class="form-avis">
    //             <div class="form-item">
    //             <textarea name="comment" id="comment" placeholder="Ajouter votre avis ici" required></textarea>
    //             </div>
    //             <div class="flex-end">
    //           <input type="submit" value="Ajouter" class="submit-btn" >
    //           </div>
    //         </div>
    //         </form>
    //     </div>
    //     </div>
    //     <?php } 
    // }
    // public function allavis(){
    //     ?>
    //     <div class="tousavis-container">
    //     <h2 class="heading-2 mb-1">Autre avis</h2>
    //     <div class="tousavis"></div>
    //     </div>
    //     <?php
    // }
    // public function avis($ismarque,$entity){
    //     ?>
    //   <div class="avis" isMarque="<?php echo $ismarque; ?>" data-value-review="<?php echo $ismarque ? $entity["idmarque"] : $entity["idvehicule"]; ?>">
    //     <?php
    //     if(isset($_SESSION["userId"])){
    //     echo '<h1 class="heading">Avis & Note  </h1>';
    //     } else {
    //         echo '<h1 class="heading">Avis  </h1>'; 
    //     }
    //     ?>
    //     <div class="avis-appr-container">
    //     <h2 class="heading-2 mb-1">Les avis appréciés</h2>
    //     <div class="avis-appr"></div>
    //     </div>
    //     <?php $this->reviewrateuser($ismarque,$entity);  
    //     $this->allavis();
    //     ?>
       
    //     </div>

    //     <?php
    // }


    <?php
require_once("./controllers/VehiculeController.php");
class vehiculeView{
    public function showmarquevehicules($idmarque){
        ob_start();
        ?>
        <h1 class="heading">
         Les vehicules de cette marque 
        </h1>
         <div class="vehicules-container" data-value="<?php echo $idmarque;?>">
                <!-- Container is displayed by request ajax  -->
        </div>
        <?php
        $content = ob_get_clean();
        require("layout.php");
    }
    public function vehiculeDetail($idvehicule){
        $r=new vehiculeController();
        $vehicule=$r->getVehiculeById($idvehicule);
        $caracts=$r->getVehiculecarac($idvehicule);
        ob_start();
        ?>
        <h2 class="heading">
         <?php echo $vehicule[0]['marquen'].' '.$vehicule[0]['modelen'].' '.$vehicule[0]['versionn'] ;?>
        </h2>
        <div class="images mb-1">
            <h2 class="heading-2">Images</h2>
            <div class="list-images">
            <?php foreach($vehicule as $pic){
            echo '<div class="imagev-container"> 
            <img src='.$pic['url'].' alt="">
            </div>';
           }
            ?>
            </div>
        </div>
        <div class="caract">
            <h2 class="heading-2 mb-1">Spécifications</h2>
            <div class="list-spec mb-1">
            <div class="spec-container"> 
                <?php
                echo '<h5>Marque</h5>
                    <p> '.$vehicule[0]['marquen'].'</p>
                    </div>
                    <div class="spec-container"> 
                    <h5>Modele</h5>
                    <p>'.$vehicule[0]['modelen'].'</p>
                    </div>
                    <div class="spec-container"> 
                    <h5>Version & Année</h5>
                    <p>'.$vehicule[0]['versionn'].'</p>
                    </div>';
                    foreach($caracts as $carac){
                echo' <div class="spec-container"> 
                    <h5>'.$carac["nom"].'</h5>
                    <p>'.$carac["valeur"].'</p>
                    </div>';
                    }
                 ?>
            <div class="flex-end">
            <a href="index.php?router=Comparateur&id=<?php echo $idvehicule?>">Comparer avec d'autre véhicule<i class="fa-solid fa-chevron-right"></i></a>
            </div>
            </div>
        </div>
        <?php
        $content = ob_get_clean();
        require("layout.php");
    }
}





?>


<!-- <a href="index.php?router=Comparateur&id=<?php echo $idvehicule?>">Comparer avec d'autre véhicule<i class="fa-solid fa-chevron-right"></i></a> -->