'use strict';
ajaxRequest('GET', 'php/requete.php/match/', displayMatch);
ajaxRequest('GET', 'php/requete.php/profil/', displayProfil);
/*$('#creer-compte').submit((event) =>
  {
    console.log('appuyé');
    event.preventDefault();
    ajaxRequest('POST', 'php/requete.php/creercompte/', InsertCompte,'nom=' + $('#nom').val() + '&prenom=' + $('#prenom').val() + '&email=' + $('#email').val() + '&mdp=' + $('#mdp').val() + '&ville=' + $('#ville').val() + '&fs=' + $('#fs').val() + '&avatar=' + $('#avatar').val() + '&date_naissance=' + $('#date_naissance').val());
  }
);*/


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

/*function InsertCompte(){

}*/

//$("#profil").attr("style", "display: none !important");
//                    $("#connexion").attr("style", "display: inline !important");