/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    contient les fonctions pour la creation compte
*/

//creer-compte.js
'use strict';
//Appel des requêtes PHP
ajaxRequest('GET', 'php/requete.php/ville/', displayVille);
ajaxRequest('GET', 'php/requete.php/photo/', displayPhoto);

//Affichage des conditions physiques dans un <select>
ajaxRequest('GET', 'php/requete.php/fs/', (data)=>{
  for (let fs of data){
          $('.fs').append('<option value="' + fs.condition_p + '">'+ fs.condition_p +'</option>');
  }
});

//Insérer les données du nouvel utilisateur
$('#creer-compte').submit((event) =>
  {
    console.log('appuyé');
    event.preventDefault();
    ajaxRequest('POST', 'php/requete.php/creercompte/', InsertCompte,'nom=' + $('#nom').val() + '&prenom=' + $('#prenom').val() + '&email=' + $('#email').val() + '&mdp=' + $('#mdp').val() + '&ville=' + $('#ville').val() + '&fs=' + $('#fs').val() + '&avatar=' + $('#photo').val() + '&date_naissance=' + $('#date_naissance').val());
  }
);

//Vérifier si l'email est déjà utilisé ou non
function InsertCompte(data){
    console.log(data);
    if (data == "email déjà utilisé")
    {
      alert(data);
      document.location.href="index.html";
    }
  }

  //Affichage des villes dans un <select>
  function displayVille(infos){
    for(let ville of infos){
        $('.ville').append('<option value="' + ville.nom + '">'+ ville.nom +'</option>');     
        };
}

//Affichage des photos dans un <select>
function displayPhoto(infos){
  for(let image of infos){
      $('#photo').append('<option value="' + image.photo + '">'+ image.nom_photo +'</option>');     
      };
}