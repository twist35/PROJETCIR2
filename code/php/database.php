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

function dbRequestFiltreMesMatchOrga($db, $sport = NULL, $date = NULL, $ville = NULL, $dispo = true)
  {
    try
    {
      $request = 'SELECT p.id_partie, p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
      FROM partie p
      JOIN ville v ON p.id_ville = v.id_ville
      WHERE p.email = :email AND p.nom_sport = :sport AND p.date < :pdate AND v.nom = :ville AND :dispo AND p.date > NOW()';
      //WHERE p.email = 'lulu@gmail.com' AND p.nom_sport = 'Basketball' AND p.date = p.date AND v.nom = 'Quimper' AND p.joueurs_max-p.nb_joueurs > 0 AND p.date > NOW();
      $statement = $db->prepare($request);
      $statement->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
      
      $sportnull = 'p.nom_sport';
      $villenull = 'v.nom';
      

      if($sport != NULL){
        $statement->bindParam(':sport', $sport, PDO::PARAM_STR);
      }else{
        $statement->bindParam(':sport', $sportnull, PDO::PARAM_STR);
      }

      if($date != NULL){
        $statement->bindParam(':pdate', $date, PDO::PARAM_STR);
      }

      if($ville != NULL){
        $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
      }else{
        $statement->bindParam(':ville', $villenull, PDO::PARAM_STR);
      }

      if($dispo != false){
        $dispo = 'p.joueurs_max-p.nb_joueurs > 0';
        $statement->bindParam(':dispo', $dispo, PDO::PARAM_BOOL);
      }else{
        $dispo = 'p.joueurs_max-p.nb_joueurs = 0';
        $statement->bindParam(':dispo', $dispo, PDO::PARAM_BOOL);
      }
      

      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return 'Request error: '.$exception->getMessage();
    }
    return $result;
  }

  function dbRequestFiltreMesMatchParti($db, $sport = NULL, $date = NULL, $ville = NULL, $dispo = true)
  {
    try
    {
      $request = 'SELECT p.id_partie, p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
      FROM partie p
      JOIN ville v ON p.id_ville = v.id_ville
      JOIN user_inscrits i ON p.id_partie = i.id_partie
      WHERE i.valide = 1 AND i.email = :email AND p.nom_sport = :sport AND p.date < :pdate AND v.nom = :ville AND :dispo AND p.date > NOW()';
      //WHERE p.email = 'lulu@gmail.com' AND p.nom_sport = 'Basketball' AND p.date = p.date AND v.nom = 'Quimper' AND p.joueurs_max-p.nb_joueurs > 0 AND p.date > NOW();
      $statement = $db->prepare($request);
      $statement->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
      
      $sportnull = 'p.nom_sport';
      $villenull = 'v.nom';
      

      if($sport != NULL){
        $statement->bindParam(':sport', $sport, PDO::PARAM_STR);
      }else{
        $statement->bindParam(':sport', $sportnull, PDO::PARAM_STR);
      }

      if($date != NULL){
        $statement->bindParam(':pdate', $date, PDO::PARAM_STR);
      }

      if($ville != NULL){
        $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
      }else{
        $statement->bindParam(':ville', $villenull, PDO::PARAM_STR);
      }

      if($dispo != false){
        $dispo = 'p.joueurs_max-p.nb_joueurs > 0';
        $statement->bindParam(':dispo', $dispo, PDO::PARAM_BOOL);
      }else{
        $dispo = 'p.joueurs_max-p.nb_joueurs = 0';
        $statement->bindParam(':dispo', $dispo, PDO::PARAM_BOOL);
      }
      

      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return 'Request error: '.$exception->getMessage();
    }
    return $result;
  }

  function dbRequestFiltreLesMatch($db, $sport = NULL, $date = NULL, $ville = NULL, $dispo = true)
  {
    try
    {
      $request = 'SELECT p.id_partie, p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
      FROM partie p
      JOIN ville v ON p.id_ville = v.id_ville
      WHERE p.nom_sport = :sport AND p.date < :pdate AND v.nom = :ville AND :dispo AND p.date > NOW()';
      //WHERE p.email = 'lulu@gmail.com' AND p.nom_sport = 'Basketball' AND p.date = p.date AND v.nom = 'Quimper' AND p.joueurs_max-p.nb_joueurs > 0 AND p.date > NOW();
      $statement = $db->prepare($request);
      
      $sportnull = 'p.nom_sport';
      $villenull = 'v.nom';
      

      if($sport != NULL){
        $statement->bindParam(':sport', $sport, PDO::PARAM_STR);
      }else{
        $statement->bindParam(':sport', $sportnull, PDO::PARAM_STR);
      }

      if($date != NULL){
        $statement->bindParam(':pdate', $date, PDO::PARAM_STR);
      }

      if($ville != NULL){
        $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
      }else{
        $statement->bindParam(':ville', $villenull, PDO::PARAM_STR);
      }

      if($dispo != false){
        $dispo = 'p.joueurs_max-p.nb_joueurs > 0';
        $statement->bindParam(':dispo', $dispo, PDO::PARAM_BOOL);
      }else{
        $dispo = 'p.joueurs_max-p.nb_joueurs = 0';
        $statement->bindParam(':dispo', $dispo, PDO::PARAM_BOOL);
      }
      

      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return 'Request error: '.$exception->getMessage();
    }
    return $result;
  }

