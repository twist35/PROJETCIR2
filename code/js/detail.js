/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
*/
//detail.js
'use strict';

//Récupération de l'id du match en paramètre de l'url
let queryString = window.location.search;
console.log (queryString);
let urlParams = new URLSearchParams (queryString);
let idmatch = urlParams.get('id');
console.log (idmatch);

//Appel des requetes PHP
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

//Fonction test pour débugger certaines requetes
function test(datas){
    console.log(datas)
    /*for(let data of datas){
        console.log(data);
    }*/
}

//Afficher la photo de profil de l'utilisateur sur le bouton profil
function photoProfil(infos){
    for(let info of infos){
        $('#photo-bouton').html('<img src="' + info.photo + '" height="32" width="32" alt="photo profil"></img>');
    }
}

//Afficher les détails du match selectionné
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

//Afficher les participants du match
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

//Gestion du bouton s'inscrire qui apparait ou non selon certaines conditions
function displayBouton(infos){
    console.log(infos);
    if(infos.length != 0){                  //Si l'utilisateur est déjà inscrit
        for(let info of infos){
            if(info.date > info.mtn){
                if(info.valide = 0){
                    $('#inscrire').html('<div class="d-flex  align-items-end flex-row justify-content-center h6 text-marron">' +     //Si l'utilisateur n'est pas encore accepté par l'organisateur du match
                                        '<span id="joueur-orga">En attente de réponse</span>' +
                                        '</div>'
                                        )
                }else{
                    $('#inscrire').html('<div class="d-flex  align-items-end flex-row justify-content-center h6 text-marron">' +    //Si on est déjà accepté par l'organisateur du match
                                        '<span id="joueur-orga">Déjà inscrit !</span>' +
                                        '</div>'
                                        )
                }
    
            }else{
                $('#inscrire').html('<div class="d-flex  align-items-end flex-row justify-content-center h6 text-marron">' +      //Si le match s'est déjà déroulé
                                        '<span id="joueur-orga">Match fini !</span>' +
                                        '</div>'
                                        )
            }
        }
    }else{     //Si l'utilisateur n'est pas encore inscrit alors afficher le bouton s'inscrire
        $('#inscrire').html('<div class="text-center center" >' + 
                            '<button type="submit" onClick=inscrire(' + idmatch + ') id="boutonInscrire" class=" center boutonInscrire btn back-b-marine text-beige"><span id="bouton_inscription">S'+ "'" + 'inscrire</span></button>' +
                            '</div')
    }
    
}

//Mettre un utilisateur qui s'est inscrit en file d'attente
function inscrire(){
    
    console.log('appuyé');
    ajaxRequest('POST', 'php/requete.php/inscription/', inscription, 'idmatch=' + idmatch);
    document.location.href="match.html?id=" + idmatch;
}

//callback
function inscription(){
    
}

//Afficher les matchs que l'utilisateur va organiser
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

//Afficher les matchs que l'utilisateur va jouer
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

//Afficher les matchs que l'utilisateur a déjà organisé
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

//Afficher les matchs que l'utilisateur a déjà joué
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

//Redirige l'utilisateur sur la page du match sur lequel il vient de cliquer
function id_partie(id_partie){
    document.location.href="match.html?id=" + id_partie;
}