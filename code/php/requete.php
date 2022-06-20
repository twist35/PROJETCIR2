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
                //$data = $_SESSION['email'];
            }
        }
    }

    if ($requestRessource == 'creercompte'){
        //if(isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['ville']) && isset($_POST['fs']) && isset($_POST['date_naissance'])){
            dbInsertCompte($db, $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['ville'], $_POST['fs'], $_POST['avatar'], $_POST['date_naissance']);
        //}
    }
}

// Match request.
if ($requestMethod == 'GET'){
    if ($requestRessource == 'match'){
        $data = dbRequestMatch($db);
    }

    if($requestRessource == 'profil'){
        $data = dbRequestUser($db, /*'lulu@gmail.com'*/$_SESSION['email']);
    }

    if($requestRessource == 'compte'){
        dbInsertCompte($db, $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['ville'], $_POST['fs'], $_POST['avatar'], $_POST['date_naissance']);
    }
}

// Send data to the client.
header('Content-Type: application/json; charset=utf-8');
header('Cache-control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('HTTP/1.1 200 OK');
echo json_encode($data);

exit;


?>