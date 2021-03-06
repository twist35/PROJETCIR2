/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
   contient les fonctions pour afficher les matchs
*/
//display.js
'use strict';
//Appel des requetes PHP
ajaxRequest('GET', 'php/requete.php/profil/', photoProfil);
ajaxRequest('GET', 'php/requete.php/mesmatchOrganisateur/', displayMesMatchOrga);
ajaxRequest('GET', 'php/requete.php/mesmatchParticipant/', displayMesMatchParti);
ajaxRequest('GET', 'php/requete.php/lesmatch/', displayLesMatch);
ajaxRequest('GET', 'php/requete.php/typeSport/', displaySport);
ajaxRequest('GET', 'php/requete.php/ville/', displayVille);
ajaxRequest('GET', 'php/requete.php/test/', test);

//Affiche la photo de profil de l'utilisateur
function photoProfil(infos){
    for(let info of infos){
        $('#photo-bouton').html('<img src="' + info.photo + '" height="32" width="32" alt="photo profil"></img>');
    }
}

//Affiche les villes dans un <select>
function displayVille(infos){
    for(let ville of infos){
        $('.ville').append('<option value="' + ville.nom + '">'+ ville.nom +'</option>');     
        };
        $('.ville').append('<option selected value="' + 'null'+ '">'+'Toutes' +'</option>');
}

//Affiche les sports dans un <select>
function displaySport(data)
{
    for (let sport of data)
        $('.sport').append('<option value="' + sport.nom_sport + '">'+ sport.nom_sport +'</option>');  
        $('.sport').append('<option selected value="' + 'null'+ '">'+'Tous' +'</option>');
}

//Filtre les données du 1er filtre
$('#formulaire-recherche').submit((event) =>
  {
    console.log('appuyé');
    event.preventDefault();
    ajaxRequest('POST', 'php/requete.php/filtreMesMatchOrga/', filtreMesMatchOrga,'sport=' + $('#sport').val() + '&date=' + $('#date_r').val() + '&ville=' + $('#ville').val() + '&dispo=' + $('#dispo').val());
    ajaxRequest('POST', 'php/requete.php/filtreMesMatchParti/', filtreMesMatchParti,'sport=' + $('#sport').val() + '&date=' + $('#date_r').val() + '&ville=' + $('#ville').val() + '&dispo=' + $('#dispo').val());
    }
);

//Filtre les données du 2ème filtre
$('#formulaire-recherche-g').submit((event) =>
  {
    console.log('appuyé');
    event.preventDefault();
    ajaxRequest('POST', 'php/requete.php/filtreLesMatch/', filtreLesMatch,'sport=' + $('#sport_g').val() + '&date=' + $('#date_r_g').val() + '&ville=' + $('#ville_g').val() + '&dispo=' + $('#dispo_g').val());
    }
);

//Affiche les matchs que l'utilisateur va organiser
function displayMesMatchOrga(matchs){
    //console.log(matchs);
    for(let match of matchs){
        //console.log(match);
        //console.log(match.nom_partie)
        $('#mes_matchs').append('<div class="bulle text-center" id="' + match.id_partie + '">' +
                                '<div class="d-flex flex-column justify-content-center align-items-center w-100 mx-auto py-3 text-white">' +
                                '<div class="h5">' +
                                '<span id="num">' + match.nom_partie + '</span>' +  ' | ' +
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
                                '<div class="h6 text-marron">' +
                                '<span id="joueur-orga">Organisateur</span>' +
                                '</div>' +
                                '<button onClick=id_partie(' + match.id_partie + ') class=" bouton-recherche btn back-b-marine text-beige"><span>Détails</span>' +
                                '</div>'
                                );
    }
}

