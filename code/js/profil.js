'use strict';
ajaxRequest('GET', 'php/requete.php/profil/', displayProfil);


function displayProfil(infos){
    for(let info of infos){
        $('#ville_profil').html(info.ville);
        $('.fs').html(info.condition_p);
        
        ajaxRequest('GET', 'php/requete.php/fs/', (data)=>{
            for (let fs of data){
                if (info.condition_p == fs.condition_p)
                $('.fs').append('<option selected value="' + fs.condition_p + '">'+ fs.condition_p +'</option>');
                else
                    $('.fs').append('<option value="' + fs.condition_p + '">'+ fs.condition_p +'</option>');
            }
        });
    }
}

$('#modifier_profil').submit((event) =>
  {
    event.preventDefault();
    ajaxRequest('POST', 'php/requete.php/modifierProfil/', modifierProfil,'ville=' + $('#ville').val() + '&fs=' + $('#fs-t').val() + '&old_mdp=' + $('#old_mdp').val() + '&new_mdp=' + $('#new_mdp').val() + '&avatar=' + $('#avatar').val() +'&note=' + $('#note').val());
  }
);


function modifierProfil(data)
{
    window.alert(data);
}
