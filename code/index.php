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
<div class="bg-primary text-center mt-3 py-2 d-flex flex-row justify-content-around align-items-center text-center">
    <div class="h4 ml-n2">
        Mes Matchs
    </div>
    <div>
        <form class="text-center center d-flex justify-content-center flex-row align-items-center">
            <div>Ville
                <label for="ville"></label>
                <select class="back">
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                </select>
            </div>
            
            <div style="margin-left: 1vw;" >Forme sportive
                <label for="fs"></label>
                <select class="back">
                    <option >A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                </select>
            </div>
            <div  style="margin-left: 1vw;" >Date Maximale
                <label for="date_r"></label>
                <input class="back" type="date" id="date_r" name="date_r" value="2018-07-22" min="2018-01-01">
            </div>
            <div style="margin-left: 1vw;" >Disponibilité
                <label for="dispo"></label>
                <select class="back">
                    <option>Disponible</option>
                    <option>Indisponible</option>
                </select>
            </div>
            <button type="submit" class="btn back-b-marine text-beige " style="margin-left: 1vw;">Rechercher</button>
        </form>
    </div>
</div>


<?php include_once("php/footer.php")?>
