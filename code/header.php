<!--
    Créé par Antonin SABIRON le 15/06/2022
    Pour le projet de fin d'année CIR2
    Fichier contenant le code html header commun à chaque page du site
-->
<?php
    $connected = true;
    if ($connected)
    {
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/general.css">
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <title>Page1</title>

</head>
<?php
?>

<body>
    <header>
        <nav id="head" class="navbar navbar-expand-lg navbar-light d-flex back-v-b align-items-center flex-column justify-content-center">
            <span class="navbar-brand p-1 text-b-marine ">Match Generator</span>
            <ul id="menu" class="navbar-nav d-flex flex-row justify-content-around align-items-center text-center"> 
                <li class="nav-item  rounded-3 back-b-marine">
                    <a class="nav-link text-beige" href="#">les matchs</a>
                </li>
                <li  id="nav2" class="nav-item  rounded-3 back-b-marine" >
                    <a class="nav-link text-beige"  href="#">créer un match</a>
                </li>
                <li id="connexion" class="nav-item rounded-3 back-b-marine">
                    <a class="nav-link  text-beige" href="#">connexion</a>
                </li>
                <li id="profil" class="nav-item d-flex align-items-center back-b-marine rounded-3 ">
                    <a class="nav-link text-beige" href="#">profil
                        <img id="photo-bouton" src="ressources\img\avatar_t.png" height="32" width="32" alt="photo profil">
                    </a>
                </li>
            </ul>
        </nav>
    </header>
