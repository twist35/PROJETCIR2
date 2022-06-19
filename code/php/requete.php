<?php
require_once('database.php');

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
        if(isset($_POST['login']) && isset($_POST['mdp']))
        {
            $data = dbConnexion($db, $_POST['login'], $_POST['mdp']);
            if ($data != NULL)
            {
                session_start();
                $_SESSION['email'] = $data[0]['email'];
                //$data = $_SESSION['email'];

            }
            
        }
            
    }
}


// Match request.
if ($requestRessource == 'match'){
    $data = dbRequestMatch($db, 1);
}

if($requestRessource == 'profil'){
    $data = dbRequestUser($db, 'lulu@gmail.com');
}

if($requestRessource == 'compte'){
    dbInsertCompte($db, $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['ville'], $_POST['fs'], $_POST['avatar'], $_POST['date_naissance']);
}

if ($requestRessource == 'login'){
    session_start();
    if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
    } else {
    $_SESSION['count']++;
    }
    $data = $_SESSION['count'];
}

// Send data to the client.
header('Content-Type: application/json; charset=utf-8');
header('Cache-control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('HTTP/1.1 200 OK');
echo json_encode($data);

exit;


?>