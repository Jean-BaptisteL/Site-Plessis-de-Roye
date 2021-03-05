<?php
session_start();
$pagetitle = 'Plessis de Roye - Contact';
include_once 'includes/header.php';
?>
<div class="contentFormBody">
    <h2 class="text-center mt-4 mb-3 saveFileTitle">Nous contacter</h2>
    <div class="row m-0 d-flex justify-content-center">
        <div class="col-sm-12 col-md-4">
            <img id="photoMairie" class="img-fluid text-center m-1 rounded" src="assets/images/mairie.jpg" alt="Mairie du village" />
            <h3 class="text-center mt-4">Permanences en mairie :</h3>
            <h4 class="text-center">Les élus :</h4>
            <p class="text-center">Mardi et Jeudi de 18h à 19h</p>
            <h4 class="text-center">Le secrétariat :</h4>
            <p class="text-center">Ouverture publique<br />
            Mardi de 10h à 11h30<br />
            Jeudi de 13h45 à 15h15</p>
            <h3 class="text-center mt-5">Adresse e-mail :</h3>
            <p class="text-center">mairie.plessierderoye@wanadoo.fr<br />
            Tout mail envoyé à l’adresse de la mairie, sera suivi d’un accusé réception (AR) dans les 72 h.<br />
            Si vous ne recevez pas d’AR, prière de contacter la mairie par téléphone.</p>
            <h3 class="text-center">Téléphone :</h3>
            <p class="text-center">03 44 43 72 29</p>
        </div>
    </div>
</div>
<?php
include_once 'includes/footer.php';
