'use strict';

ajaxRequest('GET', 'php/requete.php/typeSport/', displaySport);

ajaxRequest('GET', 'php/requete.php/RequestAllAttente/', displayAll);

function displayAll(data)
{

  //console.log(data);
  for (let match of data[0]){
    //console.log(match);

    let chaine_attente= '';
    for (let liste_attente of data[1])
    {
      if (liste_attente.length != 0 )
      {
        //console.log(liste_attente);
        for (let p_inscrit of liste_attente)
        {
          if(p_inscrit.nom_partie == match["nom_partie"])
          {
            //console.log(p_inscrit);
            chaine_attente +='<div class="d-flex flex-row justify-content-between border-bottom border-dark p-1">\
                            <div>\
                              <span id="prenom_attente">'+ p_inscrit.prenom+' </span><span id="nom_attente">'+ p_inscrit.nom+'</span>\
                            </div>\
                            <div>\
                              <button type="button" id="refuser" value="'+ p_inscrit.nom +'" class=" btn  btn-sm back-b-marine text-beige refuser">Refuser</button>\
                              <button type="button" id="accepter" value="'+ p_inscrit.nom +'" class=" btn btn-sm back-b-marine text-beige accepter">Accepter</button>\
                            </div>\
                          </div>\
            ';
          }
          
        }
      }
      /*else //gestion si personne // ne marche pas
          {
            chaine_attente += '<div class="d-flex flex-row justify-content-between border-bottom border-dark p-1 text-center">\
                                <div> Personne en attente !\
                                </div>\
                                </div>\
                              ';
          }*/
    }

    
    
      $("#les_matchs").append('\
      <div class= "bulle-attente text-center px-3">\
      <form action="">\
          <div class="h6 mt-1"><span id="num_attente">'+ match.nom_partie+'</span>\ |\
              <span id="type_attente">'+ match.nom_sport+'</span>\
          </div>\
          <div  id="liste_attente">\
          '+ 
            chaine_attente
          
          + '\
          </div>\
          </form>\
          <\div>\
              ');
  }

  console.log('================================');
}

function displaySport(data)
{
    for (let sport of data)
        $('#type').append('<option selected value="' + sport.nom_sport + '">'+ sport.nom_sport +'</option>');  
}

$('#origaniser_match').submit((event) =>
  {
    event.preventDefault();
    ajaxRequest('POST', 'php/requete.php/creerMatch/', creerMatch,'nom_m=' + $('#nom_m').val() + '&type=' + $('#type').val() + '&nb_max=' + $('#nb_max').val() + '&nb_min=' + $('#nb_min').val() + '&adresse=' + $('#adresse').val() +'&ville=' + $('#ville').val() +'&date=' + $('#date').val() +'&duree=' + $('#duree').val() +'&prix=' + $('#prix').val());
  }
);
$('#liste_attente').click((event) =>
  {
    event.preventDefault();
    console.log("cliked");
    //ajaxRequest('POST', 'php/requete.php/creerMatch/', creerMatch,'nom_m=' + $('#nom_m').val() + '&type=' + $('#type').val() + '&nb_max=' + $('#nb_max').val() + '&nb_min=' + $('#nb_min').val() + '&adresse=' + $('#adresse').val() +'&ville=' + $('#ville').val() +'&date=' + $('#date').val() +'&duree=' + $('#duree').val() +'&prix=' + $('#prix').val());
  }
);

setTimeout(()=>
{
  console.log("tt");
  $('.refuser').click(() =>{
  console.log("refuser " + $('.refuser').val());
  console.log("refuser " + $('.refuser').html());
  });
  $('.accepter').click(() =>{
    console.log("accepter " + $('.accepter').val());
  });
  $('.accepter').val('Test');

}, 50);



function creerMatch(data)
{
    console.log(data);
}