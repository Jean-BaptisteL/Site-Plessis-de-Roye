<?php
session_start();
$pagetitle = 'Gestion du contenu';
include_once 'models/publications.php';
include_once 'models/agendaModel.php';
include_once 'models/councilComposition.php';
include_once 'models/villagehallbooking.php';
include_once 'controllers/contentFormCtrl.php';
include_once 'includes/header.php';
?>
<div class="contentFormBody">
    <div class="d-flex justify-content-center mt-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link <?= $showArticlesManagementLink ?>" id="profile-tab" data-toggle="tab" href="#updateDeleteFiles" role="tab" aria-controls="updateDeleteFiles" aria-selected="false">Gestion des fichiers</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?= $showCounsilFormLink ?>" id="contact-tab" data-toggle="tab" href="#councilMembers" role="tab" aria-controls="councilMembers" aria-selected="false">Membres du conseil</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?= $showAgendaFormLink ?>" id="contact-tab" data-toggle="tab" href="#agendaGestion" role="tab" aria-controls="agendaGestion" aria-selected="false">Agenda</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?= $showBookingFormLink ?>" id="contact-tab" data-toggle="tab" href="#bookingGestion" role="tab" aria-controls="agendaGestion" aria-selected="false">Réservation de la salle des fêtes</a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <!--Gestion des fichiers déjà existants-->
        <div class="tab-pane fade <?= $showArticlesManagement ?>" id="updateDeleteFiles" role="tabpanel" aria-labelledby="updateDeleteFiles-tab">
            <h2 class="text-center mt-4 mb-3 saveFileTitle">Gestion des articles :</h2>
            <div class="row m-0 d-flex justify-content-center">
                <div class="col-md-6 col-sm-12">
                <h3 class="text-center mt-4 mb-3">Liste des articles :</h3>
                    <p class="text-center"><?= $messages ?></p>
                    <div class="d-flex justify-content-center">
                        <div class="list-group">
                            <?php
                            if ($numberOfPublications > 0) {
                                foreach ($allArticles as $article) {
                                    ?>
                                    <div class="list-group-item list-group-item-action ml-2">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h3 class="mb-1 publicationTitle"><a href="<?= $article->path ?>" class="text-dark" target="_blank"><?= $article->title ?></a></h3>
                                            <small><?= $article->publicationDate ?></small>
                                        </div>
                                        <div class="row m-0 d-flex justify-content-between">
                                            <small class="col-sm-12 col-md-4 m-o"><?= articleType($article->type) ?></small>
                                            <div class="col-md-3 col-sm-12 m-o text-right">
                                                <button class="updateArticleBtn btn" data-toggle="modal" data-target="#updateArticleModal" data-id="<?= $article->id ?>" data-title="<?= $article->title ?>" data-path="<?= $article->path ?>" data-type="<?= $article->type ?>" title="Modifier"><i class="fas fa-edit"></i></button>
                                                <button class="deleteArticleBtn btn" data-toggle="modal" data-target="#deleteArticleModal" data-id="<?= $article->id ?>" data-path="<?= $article->path ?>" title="Supprimer"><i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <p>Aucune publication n'a été enregistrée jusqu'à présent.</p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <?php
                        //Pagination
                        if ($page > 1) {
                            ?>
                            <a href="contentForm.php?page=<?= $page - 1 ?>" class="btn btn-light">Page précédente</a>
                            <?php
                        }
                        for ($infPages = 3; $infPages >= 1; $infPages--) {
                            if ($page - $infPages >= 1) {
                                ?>
                                <a href="contentForm.php?page=<?= $page - $infPages ?>" class="btn btn-light"><?= $page - $infPages; ?></a>
                                <?php
                            }
                        }
                        ?>
                        <a href="contentForm.php?page=<?= $page ?>" class="btn btn-primary"><?= $page; ?></a>
                        <?php
                        for ($supPages = 1; $supPages <= 3; $supPages++) {
                            if ($page + $supPages <= $numberOfPages) {
                                ?>
                                <a href="contentForm.php?page=<?= $page + $supPages ?>" class="btn btn-light"><?= $page + $supPages; ?></a><?php } ?>
                            <?php
                        }
                        if ($page < $numberOfPages) {
                            ?>
                            <a href="contentForm.php?page=<?= $page + 1 ?>" class="btn btn-light">Page suivante</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h3 class="text-center mt-4">Formulaire d'enregistrement d'article :</h3>
                    <p class="text-success"><?= isset($errorMessages['success']) ? $errorMessages['success'] : '' ?></p>
                    <form class="d-flex justify-content-center mt-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <div  id="saveFileForm">
                            <p class="text-success"><?= isset($successMessages['savedFile']) ? $successMessages['savedFile'] : '' ?></p>
                            <div class="form-group">
                                <label for="locationFile">Emplacement de l'article :</label>
                                <select name="locationFile" id="locationFile" class="form-control <?= isset($_POST['locationFile']) ? (!isset($errorMessages['locationFile']) ? 'is-valid' : 'is-invalid') : '' ?>" >
                                    <option disabled <?= !isset($_POST['locationFile']) ? 'selected' : '' ?>>Selectionnez un emplacement</option>
                                    <option value="conseilMunicipal" <?= isset($_POST['locationFile']) && $_POST['locationFile'] == 'conseilMunicipal' ? 'selected' : '' ?>>Conseil municipal</option>
                                    <option value="bulletinCommunal" <?= isset($_POST['locationFile']) && $_POST['locationFile'] == 'bulletinCommunal' ? 'selected' : '' ?>>Bulletin communal</option>
                                    <option value="demarcheAdministrative" <?= isset($_POST['locationFile']) && $_POST['locationFile'] == 'demarcheAdministrative' ? 'selected' : '' ?>>Démarche administrative</option>
                                    <option value="informationCommunale" <?= isset($_POST['locationFile']) && $_POST['locationFile'] == 'informationCommunale' ? 'selected' : '' ?>>Information communale</option>
                                    <option value="actualite" <?= isset($_POST['locationFile']) && $_POST['locationFile'] == 'actualite' ? 'selected' : '' ?>>Actualité</option>
                                </select>
                                <small class="text-danger"><?= isset($errorMessages['locationFile']) ? $errorMessages['locationFile'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="titleFile">Titre du fichier :</label>
                                <input type="text" name="titleFile" id="titleFile" class="form-control <?= isset($_POST['titleFile']) ? (!isset($errorMessages['titleFile']) ? 'is-valid' : 'is-invalid') : '' ?>" value="<?= isset($_POST['titleFile']) ? htmlspecialchars($_POST['titleFile']) : '' ?>" />
                                <small class="text-danger"><?= isset($errorMessages['titleFile']) ? $errorMessages['titleFile'] : '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="inputFile">Choisissez votre fichier :</label>
                                <input type="file" name="inputFile" id="inputFile" class="form-control-file" />
                                <small class="text-danger"><?= isset($errorMessages['inputFile']) ? $errorMessages['inputFile'] : '' ?></small>
                            </div>
                            <input type="submit" name="saveFile" id="saveFile" class="btn" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Gestion du conseil municipal-->
        <div class="tab-pane fade <?= $showCounsilForm ?>" id="councilMembers" role="tabpanel" aria-labelledby="councilMembers-tab">
            <h2 class="text-center mt-4 saveFileTitle">Gestion du conseil municipal :</h2>
            <div class="row d-flex justify-content-center m-0">
                <div class="col-sm-12 col-lg-4">
                    <h3>Liste des membres :</h3>
                    <?php
                    if ($mayorExists > 0 || $numberOfAssistants > 0 || $numberOfAdvisors > 0 || $numberOfOtherMembers > 0) {
                        if ($mayorExists > 0) {
                            ?>
                            <div class="row councilBox">
                                <div class="col-lg-6 col-sm-12"><img class="councilPhotos rounded ml-auto mr-auto" src="<?= $theMayor->photoPath ?>" alt="<?= $theMayor->firstname . ' ' . $theMayor->lastname ?>" /></div>
                                <div class="col-lg-6 col-sm-12 text-center text-md-left mt-auto mb-auto">
                                    <h3><?= $theMayor->firstname . ' ' . $theMayor->lastname ?></h3>
                                    <p><?= $theMayor->job ?></p>
                                    <button class="updateMemberBtn btn" data-toggle="modal" data-target="#updateCouncilMemberModal" data-id="<?= $theMayor->id ?>" data-firstname="<?= $theMayor->firstname ?>" data-lastname="<?= $theMayor->lastname ?>" data-path="<?= $theMayor->photoPath ?>" data-job="<?= $theMayor->job ?>" title="Modifier"><i class="fas fa-edit"></i></button>
                                    <button class="deleteMemberBtn btn" data-toggle="modal" data-target="#deleteMemberModal" data-id="<?= $theMayor->id ?>" data-path="<?= $theMayor->photoPath ?>" title="Supprimer"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </div>
                            <?php
                        }
                        if ($numberOfAssistants > 0) {
                            foreach ($assistants as $assitant) {
                                ?>
                                <div class="row councilBox">
                                    <div class="col-lg-6 col-sm-12"><img class="councilPhotos rounded ml-auto mr-auto" src="<?= $assitant->photoPath ?>" alt="<?= $assitant->firstname . ' ' . $assitant->lastname ?>" /></div>
                                    <div class="col-lg-6 col-sm-12 text-center text-md-left mt-auto mb-auto">
                                        <h3><?= $assitant->firstname . ' ' . $assitant->lastname ?></h3>
                                        <p><?= $assitant->job ?></p>
                                        <button class="updateMemberBtn btn" data-toggle="modal" data-target="#updateCouncilMemberModal" data-id="<?= $assitant->id ?>" data-firstname="<?= $assitant->firstname ?>" data-lastname="<?= $assitant->lastname ?>" data-path="<?= $assitant->photoPath ?>" data-job="<?= $assitant->job ?>" title="Modifier"><i class="fas fa-edit"></i></button>
                                        <button class="deleteMemberBtn btn" data-toggle="modal" data-target="#deleteMemberModal" data-id="<?= $assitant->id ?>" data-path="<?= $assitant->photoPath ?>" title="Supprimer"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        if ($numberOfAdvisors > 0) {
                            foreach ($advisors as $advisor) {
                                ?>
                                <div class="row councilBox">
                                    <div class="col-lg-6 col-sm-12"><img class="councilPhotos rounded ml-auto mr-auto" src="<?= $advisor->photoPath ?>" alt="<?= $advisor->firstname . ' ' . $advisor->lastname ?>" /></div>
                                    <div class="col-lg-6 col-sm-12 text-center text-md-left mt-auto mb-auto">
                                        <h3><?= $advisor->firstname . ' ' . $advisor->lastname ?></h3>
                                        <p><?= $advisor->job ?></p>
                                        <button class="updateMemberBtn btn" data-toggle="modal" data-target="#updateCouncilMemberModal" data-id="<?= $advisor->id ?>" data-firstname="<?= $advisor->firstname ?>" data-lastname="<?= $advisor->lastname ?>" data-path="<?= $advisor->photoPath ?>" data-job="<?= $advisor->job ?>" title="Modifier"><i class="fas fa-edit"></i></button>
                                        <button class="deleteMemberBtn btn" data-toggle="modal" data-target="#deleteMemberModal" data-id="<?= $advisor->id ?>" data-path="<?= $advisor->photoPath ?>" title="Supprimer"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        if ($numberOfOtherMembers > 0) {
                            foreach ($otherMembers as $otherMember) {
                                ?>
                                <div class="row councilBox">
                                    <div class="col-lg-6 col-sm-12"><img class="councilPhotos rounded ml-auto mr-auto" src="<?= $otherMember->photoPath ?>" alt="<?= $otherMember->firstname . ' ' . $otherMember->lastname ?>" /></div>
                                    <div class="col-lg-6 col-sm-12 text-center text-md-left mt-auto mb-auto">
                                        <h3><?= $otherMember->firstname . ' ' . $otherMember->lastname ?></h3>
                                        <p><?= $otherMember->job ?></p>
                                        <button class="updateMemberBtn btn" data-toggle="modal" data-target="#updateCouncilMemberModal" data-id="<?= $otherMember->id ?>" data-firstname="<?= $otherMember->firstname ?>" data-lastname="<?= $otherMember->lastname ?>" data-path="<?= $otherMember->photoPath ?>" data-job="<?= $otherMember->job ?>" title="Modifier"><i class="fas fa-edit"></i></button>
                                        <button class="deleteMemberBtn btn" data-toggle="modal" data-target="#deleteMemberModal" data-id="<?= $otherMember->id ?>" data-path="<?= $otherMember->photoPath ?>" title="Supprimer"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                </div>
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
                <div class="col-sm-12 col-lg-4">
                    <h3>Ajouter un membre :</h3>
                    <form class="mt-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <p class="text-success"><?= isset($successMessages['addCounsilMember']) ? $successMessages['addCounsilMember'] : '' ?></p>
                        <div class="form-group">
                            <label for="counsilMemberFirstname">Prénom :</label>
                            <input type="text" class="form-control <?= isset($_POST['counsilMemberFirstname']) ? (!isset($errorMessages['counsilMemberFirstname']) ? 'is-valid' : 'is-invalid') : '' ?>" name="counsilMemberFirstname" id="counsilMemberFirstname" value="<?= isset($_POST['counsilMemberFirstname']) ? htmlspecialchars($_POST['counsilMemberFirstname']) : '' ?>" />
                            <small class="text-danger"><?= isset($errorMessages['counsilMemberFirstname']) ? $errorMessages['counsilMemberFirstname'] : '' ?></small>
                        </div>
                        <div class="form-group">
                            <label for="counsilMemberLastname">Nom :</label>
                            <input type="text" class="form-control <?= isset($_POST['counsilMemberLastname']) ? (!isset($errorMessages['counsilMemberLastname']) ? 'is-valid' : 'is-invalid') : '' ?>" name="counsilMemberLastname" id="counsilMemberLastname" value="<?= isset($_POST['counsilMemberLastname']) ? htmlspecialchars($_POST['counsilMemberLastname']) : '' ?>" />
                            <small class="text-danger"><?= isset($errorMessages['counsilMemberLastname']) ? $errorMessages['counsilMemberLastname'] : '' ?></small>
                        </div>
                        <div class="form-group">
                            <label for="counsilMemberJob">Rôle :</label>
                            <input type="text" class="form-control <?= isset($_POST['counsilMemberJob']) ? (!isset($errorMessages['counsilMemberJob']) ? 'is-valid' : 'is-invalid') : '' ?>" name="counsilMemberJob" id="counsilMemberJob" placeholder="Ex : Maire" value="<?= isset($_POST['counsilMemberJob']) ? htmlspecialchars($_POST['counsilMemberJob']) : '' ?>" />
                            <small class="text-danger"><?= isset($errorMessages['counsilMemberJob']) ? $errorMessages['counsilMemberJob'] : '' ?></small>
                        </div>
                        <div class="form-group">
                            <label for="inputPhoto">Choisissez votre photo :</label>
                            <input type="file" name="inputPhoto" id="inputPhoto" class="form-control-file" />
                            <small class="text-danger"><?= isset($errorMessages['inputPhoto']) ? $errorMessages['inputPhoto'] : '' ?></small>
                        </div>
                        <input type="submit" name="addCounsilMember" id="addCounsilMember" class="btn" />
                    </form>
                </div>
            </div>
        </div>
        <!--Gestion de l'agenda-->
        <div class="tab-pane fade <?= $showAgendaForm ?>" id="agendaGestion" role="tabpanel" aria-labelledby="councilMembers-tab">
            <h2 class="text-center mt-4 saveFileTitle">Gestion de l'agenda :</h2>
            <div class="row m-0 d-flex justify-content-center">
                <div class="col-sm-12 col-md-4">
                    <h3>Evènements enregistrés :</h3>
                    <div class="mt-4">
                        <?php
                        if ($numberOfEvents > 0) {
                            foreach ($events as $event) {
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $event->topic ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Le <?= $event->dateFormat ?></h6>
                                        <p class="card-text"><?= $event->description ?></p>
                                        <button class="updateEventBtn btn" data-toggle="modal" data-target="#updateEventModal" data-id="<?= $event->id ?>" data-topic="<?= $event->topic ?>" data-date="<?= $event->date ?>" data-description="<?= $event->description ?>" title="Modifier"><i class="fas fa-edit"></i></button>
                                        <button class="deleteEventBtn btn" data-toggle="modal" data-target="#deleteEventModal" data-id="<?= $event->id ?>" title="Supprimer"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <h4>Aucun évènement n'a encore été enregistré.</h4>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <h3>Ajouter un évènement :</h3>
                    <form class="mt-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <p class="text-success"><?= isset($successMessages['addDate']) ? $successMessages['addDate'] : '' ?></p>
                        <div class="form-group">
                            <label for="dateTopic">Titre de l'évènement :</label>
                            <input type="text" name="dateTopic" id="dateTopic" class="form-control <?= isset($_POST['dateTopic']) ? (!isset($errorMessages['dateTopic']) ? 'is-valid' : 'is-invalid') : '' ?>" placeholder="Fête de la Saint Jean" value="<?= isset($_POST['dateTopic']) ? htmlspecialchars($_POST['dateTopic']) : '' ?>" />
                            <small class="text-danger"><?= isset($errorMessages['dateTopic']) ? $errorMessages['dateTopic'] : '' ?></small>
                        </div>
                        <div class="form-group">
                            <label for="dateDescription">Description :</label>
                            <textarea class="form-control <?= isset($_POST['dateDescription']) ? (!isset($errorMessages['dateDescription']) ? 'is-valid' : 'is-invalid') : '' ?>" name="dateDescription" id="dateDescription"><?= isset($_POST['dateDescription']) ? htmlspecialchars($_POST['dateDescription']) : '' ?></textarea>
                            <small class="text-danger"><?= isset($errorMessages['dateDescription']) ? $errorMessages['dateDescription'] : '' ?></small>
                        </div>
                        <div class="form-group">
                            <label for="eventDate"></label>
                            <input type="date" class="form-control <?= isset($_POST['eventDate']) ? (!isset($errorMessages['eventDate']) ? 'is-valid' : 'is-invalid') : '' ?>" name="eventDate" id="eventDate" value="<?= isset($_POST['eventDate']) ? htmlspecialchars($_POST['eventDate']) : '' ?>" />
                            <small class="text-danger"><?= isset($errorMessages['eventDate']) ? $errorMessages['eventDate'] : '' ?></small>
                        </div>
                        <input type="submit" class="btn" name="addDate" id="addDate" value="Enregistrer" />
                    </form>
                </div>
            </div>
        </div>
        <!--Gestion des réservations-->
        <div class="tab-pane fade <?= $showBookingForm ?>" id="bookingGestion" role="tabpanel" aria-labelledby="councilMembers-tab">
            <h2 class="text-center mt-4 saveFileTitle">Gestion des réservations :</h2>
            <div class="row m-0 d-flex justify-content-center">
                <div class="col-sm-12 col-md-3 mt-4">
                    <h3>Liste des réservations :</h3>
                    <?php
                    if ($numberOfBooking > 0) {
                        foreach ($bookings as $booking) {
                            ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Réservation</h5>
                                    <h6 class="card-subtitle mb-2">Du <?= $booking->startDateFormat ?></h6>
                                    <h6 class="card-subtitle mb-2">Au <?= $booking->endDateFormat ?></h6>
                                    <p class="card-text">Par <?= $booking->name ?></p>
                                    <button class="updateBookingBtn btn" data-toggle="modal" data-target="#updateBookingModal" data-id="<?= $booking->id ?>" data-startDate="<?= $booking->startDate ?>" data-endDate="<?= $booking->endDate ?>" data-name="<?= $booking->name ?>" title="Modifier"><i class="fas fa-edit"></i></button>
                                    <button class="deleteBookingBtn btn" data-toggle="modal" data-target="#deleteBookingModal" data-id="<?= $booking->id ?>" title="Supprimer"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <h4>Aucune réservation n'a encore été enregistrée.</h4>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-sm-12 col-md-4 mt-3">
                    <h3>Ajouter une réservation :</h3>
                    <form class="mt-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <p class="text-success"><?= isset($successMessages['addBooking']) ? $successMessages['addBooking'] : '' ?></p>
                        <div class="form-group">
                            <label for="startDate">Date du début de la réservation :</label>
                            <input type="date" name="startDate" id="startDate" class="form-control <?= isset($_POST['startDate']) ? (!isset($errorMessages['startDate']) ? 'is-valid' : 'is-invalid') : '' ?>" placeholder="Fête de la Saint Jean" value="<?= isset($_POST['startDate']) ? htmlspecialchars($_POST['startDate']) : '' ?>" required />
                            <small class="text-danger"><?= isset($errorMessages['startDate']) ? $errorMessages['startDate'] : '' ?></small>
                        </div>
                        <div class="form-group">
                            <label for="endDate">Date de la fin de la réservation :</label>
                            <input type="date" class="form-control <?= isset($_POST['endDate']) ? (!isset($errorMessages['endDate']) ? 'is-valid' : 'is-invalid') : '' ?>" name="endDate" id="endDate" value="<?= isset($_POST['endDate']) ? htmlspecialchars($_POST['endDate']) : '' ?>" required />
                            <small class="text-danger"><?= isset($errorMessages['endDate']) ? $errorMessages['endDate'] : '' ?></small>
                        </div>
                        <div class="form-group">
                            <label for="name">Réservé par :</label>
                            <input type="text" class="form-control <?= isset($_POST['name']) ? (!isset($errorMessages['name']) ? 'is-valid' : 'is-invalid') : '' ?>" name="name" id="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" required />
                            <small class="text-danger"><?= isset($errorMessages['name']) ? $errorMessages['name'] : '' ?></small>
                        </div>
                        <input type="submit" class="btn addBookingBtn" name="addBooking" id="addBooking" value="Enregistrer" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Modals-->
<!--Modification d'article-->
<div class="modal fade" id="updateArticleModal" tabindex="-1" role="dialog" aria-labelledby="updateModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="updateModalTitle">Modification d'article</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newLocationFile">Emplacement de l'article :</label>
                        <select name="newLocationFile" id="newLocationFile" class="form-control" required>
                            <option id="conseilMunicipal" value="conseilMunicipal">Conseil municipal</option>
                            <option id="bulletinCommunal" value="bulletinCommunal">Bulletin communal</option>
                            <option id="demarcheAdministrative" value="demarcheAdministrative">Démarche administrative</option>
                            <option id="informationCommunale" value="informationCommunale">Information communale</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newTitleFile">Titre du fichier :</label>
                        <input type="text" name="newTitleFile" id="newTitleFile" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="newInputFile">Choisissez votre fichier :</label>
                        <input type="file" name="newInputFile" id="newInputFile" class="form-control-file" />
                    </div>
                    <input type="hidden" name="articleId" id="articleId"/>
                    <input type="hidden" name="articlePath" id="articlePath"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-primary" name="updateArticle" id="updateArticle" value="Enregistrer les modifications" />
                </div>
            </form>
        </div>
    </div>
</div>
<!--Suppression d'article-->
<div class="modal fade" id="deleteArticleModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteModalTitle">Suppression d'article</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="modal-body">
                    <p>Désirez vous vraiment supprimer cet article ?</p>
                    <input type="hidden" name="deleteArticleId" id="deleteArticleId" />
                    <input type="hidden" name="deleteArticlePath" id="deleteArticlePath" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-danger" name="deleteArticle" id="deleteArticle" value="Supprimer l'article" />
                </div>
            </form>
        </div>
    </div>
</div>
<!--Modification d'un membre-->
<div class="modal fade" id="updateCouncilMemberModal" tabindex="-1" role="dialog" aria-labelledby="updateCouncilMemberModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="updateCouncilMemberTitle">Modification du membre</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="counsilMemberNewFirstname">Prénom :</label>
                        <input type="text" name="counsilMemberNewFirstname" id="counsilMemberNewFirstname" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="counsilMemberNewLastname">Nom :</label>
                        <input type="text" name="counsilMemberNewLastname" id="counsilMemberNewLastname" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="counsilMemberNewJob">Rôle :</label>
                        <input type="text" name="counsilMemberNewJob" id="counsilMemberNewJob" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="inputNewPhoto">Choisissez votre fichier :</label>
                        <input type="file" name="inputNewPhoto" id="inputNewPhoto" class="form-control-file" />
                    </div>
                    <input type="hidden" name="memberId" id="memberId"/>
                    <input type="hidden" name="oldPath" id="oldPath"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-primary" name="updateCounsilMember" id="updateCounsilMember" value="Enregistrer les modifications" />
                </div>
            </form>
        </div>
    </div>
</div>
<!--Suppression de membre-->
<div class="modal fade" id="deleteMemberModal" tabindex="-1" role="dialog" aria-labelledby="deleteMemberModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteMemberModalTitle">Suppression du membre</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="modal-body">
                    <p>Désirez vous vraiment supprimer ce membre ?</p>
                    <input type="hidden" name="deleteMemberId" id="deleteMemberId" />
                    <input type="hidden" name="deleteMemberPath" id="deleteMemberPath" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-danger" name="deleteMember" id="deleteMember" value="Supprimer le membre" />
                </div>
            </form>
        </div>
    </div>
</div>
<!--Modification d'un évènement-->
<div class="modal fade" id="updateEventModal" tabindex="-1" role="dialog" aria-labelledby="updateEventModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="updateCouncilMemberTitle">Modification de l'évènement</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="eventNewTopic">Titre de l'évènement :</label>
                        <input type="text" name="eventNewTopic" id="eventNewTopic" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="eventNewDescription">Description :</label>
                        <textarea name="eventNewDescription" id="eventNewDescription" class="form-control" required/></textarea>
                    </div>
                    <div class="form-group">
                        <label for="eventNewDate">Date :</label>
                        <input type="date" name="eventNewDate" id="eventNewDate" class="form-control" required/>
                    </div>
                    <input type="hidden" name="eventId" id="eventId"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-primary" name="updateEvent" id="updateEvent" value="Enregistrer les modifications" />
                </div>
            </form>
        </div>
    </div>
</div>
<!--Suppression d'un évènement-->
<div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="deleteEventModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteMemberModalTitle">Suppression de l'évènement</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="modal-body">
                    <p>Désirez vous vraiment supprimer cet évènement ?</p>
                    <input type="hidden" name="deleteEventId" id="deleteEventId" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-danger" name="deleteEvent" id="deleteEvent" value="Supprimer l'évènement" />
                </div>
            </form>
        </div>
    </div>
</div>
<!--Modification d'une réservation-->
<div class="modal fade" id="updateBookingModal" tabindex="-1" role="dialog" aria-labelledby="updateEventModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="updateBookingTitle">Modification de l'évènement</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newStartDate">Date du début de la réservation :</label>
                        <input type="date" name="newStartDate" id="newStartDate" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="newEndDate">Date de la fin de la réservation :</label>
                        <input type="date" class="form-control" name="newEndDate" id="newEndDate" required />
                    </div>
                    <div class="form-group">
                        <label for="newName">Réservé par :</label>
                        <input type="text" class="form-control" name="newName" id="newName" required />
                    </div>
                    <input type="hidden" name="bookingId" id="bookingId" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-primary" name="updateBooking" id="updateBooking" value="Enregistrer les modifications" />
                </div>
            </form>
        </div>
    </div>
</div>
<!--Suppression d'une réservation-->
<div class="modal fade" id="deleteBookingModal" tabindex="-1" role="dialog" aria-labelledby="deleteBookingModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteMemberModalTitle">Suppression d'une réservation</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="modal-body">
                    <p>Désirez vous vraiment supprimer cet évènement ?</p>
                    <input type="hidden" name="deleteBookingId" id="deleteBookingId" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-danger" name="deleteBooking" id="deleteEvent" value="Supprimer la réservation" />
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once 'includes/footer.php';
