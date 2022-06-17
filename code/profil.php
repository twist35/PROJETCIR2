<!--
    Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    Fichier contenant le profil
-->
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
    <script src="js/ajax.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"
      integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>

    <title>Page1</title>

</head>

<body class="back">   
    <header>
        <nav id="head" class="navbar navbar-expand-lg navbar-light d-flex back-v-b align-items-center flex-column justify-content-center">
            <a href="index.html" class="nav-link"><span class="h1  text-b-marine">Match Generator</span></a>
            <ul id="menu" class="navbar-nav d-flex flex-row justify-content-around align-items-center text-center"> 
                <li class="nav-item  rounded-3 back-b-marine">
                    <a class="nav-link text-beige" href="index.html">les matchs</a>
                </li>
                <li  id="nav2" class="nav-item  rounded-3 back-b-marine" >
                    <a class="nav-link text-beige"  href="organisation.html">créer un match</a>
                </li>
                <li id="connexion" class="nav-item rounded-3 back-b-marine">
                    <a class="nav-link  text-beige" href="authentification..html">connexion</a>
                </li>
                <li id="profil" class="nav-item back-b-marine rounded-3 ">
                    <a class="nav-link text-beige" href="profil.html">profil
                        <img id="photo-bouton" src="ressources\img\avatar_t.png" height="32" width="32" alt="photo profil">
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <div id="page" class="back">
    <script>
            $connected = true; // valeur a modifier si on est connecter
            if($connected)
            {
                $("#profil").attr("style", "display: inline !important");
                $("#connexion").attr("style", "display: none !important");
                console.log("cc1");
            }
            else
            {
                $("#profil").attr("style", "display: none !important");
                $("#connexion").attr("style", "display: inline !important");
                console.log("cc2");
            }

    </script>
<div class="titre-page back-b-marine text-center h2 text-marron py-1">
    Profil
</div>
<form class="text-center center d-flex justify-content-center flex-column align-items-center">
  <div class="form-group vw-60 mb-2">
    <div>Ville : <span id="ville_profil"></span></div>
    <label for="ville"></label>
    <small class="form-text text-muted">Modifier votre ville :</small>
    <input type="text" class="form-control" id="ville" placeholder="Entrer ville">
  </div>
  <div class="form-group vw-60 mb-2">
    <div>Forme sportive : <span id="fs"></span></div>
    <label for="fs"></label>
    <small class="form-text text-muted">Modifier votre forme sportive :</small>
    <select>
        <option>A</option>
        <option>B</option>
        <option>C</option>
        <option>D</option>
    </select>
  </div>
  <div class="form-group vw-60 mb-2">
    <div>Noter le site</div>
    <label for="note"></label>
    <small class="form-text text-muted">Mettre une note au site</small>
    <select >
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
    </select>
  </div>
  <div class="form-group vw-60 mb-2">
    <div>Mot de passe</div>
    <label for="mdp"></label>
    <small class="form-text text-muted  text-b-marine">Modifier votre mot de passe :</small>
    <input type="text" class="form-control mb-2" id="old_mdp" placeholder="Entrer l'ancien mot de passe">
    <input type="text" class="form-control " id="new_mdp" placeholder="Entrer le nouveau mot de passe">
  </div>
  <div class="form-group vw-60 mb-2">
    <div id="pdp text-b-marine">Photo de Profil</div>
    <label for="pdp"></label>
    <small class="form-text text-muted ">Modifier votre photo de profil :</small>
    <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">
  </div>
  <button type="submit" class="btn back-b-marine text-beige ">Valider</button>
</form>

</div>
    <footer class=" back-v-b">

    <div class="text-center p-2 align-text-bottom mt-3 py-3">
        Projet CIR2 | Antonin SABIRON - Lucas LE BIHAN
    </div>
</footer>