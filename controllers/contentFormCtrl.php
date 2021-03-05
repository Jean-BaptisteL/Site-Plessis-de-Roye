<?php

if (!isset($_SESSION['user']) && $_SESSION['user']['userFirstname'] != 'MairieDePlessisEtBelval') {
    header('location: index.php');
    exit();
}
$errorMessages = array();
$successMessages = array();
$publications = new publications();
$agenda = new agenda();
$villagehallbooking = new villagehallbooking();
$agenda->deleteOldDate();
$showArticlesManagement = 'show active';
$showArticlesManagementLink = 'active';
$showCounsilForm = '';
$showCounsilFormLink = '';
$showAgendaForm = '';
$showAgendaFormLink = '';
$showBookingForm = '';
$showBookingFormLink = '';
//Ajout de fichier :
if (isset($_POST['saveFile'])) {
    $showArticlesManagement = 'show active';
    $showArticlesManagementLink = 'active';
    $publicationLacation = '';
    if (isset($_POST['locationFile'])) {
        if ($_POST['locationFile'] == 'conseilMunicipal') {
            $publications->type = htmlspecialchars('conseilMunicipal');
            $publicationLacation = 'consMuni';
        } else if ($_POST['locationFile'] == 'bulletinCommunal') {
            $publications->type = htmlspecialchars('bulletinCommunal');
            $publicationLacation = 'bullComm';
        } else if ($_POST['locationFile'] == 'demarcheAdministrative') {
            $publications->type = htmlspecialchars('demarcheAdministrative');
            $publicationLacation = 'demaAdmi';
        } else if ($_POST['locationFile'] == 'informationCommunale') {
            $publications->type = htmlspecialchars('informationCommunale');
            $publicationLacation = 'infoComm';
        } else if ($_POST['locationFile'] == 'actualite') {
            $publications->type = htmlspecialchars('actualite');
            $publicationLacation = 'actus';
        } else {
            $errorMessages['locationFile'] = 'Veuillez sélectionner un emplacement de la liste.';
        }
    } else {
        $errorMessages['locationFile'] = 'Veuillez sélectionner un emplacement pour l\'article.';
    }
    if (isset($_POST['titleFile'])) {
        $publications->title = htmlspecialchars($_POST['titleFile']);
        $titleExists = $publications->checkIfArticleTitleExists();
        if ($titleExists->titleExists > 0) {
            $errorMessages['titleFile'] = 'Ce titre existe déjà .';
        }
    } else {
        $errorMessages['titleFile'] = 'Veillez donner un titre à  l\'article.';
    }
    if (isset($_FILES['inputFile']) && $_FILES['inputFile']['error'] == 0) {
        if ($_FILES['inputFile']['size'] <= 30000000) {
            $infosfichier = pathinfo($_FILES['inputFile']['name']);
            $extension_upload = $infosfichier['extension'];
            if ($extension_upload == 'pdf') {
                $path = 'pdfFiles/' . $publicationLacation . '/' . basename($_FILES['inputFile']['name']);
                $publications->path = $path;
                $publicationExists = $publications->checkIfArticleExists();
                if ($publicationExists->articleExists == 0) {
                    if (count(explode('/', basename($_FILES['inputFile']['name']))) > 0) {
                        if (count($errorMessages) == 0) {
                            move_uploaded_file($_FILES['inputFile']['tmp_name'], $path);
                            $publications->addNewPublication();
                            $successMessages['savedFile'] = 'Enregistrement de l\'article réussi !';
                        }
                    } else {
                        $errorMessages['inputFile'] = 'Le nom du fichier ne doit pas contenir  de \'/\'.';
                    }
                } else {
                    $errorMessages['inputFile'] = 'Un fichier avec un nom identique existe déjà  à   l\'emplacement que vous avez choisi.';
                }
            } else {
                $errorMessages['inputFile'] = 'Seuls les fichiers PDF sont acceptés.';
            }
        } else {
            $errorMessages['inputFile'] = 'La taille du fichier ne doit pas dépasser les 30Mo.';
        }
    } else {
        $errorMessages['inputFile'] = 'Veuillez sélectionner un fichier.';
    }
}

