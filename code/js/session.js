'use strict';
ajaxRequest('GET', 'php/session.php', login);

function login(data){
    console.log(data);
    let connected = false
    if (data != null)
        connected = true; 

    if(connected)
    {
        $("#profil").attr("style", "display: inline !important");
        $("#connexion").attr("style", "display: none !important");
    }
    else
    {
        $("#profil").attr("style", "display: none !important");
        $("#connexion").attr("style", "display: inline !important");
    }
}