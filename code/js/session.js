/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
*/
'use strict';
ajaxRequest('GET', 'php/session.php', login);
setInterval(ajaxRequest, 1500, 'GET', 'php/session.php', login);
//ajaxRequest('GET', 'php/session.php', login);

function login(data)
{


    let fichier_actuel = window.location.href.replace(/\/$/,"").substring(window.location.href.lastIndexOf('/')+1);
    //console.log(data);
    let connected = false
    if (data != null)
        connected = true; 

    if(connected)
    {
        $("#profil").attr("style", "display: inline !important");
        $("#connexion").attr("style", "display: none !important");
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
    }
}

$('#deconnexion').click(() =>
  {
    console.log("dd");
    ajaxRequest('POST', 'php/session.php', zero, 'deconnexion=vrai');
  }
);

function zero(data){
    console.log(data);
}