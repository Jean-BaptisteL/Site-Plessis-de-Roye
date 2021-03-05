<?php

$agenda = new agenda();
$agenda->deleteOldDate();
//Afficher les évènement de l'agenda
$events = $agenda->showAgenda();
$numberOfEvents = $agenda->numberOfEvent();
