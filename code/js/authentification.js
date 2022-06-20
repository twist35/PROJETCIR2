'use strict';
$('#se-connecter').submit((event) =>
  {
    event.preventDefault();
    ajaxRequest('POST', 'php/requete.php/authentification', Connect, 'email=' + $('#email').val() + '&mdp=' + $('#mdp').val());
  }
);

function Connect(data) 
{
    let email;
    if (data.length == 0)
        email = null;
    else
        email = data[0].email;
        
    console.log(email);        
}