//Update des articles
if (isset($_POST['updateArticle'])) {
    $publicationLacation = '';
    if (isset($_POST['newLocationFile'])) {
        if ($_POST['newLocationFile'] == 'conseilMunicipal') {
            $publications->type = htmlspecialchars('conseilMunicipal');
            $publicationLacation = 'consMuni';
        } else if ($_POST['newLocationFile'] == 'bulletinCommunal') {
            $publications->type = htmlspecialchars('bulletinCommunal');
            $publicationLacation = 'bullComm';
        } else if ($_POST['newLocationFile'] == 'demarcheAdministrative') {
            $publications->type = htmlspecialchars('demarcheAdministrative');
            $publicationLacation = 'demaAdmi';
        } else if ($_POST['newLocationFile'] == 'informationCommunale') {
            $publications->type = htmlspecialchars('informationCommunale');
            $publicationLacation = 'infoComm';
        } else {
            $errorMessages['newLocationFile'] = 'Veuillez sélectionner un emplacement de la liste.';
        }
    } else {
        $errorMessages['newLocationFile'] = 'Veuillez sélectionner un emplacement pour l\'article.';
    }
    if (isset($_POST['newTitleFile'])) {
        $publications->title = htmlspecialchars($_POST['newTitleFile']);
        if (filter_var($_POST['articleId'], FILTER_VALIDATE_INT)) {
            $publications->id = htmlspecialchars($_POST['articleId']);
            $titleExists = $publications->checkIfArticleTitleExistsById();
            if ($titleExists->titleExists > 0) {
                $errorMessages['newTitleFile'] = 'Ce titre existe déjà .';
            }
        }
    } else {
        $errorMessages['newTitleFile'] = 'Veillez donner un titre à  l\'article.';
    }
    if (count($errorMessages) == 0 && filter_var($_POST['articleId'], FILTER_VALIDATE_INT) && $_FILES['newInputFile']['error'] != 0) {
        $publications->id = $_POST['articleId'];
        $oldPath = $_POST['articlePath'];
        $oldPathArray = explode('/', $oldPath);
        $newPath = $oldPathArray[0] . '/' . $publicationLacation . '/' . $oldPathArray[2];
        rename($oldPath, $newPath);
        $publications->path = $newPath;
        $idAndPathExist = $publications->checkIfIdAndPathExist();
        if ($idAndPathExist->idAndPathExists == 1) {
            $publications->updateArticleInfos();
            $successMessages['updateArticleInfos'] = 'Mise à  jour effectuée.';
            $allArticles = $publications->showAllArticles($offset);
        } else {
            $errorMessages['articleId'] = 'Cet article n\'existe pas.';
        }
    }
    if (isset($_FILES['newInputFile']) && $_FILES['newInputFile']['error'] == 0) {
        if ($_FILES['newInputFile']['size'] <= 30000000) {
            $infosfichier = pathinfo($_FILES['newInputFile']['name']);
            $extension_upload = $infosfichier['extension'];
            if ($extension_upload == 'pdf') {
                $path = 'pdfFiles/' . $publicationLacation . '/' . basename($_FILES['newInputFile']['name']);
                $publications->path = $path;
                $publicationExists = $publications->checkIfArticleExists();
                if ($publicationExists->articleExists == 0) {
                    if (count(explode('/', basename($_FILES['newInputFile']['name']))) > 0) {
                        if (count($errorMessages) == 0 && filter_var($_POST['articleId'], FILTER_VALIDATE_INT)) {
                            $publications->id = $_POST['articleId'];
                            $idAndPathExist = $publications->checkIfIdAndPathExist();
                            if ($idAndPathExist->idAndPathExists == 1) {
                                unlink($_POST['articlePath']);
                                move_uploaded_file($_FILES['newInputFile']['tmp_name'], $path);
                                $publications->updateArticleInfos();
                                $successMessages['savedNewFile'] = 'Mise à  jour effectuée.';
                                $allArticles = $publications->showAllArticles($offset);
                            } else {
                                $errorMessages['newInputFile'] = 'Cet article n\'existe pas.';
                            }
                        }
                    } else {
                        $errorMessages['newInputFile'] = 'Le nom du fichier ne doit pas contenir  de \'/\'.';
                    }
                } else {
                    $errorMessages['newInputFile'] = 'Un fichier avec un nom identique existe déjà  à   l\'emplacement que vous avez choisi.';
                }
            } else {
                $errorMessages['newInputFile'] = 'Seuls les fichiers PDF sont acceptés.';
            }
        } else {
            $errorMessages['newInputFile'] = 'La taille du fichier ne doit pas dépasser les 30Mo.';
        }
    }
}
//Affichage messages d'erreurs
$messages = '';
if (isset($errorMessages['newLocationFile'])) {
    $messages = $messages . ' ' . $errorMessages['newLocationFile'];
}
if (isset($errorMessages['newTitleFile'])) {
    $messages = $messages . ' ' . $errorMessages['newTitleFile'];
}
if (isset($errorMessages['newInputFile'])) {
    $messages = $messages . ' ' . $errorMessages['newInputFile'];
}
if (isset($successMessages['savedNewFile'])) {
    $messages = $successMessages['savedNewFile'];
} else if (isset($successMessages['updateArticleInfos'])) {
    $messages = $successMessages['updateArticleInfos'];
}

