<?php

$villagehallbooking = new villagehallbooking();
$bookings = $villagehallbooking->showBookings();

$unselectedOption = 'selected';
if (isset($_POST['year']) && isset($_POST['months']) && preg_match('/^[1-9]|1[1-2]$/', $_POST['months']) && preg_match('/^19[0-9][0-9]|20[0-9][0-9]$/', $_POST['year'])) {
    $unselectedOption = '';
}
