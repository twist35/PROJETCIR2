<?php

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


function dbRequestMatch($db, $id)
  {
    try
    {
      $request = 'SELECT p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
      FROM partie p
      JOIN ville v ON p.id_ville = v.id_ville
      WHERE id_partie = :id';
      $statement = $db->prepare($request);
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
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
?>