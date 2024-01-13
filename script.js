// $(document).ready(() => {

//     console.log("hellohqsvyujh");
// //     // Login et Signup 
//     //Handle login form 
//     const conBtn=$("#connecter-btn");
//     const seconnecter=$(".connecter button");
//     const inscrire=$(".inscrire button");
//     let registermessage=$("<div></div>");
//     let loginmessage=$("<div></div>");
//     $(".form-signup").prepend(registermessage);
//     $(".form-login").prepend(loginmessage);
    


//     conBtn.click(()=>{
//         $(".popup-login").show();
//         $(".popup-login-bg").show();
//     })
//     seconnecter.click(()=>{
//         $(".popup-signup").hide();
//         $(".popup-login").show();
//     })
//     inscrire.click(()=>{
//         $(".popup-login").hide();
//         $(".popup-signup").show();
//     })
//     $(".form-signup").submit((e)=>{
//         e.preventDefault();
//       const data={
//         nom:$("#nom").val(),
//         prenom:$("#prenom").val(),
//         username:$("#username").val(),
//         date:$("#date").val(),
//         sexe:$("#sexe").val(),
//         password:$("#password").val(),  
//       }
//         $.ajax({
//             url: "index.php?router=UserRegister",
//             method: "POST",
//             data: data,
//             dataType: "json",
//             success: (res) => {
//                 const mes=$('<p>'+res.message+'</p>');
//                 registermessage.empty();
//                 registermessage.append(mes);
//                 console.log(res.message)
//                 if(res.status=="success"){
//                   registermessage.css({'color':'green','font-weight':'bold'});
//                   registermessage.fadeIn(function(){
//                    registermessage.delay(2000).fadeOut(()=>{
//                     $(".popup-signup").hide();
//                     $(".popup-login-bg").hide();
//                    }); 
//                  });
//                 }else {
//                     registermessage.css({'color':'red','font-weight':'bold'});
//                     registermessage.fadeIn(function(){
//                      registermessage.delay(2000).fadeOut(); 
//                     });
//                 }
//                 },
//             error: function(error) {
//                   console.log(error.message);
//                 }
         
//         });
//     });
//     $(".form-login").submit((e)=>{
//         e.preventDefault();
//         $.ajax({
//         url: "index.php?router=UserLogin",
//         method: "POST",
//         data:{username:$("#usernamel").val(),
//         password:$("#passwordl").val(),
//          } ,
//         dataType: "json",
//         success: (res) => {
//             const mes=$('<p>'+res.message+'</p>');
//             loginmessage.empty();
//             loginmessage.append(mes);
//             console.log(res.message)
//             if(res.status=="success"){
//             location.reload();
//             }else {
//                loginmessage.css({'color':'red','font-weight':'bold'});
//                 loginmessage.fadeIn(function(){
//                  loginmessage.delay(2000).fadeOut(); 
//                 });
//             }
//             },
//         error: function(error) {
//               console.log(error.message);
//             }  
//     });
// });

       
//     let typeid=1;
//     let selectedBox=0;
//     let selectedIDs=[];
//     let selectedTypes=[];
//     const marqueSelect = $("#marquev");
//     const modeleSelect = $("#modelev");
//     const annvSelect = $("#annv");
//     const versionSelect = $("#versionv");


//     function equalArrayEle(table){
//         for($i=0;$i<table.length;$i++){
//             for($j=$i+1;$j<table.length;$j++){
//                 if(table[$i] !== table[$j]) return false;
//             }
//         }
//      return true;
//     }


//     $(".add").eq(0).removeClass("disabled");


//     $(".types li:first-child").addClass("selected");

//     $(".types li").click((e)=>{

//         $(".types li").removeClass("selected");
//         $(e.target).addClass("selected");
//         typeid= $(e.target).attr('id') ;
//         console.log(typeid);
//     })


//      //Lister les marques selon le choix de la type de véhicule 
//      $(".add").click((e) => {
//         console.log(typeid);
//         selectedBox= $(".add").index($(e.target));
//         $(".popup-select").show();
//         $(".popup-bg").show();
//             $.ajax({
//                 url: "index.php?router=Marquesall",
//                 method: "POST",
//                 data: {typeid: typeid},
//                 success: (data) => {
//                 var marques = JSON.parse(data);
//                 marqueSelect.empty();
//                 marqueSelect.append('<option selected disabled>Choisir</option>');
//                 modeleSelect.empty();
//                 modeleSelect.append('<option selected disabled>Choisir</option>');
//                 modeleSelect.attr("disabled","disabled");
//                 annvSelect.empty();
//                 annvSelect.append('<option selected disabled>Choisir</option>');
//                 annvSelect.attr("disabled","disabled");
//                 versionSelect.empty();
//                 versionSelect.append('<option selected disabled>Choisir</option>');
//                 versionSelect.attr("disabled","disabled");
//                     $.each(marques, (index, marque) => {
//                         marqueSelect.append('<option value="'+marque.id_marque+'">'+marque.nom+'</option>');
//                     })
//                 }
//             });
//     });


