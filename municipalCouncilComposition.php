<?php
session_start();
$pagetitle = 'Plessis de Roye - Composition du conseil municipal';
include_once 'models/councilComposition.php';
include_once 'controllers/municipalCouncilCompositionCtrl.php';
include_once 'includes/header.php';
?>
<main>
    <section>
    <h2 class="pageTitle text-center mt-4">Composition du conseil municipal :</h2>
    <p class="text-center">Vous pouvez trouver les informations concernant l'équipe municipale <a href="assets/pdf/Equipe municipale.pdf" title="Infos sur l'équipe communale" target="_blank">ici</a>.</p>
    <div class="d-flex flex-wrap justify-content-around">
        <?php
        if ($mayorExists > 0 || $numberOfAssistants > 0 || $numberOfAdvisors > 0 || $numberOfOtherMembers > 0) {
            if ($mayorExists > 0) {
                ?>
                <article class="row councilBox">
                    <div class="col-lg-6 col-sm-12"><img class="councilPhotos rounded ml-auto mr-auto" src="<?= $theMayor->photoPath ?>" alt="<?= $theMayor->firstname . ' ' . $theMayor->lastname ?>" /></div>
                    <div class="col-lg-6 col-sm-12 text-center text-md-left mt-auto mb-auto">
                        <h3><?= $theMayor->firstname . ' ' . $theMayor->lastname ?></h3>
                        <p><?= $theMayor->job ?></p>
                    </div>
                </article>
                <?php
            }
            if ($numberOfAssistants > 0) {
                foreach ($assistants as $assitant) {
                    ?>
                    <article class="row councilBox">
                        <div class="col-lg-6 col-sm-12"><img class="councilPhotos rounded ml-auto mr-auto" src="<?= $assitant->photoPath ?>" alt="<?= $assitant->firstname . ' ' . $assitant->lastname ?>" /></div>
                        <div class="col-lg-6 col-sm-12 text-center text-md-left mt-auto mb-auto">
                            <h3><?= $assitant->firstname . ' ' . $assitant->lastname ?></h3>
                            <p><?= $assitant->job ?></p>
                        </div>
                    </article>
                    <?php
                }
            }
            if ($numberOfAdvisors > 0) {
                foreach ($advisors as $advisor) {
                    ?>
                    <article class="row councilBox">
                        <div class="col-lg-6 col-sm-12"><img class="councilPhotos rounded ml-auto mr-auto" src="<?= $advisor->photoPath ?>" alt="<?= $advisor->firstname . ' ' . $advisor->lastname ?>" /></div>
                        <div class="col-lg-6 col-sm-12 text-center text-md-left mt-auto mb-auto">
                            <h3><?= $advisor->firstname . ' ' . $advisor->lastname ?></h3>
                            <p><?= $advisor->job ?></p>
                        </div>
                    </article>
                    <?php
                }
            }
            if ($numberOfOtherMembers > 0) {
                foreach ($otherMembers as $otherMember) {
                    ?>
                    <article class="row councilBox">
                        <div class="col-lg-6 col-sm-12"><img class="councilPhotos rounded ml-auto mr-auto" src="<?= $otherMember->photoPath ?>" alt="<?= $otherMember->firstname . ' ' . $otherMember->lastname ?>" /></div>
                        <div class="col-lg-6 col-sm-12 text-center text-md-left mt-auto mb-auto">
                            <h3><?= $otherMember->firstname . ' ' . $otherMember->lastname ?></h3>
                            <p><?= $otherMember->job ?></p>
                        </div>
                    </article>
                    <?php
                }
            }
        } else {
            ?>
            <p>Aucun membre du conseil municipal n'a encore été enregistré.</p>
            <?php
        }
        ?>
    </div>
    </section>
</main>
<?php
include_once 'includes/footer.php';
