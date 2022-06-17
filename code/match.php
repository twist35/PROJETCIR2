<!--
    Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    Fichier contenant les matchs
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
    Détail du Match
</div>
Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente, eaque aliquam debitis at odio laborum eveniet mollitia quasi quos porro nisi voluptatibus ut dicta veniam eligendi tempore obcaecati similique excepturi.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium nisi ligula, a feugiat purus rhoncus sed. Praesent tempus quis nibh at gravida. Integer leo nisi, feugiat ut leo quis, dapibus scelerisque odio. Proin id leo ultricies, elementum lorem vel, interdum velit. Praesent magna leo, efficitur quis leo sed, ullamcorper lobortis libero. Suspendisse a imperdiet dolor, aliquam imperdiet nunc. Quisque pellentesque sit amet nunc quis condimentum. Aliquam consequat urna sit amet orci egestas, eu varius mi iaculis.

Sed a mollis turpis. Nulla rutrum urna bibendum erat aliquet, vitae sodales arcu fringilla. Nullam nulla nisl, accumsan cursus suscipit ac, molestie quis nisl. Phasellus ante ante, laoreet eu volutpat ut, dignissim a ligula. Nam semper ante dolor, ac sagittis urna volutpat et. Mauris imperdiet cursus turpis ut suscipit. Duis quis finibus nisl. Curabitur consectetur felis odio, at porttitor sapien vestibulum efficitur. Vivamus ultricies quam ac lorem eleifend mollis.

Vestibulum tincidunt leo eu sagittis faucibus. Sed leo diam, ultricies vitae sem at, convallis pulvinar diam. Donec ultrices ligula at leo pretium, vitae iaculis lorem mollis. Nullam pharetra, orci quis sollicitudin ultrices, nunc nulla aliquet felis, sit amet pretium nibh justo in turpis. Praesent blandit nunc vitae placerat mollis. Curabitur venenatis posuere mi. Donec purus purus, lobortis vel felis in, tempor molestie tortor. Quisque libero purus, commodo eu maximus a, egestas vitae tellus. Nulla facilisis, ligula eget consequat feugiat, ligula nunc rutrum ex, quis hendrerit justo orci ut dolor. Ut arcu sem, elementum sit amet vestibulum sit amet, elementum sed arcu. Ut justo neque, blandit quis posuere tempus, sollicitudin vitae lorem. Etiam ultrices dapibus quam eu pulvinar. Suspendisse a aliquet urna.

Etiam sem mi, faucibus nec porta vel, venenatis pellentesque nibh. Praesent iaculis elementum sapien a suscipit. Aliquam consequat blandit mattis. Aliquam in felis massa. Phasellus venenatis justo sed mi vehicula cursus. Vestibulum gravida eros faucibus vestibulum eleifend. Vivamus sodales pulvinar felis vitae laoreet. Proin eget quam sed lectus laoreet pretium. Aliquam erat volutpat. Pellentesque egestas luctus mattis.

Sed maximus nibh suscipit pellentesque posuere. Etiam faucibus augue sagittis eleifend sodales. Phasellus mi sem, viverra volutpat auctor placerat, consectetur quis lectus. Sed eget pulvinar ex, id scelerisque neque. Fusce egestas nibh justo, nec molestie arcu rhoncus quis. Suspendisse potenti. Nunc rhoncus purus porta odio fringilla, id vehicula ante fringilla. Nulla sit amet sodales diam. Fusce fermentum, arcu vitae hendrerit rutrum, purus magna tempor augue, vel maximus turpis nisl non leo. Nunc efficitur elit eget justo volutpat imperdiet. Proin congue auctor felis, ac tempus justo gravida vitae. Ut pharetra ut quam nec pulvinar. Fusce id eleifend enim, ut euismod felis. Phasellus id nibh mi.

</div>
    <footer class=" back-v-b">

    <div class="text-center p-2 align-text-bottom mt-3 py-3">
        Projet CIR2 | Antonin SABIRON - Lucas LE BIHAN
    </div>
</footer>