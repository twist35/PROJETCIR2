<?php
/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    contient les différentes requetes pour ensuitre contacter la base de données
*/
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

$data = false; // contient les valeursà encoder en JSON à la fin de ce fichier

if ($requestMethod == 'POST') // si la requete est du POST
{   
    if ($requestRessource == 'authentification') 
    {
        if(isset($_POST['email']) && isset($_POST['mdp']))
        {
            $data = dbConnexion($db, $_POST['email'], $_POST['mdp']);
            if ($data != NULL)
                $_SESSION['email'] = $data[0]['email'];
        }
    }
    if ($requestRessource == 'creercompte')
    {
        if(isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['ville']) && isset($_POST['fs']) && isset($_POST['date_naissance']))
        {
            if($_POST['avatar'] == "") // image par défaut
                $_POST['avatar'] = 'ressources/img/image-vide.jpg';

            $temp = dbCheckUserExist($db, $_POST['email']); // si l'email est délà prit
            if ($temp == NULL) // si le mail est libre
            {
                dbInsertCompte($db, $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['ville'], $_POST['fs'], $_POST['avatar'], $_POST['date_naissance']);
                $_SESSION['email'] = $_POST['email'];
            }
            else
            $data = "email déjà utilisé";
        }
    }
    if ($requestRessource == 'creerMatch')
    {
        if(isset($_POST['nom_m']) && isset($_POST['type']) && isset($_POST['nb_max']) && isset($_POST['nb_min']) && isset($_POST['adresse']) && isset($_POST['ville'])&& isset($_POST['date'])&& isset($_POST['duree'])&& isset($_POST['prix']))
            $data = dbCreerMatch($db, $_POST['nom_m'], $_POST['type'], $_POST['nb_max'], $_POST['nb_min'], $_POST['adresse'], $_POST['ville'], $_POST['date'], $_POST['duree'], $_POST['prix']);
        
    }
    if ($requestRessource == 'filtreMesMatchOrga')
    {
        if(isset($_POST['ville']) && isset($_POST['sport']) && isset($_POST['date']) && isset($_POST['dispo'])){
            $data = dbRequestFiltreMesMatchOrga($db, $_POST['sport'], $_POST['date'], $_POST['ville'], $_POST['dispo']);
        }
    }

    if ($requestRessource == 'filtreMesMatchParti')
    {
        if(isset($_POST['ville']) && isset($_POST['sport']) && isset($_POST['date']) && isset($_POST['dispo'])){
            $data = dbRequestFiltreMesMatchParti($db, $_POST['sport'], $_POST['date'], $_POST['ville'], $_POST['dispo']);
        }
    }

    if ($requestRessource == 'filtreLesMatch')
    {
        if(isset($_POST['ville']) && isset($_POST['sport']) && isset($_POST['date']) && isset($_POST['dispo'])){
            $data = dbRequestFiltreLesMatch($db, $_POST['sport'], $_POST['date'], $_POST['ville'], $_POST['dispo']);
        }
    }

    if($requestRessource == 'inscription')
    {
        if(isset($_POST['idmatch'])){
            if(empty(dejaInscrit($db, $_POST['idmatch']))) // verification si on déjà inscrit
            {
                dbInscription($db, $_POST['idmatch']);
                $data = 'vous etes inscrit';
            }else
                $data = 'vous etes deja inscrit';
            
        }
    }
}
if ($requestMethod == 'PUT') // si on demand du PUT
{
    if ($requestRessource == 'modifierProfil')
    {
        parse_str(file_get_contents('php://input'), $_PUT);
        if(isset($_PUT['ville']) && isset($_PUT['fs']) && isset($_PUT['old_mdp']) && isset($_PUT['new_mdp']) && isset($_PUT['avatar']) && isset($_PUT['note']))
        {
            $data = dbUpdateUser($db, $_PUT['ville'], $_PUT['fs'],$_PUT['old_mdp'] ,$_PUT['new_mdp'], $_PUT['avatar'], $_PUT['note']);
            $data= "Changement effectué";
        }
        else
            $data = "erreur lors de la modification";
    }
    if ($requestRessource =='changerStats')
    {
        parse_str(file_get_contents('php://input'), $_PUT);
        if(isset($_PUT['id']))
            $data = $_PUT; // fonction par terminer, à coder
    }
}

// Match request.

if ($requestMethod == 'GET') // si on demande du GET
{
    if ($requestRessource == 'mesmatchOrganisateur')
        $data = dbRequestMesMatchO($db);
        
    if ($requestRessource == 'mesmatchParticipant')
        $data = dbRequestMesMatchP($db);
        
    if ($requestRessource == 'mesmatchOrganisateurPasses')
        $data = dbRequestMesMatchOP($db);

    // utilisation d'un double tableau pour retourner les informations 
    if ($requestRessource == 'mesmatchOrganisateurPassesOrga')                                                                 
    {
        $data[0] = dbRequestMesMatchOP($db);
        for ($num_d = 0; $num_d < count($data[0]) ; $num_d++) 
           $data[1][$num_d] = dbRequestFileAttente($db, $data[0][$num_d]["id_partie"]);
    }
    
    if ($requestRessource == 'mesmatchParticipantPasses')
        $data = dbRequestMesMatchPP($db);

    if ($requestRessource == 'lesmatch')
        $data = dbRequestLesMatch($db);

    if($requestRessource == 'profil')
        $data = dbRequestUser($db, $_SESSION['email']);
        
    if($requestRessource == 'fs')
        $data =dbFormeSportive($db);

    if($requestRessource == 'ville')
        $data =dbVille($db);

    if($requestRessource == 'typeSport')
        $data =dbTypeSport($db);

    if($requestRessource == 'fileAttente')
        $data = dbRequestFileAttente($db, $id);        

    // utilisation d'un double tableau pour retourner les informations 
    if($requestRessource =='RequestAllAttente')
    {
        $data = array();
        $data1 = dbRequestMesMatchO($db); // les matchs organisé
        
        $data[0] = $data1;
        for ($num_d = 0; $num_d < count($data1); $num_d++)
        {
            $data[1][$num_d] = dbRequestFileAttente($db, $data1[$num_d]["id_partie"]); // chaque file d'attente
        }
    } 

    if($requestRessource == 'detail')
        $data = dbDetail($db, $id);

    if($requestRessource == 'participants')
        $data = dbParticipants($db, $id);

    if($requestRessource == 'buttonTest')
        $data = dbButtonTest($db, $id);

    if($requestRessource == 'photo')
        $data = dbPhoto($db);

    if($requestRessource == 'test')
        $data = dbTest($db, $id);
}

// Send data to the client.
header('Content-Type: application/json; charset=utf-8');
header('Cache-control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('HTTP/1.1 200 OK');
echo json_encode($data);

exit;