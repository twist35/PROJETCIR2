/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    contient les fonctions pour la page profil
*/
//profil.js
'use strict';

//Appel des requêtes PHP
ajaxRequest('GET', 'php/requete.php/profil/', displayProfil);
ajaxRequest('GET', 'php/requete.php/profil/', photoProfil);
ajaxRequest('GET', 'php/requete.php/ville/', displayVille);
ajaxRequest('GET', 'php/requete.php/photo/', displayPhoto);

//Affiche les informatons du profil
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

//Affiche les villes dans un <select>
function displayVille(infos){
    console.log(infos);
    for(let ville of infos){
        $('.ville').append('<option value="' + ville.nom + '">'+ ville.nom +'</option>');     
        };
}

//Affichage des villes dans un <select>
function displayPhoto(infos){
    for(let image of infos){
        $('#photo').append('<option value="' + image.photo + '">'+ image.nom_photo +'</option>');     
        };
  }

//Affiche la photo de profil de l'utilisateur
function photoProfil(infos){
    for(let info of infos){
        $('#photo-bouton').html('<img src="' + info.photo + '" height="32" width="32" alt="photo profil"></img>');
    }
}

//Récupère les valeurs saisies par l'utilisateur
$('#modifier_profil').submit((event) =>
  {
    event.preventDefault();
    ajaxRequest('PUT', 'php/requete.php/modifierProfil/', modifierProfil,'ville=' + $('#ville').val() + '&fs=' + $('#fs-t').val() + '&old_mdp=' + $('#old_mdp').val() + '&new_mdp=' + $('#new_mdp').val() + '&avatar=' + $('#avatar').val() +'&note=' + $('#note').val());
  }
);

//Vérification du mot de passe
function modifierProfil(data)
{
    if (data == "Changement de mot de passe effectué")
        window.alert(data);
    if (data == "mauvais mdp")
        window.alert(data);
    window.location.reload();
}
