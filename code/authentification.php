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
<form>
  <div class="form-group text-center">
  <div class="form-group vw-60 mb-2">
    <div>Mot de passe</div>
    <label for="mdp"></label>
    <small class="form-text text-muted  text-b-marine">Modifier votre mot de passe :</small>
    <input type="text" class="form-control " id="ville" placeholder="Entrer l'ancien mot de passe">
    <input type="text" class="form-control " id="ville" placeholder="Entrer le nouveau mot de passe">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include_once("php/footer.php")?>