<?php
session_start();
$pagetitle = '';
include_once 'models/publications.php';
include_once 'controllers/articlesCtrl.php';
include_once 'includes/header.php';
?>
<div id="articlesPage" class="row m-0 d-flex justify-content-center">
    <div class="col-md-6 col-sm-12 list-group">
        <h2 class="text-center" id="articlesPageTitle"><?= $articlesPageTitle ?></h2>
        <?php
        if ($numberOfPublications > 0) {
            foreach ($publicationsByType as $publication) {
                ?>
                <a href="<?= $publication->path ?>" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h3 class="mb-1 publicationTitle"><?= $publication->title ?></h3>
                        <small><?= $publication->publicationDate ?></small>
                    </div>
                </a>
                <?php
            }
        } else {
            ?>
        <p class="text-center">Aucune publication n'a été enregistrée jusqu'à présent.</p>
            <?php
        }
        ?>
            <div class="text-center mt-2">
                <?php
                //Pagination
                if ($page > 1) {
                    ?>
                    <a href="articles.php?type=<?= $_GET['type'] ?>&amp;page=<?= $page - 1 ?>" class="btn btn-light">Page précédente</a>
                    <?php
                }
                for ($infPages = 3; $infPages >= 1; $infPages--) {
                    if ($page - $infPages >= 1) {
                        ?>
                        <a href="articles.php?type=<?= $_GET['type'] ?>&amp;page=<?= $page - $infPages ?>" class="btn btn-light"><?= $page - $infPages; ?></a>
                        <?php
                    }
                }
                ?>
                <a href="articles.php?type=<?= $_GET['type'] ?>&amp;page=<?= $page ?>" class="btn btn-primary"><?= $page; ?></a>
                <?php
                for ($supPages = 1; $supPages <= 3; $supPages++) {
                    if ($page + $supPages <= $numberOfPages) {
                        ?>
                        <a href="articles.php?type=<?= $_GET['type'] ?>&amp;page=<?= $page + $supPages ?>" class="btn btn-light"><?= $page + $supPages; ?></a><?php } ?>
                    <?php
                }
                if ($page < $numberOfPages) {
                    ?>
                    <a href="articles.php?type=<?= $_GET['type'] ?>&amp;page=<?= $page + 1 ?>" class="btn btn-light">Page suivante</a>
                    <?php
                }
                ?>
            </div>
    </div>
    <?php
    if ($_GET['type'] == 'AC') {
    ?>
    <div class="col-sm-12 col-md-5 text-center mt-5">
        <p>Vous pouvez suivre les actualités où que vous soyez grâce à l'application <a href="assets/pdf/Affiche Mairie propose.pdf" title="Présentation PanneauPocket" target="_blank">PanneauPocket</a>.<br />
        <a href="assets/pdf/Affiche installation.pdf" title="Guide d'installation" target="_blank">Disponible</a> sur Android et iOS.</p>
        <iframe src="https://app.panneaupocket.com/ville/335021804" height="518" width="300" frameborder="0"></iframe>
    </div>
    <?php
    }
    ?>
</div>
<?php
include_once 'includes/footer.php';
