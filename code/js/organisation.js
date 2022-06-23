/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
*/
'use strict';

ajaxRequest('GET', 'php/requete.php/typeSport/', displaySport);
ajaxRequest('GET', 'php/requete.php/profil/', photoProfil);
ajaxRequest('GET', 'php/requete.php/RequestAllAttente/', displayAll);
ajaxRequest('GET', 'php/requete.php/mesmatchOrganisateurPassesOrga/', displayStat);
ajaxRequest('GET', 'php/requete.php/ville/', displayVille);

function photoProfil(infos){
  for(let info of infos){
      $('#photo-bouton').html('<img src="' + info.photo + '" height="32" width="32" alt="photo profil"></img>');
  }
}

function displayVille(infos){
  for(let ville of infos){
      $('.ville').append('<option value="' + ville.nom + '">'+ ville.nom +'</option>');     
      };
}

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
}

function displayStat(data)
{
  console.log(data);
  for (let i =0; i < data[0].length; i++){
    let chaine_attente= '<form>\
    <div class="d-flex flex-row justify-content-between p-1">\
        <div>\
            <div>\
                Score équipe A\
            </div>\
            <div>\
                <input type="number" class="form-control" id="scoreA" name="scoreA" placeholder="'+data[0][i].score_a +'"required>\
            </div>\
        </div>\
        <div class="mx-auto">\
            <div>\
                Score équipe B\
            </div>\
            <div >\
                <input type="number" class="form-control  center" id="scoreB" placeholder="'+ data[0][i].score_b +'" name="scoreB" required>\
            </div>\
        </div>\
    </div>\
    ';
    

    
    
      $("#les_matchs_stat").append('\
      <div class= "bulle-attente text-center px-3">\
      <form class="changer_stat" action="">\
          <div class="h6 mt-1"><span id="num_attente">'+ data[0][i].nom_partie+'</span>\ |\
              <span id="type_stat">'+ data[0][i].nom_sport+'</span>\
          </div>\
          <div  id="liste_attente">\
          '+ 
            chaine_attente
          
          + '\
          </div>\
          <\div>\
          <div class="d-flex flex-column justify-content-between p-1">\
                    <div>\
                        Meilleur joueur\
                    </div>\
                    <div>\
                        <input type="text" class="form-control center mb-1" id="prenom_'+data[1][0][i].prenom+'" value="'+data[1][0][i].prenom+'" placeholder="'+ data[1][0][i].prenom+'" required>\
                        <input type="text" class="form-control center" id="nom_'+data[1][0][i].nom+'" value="'+data[1][0][i].nom+'" placeholder="'+ data[1][0][i].nom+'" required>\
                    </div>\
                    <button type="bouton"'+
                     //onClick=id_changeStats(' + data[0][i].id_partie +','+ $('#nom_'+data[1][0][i].nom).val() +')
                      'id="valider" class="btn btn-sm back-b-marine text-beige mt-2 valider">Valider</button>\
                </div>\
                </form>\
              ');
              console.log($('#nom_'+data[1][0][i].nom).val());
  }
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
  
  $('.changer_stat').submit((event) =>{
    console.log($('.changer_stat').val());
  });



}, 50);



function creerMatch(data)
{
    console.log(data);
}
function id_changeStats(data, nb)
{
  console.log(nb);
  ajaxRequest('PUT', 'php/requete.php/changerStats/', (data1)=>{

    console.log(data1);
  },"id=" + data);
}