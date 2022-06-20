'use strict';
ajaxRequest('GET', 'php/requete.php/match/', displayMatch);
ajaxRequest('GET', 'php/requete.php/profil/', displayProfil);




function displayMatch(matchs){
    /*for(let match of matchs){
        console.log(match);
        $('#les_matchs').append('<div class="bulle text-center">' +
                                '<div class="d-flex flex-column justify-content-center align-items-center w-100 mx-auto py-3 text-white">' +
                                '<div class="h5">' +);
    }*/
                    
}

function displayProfil(infos){
    for(let info of infos){
        console.log(info);
        $('#ville_profil').html(info.ville);
        $('#fs').html(info.condition_p);
    }
}

function InsertCompte(data){
  console.log(data);
}

//$("#profil").attr("style", "display: none !important");
//                    $("#connexion").attr("style", "display: inline !important");