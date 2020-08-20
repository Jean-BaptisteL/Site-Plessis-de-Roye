<?php
include_once 'models/users.php';
include_once 'controllers/headerCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet"> 
        <title><?= $pagetitle ?></title>
    </head>
    <body class="container-fluid p-0">
        <header>
            <div id="homeHead" class="d-flex align-items-center justify-content-center">
                <div id="titleAndBlazon" class="container-fluid p-0 row d-flex justify-content-center align-items-center">
                    <div class="col-10 text-center"> 
                        <h1 id="titleSite">Plessis de Roye - Belval</h1>
                    </div>
                    <div class="col-10 text-center">
                        <img id="villagesBlazon" src="assets/images/800px-Blason_PLESSIS_DE_ROYE.svg.png" alt="Blason de Plessier de Roye" />
                    </div>
                </div>
            </div>
            <!--Barre de navigation-->
            <nav class="navbar navbar-light navbar-expand-lg shadow-sm">
                <a class="navbar-brand" href="index.php" title="Plessis de Roye"><img id="homeButton" src="assets/images/800px-Blason_PLESSIS_DE_ROYE.svg.png" alt="Accueil" /> Accueil</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTownHall" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mairie</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownTownHall">
                                <a class="dropdown-item" href="#">Histoire de la commune</a>
                                <a class="dropdown-item" href="#">Composition du conseil</a>
                                <a class="dropdown-item" href="#">Horaires et permanences</a>
                                <a class="dropdown-item" href="#">Conseils municipaux</a>
                                <a class="dropdown-item" href="#">Bulletin communal</a>
                                <a class="dropdown-item" href="#">Démarches administratives</a>
                                <a class="dropdown-item" href="#">Nous contacter</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProjects" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Evolution du village</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownProjects">
                                <a class="dropdown-item" href="#">Plan d'urbanisme</a>
                                <a class="dropdown-item" href="#">Permis de construire</a>
                                <a class="dropdown-item" href="#">Travaux</a>
                                <a class="dropdown-item" href="#">Informations communales</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLeisure" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Associations et Loisirs</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownProjects">
                                <a class="dropdown-item" href="#">Sport et loisirs</a>
                                <a class="dropdown-item" href="#">Associations</a>
                                <a class="dropdown-item" href="#">Vie culturelle</a>
                                <a class="dropdown-item" href="#">Vie solidaire</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Actualités</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Agenda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Forum des habitants</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <form class="form-inline" action="#">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Rechercher" name="search"  method="POST" aria-label="Rechercher" aria-describedby="searchBtn">
                                <div class="input-group-append" >
                                    <button id="searchBtn" class="btn btn-outline-dark" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <?php
                        if(!isset($_SESSION['user'])){
                        ?>
                        <li class="nav-intem">                            
                            <a class="nav-link text-nowrap" href="registration.php" title="Inscription"><i class="fas fa-user-plus"></i> Inscription</a>
                        </li>
                        <li class="nav-intem"> 
                            <a class="nav-link text-nowrap" href="#" data-toggle="modal" data-target="#loginModal"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                        </li>
                        <?php
                        }else{
                        ?>
                        <li class="nav-intem">                            
                            <a class="nav-link text-nowrap" href="userProfil.php" title="Profil"><i class="fas fa-user"></i> Mon profil</a>
                        </li>
                        <li class="nav-intem"> 
                            <a class="nav-link text-nowrap" href="?signOut=true" title="Déconnexion"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </nav>
            <!--Modal de connexion-->
            <div class="modal" id="loginModal" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Connexion</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                        </div>
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="modal-body">
                                <p class="text-danger"><?= isset($errorMessagesForLogin['errorLogin']) ? $errorMessagesForLogin['errorLogin'] : '' ?></p>
                                <div class="row ml-2">
                                    <label for="userName">Adresse mail :</label><input type="text" class="col-11 form-control <?= (isset($_POST['userEmail']) ? (isset($errorMessagesForLogin['userEmail']) || isset($errorMessagesForLogin['errorLogin']) ? 'is-invalid' : 'is-valid') : '') ?>" name="userEmail" id="userEmail" required />
                                    <p class="col-10 text-danger"><?= isset($errorMessagesForLogin['userEmail']) ? $errorMessagesForLogin['userEmail'] : '' ?></p>
                                </div>
                                <div class="row ml-2">
                                    <label for="userPassword">Mot de passe :</label><input type="password" class="col-11 form-control <?= (isset($_POST['userPassword']) ? (isset($errorMessagesForLogin['userPassword']) || isset($errorMessagesForLogin['errorLogin']) ? 'is-invalid' : 'is-valid') : '') ?>" name="userPassword" id="userPassword" required />
                                    <p class="col-10 text-danger"><?= isset($errorMessagesForLogin['userPassword']) ? $errorMessagesForLogin['userPassword'] : '' ?></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <input type="submit" class="btn btn-primary" id="userLogin" name="userLogin" value="Se connecter" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>