/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
*/
'use strict';

let queryString = window.location.search;
console.log (queryString);
let urlParams = new URLSearchParams (queryString);
let idmatch = urlParams.get('id');
console.log (idmatch);

ajaxRequest('GET', 'php/requete.php/test/' + idmatch, test);
ajaxRequest('GET', 'php/requete.php/profil/', photoProfil);
ajaxRequest('GET', 'php/requete.php/detail/' + idmatch, detail);
ajaxRequest('GET', 'php/requete.php/participants/' + idmatch, participants);
ajaxRequest('GET', 'php/requete.php/buttonTest/' + idmatch, displayBouton);
ajaxRequest('GET', 'php/requete.php/inscription/', inscription);
ajaxRequest('GET', 'php/requete.php/mesmatchOrganisateur/', displayMesMatchOrgaFuturs);
ajaxRequest('GET', 'php/requete.php/mesmatchParticipant/', displayMesMatchPartiFuturs);
ajaxRequest('GET', 'php/requete.php/mesmatchOrganisateurPasses/', displayMesMatchOrgaPasses);
ajaxRequest('GET', 'php/requete.php/mesmatchParticipantPasses/', displayMesMatchPartiPasses);
//ajaxRequest('POST', 'php/requete.php/inscription/', inscription, 'idmatch=' + idmatch);

function test(datas){
    console.log(datas)
    /*for(let data of datas){
        console.log(data);
    }*/
}

function photoProfil(infos){
    for(let info of infos){
        $('#photo-bouton').html('<img src="' + info.photo + '" height="32" width="32" alt="photo profil"></img>');
    }
}

function detail(infos){
    console.log(infos);
    for(let info of infos){
        console.log(info.nom_partie);
        $('#detail').html('<div class="h5">' +
                                '<span id="partie' + info.id_partie + '">' + info.nom_partie + '</span> | ' +
                                '<span id="type">' + info.nom_sport + '</span>' +
                                '</div>' +
                                '<div class="d-flex flex-row justify-content-around w-100">' +
                                '<div>' +
                                '<div>' + info.adresse + '</div>' +
                                '<div>Durée : <span id="duree">' + info.duree + '</span></div>' +
                                '<div>Prix : <span id="prix">' + info.prix + '</span></div>' +
                                '<div class="mt-3">' +
                                'Organisateur : <span id="organisateur">' + info.prenom + ' ' + info.nom + '</span>' +
                                '<img class="rounded-3" id="photo_orga" src="' + info.photo + '" alt="photo profil orga">' +
                                '</div>' +
                                '</div>' +
                                '<div>' +
                                '<div>' + info.date + '</div>' +
                                '<div>' + info.heure + '</div>' +
                                '<div>Places : <span id="places">' + info.places_restantes + '</span></div>' +
                                '<div>Joueurs inscrits : <span id="inscrits">' + info.nb_joueurs + '</span></div>' +
                                '</div>' +
                                '</div>'
                                )
    }
}

function participants(infos){
    //console.log(infos);
    for(let info of infos){
        $('#les_matchs').append('<div class="bulle-joueur text-center">' +
                            '<div class="h6">' + info.prenom + ' ' + info.nom + '</div>' +
                            '<img src="' + info.photo + '" alt="photo profil">' +
                            '</div>'
                                )
    }
}

function displayBouton(infos){
    console.log(infos);
    if(infos.length != 0){
        for(let info of infos){
            if(info.date > info.mtn){
                if(info.valide = 0){
                    $('#inscrire').html('<div class="d-flex  align-items-end flex-row justify-content-center h6 text-marron">' +
                                        '<span id="joueur-orga">En attente de réponse</span>' +
                                        '</div>'
                                        )
                }else{
                    $('#inscrire').html('<div class="d-flex  align-items-end flex-row justify-content-center h6 text-marron">' +
                                        '<span id="joueur-orga">Déjà inscrit !</span>' +
                                        '</div>'
                                        )
                }
    
            }else{
                $('#inscrire').html('<div class="d-flex  align-items-end flex-row justify-content-center h6 text-marron">' +
                                        '<span id="joueur-orga">Match fini !</span>' +
                                        '</div>'
                                        )
            }
        }
    }else{
        $('#inscrire').html('<div class="text-center center" >' + 
                            '<button type="submit" onClick=inscrire(' + idmatch + ') id="boutonInscrire" class=" center boutonInscrire btn back-b-marine text-beige"><span id="bouton_inscription">S'+ "'" + 'inscrire</span></button>' +
                            '</div')
    }
    
}

function inscrire(){
    
    console.log('appuyé');
    ajaxRequest('POST', 'php/requete.php/inscription/', inscription, 'idmatch=' + idmatch);
    document.location.href="match.html?id=" + idmatch;
}

function inscription(){
    
}

function displayMesMatchOrgaFuturs(matchs){
    //console.log(matchs);
    for(let match of matchs){
        //console.log(match);
        //console.log(match.nom_partie)
        $('#mes_matchs_F').append('<div class="bulle text-center" id="' + match.id_partie + '">' +
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

function displayMesMatchPartiFuturs(matchs){
    //console.log(matchs);
    for(let match of matchs){
        //console.log(match);
        //console.log(match.nom_partie)
        $('#mes_matchs_F').append('<div class="bulle text-center" id="' + match.id_partie + '">' +
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

function displayMesMatchOrgaPasses(matchs){
    //console.log(matchs);
    for(let match of matchs){
        //console.log(match);
        //console.log(match.nom_partie)
        $('#mes_matchs_P').append('<div class="bulle text-center" id="' + match.id_partie + '">' +
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

function displayMesMatchPartiPasses(matchs){
    //console.log(matchs);
    for(let match of matchs){
        //console.log(match);
        //console.log(match.nom_partie)
        $('#mes_matchs_P').append('<div class="bulle text-center" id="' + match.id_partie + '">' +
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

function id_partie(id_partie){
    document.location.href="match.html?id=" + id_partie;
}