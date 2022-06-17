<!--
    Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    Fichier contenant la page d'authentification
-->
<?php include_once("php/header.php")?>
<div class="titre-page back-b-marine text-center h2 text-marron py-1">
    Authentification
</div>
<form class="text-center center d-flex justify-content-center flex-column align-items-center">
  <div>Se connecter : </div>
  <div class="form-group vw-60 mb-2"> 
    <label for="login"></label>
    <small class="form-text text-muted  text-b-marine">Email</small>
    <input type="text" class="form-control " id="login" placeholder="Entrer votre email">
  </div>
  <div class="form-group vw-60 mb-2">
  <label for="mdp"></label>
    <small class="form-text text-muted  text-b-marine">Mot de passe</small>
    <input type="text" class="form-control" id="mdp" placeholder="Entrer votre mot de passe">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include_once("php/footer.php")?>