//Suppression des articles
if (isset($_POST['deleteArticle'])) {
    if (isset($_POST['deleteArticleId']) && filter_var($_POST['deleteArticleId'], FILTER_VALIDATE_INT)) {
        $publications->id = htmlspecialchars($_POST['deleteArticleId']);
    } else {
        $errorMessages['deleteArticleId'] = 'Veuillez ne pas toucher aux inputs cachés.';
    }
    if (isset($_POST['deleteArticlePath'])) {
        $publications->path = htmlspecialchars($_POST['deleteArticlePath']);
    } else {
        $errorMessages['deleteArticlePath'] = 'Veuillez ne pas toucher aux inputs cachés.';
    }
    if (count($errorMessages) == 0) {
        $idAndPathExist = $publications->checkIfIdAndPathExist();
        if ($idAndPathExist->idAndPathExists == 1) {
            unlink($_POST['deleteArticlePath']);
            $publications->deleteArticle();
        } else {
            $errorMessages['deleteArticle'] = 'Cet article n\'existe pas.';
        }
    }
}

//Affichage des articles et pagination :
$offset = 0;
$page = 1;
$allArticles = $publications->showAllArticles($offset);
$numberOfPublications = $publications->numberOfPublications();
$numberOfPages = ceil($numberOfPublications / 10);
if (isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT) && $_GET['page'] <= $numberOfPages) {
    $page = $_GET['page'];
    $offset = ($page - 1) * 10;
    $allArticles = $publications->showAllArticles($offset);
} else if (isset($_GET['page']) && (!filter_var($_GET['page'], FILTER_VALIDATE_INT) || $_GET['page'] >= $numberOfPages || $_GET['page'] < 1)) {
    header('location: index.php');
    exit();
}

function articleType($param) {
    $fileType = '';
    if ($param == 'conseilMunicipal') {
        $fileType = 'Compte rendu de conseil municipal';
    } else if ($param == 'bulletinCommunal') {
        $fileType = 'Bulletin communal';
    } else if ($param == 'demarcheAdministrative') {
        $fileType = 'Démarche administrative';
    } else if ($param == 'informationCommunale') {
        $fileType = 'Information communale';
    }
    return $fileType;
}

