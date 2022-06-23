<?php
/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    contient les fonctions pour les connexions et la déconnexions
*/
session_start();
$data = null;

    if(isset($_POST['deconnexion']) ) // si on est deconncté on clear les variables de $_SESSION 
    {
        unset($_SESSION['deconnexion']);
        unset($_SESSION['email']);
        $data = "deconnexion effectuée";
    }
    else
    {
        if (isset($_SESSION['email']))
        $data = $_SESSION['email'];
    }
    
echo json_encode($data); // on renvoie l'email avec lequel on est connecté

header('Content-Type: application/json; charset=utf-8');
header('Cache-control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('HTTP/1.1 200 OK');