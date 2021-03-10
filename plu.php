<?php
session_start();
$pagetitle = 'Plessis de Roye - Plan local d\'urbanisme';
include_once 'includes/header.php';
?>
<main>
    <h2 class="text-center pageTitle">Plan local d'urbanisme</h2>
    <p class="text-center"> Cliquez sur la partie Nord ou la partie Sud de la carte pour zoomer.</p>
    <div class="row m-0 d-flex justify-content-center">
        <div class="col-md-6 col-sm-12">
            <a href="assets/pdf/Plan Plessis bourg Nord.pdf" target="_blank" title="Plan Plessis-de-Roye Nord">
                <img src="assets/images/PluNord.png" alt="PLU Nord" class="img-fluid" id="pluNord" />
            </a>
            <a href="assets/pdf/Plan Plessis bourg Sud.pdf" target="_blank" title="Plan Plessis-de-Roye Sud">
                <img src="assets/images/PluSud.png" alt="PLU Sud" class="img-fluid" />
            </a>
        </div>
    </div>
    
</main>
<?php
include_once 'includes/footer.php';