//Ajout de membre du conseil municipal
$councilComposition = new councilComposition();
$firstnameRegex = '/^[A-Z][a-zA-Zéèêàëïäçùô-]+$/';
$lastnameOrJobRegex = '/^[A-Z][a-zA-ZéÉèÈêÊæÆàëËïÏäçÇùô\s-]+$/';
if (isset($_POST['addCounsilMember'])) {
    $showArticlesManagement = $showArticlesManagementLink = '';
    $showCounsilForm = 'show active';
    $showCounsilFormLink = 'active';
    if (isset($_POST['counsilMemberFirstname'])) {
        if (preg_match($firstnameRegex, $_POST['counsilMemberFirstname'])) {
            $councilComposition->firstname = htmlspecialchars($_POST['counsilMemberFirstname']);
        } else {
            $errorMessages['counsilMemberFirstname'] = 'Le prénom doit commencer par une majuscule. Les chiffres, les caractères spéciaux et les espaces ne sont pas autorisés.';
        }
    } else {
        $errorMessages['counsilMemberFirstname'] = 'Veuillez entrer un prénom.';
    }
    if (isset($_POST['counsilMemberLastname'])) {
        if (preg_match($lastnameOrJobRegex, $_POST['counsilMemberLastname'])) {
            $councilComposition->lastname = htmlspecialchars($_POST['counsilMemberLastname']);
        } else {
            $errorMessages['counsilMemberLastname'] = 'Le nom doit commencer par une majuscule. Les chiffres et les caractères spéciaux ne sont pas autorisés.';
        }
    } else {
        $errorMessages['counsilMemberLastname'] = 'Veuillez entrer un nom.';
    }
    if (isset($_POST['counsilMemberJob'])) {
        if (preg_match($lastnameOrJobRegex, $_POST['counsilMemberJob'])) {
            $councilComposition->job = htmlspecialchars($_POST['counsilMemberJob']);
        } else {
            $errorMessages['counsilMemberJob'] = 'Le rôle doit commencer par une majuscule. Les chiffres et les caractères spéciaux ne sont pas autorisés.';
        }
    } else {
        $errorMessages['counsilMemberJob'] = 'Veuillez entrer un rôle.';
    }
    if (isset($_FILES['inputPhoto']) && $_FILES['inputPhoto']['error'] == 0) {
        $ifMemberExists = $councilComposition->checkIfMemberExists();
        if ($ifMemberExists->memberExists == 0) {
            if ($_FILES['inputPhoto']['size'] <= 2000000) {
                $infosfichier = pathinfo($_FILES['inputPhoto']['name']);
                $extensionUpload = $infosfichier['extension'];
                $autorisedExtensions = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array($extensionUpload, $autorisedExtensions)) {
                    $path = 'counsilMembers/' . htmlspecialchars($_POST['counsilMemberFirstname']) . htmlspecialchars($_POST['counsilMemberLastname']) . '.' . $extensionUpload;
                    $councilComposition->photoPath = $path;
                    if (count($errorMessages) == 0) {
                        move_uploaded_file($_FILES['inputPhoto']['tmp_name'], $path);
                        $councilComposition->addNewConcilMember();
                        $successMessages['addCounsilMember'] = 'Enregistrement réussi !';
                    }
                } else {
                    $errorMessages['inputPhoto'] = 'Seuls les fichiers ayant le format jpg ou jpeg ou png ou gif sont autorisés.';
                }
            } else {
                $errorMessages['inputPhoto'] = 'La taille de la photo ne doit pas dépasser les 2Mo.';
            }
        } else {
            $errorMessages['counsilMemberFirstname'] = $errorMessages['counsilMemberLastname'] = 'Un membre du conseil portant le même nom et le même prénom existe déjà .';
        }
    } else {
        $errorMessages['inputPhoto'] = 'Veuillez sélectionner une photo.';
    }
}

