/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
*/
//Session.js
'use strict';

//Appel des requêtes PHP
ajaxRequest('GET', 'php/session.php', login);
setInterval(ajaxRequest, 1500, 'GET', 'php/session.php', login);
//ajaxRequest('GET', 'php/session.php', login);

//gérer la connexion d'un utilisateur
function login(data)
{
    let fichier_actuel = window.location.href.replace(/\/$/,"").substring(window.location.href.lastIndexOf('/')+1);
    //console.log(data);
    let connected = false
    if (data != null)
        connected = true; 

    if(connected)   //afficher le bouton profil si connecté
    {
        $("#profil").attr("style", "display: inline !important");
        $("#connexion").attr("style", "display: none !important");
        $("#mes_matchs_recherche").attr("style", "display: inline !important");
        switch(fichier_actuel)
        {
            case 'authentification.html':
            case 'compte.html':
                document.location.href="index.html"; 
                break;
            default:
                break;
        }
    }
    else
    {
        switch(fichier_actuel)
        {
            case 'profil.html':
            case 'organisation.html':
                document.location.href="index.html";
            default:
                break;
        }
        $("#profil").attr("style", "display: none !important");
        $("#connexion").attr("style", "display: inline !important");
        $("#mes_matchs_recherche").attr("style", "display: none !important");
    }
}

//Déconnexion de la session
$('#deconnexion').click(() =>
  {
    console.log("dd");
    ajaxRequest('POST', 'php/session.php', zero, 'deconnexion=vrai');
  }
);

function zero(data){
    console.log(data);
}