<?php

use LDAP\Result;

require_once('constants.php');

//----------------------------------------------------------------------------
//--- dbConnect --------------------------------------------------------------
//----------------------------------------------------------------------------
// Create the connection to the database.
// \return False on error and the database otherwise.
function dbConnect()
{
  try
  {
    $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8',
      DB_USER, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
  }
  catch (PDOException $exception)
  {
    error_log('Connection error: '.$exception->getMessage());
    return false;
  }
  return $db;
}

function dbRequestMesMatchO($db)
  {
    try
    {
      $request = 'SELECT p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
      FROM partie p
      JOIN ville v ON p.id_ville = v.id_ville
      WHERE p.email = :email AND p.date > NOW()';
      $statement = $db->prepare($request);
      $statement->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
  }

function dbRequestMesMatchP($db)
  {
    try
    {
      $request = 'SELECT p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
      FROM partie p
      JOIN ville v ON p.id_ville = v.id_ville
      JOIN user_inscrits i ON p.id_partie = i.id_partie
      WHERE i.valide = 1 AND i.email = :email AND p.date > NOW()';
      $statement = $db->prepare($request);
      $statement->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
  }


function dbRequestLesMatch($db)
  {
    try
    {
      $request = 'SELECT p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
      FROM partie p
      JOIN ville v ON p.id_ville = v.id_ville
      WHERE p.date > NOW()';
      $statement = $db->prepare($request);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
  }

function dbRequestUser($db, $email){
    try{
        $request = 'SELECT v.nom as "ville", u.condition_p
        FROM ville v
        JOIN user u ON v.id_ville = u.id_ville
        WHERE u.email = :email';
        $statement = $db->prepare($request);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
}

function dbInsertCompte($db, $nom, $prenom, $email, $mdp, $ville, $fs, $photo, $naissance){
    try{
        $request = 'INSERT INTO user (nom, prenom, email, mdp, id_ville, condition_p, photo, date_naissance) VALUES
        (:prenom, :nom, :email, :mdp, (SELECT id_ville FROM ville WHERE nom = :ville), :fs, :photo, :naissance)';
        $statement = $db->prepare($request);
        $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $statement->bindParam(':fs', $fs, PDO::PARAM_STR);
        $statement->bindParam(':photo', $photo, PDO::PARAM_STR);
        $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
        $statement->bindParam(':naissance', $naissance, PDO::PARAM_STR);
        $statement->execute();
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
}

function dbConnexion($db, $email, $mdp)
{
  try
  {
    $request =' SELECT email FROM user
    WHERE email = :email
    AND mdp = :mdp';
    $statement = $db->prepare($request);
    $statement->bindParam(':email', $email, PDO::PARAM_STR, 20);
    $statement->bindParam(':mdp', $mdp, PDO::PARAM_STR, 20);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result;
}


function dbFormeSportive($db)
{
  try
  {
    $request ='SELECT * FROM condition_physique';
    $statement = $db->prepare($request);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result;
}

function dbTypeSport($db)
{
  try
  {
    $request ='SELECT * FROM sport';
    $statement = $db->prepare($request);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result;
}

function dbUpdateUser($db, $ville = NULL, $fs = NULL, $old_mdp = NULL ,$mdp = NULL, $avatar = NULL, $note = NULL)
{
  try{
    $request = 'SELECT v.nom as "ville", u.condition_p, u.mdp, u.photo, u.note_site 
                FROM ville v 
                JOIN user u ON v.id_ville = u.id_ville 
                WHERE u.email = :email;
                ';

    $statement = $db->prepare($request);
    $statement->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $statement->execute();
    $info_old = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    $result = $info_old;

    if ($info_old[0]['mdp'] != $old_mdp)
      $result = "mauvais mdp";
    
    if ($ville == NULL)
      $ville = $info_old[0]['ville'];
    if ($fs == NULL)
      $fs = $info_old[0]['condition_p'];
    if ($mdp == NULL)
      $mdp = $info_old[0]['mdp'];
    if ($avatar == NULL)
      $avatar = $info_old[0]['photo'];
    if ($note == NULL)
      $note = $info_old[0]['note_site'];




  try
  {
    $request ='UPDATE user 
    SET id_ville = (SELECT id_ville FROM ville WHERE nom = :ville),
        condition_p = :fs,
        note_site = :note,
        mdp = :mdp,
        photo = :avatar
        WHERE user.email = :email;';
    
    $statement = $db->prepare($request);
    $statement->bindParam(':fs', $fs, PDO::PARAM_STR, 20);
    $statement->bindParam(':note', $note, PDO::PARAM_STR, 20);
    $statement->bindParam(':mdp', $mdp, PDO::PARAM_STR, 20);
    $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR, 20);
    $statement->bindParam(':ville', $ville, PDO::PARAM_STR, 20);
    $statement->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR, 20);

    $result = $statement->execute();
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return 'Request error: '.$exception->getMessage();
  }
  return $result;
}