//Modification des membres
if (isset($_POST['updateCounsilMember'])) {
    $showArticlesManagement = $showArticlesManagementLink = '';
    $showCounsilForm = 'show active';
    $showCounsilFormLink = 'active';
    if (isset($_POST['counsilMemberNewFirstname'])) {
        if (preg_match($firstnameRegex, $_POST['counsilMemberNewFirstname'])) {
            $councilComposition->firstname = htmlspecialchars($_POST['counsilMemberNewFirstname']);
        } else {
            $errorMessages['counsilMemberNewFirstname'] = 'Le prénom doit commencer par une majuscule. Les chiffres, les caractères spéciaux et les espaces ne sont pas autorisés.';
        }
    } else {
        $errorMessages['counsilMemberNewFirstname'] = 'Veuillez entrer un prénom.';
    }
    if (isset($_POST['counsilMemberNewLastname'])) {
        if (preg_match($lastnameOrJobRegex, $_POST['counsilMemberNewLastname'])) {
            $councilComposition->lastname = htmlspecialchars($_POST['counsilMemberNewLastname']);
        } else {
            $errorMessages['counsilMemberNewLastname'] = 'Le nom doit commencer par une majuscule. Les chiffres et les caractères spéciaux ne sont pas autorisés.';
        }
    } else {
        $errorMessages['counsilMemberNewLastname'] = 'Veuillez entrer un nom.';
    }
    if (isset($_POST['counsilMemberNewJob'])) {
        if (preg_match($lastnameOrJobRegex, $_POST['counsilMemberNewJob'])) {
            $councilComposition->job = htmlspecialchars($_POST['counsilMemberNewJob']);
        } else {
            $errorMessages['counsilMemberNewJob'] = 'Le rôle doit commencer par une majuscule. Les chiffres et les caractères spéciaux ne sont pas autorisés.';
        }
    } else {
        $errorMessages['counsilMemberNewJob'] = 'Veuillez entrer un rôle.';
    }
    if (isset($_POST['memberId']) && filter_var($_POST['memberId'], FILTER_VALIDATE_INT)) {
        $councilComposition->id = htmlspecialchars($_POST['memberId']);
    } else {
        $errorMessages['memberId'] = 'Veuillez ne pas modifier les inputs cachés s\'il vous plaît.';
    }
    if (!isset($_POST['oldPath'])) {
        $errorMessages['oldPath'] = 'Veuillez ne pas modifier les inputs cachés s\'il vous plaît.';
    }
    if (isset($_FILES['inputNewPhoto']) && $_FILES['inputNewPhoto']['error'] == 0) {
        $ifMemberExists = $councilComposition->checkIfOtherMemberExists();
        if ($ifMemberExists->memberExists == 0) {
            if ($_FILES['inputNewPhoto']['size'] <= 2000000) {
                $infosfichier = pathinfo($_FILES['inputNewPhoto']['name']);
                $extensionUpload = $infosfichier['extension'];
                $autorisedExtensions = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array($extensionUpload, $autorisedExtensions)) {
                    $newPath = 'counsilMembers/' . htmlspecialchars($_POST['counsilMemberNewFirstname']) . htmlspecialchars($_POST['counsilMemberNewLastname']) . '.' . $extensionUpload;
                    $councilComposition->photoPath = $newPath;
                    if (count($errorMessages) == 0) {
                        unlink($_POST['oldPath']);
                        move_uploaded_file($_FILES['inputNewPhoto']['tmp_name'], $newPath);
                        $councilComposition->updateMemberInfos();
                        $successMessages['updateMemberInfos'] = 'Modification réussi !';
                    }
                } else {
                    $errorMessages['inputNewPhoto'] = 'Seuls les fichiers ayant le format jpg ou jpeg ou png ou gif sont autorisés.';
                }
            } else {
                $errorMessages['inputNewPhoto'] = 'La taille de la photo ne doit pas dépasser les 2Mo.';
            }
        } else {
            $errorMessages['counsilMemberNewFirstname'] = $errorMessages['counsilMemberNewLastname'] = 'Un membre du conseil portant le même nom et le même prénom existe déjà .';
        }
    }
    if ($_FILES['inputNewPhoto']['error'] != 0) {
        $ifMemberExists = $councilComposition->checkIfOtherMemberExists();
        if ($ifMemberExists->memberExists == 0) {
            $expodedOldPath = explode('.', $_POST['oldPath']);
            $newPath = 'counsilMembers/' . htmlspecialchars($_POST['counsilMemberNewFirstname']) . htmlspecialchars($_POST['counsilMemberNewLastname']) . '.' . $expodedOldPath[1];
            $councilComposition->photoPath = $newPath;
            if (count($errorMessages) == 0) {
                rename($_POST['oldPath'], $newPath);
                $councilComposition->updateMemberInfos();
                $successMessages['updateMemberInfos'] = 'Modification réussi !';
            }
        } else {
            $errorMessages['counsilMemberNewFirstname'] = $errorMessages['counsilMemberNewLastname'] = 'Un membre du conseil portant le même nom et le même prénom existe déjà .';
        }
    }
}

