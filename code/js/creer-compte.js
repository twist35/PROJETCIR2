'use strict';
ajaxRequest('GET', 'php/requete.php/ville/', displayVille);
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

  function displayVille(infos){
    for(let ville of infos){
        $('.ville').append('<option value="' + ville.nom + '">'+ ville.nom +'</option>');     
        };
}