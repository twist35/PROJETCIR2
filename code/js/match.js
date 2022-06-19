'use strict';
ajaxRequest('GET', 'php/requete.php/match/', displayMatch);
ajaxRequest('GET', 'php/requete.php/profil/', displayProfil);
//ajaxRequest('POST', 'php/requete.php/compte/', InsertCompte);

function displayMatch(match){
    console.log("cc2");
                    
}

function displayProfil(infos){
    for(let info of infos){
        console.log(info);
        $('#ville_profil').html(info.ville);
        $('#fs').html(info.condition_p);
    }
}

/*function InsertCompte(){
    

    $('#ville_profil').change((event) => 
    {
        ajaxRequest('GET', 'php/requete.php/profil/' + S(event.target).val(), displayProfil);
    });
}*/
//$("#profil").attr("style", "display: none !important");
//                    $("#connexion").attr("style", "display: inline !important");