//Suppression des membres
if (isset($_POST['deleteMember'])) {
    $showArticlesManagement = $showArticlesManagementLink = '';
    $showCounsilForm = 'show active';
    $showCounsilFormLink = 'active';
    if (isset($_POST['deleteMemberId']) && filter_var($_POST['deleteMemberId'], FILTER_VALIDATE_INT)) {
        $councilComposition->id = htmlspecialchars($_POST['deleteMemberId']);
    } else {
        $errorMessages['deleteMemberId'] = 'Veuillez ne pas toucher aux inputs cachés.';
    }
    if (isset($_POST['deleteMemberPath'])) {
        $councilComposition->photoPath = htmlspecialchars($_POST['deleteMemberPath']);
    } else {
        $errorMessages['deleteMemberPath'] = 'Veuillez ne pas toucher aux inputs cachés.';
    }
    if (count($errorMessages) == 0) {
        $idAndPathExist = $councilComposition->checkIfIdAndPathOfMemberExist();
        if ($idAndPathExist->idAndPathExists == 1) {
            unlink($_POST['deleteMemberPath']);
            $councilComposition->deleteMember();
        } else {
            $errorMessages['deleteMember'] = 'Ce membre n\'existe pas.';
        }
    }
}

//Affichage des membres du conseil
$theMayor = $councilComposition->showMayor();
$mayorExists = $councilComposition->numberOfMember();
$assistants = $councilComposition->showAssistants();
$numberOfAssistants = $councilComposition->numberOfMember();
$advisors = $councilComposition->showAdvisor();
$numberOfAdvisors = $councilComposition->showAdvisor();
$otherMembers = $councilComposition->showOtherMembers();
$numberOfOtherMembers = $councilComposition->showAdvisor();

//Ajout d'une entrée à l'agenda
if (isset($_POST['addDate'])) {
    $showArticlesManagement = $showArticlesManagementLink = '';
    $showAgendaForm = 'show active';
    $showAgendaFormLink = 'active';
    if (isset($_POST['dateTopic'])) {
        $agenda->topic = htmlspecialchars($_POST['dateTopic']);
    } else {
        $errorMessages['dateTopic'] = 'Veuillez donner un titre à l\'évènement.';
    }
    if (isset($_POST['dateDescription'])) {
        $agenda->description = htmlspecialchars($_POST['dateDescription']);
    } else {
        $errorMessages['dateDescription'] = 'Veuillez décrire l\'évènement';
    }
    if (isset($_POST['eventDate'])) {
        if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $_POST['eventDate'])) {
            $explodedDate = explode('-', $_POST['eventDate']);
            if (checkdate($explodedDate[1], $explodedDate[2], $explodedDate[0])) {
                if (date('Y-m-d') <= $_POST['eventDate']) {
                    $agenda->date = htmlspecialchars($_POST['eventDate']);
                } else {
                    $errorMessages['eventDate'] = 'Veuillez sélectionner une date future.';
                }
            } else {
                $errorMessages['eventDate'] = 'Veuillez sélectionner une date valide.';
            }
        } else {
            $errorMessages['eventDate'] = 'Veuillez ne pas modifier l\'input type date.';
        }
    } else {
        $errorMessages['eventDate'] = 'Veuillez sélectionner une date.';
    }
    if (count($errorMessages) == 0) {
        $agenda->addNewDate();
        $successMessages['addDate'] = 'L\'évènement a bien été enregistré.';
    }
}

