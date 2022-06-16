<!--
    Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    Fichier contenant le profil
-->
<?php include_once("php/header.php")?>
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
        <option >A</option>
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
    <input type="text" class="form-control " id="ville" placeholder="Entrer l'ancien mot de passe">
    <input type="text" class="form-control " id="ville" placeholder="Entrer le nouveau mot de passe">
  </div>
  <div class="form-group vw-60 mb-2">
    <div id="pdp text-b-marine">Photo de Profil</div>
    <label for="pdp"></label>
    <small class="form-text text-muted ">Modifier votre photo de profil :</small>
    <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">
  </div>
  <button type="submit" class="btn back-b-marine text-beige ">Valider</button>
</form>

<?php include_once("php/footer.php")?>