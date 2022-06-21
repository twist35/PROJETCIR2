<?php
require_once('database.php');
session_start();

// Database connexion.
$db = dbConnect();
if (!$db)
{
  header ('HTTP/1.1 503 Service Unavailable');
  exit;
}

// Check the request.
$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);

$id = array_shift($request);
  if ($id == '')
    $id = NULL;

$data = false;

if ($requestMethod == 'POST')
{   
    if ($requestRessource == 'authentification')
    {
        if(isset($_POST['email']) && isset($_POST['mdp']))
        {
            $data = dbConnexion($db, $_POST['email'], $_POST['mdp']);
            if ($data != NULL)
            {
                $_SESSION['email'] = $data[0]['email'];
            }
        }
    }
    if ($requestRessource == 'creercompte')
    {
        
        if(isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['ville']) && isset($_POST['fs']) && isset($_POST['date_naissance']))
        {
            dbInsertCompte($db, $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['ville'], $_POST['fs'], $_POST['avatar'], $_POST['date_naissance']);
            $_SESSION['email'] = $_POST['email'];
        }
    }
    if ($requestRessource == 'creerMatch')
    {
        if(isset($_POST['nom_m']) && isset($_POST['type']) && isset($_POST['nb_max']) && isset($_POST['nb_min']) && isset($_POST['adresse']) && isset($_POST['ville'])&& isset($_POST['date'])&& isset($_POST['duree'])&& isset($_POST['prix']))
        $data = dbCreerMatch($db, $_POST['nom_m'], $_POST['type'], $_POST['nb_max'], $_POST['nb_min'], $_POST['adresse'], $_POST['ville'], $_POST['date'], $_POST['duree'], $_POST['prix']);
        
    }
}
if ($requestMethod == 'PUT')
{
    if ($requestRessource == 'modifierProfil')
    {
        
        parse_str(file_get_contents('php://input'), $_PUT);
        if(isset($_PUT['ville']) && isset($_PUT['fs']) && isset($_PUT['old_mdp']) && isset($_PUT['new_mdp']) && isset($_PUT['avatar']) && isset($_PUT['note']))
        {
            $data = dbUpdateUser($db, $_PUT['ville'], $_PUT['fs'],$_PUT['old_mdp'] ,$_PUT['new_mdp'], $_PUT['avatar'], $_PUT['note']);
            //$data= "Changement de mot de passe effectué";
            
        }
        else
            $data = "nono";
    }
    

}
// Match request.

if ($requestMethod == 'GET'){
    if ($requestRessource == 'mesmatchOrganisateur')
        $data = dbRequestMesMatchO($db);

    if ($requestRessource == 'mesmatchParticipant')
        $data = dbRequestMesMatchP($db);

    if ($requestRessource == 'lesmatch')
        $data = dbRequestLesMatch($db);

    if($requestRessource == 'profil')
        $data = dbRequestUser($db, /*'lulu@gmail.com'*/$_SESSION['email']);
    if($requestRessource == 'fs')
        $data =dbFormeSportive($db);
    if($requestRessource == 'typeSport')
        $data =dbTypeSport($db);
    if($requestRessource == 'fileAttente')
    {

        $data = dbRequestFileAttente($db, $id);
        
        //dbRequestAllMatchsOrga($db);
        
    }
    if($requestRessource =='RequestAllAttente')
    {
        $data = array();
        $data1 = dbRequestAllMatchsOrga($db);
        
        $data[0] = $data1;
        for ($num_d = 0; $num_d < count($data1); $num_d++)
        {
            $data[1][$num_d] = dbRequestFileAttente($db, $data1[$num_d]["id_partie"]);
        }       
    }
}

// Send data to the client.
header('Content-Type: application/json; charset=utf-8');
header('Cache-control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('HTTP/1.1 200 OK');
echo json_encode($data);

exit;

