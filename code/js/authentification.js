/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    contient les fonctions pour l'authentification
*/

'use strict';
$('#se-connecter').submit((event) =>
  {
    console.log('appuyé');
    event.preventDefault();
    ajaxRequest('POST', 'php/requete.php/authentification', Connect, 'email=' + $('#email').val() + '&mdp=' + $('#mdp').val());
  }
);

function Connect(data) 
{
    let email;
    if (data.length == 0)
        email = null;
    else
        email = data[0].email;
        
    console.log(email);        
}