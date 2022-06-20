'use strict';
ajaxRequest('GET', 'php/requete.php/mesmatchOrganisateur/', displayMesMatchOrga);
ajaxRequest('GET', 'php/requete.php/mesmatchParticipant/', displayMesMatchParti);
ajaxRequest('GET', 'php/requete.php/lesmatch/', displayLesMatch);
ajaxRequest('GET', 'php/requete.php/profil/', displayProfil);


function displayMesMatchOrga(matchs){
    console.log(matchs);
    for(let match of matchs){
        //console.log(match);
        //console.log(match.nom_partie)
        $('#mes_matchs').append('<div class="bulle text-center">' +
                                '<div class="d-flex flex-column justify-content-center align-items-center w-100 mx-auto py-3 text-white">' +
                                '<div class="h5">' +
                                '<span id="num">' + match.nom_partie + '</span>' +
                                '<span id="type">' + match.nom_sport + '</span>' +
                                '</div>' +
                                '<div class="d-flex flex-row justify-content-around w-100 pt-4">' +
                                '<div>' +
                                '<div id="ville">' + match.ville + '</div>' +
                                '<div id="date">' + match.date + '</div>' +
                                '<div id="heure">' + match.heure + '</div>' +
                                '</div>' +
                                '<div>' +  
                                '<div>Places : <span id="places">' + match.places_restantes + '</span></div>' +
                                '<div>Joueurs inscrits : <span id="inscrits">' + match.nb_joueurs + '</span></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                                );
    }
}

function displayMesMatchParti(matchs){
    console.log(matchs);
    for(let match of matchs){
        //console.log(match);
        //console.log(match.nom_partie)
        $('#mes_matchs').append('<div class="bulle text-center">' +
                                '<div class="d-flex flex-column justify-content-center align-items-center w-100 mx-auto py-3 text-white">' +
                                '<div class="h5">' +
                                '<span id="num">' + match.nom_partie + '</span>' +
                                '<span id="type">' + match.nom_sport + '</span>' +
                                '</div>' +
                                '<div class="d-flex flex-row justify-content-around w-100 pt-4">' +
                                '<div>' +
                                '<div id="ville">' + match.ville + '</div>' +
                                '<div id="date">' + match.date + '</div>' +
                                '<div id="heure">' + match.heure + '</div>' +
                                '</div>' +
                                '<div>' +  
                                '<div>Places : <span id="places">' + match.places_restantes + '</span></div>' +
                                '<div>Joueurs inscrits : <span id="inscrits">' + match.nb_joueurs + '</span></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                                );
    }
}

function displayLesMatch(matchs){
    for(let match of matchs){
        //console.log(match);
        //console.log(match.nom_partie)
        $('#les_matchs').append('<div class="bulle text-center">' +
                                '<div class="d-flex flex-column justify-content-center align-items-center w-100 mx-auto py-3 text-white">' +
                                '<div class="h5">' +
                                '<span id="num">' + match.nom_partie + '</span>' + ' | ' +
                                '<span id="type">' + match.nom_sport + '</span>' +
                                '</div>' +
                                '<div class="d-flex flex-row justify-content-around w-100 pt-4">' +
                                '<div>' +
                                '<div id="ville">' + match.ville + '</div>' +
                                '<div id="date">' + match.date + '</div>' +
                                '<div id="heure">' + match.heure + '</div>' +
                                '</div>' +
                                '<div>' +  
                                '<div>Places : <span id="places">' + match.places_restantes + '</span></div>' +
                                '<div>Joueurs inscrits : <span id="inscrits">' + match.nb_joueurs + '</span></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                                );
    }
                    
}

function displayProfil(infos){
    for(let info of infos){
        console.log(info);
        $('#ville_profil').html(info.ville);
        $('#fs').html(info.condition_p);
        
        ajaxRequest('GET', 'php/requete.php/fs/', (data)=>{
            for (let fs of data){
                console.log(fs);
                if (info.condition_p == fs.condition_p)
                $('#fs_select').append('<option selected value="' + fs.condition_p + '">'+ fs.condition_p +'</option>');
                else
                    $('#fs_select').append('<option value="' + fs.condition_p + '">'+ fs.condition_p +'</option>');
            }
        });
    }
}

function InsertCompte(data){
  console.log(data);
}

//$("#profil").attr("style", "display: none !important");
//                    $("#connexion").attr("style", "display: inline !important");