//Modification d'une entrée à l'agenda
if (isset($_POST['updateEvent'])) {
    $showArticlesManagement = $showArticlesManagementLink = '';
    $showAgendaForm = 'show active';
    $showAgendaFormLink = 'active';
    if (isset($_POST['eventNewTopic'])) {
        $agenda->topic = htmlspecialchars($_POST['eventNewTopic']);
    } else {
        $errorMessages['eventNewTopic'] = 'Veuillez donner un titre à l\'évènement.';
    }
    if (isset($_POST['eventNewDescription'])) {
        $agenda->description = htmlspecialchars($_POST['eventNewDescription']);
    } else {
        $errorMessages['eventNewDescription'] = 'Veuillez décrire l\'évènement';
    }
    if (isset($_POST['eventNewDate'])) {
        if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $_POST['eventNewDate'])) {
            $explodedDate = explode('-', $_POST['eventNewDate']);
            if (checkdate($explodedDate[1], $explodedDate[2], $explodedDate[0])) {
                if (date('Y-m-d') <= $_POST['eventNewDate']) {
                    $agenda->date = htmlspecialchars($_POST['eventNewDate']);
                } else {
                    $errorMessages['eventNewDate'] = 'Veuillez sélectionner une date future.';
                }
            } else {
                $errorMessages['eventNewDate'] = 'Veuillez sélectionner une date valide.';
            }
        } else {
            $errorMessages['eventNewDate'] = 'Veuillez ne pas modifier l\'input type date.';
        }
    } else {
        $errorMessages['eventNewDate'] = 'Veuillez sélectionner une date.';
    }
    if (isset($_POST['eventId']) && filter_var($_POST['eventId'], FILTER_VALIDATE_INT)) {
        $agenda->id = htmlspecialchars($_POST['eventId']);
    } else {
        $errorMessages['eventId'] = 'Veuillez ne pas modifier les inputs cachés s\'il vous plaît.';
    }
    if (count($errorMessages) == 0) {
        $agenda->updateDate();
        $successMessages['updateEvent'] = 'L\'évènement a bien été modifié.';
    }
}

//Suppression des membres
if (isset($_POST['deleteEvent'])) {
    $showArticlesManagement = $showArticlesManagementLink = '';
    $showAgendaForm = 'show active';
    $showAgendaFormLink = 'active';
    if (isset($_POST['deleteEventId']) && filter_var($_POST['deleteEventId'], FILTER_VALIDATE_INT)) {
        $agenda->id = htmlspecialchars($_POST['deleteEventId']);
    } else {
        $errorMessages['deleteEventId'] = 'Veuillez ne pas toucher aux inputs cachés.';
    }
    if (count($errorMessages) == 0) {
        $eventExists = $agenda->checkIfEventExist();
        if ($eventExists->numberOfEvent == 1) {
            $agenda->deleteDate();
        }
    }
}

//Afficher les évènement de l'agenda
$events = $agenda->showAgenda();
$numberOfEvents = $agenda->numberOfEvent();

//Ajouter une réservation
if (isset($_POST['addBooking'])) {
    $showArticlesManagement = $showArticlesManagementLink = '';
    $showBookingForm = 'show active';
    $showBookingFormLink = 'active';
    if (isset($_POST['startDate'])) {
        if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $_POST['startDate'])) {
            $explodedDate = explode('-', $_POST['startDate']);
            if (checkdate($explodedDate[1], $explodedDate[2], $explodedDate[0])) {
                if (date('Y-m-d') <= $_POST['startDate']) {
                    $villagehallbooking->startDate = htmlspecialchars($_POST['startDate']);
                } else {
                    $errorMessages['startDate'] = 'Veuillez sélectionner une date future.';
                }
            } else {
                $errorMessages['startDate'] = 'Veuillez sélectionner une date valide.';
            }
        } else {
            $errorMessages['startDate'] = 'Veuillez ne pas modifier l\'input type date.';
        }
    } else {
        $errorMessages['startDate'] = 'Veuillez sélectionner une date.';
    }
    if (isset($_POST['endDate'])) {
        if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $_POST['endDate'])) {
            $explodedDate = explode('-', $_POST['endDate']);
            if (checkdate($explodedDate[1], $explodedDate[2], $explodedDate[0])) {
                if (date('Y-m-d') <= $_POST['endDate'] && $_POST['endDate'] >= $_POST['startDate']) {
                    $villagehallbooking->endDate = htmlspecialchars($_POST['endDate']);
                } else {
                    $errorMessages['endDate'] = 'Veuillez sélectionner une date future.';
                }
            } else {
                $errorMessages['endDate'] = 'Veuillez sélectionner une date valide.';
            }
        } else {
            $errorMessages['endDate'] = 'Veuillez ne pas modifier l\'input type date.';
        }
    } else {
        $errorMessages['endDate'] = 'Veuillez sélectionner une date.';
    }
    if (isset($_POST['name'])) {
        $villagehallbooking->name = htmlspecialchars($_POST['name']);
    } else {
        $errorMessages['name'] = 'Veuillez donner le nom de la personne qui a réserver.';
    }
    if (count($errorMessages) == 0) {
        $villagehallbooking->addBooking();
        $successMessages['addBooking'] = 'La réservation a bien été enregistré.';
    }
}

