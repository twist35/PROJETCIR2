/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
*/
'use strict';

ajaxRequest('GET', 'php/requete.php/fs/', (data)=>{
    for (let fs of data){
            $('.fs').append('<option value="' + fs.condition_p + '">'+ fs.condition_p +'</option>');
    }
});