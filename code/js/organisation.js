'use strict';

ajaxRequest('GET', 'php/requete.php/typeSport/', displaySport);

function displaySport(data)
{
    for (let sport of data)
        $('#type').append('<option selected value="' + sport.nom_sport + '">'+ sport.nom_sport +'</option>');
        
}

$('#origaniser_match').submit((event) =>
  {
    event.preventDefault();
    ajaxRequest('PUT', 'php/requete.php/creerMatch/', creerMatch,'nom_m=' + $('#nom_mm').val() + '&type=' + $('#type').val() + '&nb_max=' + $('#nb_max').val() + '&nb_min=' + $('#nb_min').val() + '&adresse=' + $('#adresse').val() +'&ville=' + $('#ville').val() +'&date=' + $('#date').val() +'&duree=' + $('#duree').val() +'&prix=' + $('#prix').val());
  }
);

function creerMatch(data)
{
    console.log(data);
}