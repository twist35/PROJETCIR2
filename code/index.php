<!--
    Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
    Fichier contenant la page d'accueil (recherche)
-->
<?php include_once("php/header.php")?>
<div class="titre-page back-b-marine text-center h2 text-marron py-1">
    Accueil
</div>
<div id="recherche" class="back-bleu text-center mt-3 py-2">
    <div class="h4 ml-n2">
        Mes Matchs
    </div>
    <div>
        <form id="formulaire-recherche"class="text-center center">
            <div class="d-flex  align-items-end flex-row justify-content-center">
                <div class="recherche-div" >Forme sportive 
                    <label for="fs"></label>
                    <select class="back">
                        <option >A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                    </select>
                </div>
                <div class="recherche-div" >Date Maximale
                    <label for="date_r"></label>
                    <input class="back" type="date" id="date_r" name="date_r" value="2022-06-16" min="2018-01-01">
                </div>
                <div class="recherche-div">Ville
                    <label for="ville"></label>
                    <select class="back">
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                    </select>
                </div>
                <div class="recherche-div" >Disponibilité
                    <label for="dispo"></label>
                    <select class="back">
                        <option>Disponible</option>
                        <option>Indisponible</option>
                    </select>
                </div>
            </div>
            <button type="submit" id="bouton-recherche" class="btn back-b-marine text-beige" style="margin-left: 1vw;">Rechercher</button>
        </form>
    </div>
</div>

<div class="wrapper text-center mt-4">
    <div class="bulle text-center">
    hhhhhhhh
    hhhh
    </div>
    <div class="bulle text-center">
    hhhhhhhh
    hhhh
    </div>
    <div class="bulle text-center">
    hhhhhhhh
    hhhh
    </div>
    <div class="bulle text-center">
    hhhhhhhh
    hhhh
    </div>
</div>



<?php include_once("php/footer.php")?>
