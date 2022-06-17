<!--
    Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    Fichier contenant la page de création de compte
-->
<?php include_once("php/header.php")?>
<div class="titre-page back-b-marine text-center h2 text-marron py-1">
    Créer un compte
</div>
<form class="text-center center d-flex justify-content-center flex-column align-items-center">
    <div class="form-group vw-60 mb-2">
        <label for="ville">Entrer votre nom</label>
        <input type="name" class="form-control" id="nom" name="nom" required >
    </div>
    <div class="form-group vw-60 mb-2">
        <label for="ville">Entrer votre prénom</label>
        <input type="name" class="form-control" id="prenom" name="prenom" required >
    </div>
    <div class="form-group vw-60 mb-2">
        <label for="ville">Entrer votre email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="jean.dupond@gmail.com"  required >
    </div>
    <div class="form-group vw-60 mb-2">
        <label for="ville">Entrer votre mot de passe</label>
        <input type="password" class="form-control" id="mdp" name="mdp" required>
    </div>
    <div class="form-group vw-60 mb-2">
        <label for="ville">Entrer votre ville</label>
        <input type="text" class="form-control" id="ville" name="ville" placeholder="Entrer ville" required>
    </div>
    <div class="form-group vw-60 mb-2">
        <label for="fs">Entrez votre forme sportive</label>
        <select name="fs" required>
            <option>A</option>
            <option>B</option>
            <option>C</option>
            <option>D</option>
        </select>
    </div>
    <div class="form-group vw-60 mb-2">
        <label for="avatar">Entrer votre avatar</label>
        <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">
    </div>
    <div class="form-group vw-60 mb-2">
        <label for="date_naissance">Entrer votre date de naissance</label>
        <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
    </div>
    <button type="submit" class="btn back-b-marine text-beige ">Valider</button>
</form>

<?php include_once("php/footer.php")?>