//Modifier les réservations
if (isset($_POST['updateBooking'])) {
    $showArticlesManagement = $showArticlesManagementLink = '';
    $showBookingForm = 'show active';
    $showBookingFormLink = 'active';
    if (isset($_POST['newStartDate'])) {
        if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $_POST['newStartDate'])) {
            $explodedDate = explode('-', $_POST['newStartDate']);
            if (checkdate($explodedDate[1], $explodedDate[2], $explodedDate[0])) {
                if (date('Y-m-d') <= $_POST['newStartDate']) {
                    $villagehallbooking->startDate = htmlspecialchars($_POST['newStartDate']);
                } else {
                    $errorMessages['newStartDate'] = 'Veuillez sélectionner une date future.';
                }
            } else {
                $errorMessages['newStartDate'] = 'Veuillez sélectionner une date valide.';
            }
        } else {
            $errorMessages['newStartDate'] = 'Veuillez ne pas modifier l\'input type date.';
        }
    } else {
        $errorMessages['newStartDate'] = 'Veuillez sélectionner une date.';
    }
    if (isset($_POST['newEndDate'])) {
        if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $_POST['newEndDate'])) {
            $explodedDate = explode('-', $_POST['newEndDate']);
            if (checkdate($explodedDate[1], $explodedDate[2], $explodedDate[0])) {
                if (date('Y-m-d') <= $_POST['newEndDate'] && $_POST['newEndDate'] >= $_POST['newStartDate']) {
                    $villagehallbooking->endDate = htmlspecialchars($_POST['newEndDate']);
                } else {
                    $errorMessages['newEndDate'] = 'Veuillez sélectionner une date future.';
                }
            } else {
                $errorMessages['newEndDate'] = 'Veuillez sélectionner une date valide.';
            }
        } else {
            $errorMessages['newEndDate'] = 'Veuillez ne pas modifier l\'input type date.';
        }
    } else {
        $errorMessages['newEndDate'] = 'Veuillez sélectionner une date.';
    }
    if (isset($_POST['newName'])) {
        $villagehallbooking->name = htmlspecialchars($_POST['newName']);
    } else {
        $errorMessages['newName'] = 'Veuillez donner un titre à l\'évènement.';
    }
    if (isset($_POST['bookingId']) && filter_var($_POST['bookingId'], FILTER_VALIDATE_INT)) {
        $villagehallbooking->id = htmlspecialchars($_POST['bookingId']);
    } else {
        $errorMessages['bookingId'] = 'Veuillez ne pas toucher aux inputs cachés.';
    }
    if (count($errorMessages) == 0) {
        $villagehallbooking->updateBooking();
        $successMessages['updateBooking'] = 'L\'évènement à bien été enregistré.';
    }
}

//Supprimer une réservation
if (isset($_POST['deleteBooking'])) {
    $showArticlesManagement = $showArticlesManagementLink = '';
    $showBookingForm = 'show active';
    $showBookingFormLink = 'active';
    if (isset($_POST['deleteBookingId']) && filter_var($_POST['deleteBookingId'], FILTER_VALIDATE_INT)) {
        $villagehallbooking->id = htmlspecialchars($_POST['deleteBookingId']);
    } else {
        $errorMessages['deleteBookingId'] = 'Veuillez ne pas toucher aux inputs cachés.';
    }
    if (count($errorMessages) == 0) {
        $bookingExists = $villagehallbooking->checkIfBookingExist();
        if ($bookingExists->numberOfBooking == 1) {
            $villagehallbooking->deleteDate();
        }
    }
}

//Afficher les réservations
$bookings = $villagehallbooking->showBookings();
$numberOfBooking = $villagehallbooking->numberOfBooking();
