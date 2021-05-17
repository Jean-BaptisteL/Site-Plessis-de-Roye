<?php
session_start();
$pagetitle = 'Plessis de Roye - Plan local d\'urbanisme';
include_once 'includes/header.php';
?>
<main>
    <h2 class="text-center pageTitle">Plan local d'urbanisme</h2>
    <h3 class="text-center mt-4">Plan du village de Plessis-de-Roye :</h3>
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
    <div class="row m-0 d-flex justify-content-center">
        <div class="table-responsive-sm col-md-6 col-sm-12">
            <table class="table table-bordered mt-5 shadow">
                <thead class="thead-light">
                    <tr>
                        <th colspan="3" class="text-center">Légendes :</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Zone A</td>
                        <td>Zone Agricole</td>
                        <td><a href="assets/pdf/PLU zone A.pdf" title="PLU zone A" target="_blank">Fichier PLU zone A</a></td>
                    </tr>
                    <tr>
                        <td>Zone N</td>
                        <td>Zone Naturelle</td>
                        <td><a href="assets/pdf/PLU zone N.pdf" title="PLU zone N" target="_blank">Fichier PLU zone N</a></td>
                    </tr>
                    <tr>
                        <td>Zone UA</td>
                        <td>Zone Urbanisée Ancienne</td>
                        <td><a href="assets/pdf/PLU zone UA.pdf" title="PLU zone UA" target="_blank">Fichier PLU zone UA</a></td>
                    </tr>
                    <tr>
                        <td>Zone UD</td>
                        <td>Zone Urbanisée Dispersée</td>
                        <td><a href="assets/pdf/PLU zone UD.pdf" title="PLU zone UD" target="_blank">Fichier PLU zone UD</a></td>
                    </tr>
                    <tr>
                        <td>Zone AU</td>
                        <td>Zone à Urbaniser</td>
                        <td><a href="assets/pdf/PLU zone AU.pdf" title="PLU zone AU" target="_blank">Fichier PLU zone AU</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php
include_once 'includes/footer.php';
