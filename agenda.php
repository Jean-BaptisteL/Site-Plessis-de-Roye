<?php
session_start();
$pagetitle = 'Plessis de Roye - Agenda';
include_once 'models/agendaModel.php';
include_once 'controllers\agendaCtrl.php';
include_once 'includes/header.php';
?>
<div class="contentFormBody">
    <h2 class="text-center pageTitle"> Agenda de la commune :</h2>
    <?php
    if ($numberOfEvents > 0) {
        ?>
        <div class="row m-0 d-flex justify-content-center">
            <ul class="col-md-4 col-sm-12 border rounded eventList shadow">
                <?php
                foreach ($events as $event) {
                    ?>
                    <li class="mb-5">
                        <h3><?= $event->topic ?> <i class="fas fa-angle-down btn btn-light" data-toggle="collapse" data-target="#event<?= $event->id ?>" aria-expanded="false" aria-controls="multiCollapseExample2"></i></h3>
                        <p>Le <?= $event->dateFormat ?></p>
                        <div class="collapse" id="event<?= $event->id ?>">
                            <div class="card card-body">
                                <p><?= $event->description ?></p>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
    } else {
        ?>
        <h3 class="text-center">Aucun évènement n'est encore prévu pour l'instant.</h3>
        <?php
    }
    ?>
</div>
<?php
include_once 'includes/footer.php';