//     //Lister les modeles selon le choix de la marque 
// marqueSelect.change(() => {
//     $.ajax({
//         url: "index.php?router=Modeles",
//         method: "POST",
//         data: {marqueid: marqueSelect.val() },
//         success: (data) => {
//             modeleSelect.removeAttr("disabled");
//            var modeles = JSON.parse(data);
//            modeleSelect.empty();
//            modeleSelect.append('<option selected disabled>Choisir</option>');
//            annvSelect.empty();
//            annvSelect.append('<option selected disabled>Choisir</option>');
//            annvSelect.attr("disabled","disabled");
//            versionSelect.empty();
//            versionSelect.append('<option selected disabled>Choisir</option>');
//            versionSelect.attr("disabled","disabled");
//             $.each(modeles, (index, modele) => {
//                 modeleSelect.append('<option value="'+modele.idmodele+'">'+modele.nom+'</option>');
//             })
//         }
//     });
       
//     });

//   //Lister les années des véhicules disponible  selon le choix du modéle
//     modeleSelect.change(() => {
//         console.log(modeleSelect.val());
//     $.ajax({
//         url: "index.php?router=Years",
//         method: "POST",
//         data: {modeleid: modeleSelect.val() },
//         success: (data) => {
//           annvSelect.removeAttr("disabled");
//           //years récupere les années début et fin des versions de modéle choisi 
//            var years = JSON.parse(data);
//            // ce tableau va contenir tous les années entre début et fin 
//            var tous=[];
//            for(var i=years[0].year;i<=years[years.length -1].year;i++){
//             tous.push(i);
//            }
//            annvSelect.empty();
//            annvSelect.append('<option selected disabled>Choisir</option>');
//            versionSelect.empty();
//            versionSelect.append('<option selected disabled>Choisir</option>');
//            versionSelect.attr("disabled","disabled");
//             $.each(tous, (index, year) => {
//                 //ajouter les options 
//                  annvSelect.append('<option >'+year+'</option>');
//              });
//              //Aprés qu'on choisir une année on va lister les versions disponibles dans cette année
//         }
//     });     
//     });


// annvSelect.change(() => {
//     $.ajax({
//         url: "index.php?router=Versions",
//         method: "POST",
//         data: {modeleid: modeleSelect.val() , year:annvSelect.val() },
//         success: (data) => {
//             versionSelect.removeAttr("disabled");
//            var versions = JSON.parse(data);
//            versionSelect.empty();
//            versionSelect.append('<option selected disabled>Choisir</option>');
//             $.each(versions, (index, version) => {
//                 versionSelect.append('<option value="'+version.idversion+'">'+version.nom+'</option>');
//             })
//         }
//     });    
//     });
//     versionSelect.change(() => {
//         $('.form-compar input[type="submit"]').removeAttr("disabled");
//     });


// $(".close-btn").click(() => {
//     $(".popup-select").hide();
//     $(".popup-login").hide();
//     $(".popup-signup").hide();
//     $(".popup-login-bg").hide();
//     $(".popup-bg").hide();
    
// });


// $(".form-compar").submit((e)=>{
//   e.preventDefault();
//   $.ajax({
//                 url: "index.php?router=Vehicules",
//                 method: "POST",
//                 data: {typeid: typeid,
//                 marqueid: marqueSelect.val(),
//                 modeleid: modeleSelect.val(),
//                 versionid: versionSelect.val()
//                 },
//                 success: (data) => {
//                 var vehicule = JSON.parse(data)[0];
//                 selectedIDs[selectedBox]=vehicule.idvehicule;
//                 selectedTypes[selectedBox]=vehicule.id_type;
//                 var boxv=$('<div class="boxv"></div>');
//                 var imgv='<div class="img-v"><img src="'+vehicule.url+'"/></div>';
//                 var info=$('<div class="info-v"></div>');
//                 var marquemodele=$('<p>'+vehicule.marquen+' '+vehicule.modelen+'</p>');
//                 var version=$('<p>'+vehicule.versionn+'</p>');


//                 $(".popup-select").hide();
//                 $(".popup-bg").hide();
//                 $(".compar-container").eq(selectedBox).hide();
//                 info.append(marquemodele);
//                 info.append(version);
//                 boxv.append(imgv);
//                 boxv.append(info);
//                 $(".compar-v").eq(selectedBox).append(boxv);
//                 $(".add").eq(selectedBox+1).removeClass("disabled");
//                 if (selectedIDs.length>=2 && equalArrayEle(selectedTypes) && !equalArrayEle(selectedIDs)){
//                     $('.comparer input[type="submit"]').removeAttr("disabled");
//                 }
//                 }
//             });
// })

// });
 