//Affiche les matchs que l'utilisateur va jouer
function displayMesMatchParti(matchs){
    //console.log(matchs);
    for(let match of matchs){
        //console.log(match);
        //console.log(match.nom_partie)
        $('#mes_matchs').append('<div class="bulle text-center" id="' + match.id_partie + '">' +
                                '<div class="d-flex flex-column justify-content-center align-items-center w-100 mx-auto py-3 text-white">' +
                                '<div class="h5">' +
                                '<span id="num">' + match.nom_partie + '</span>' +  ' | ' +
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
                                '<div class="h6 text-marron">' +
                                '<span id="joueur-orga">Joueur</span>' +
                                '</div>' +
                                '<button onClick=id_partie(' + match.id_partie + ') class=" bouton-recherche btn back-b-marine text-beige"><span>Détails</span>' +
                                '</div>'
                                );
    }
}

//Affiche les matchs que l'utilisateur va organiser après avoir été filtrés
function filtreMesMatchOrga(matchs){
    console.log(matchs);
    for(let match of matchs){
        //console.log(match);
        //console.log(match.nom_partie)
        $('#mes_matchs').html('<div class="bulle text-center" id="' + match.id_partie + '">' +
                                '<div class="d-flex flex-column justify-content-center align-items-center w-100 mx-auto py-3 text-white">' +
                                '<div class="h5">' +
                                '<span id="num">' + match.nom_partie + '</span>' +  ' | ' +
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
                                '<div class="h6 text-marron">' +
                                '<span id="joueur-orga">Organisateur</span>' +
                                '</div>' +
                                '<button onClick=id_partie(' + match.id_partie + ') class=" bouton-recherche btn back-b-marine text-beige"><span>Détails</span>' +
                                '</div>'
                                );
    }
    return matchs;
}

//Affiche les matchs que l'utilisateur va jouer après avoir été filtrés
function filtreMesMatchParti(matchs){
    if(filtreMesMatchOrga() != null){
        for(let match of matchs){
            $('#mes_matchs').append('<div class="bulle text-center" id="' + match.id_partie + '">' +
                                    '<div class="d-flex flex-column justify-content-center align-items-center w-100 mx-auto py-3 text-white">' +
                                    '<div class="h5">' +
                                    '<span id="num">' + match.nom_partie + '</span>' +  ' | ' +
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
                                    '<div class="h6 text-marron">' +
                                    '<span id="joueur-orga">Joueur</span>' +
                                    '</div>' +
                                    '<button onClick=id_partie(' + match.id_partie + ') class=" bouton-recherche btn back-b-marine text-beige"><span>Détails</span>' +
                                    '</div>'
                                    );
        }
    }else{
        for(let match of matchs){
            $('#mes_matchs').html('<div class="bulle text-center" id="' + match.id_partie + '">' +
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
                                    '<div class="h6 text-marron">' +
                                    '<span id="joueur-orga">Joueur</span>' +
                                    '</div>' +
                                    '<button onClick=id_partie(' + match.id_partie + ') class=" bouton-recherche btn back-b-marine text-beige"><span>Détails</span>' +
                                    '</div>'
                                    );
        }
    }
    
}

//Affiche les matchs qui vont se dérouler après avoir été filtrés
function filtreLesMatch(matchs){
    console.log(matchs);
    for(let match of matchs){
        //console.log(match);
        //console.log(match.nom_partie)
        $('#les_matchs').html('<div class="bulle text-center" id="' + match.id_partie + '">' +
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
                                '<div class="h6 text-marron">' +
                                '<span id="joueur-orga">Joueur</span>' +
                                '</div>' +
                                '<button onClick=id_partie(' + match.id_partie + ') class=" bouton-recherche btn back-b-marine text-beige"><span>Détails</span>' +
                                '</div>'
                                );
    }
}

//Affiche tous les matchs qui vont se dérouler
function displayLesMatch(matchs){
    for(let match of matchs){
        //console.log(match);
        console.log(match.id_partie)
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
                                '<button onClick=id_partie(' + match.id_partie + ') class=" bouton-recherche btn back-b-marine text-beige"><span>Détails</span>' +
                                '</div>'
                                );
    }
                    
}

//Redirige l'utilisateur sur les détails du match qu'il a choisi
function id_partie(id_partie){

    document.location.href="match.html?id=" + id_partie;

}

function test(datas){
    /*for(let data of datas){
        console.log(data);
    }*/
}