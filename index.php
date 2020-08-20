<?php
session_start();
$pagetitle = 'Plessis de Roye - Accueil';
include_once 'includes/header.php';
?>
        <div class="row m-0 p-4">
            <div class="col-sm-12 col-md-6 m-auto">
                <div>
                    <h2 class="homeTitles">Notre commune :</h2>
                    <p class="text-justify">Dominé par le Plémont, Plessis de Roye est situé au sud de Lassigny. Il y a deux petits cours d’eau sur la commune. Plessis de Roye comprend le hameau de Belval qui est situé dans un vallon au sud de la commune.</p>
                </div>
                <div id="lastPublications" class="list-group">
                    <h2 class="homeTitles">Dernières publications :</h2>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1 publicationTitle">Dernière publication</h3>
                            <small>22/07/2020</small>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1 publicationTitle">Avant-dernière publication</h3>
                            <small>10/07/2020</small>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1 publicationTitle">Publication précédente</h3>
                            <small>25/06/2020</small>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1 publicationTitle">Publication précédente encore</h3>
                            <small>5/06/2020</small>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-md-5 m-auto">
                <div id="homeCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#homeCarousel" data-slide-to="1"></li>
                        <li data-target="#homeCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/assets/images/Plessier-aglise-monu-mort-DSC08214.jpg" class="d-block w-100" alt="Eglise de Plessis de Roye">
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/images/Cloitre-Plessier-DSC01104.jpg" class="d-block w-100" alt="Cloitre de l'église">
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/images/Plessier-locale-asso.jpg" class="d-block w-100" alt="Locale">
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
            </div>
        </div>
<?php
include_once 'includes/footer.php';