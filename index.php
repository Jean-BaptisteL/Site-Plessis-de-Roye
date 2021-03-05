<?php
session_start();
$pagetitle = 'Plessis de Roye - Accueil';
include_once 'models/publications.php';
include_once 'controllers/indexCtrl.php';
include_once 'includes/header.php';
?>
<main>
    <section class="row m-0 p-4">
        <article class="col-sm-12 col-md-6 m-auto">
            <div>
                <h2 class="homeTitles">Notre commune :</h2>
                <p class="text-justify">Dominée par le Plémont, Plessis de Roye (également appelé Plessier de Roye) est une commune de 233 habitants qui est située au sud de Lassigny. On y dénombre trois petits cours d’eau qui sont la Divette, le ruisseau des Prés de Vienne et le ruisseau de Belval. Plessis de Roye comprend le hameau de Belval qui est situé dans un vallon au sud de la commune. Notre commune fait partie de la <a href="https://www.cc-pays-sources.fr/" title="Pays des Sources">Communauté du Pays des Sources</a>.</p>
            </div>
            <div id="lastPublications" class="list-group">
                <h2 class="homeTitles">Dernières publications :</h2>
                <?php
                if ($numberOfPublication > 0) {
                    foreach ($lastPublications as $publication) {
                        ?>
                        <a href="<?= $publication->path ?>" class="list-group-item list-group-item-action" target="_blank">
                            <div class="d-flex w-100 justify-content-between">
                                <h3 class="mb-1 publicationTitle"><?= $publication->title ?></h3>
                                <small><?= $publication->publicationDate ?></small>
                            </div>
                            <small><?= fileLocation($publication->type) ?></small>
                        </a>
                        <?php
                    }
                } else {
                    ?>
                    <p>Aucune publication n'a été enregistrée jusqu'à présent.</p>
                    <?php
                }
                ?>
            </div>
            <p id="applicationLink">Pour être tenu au courant des alertes et informations de l'équipe communale :<br />
                Il y a l'application <a href="assets/pdf/Affiche Mairie propose.pdf" title="Présentation PanneauPocket" target="_blank">PanneauPocket</a> et <a href="assets/pdf/Affiche installation.pdf" title="Guide d'installation" target="_blank">voici comment la télécharger</a>.</p>
        </article>
        <article class="col-sm-12 col-md-5">
            <div class="row m-0">
                <div id="widgetMeteo" class="col-md-6 col-sm-12">
                    <iframe id="widget_autocomplete_preview" class="meteoWidget" frameborder="0" src="https://meteofrance.com/widget/prevision/604990##66c75a"> </iframe>
                </div>
            </div>
            <div id="homeCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#homeCarousel" data-slide-to="1"></li>
                    <li data-target="#homeCarousel" data-slide-to="2"></li>
                    <li data-target="#homeCarousel" data-slide-to="3"></li>
                    <li data-target="#homeCarousel" data-slide-to="4"></li>
                    <li data-target="#homeCarousel" data-slide-to="5"></li>
                    <li data-target="#homeCarousel" data-slide-to="6"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/assets/images/Plessier-aglise-monu-mort-DSC08214.jpg" class="d-block w-100" alt="Eglise de Plessis de Roye">
                    </div>
                    <div class="carousel-item">
                        <img src="/assets/images/eglise2.jpg" class="d-block w-100" alt="Eglise de Plessis de Roye - Portail">
                    </div>
                    <div class="carousel-item">
                        <img src="/assets/images/Cloitre-Plessier-DSC01104.jpg" class="d-block w-100" alt="Cloitre de l'église">
                    </div>
                    <div class="carousel-item">
                        <img src="/assets/images/mairie.jpg" class="d-block w-100" alt="Mairie">
                    </div>
                    <div class="carousel-item">
                        <img src="/assets/images/placeSalle.jpg" class="d-block w-100" alt="Place de la salle des fêtes">
                    </div>
                    <div class="carousel-item">
                        <img src="/assets/images/calvaire.jpg" class="d-block w-100" alt="Calvaire">
                    </div>
                    <div class="carousel-item">
                        <img src="/assets/images/etang.jpg" class="d-block w-100" alt="Etang">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#homeCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Précédent</span>
                </a>
                <a class="carousel-control-next" href="#homeCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Suivant</span>
                </a>
            </div>
        </article>
    </section>
</main>
<?php
include_once 'includes/footer.php';
