/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    contient les fonctions pour l'authentification
*/
'use strict';

ajaxRequest('GET', 'php/requete.php/fs/', (data)=>{
  for (let fs of data){
          $('.fs').append('<option value="' + fs.condition_p + '">'+ fs.condition_p +'</option>');
  }
});

$('#creer-compte').submit((event) =>
  {
    console.log('appuyé');
    event.preventDefault();
    ajaxRequest('POST', 'php/requete.php/creercompte/', InsertCompte,'nom=' + $('#nom').val() + '&prenom=' + $('#prenom').val() + '&email=' + $('#email').val() + '&mdp=' + $('#mdp').val() + '&ville=' + $('#ville').val() + '&fs=' + $('#fs').val() + '&avatar=' + $('#avatar').val() + '&date_naissance=' + $('#date_naissance').val());
  }
);

function InsertCompte(data){
    console.log(data);
    if (data = "email déjà utilisé")
    {
      alert(data);
      document.location.href="index.html";
    }
  }