<?php

$publications = new publications;
//Gestion des titres de la page et de la variable 'type' pour la requête SQL
$articlesPageTitle = '';
if ($_GET['type'] == 'CM') {
    $pagetitle = $articlesPageTitle = 'Conseils municipaux';
    $publications->type = 'conseilMunicipal';
} else if ($_GET['type'] == 'BC') {
    $pagetitle = $articlesPageTitle = 'Bulletins communaux';
    $publications->type = 'bulletinCommunal';
} else if ($_GET['type'] == 'DA') {
    $pagetitle = $articlesPageTitle = 'Démarches administratives';
    $publications->type = 'demarcheAdministrative';
} else if ($_GET['type'] == 'IC') {
    $pagetitle = $articlesPageTitle = 'Informations communales';
    $publications->type = 'informationCommunale';
} else if ($_GET['type'] == 'AC') {
    $pagetitle = $articlesPageTitle = 'Actualités';
    $publications->type = 'actualite';
} else {
    header('location: index.php');
    exit();
}
//Pagination
$offset = 0;
$page = 1;
$publicationsByType = $publications->showArticlesByTypes($offset);
$numberOfPublications = $publications->numberOfPublications();
$numberOfPages = ceil($numberOfPublications / 10);
if (isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT) && $_GET['page'] <= $numberOfPages) {
    $page = $_GET['page'];
    $offset = ($page - 1) * 10;
    $publicationsByType = $publications->showArticlesByTypes($offset);
} else if (isset($_GET['page']) && (!filter_var($_GET['page'], FILTER_VALIDATE_INT) || $_GET['page'] >= $numberOfPages || $_GET['page'] < 1)){
    header('location: index.php');
    exit();
}
