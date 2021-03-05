<?php
session_start();
$pagetitle = 'Plessis de Roye - Mentions légales';
include_once 'includes/header.php';
?>
<div class="contentFormBody">
    <h2 class="text-center saveFileTitle">Plan du site :</h2>
    <div class="row m-0 d-flex justify-content-center">
        <div class="col-sm-12 col-md-3">
            <h3 class="titlesLegalNotice"><a class="sitemapLink" href="index.php" title="Plessis de Roye">Accueil</a></h3>
            <h3 class="titlesLegalNotice">Mairie</h3>
            <ul>
                <li><a class="sitemapLink" href="websiteUnderConstruction.php">Histoire de la commune</a></li>
                <li><a class="sitemapLink" href="municipalCouncilComposition.php">Composition du conseil</a></li>
                <li><a class="sitemapLink" href="websiteUnderConstruction.php">Horaires et permanences</a></li>
                <li><a class="sitemapLink" href="articles.php?type=CM">Conseils municipaux</a></li>
                <li><a class="sitemapLink" href="articles.php?type=BC">Bulletins communaux</a></li>
                <li><a class="sitemapLink" href="articles.php?type=DA">Démarches administratives</a></li>
                <li><a class="sitemapLink" href="contact.php">Nous contacter</a></ul>
            </ul>
            <h3 class="titlesLegalNotice">Evolution du village</h3>
            <ul>
                <li><a class="sitemapLink" href="websiteUnderConstruction.php">Plan d'urbanisme</a></li>
                <li><a class="sitemapLink" href="websiteUnderConstruction.php">Permis de construire</a></li>
                <li><a class="sitemapLink" href="websiteUnderConstruction.php">Travaux</a></li>
                <li><a class="sitemapLink" href="articles.php?type=IC">Informations communales</a></li>
            </ul>
            <h3 class="titlesLegalNotice">Associations et Loisirs</h3>
            <ul>
                <li><a class="sitemapLink" href="salleDesFetes.php">Salle des fêtes</a></li>
                <li><a class="sitemapLink" href="websiteUnderConstruction.php">Sport et loisirs</a></li>
                <li><a class="sitemapLink" href="websiteUnderConstruction.php">Associations</a></li>
                <li><a class="sitemapLink" href="websiteUnderConstruction.php">Vie culturelle</a></li>
                <li><a class="sitemapLink" href="websiteUnderConstruction.php">Vie solidaire</a></li>
            </ul>
            <h3 class="titlesLegalNotice"><a class="sitemapLink" href="articles.php?type=AC">Actualités</a></h3>
            <h3 class="titlesLegalNotice"><a class="sitemapLink" href="agenda.php">Agenda</a></h3>
        </div>
    </div>
</div>
<?php
include_once 'includes/footer.php';
