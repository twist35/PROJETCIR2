'use strict';
ajaxRequest('GET', 'php/requete.php/match/', displayMatch);





function displayMatch(matchs){
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