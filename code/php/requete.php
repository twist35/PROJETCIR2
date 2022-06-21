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

    if ($requestRessource == 'filtreMesMatch')
    {
        
        //if((isset($_POST['ville']) && isset($_POST['sport']) && isset($_POST['date']) && isset($_POST['dispo'])){
            $data = dbRequestFiltreMesMatch($db, $_POST['sport'], $_POST['date'], $_POST['ville'], $_POST['dispo']);
        //}
    }

}

// Match request.

if ($requestMethod == 'GET'){
    if ($requestRessource == 'mesmatchOrganisateur'){
        $data = dbRequestMesMatchO($db);
        }

    if ($requestRessource == 'mesmatchParticipant'){
        $data = dbRequestMesMatchP($db);
        }

    if ($requestRessource == 'lesmatch'){
        $data = dbRequestLesMatch($db);
    }

    if($requestRessource == 'profil')
    {
        $data = dbRequestUser($db, /*'lulu@gmail.com'*/$_SESSION['email']);
    }
    if($requestRessource == 'fs')
    {
        $data =dbFormeSportive($db);
    }
    if($requestRessource == 'typeSport')
    {
        $data =dbTypeSport($db);
    }

}

// Send data to the client.
header('Content-Type: application/json; charset=utf-8');
header('Cache-control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('HTTP/1.1 200 OK');
echo json_encode($data);

exit;