function dbRequestMesMatchO($db)
  {
    try
    {
      $request = 'SELECT p.id_partie, p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
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
      $request = 'SELECT p.id_partie, p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
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

  function dbRequestMesMatchOP($db)
  {
    try
    {
      $request = 'SELECT p.id_partie, p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
      FROM partie p
      JOIN ville v ON p.id_ville = v.id_ville
      WHERE p.email = :email AND p.date < NOW()';
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

function dbRequestMesMatchPP($db)
  {
    try
    {
      $request = 'SELECT p.id_partie, p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
      FROM partie p
      JOIN ville v ON p.id_ville = v.id_ville
      JOIN user_inscrits i ON p.id_partie = i.id_partie
      WHERE i.valide = 1 AND i.email = :email AND p.date < NOW()';
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
      $request = 'SELECT p.id_partie, p.nom_partie, p.nom_sport, p.adresse, v.nom AS "ville", DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs
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
        $request = 'SELECT v.nom as "ville", u.condition_p, u.photo
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

function dbRequestAllMatchsOrga($db)
{
  try{
    $request = 'SELECT * from partie where partie.email = :email;';
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

function dbRequestFileAttente($db, $nb)
{
  try{
    $request = 'SELECT p.nom_partie, p.email ,u.prenom, u.nom FROM partie p
                JOIN user_inscrits i ON i.id_partie = p.id_partie
                JOIN user u ON u.email = i.email
                WHERE i.valide = 0 AND p.id_partie = :id_partie;
    ';
    $statement = $db->prepare($request);
    $statement->bindParam(':id_partie', $nb, PDO::PARAM_STR);
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
      return 'Request error: '.$exception->getMessage();
    }
}
function dbCreerMatch($db, $nom_m, $type, $nb_max, $nb_min, $adresse, $ville, $date, $duree, $prix)
{
  //$email = "anto@gmail.com";
  try{
    $request = 'INSERT INTO partie (nom_partie, nom_sport, joueurs_min, joueurs_max, adresse, id_ville, date, duree, prix, email)
    VALUES (:nom_m, :type_s, :nb_min, :nb_max, :adresse, (SELECT id_ville FROM ville WHERE nom = :ville), :date_m, :duree, :prix, :email)';
    $statement = $db->prepare($request);
    $statement->bindParam(':nom_m', $nom_m, PDO::PARAM_STR);
    $statement->bindParam(':type_s', $type, PDO::PARAM_STR);
    $statement->bindParam(':nb_min', $nb_min, PDO::PARAM_STR);
    $statement->bindParam(':nb_max', $nb_max, PDO::PARAM_STR);
    $statement->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
    $statement->bindParam(':date_m', $date, PDO::PARAM_STR);
    $statement->bindParam(':duree', $duree, PDO::PARAM_STR);
    $statement->bindParam(':prix', $prix, PDO::PARAM_STR);
    $statement->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $statement->execute();
    return "insertion match ok";
}
catch (PDOException $exception)
{
  error_log('Request error: '.$exception->getMessage());
  return 'Request error: '.$exception->getMessage();
}
}
function dbCheckUserExist($db, $email)
{
  try
  {
    $request =' SELECT * from user
    where user.email = :email';
    $statement = $db->prepare($request);
    $statement->bindParam(':email', $email, PDO::PARAM_STR, 20);
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

function dbVille($db)
{
  try
  {
    $request ='SELECT * FROM ville';
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

function dbDetail($db, $id_partie){
  try
  {
    $request = 'SELECT p.id_partie, p.nom_partie, p.nom_sport, p.adresse, p.duree, p.prix, DATE(p.date) AS "date", TIME(p.date) AS "heure", p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs, u.prenom, u.nom, u.photo
    FROM partie p
    JOIN user u ON p.email = u.email
    WHERE id_partie = :idpartie';
    $statement = $db->prepare($request);
    $statement->bindParam(':idpartie', $id_partie, PDO::PARAM_INT);
    

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

function dbParticipants($db, $id_partie){
  try
  {
    $request = 'SELECT u.prenom, u.nom, u.photo FROM user u
    JOIN user_inscrits i ON u.email = i.email
    WHERE i.valide = 1 AND i.id_partie = :idpartie';
    $statement = $db->prepare($request);
    $statement->bindParam(':idpartie', $id_partie, PDO::PARAM_INT);
    

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

function dbButtonTest($db, $id_partie){
  try
  {
    $request = 'SELECT i.valide, p.date, NOW() AS "mtn" FROM user_inscrits i
                JOIN partie p ON p.id_partie = i.id_partie
                WHERE i.email = :email AND i.id_partie = :idpartie';
    $statement = $db->prepare($request);
    $statement->bindParam(':idpartie', $id_partie, PDO::PARAM_INT);
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

function dejaInscrit($db, $id_partie){
  try
  {
    $request = 'SELECT email FROM user_inscrits 
    WHERE email = :email AND id_partie = :idpartie';
    $statement = $db->prepare($request);
    $statement->bindParam(':idpartie', $id_partie, PDO::PARAM_INT);
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

function dbInscription($db, $id_partie){
  try
  {
    $request = 'INSERT INTO user_inscrits (valide, mj, id_partie, email)
                VALUES (0, 0, :idpartie , :email)';
    $statement = $db->prepare($request);
    $statement->bindParam(':idpartie', $id_partie, PDO::PARAM_INT);
    $statement->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);

    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result = 'db OK';
}

function dbTest($db){
    try
    {
      $request = 'SELECT p.adresse, p.duree, p.prix, p.joueurs_max-p.nb_joueurs AS "places_restantes", nb_joueurs, u.prenom, u.nom, u.photo
    FROM partie p
    JOIN user u ON p.email = u.email
    WHERE id_partie = 4';
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
