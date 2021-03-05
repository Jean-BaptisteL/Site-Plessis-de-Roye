<?php

$publications = new publications();
$lastPublications = $publications->showPublication();
$numberOfPublication = $publications->numberOfPublications();
function fileLocation($param) {
    $fileType = '';
    if ($param == 'conseilMunicipal'){
        $fileType = 'Compte rendu de conseil municipal';
    } else if ($param == 'bulletinCommunal'){
        $fileType = 'Bulletin communal';
    } else if ($param == 'demarcheAdministrative'){
        $fileType = 'Démarche administrative';
    } else if ($param == 'informationCommunale'){
        $fileType = 'Information communale';
    } else if ($param == 'actualite'){
        $fileType = 'Actualité';
    }
    return $fileType;
}
