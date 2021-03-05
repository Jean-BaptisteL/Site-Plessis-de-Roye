<?php
session_start();
$pagetitle = 'Salle des fêtes';
include_once 'models/villagehallbooking.php';
include_once 'controllers/salleDesFetesCtrl.php';
include_once 'includes/header.php';
?>
<div class="contentFormBody">
    <h2 class="pageTitle text-center">La salle des fêtes du village</h2>
    <p class="text-center text-danger mb-5">A cause de la COVID-19, la salle est inaccessible au public au moins jusqu'au 31 décembre 2020.</p>
    <div class="row m-0 d-flex justify-content-around">
        <div class="col-sm-12 col-md-5">
            <img id="photoSalle" class="mb-4 img-fluid rounded" src="assets/images/salleCommunale.JPG" alt="Salle des fêtes" />
            <p class="descriptionSalle">Il vous est possible de réserver la salle communale pour vos fêtes, anniversaires, mariages, etc.</p>
            <p class="descriptionSalle">Située dans un cadre agréable, elle est assez grande pour accueillir plusieurs dizaines de personnes.</p>
            <p class="descriptionSalle">La salle possède un parking dédié, une cuisine équipée, des tables et chaises et des toilettes.</p>
            <p class="descriptionSalle">La réservation se fait en mairie.</p>
            <p class="text-center descriptionSalle">Pour en savoir plus :<br/>
                Le secrétariat de la mairie est ouvert le mardi de 10h à 11h30 et le jeudi de 13h45 à 15h15. <br/>
                Mail : mairie.plessierderoye@wanadoo.fr<br />
                Tout mail envoyé à l’adresse de la mairie, sera suivi d’un accusé réception (AR) dans les 72 h.<br />
                Si vous ne recevez pas d’AR, prière de contacter la mairie par téléphone.<br />
                Tél.: 03 44 43 72 29</p>
        </div>
        <div class="col-sm-12 col-md-5">
            <h3 class="text-center">Calendrier des disponibilités :</h3>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label for="year">Année : </label>
                    <select class="form-control" id="year" name="year">
                        <option disabled <?= $unselectedOption ?>>--Choisissez une année--</option>
                        <?php
                        for ($year = date('Y'); $year <= date('Y', strtotime('+10 year')); $year++) {
                            if ($_POST['year'] == $year) {
                                ?><option value="<?= $year ?>" selected><?= $year ?></option>
                            <?php } else {
                                ?><option value="<?= $year ?>"><?= $year ?></option>
                            <?php } ?>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="months">Mois : </label>
                    <select id="months" name="months" class="form-control">
                        <option disabled <?= $unselectedOption ?>>--Choisissez un mois--</option>
                        <?php if (isset($_POST['months']) && $_POST['months'] == '1') { ?>
                            <option value="1" selected>Janvier</option>
                        <?php } else { ?>
                            <option value="1">Janvier</option>
                            <?php
                        }
                        if (isset($_POST['months']) && $_POST['months'] == '2') {
                            ?>
                            <option value="2" selected>Février</option>
                        <?php } else { ?>
                            <option value="2">Février</option>
                            <?php
                        }
                        if (isset($_POST['months']) && $_POST['months'] == '3') {
                            ?>
                            <option value="3" selected>Mars</option>
                        <?php } else { ?>
                            <option value="3">Mars</option>
                            <?php
                        }
                        if (isset($_POST['months']) && $_POST['months'] == '4') {
                            ?>
                            <option value="4" selected>Avril</option>
                        <?php } else { ?>
                            <option value="4">Avril</option>
                            <?php
                        }
                        if (isset($_POST['months']) && $_POST['months'] == '5') {
                            ?>
                            <option value="5" selected>Mai</option>
                        <?php } else { ?>
                            <option value="5">Mai</option>
                            <?php
                        }
                        if (isset($_POST['months']) && $_POST['months'] == '6') {
                            ?>
                            <option value="6" selected>Juin</option>
                        <?php } else { ?>
                            <option value="6">Juin</option>
                            <?php
                        }
                        if (isset($_POST['months']) && $_POST['months'] == '7') {
                            ?>
                            <option value="7" selected>Juillet</option>
                        <?php } else { ?>
                            <option value="7">Juillet</option>
                            <?php
                        }
                        if (isset($_POST['months']) && $_POST['months'] == '8') {
                            ?>
                            <option value="8" selected>Août</option>
                        <?php } else { ?>
                            <option value="8">Août</option>
                            <?php
                        }
                        if (isset($_POST['months']) && $_POST['months'] == '9') {
                            ?>
                            <option value="9" selected>Septembre</option>
                        <?php } else { ?>
                            <option value="9">Septembre</option>
                            <?php
                        }
                        if (isset($_POST['months']) && $_POST['months'] == '10') {
                            ?>
                            <option value="10" selected>Octobre</option>
                        <?php } else { ?>
                            <option value="10">Octobre</option>
                            <?php
                        }
                        if (isset($_POST['months']) && $_POST['months'] == '11') {
                            ?>
                            <option value="11" selected>Novembre</option>
                        <?php } else { ?>
                            <option value="11">Novembre</option>
                            <?php
                        }
                        if (isset($_POST['months']) && $_POST['months'] == '12') {
                            ?>
                            <option value="12" selected>Décembre</option>
                        <?php } else { ?>
                            <option value="12">Décembre</option>
                        <?php } ?>
                    </select>
                </div>
                <input type="submit" value="Calendrier" class="btn btn-secondary" />
            </form>
            <?php
            $monthName = array('1' => 'Janvier', '2' => 'Février', '3' => 'Mars', '4' => 'Avril', '5' => 'Mai', '6' => 'Juin', '7' => 'Juillet', '8' => 'Août', '9' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre');
            if (isset($_POST['year']) && isset($_POST['months']) && preg_match('/^[1-9]|1[1-2]$/', $_POST['months']) && preg_match('/^20[0-9][0-9]$/', $_POST['year'])) {
                ?>
                <h3 class="mt-5">Calendrier de <?= $monthName[$_POST['months']] ?> <?= $_POST['year'] ?></h3>
                <div class="table-responsive-sm">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Lundi</th>
                                <th>Mardi</th>
                                <th>Mercredi</th>
                                <th>Jeudi</th>
                                <th>Vendredi</th>
                                <th>Samedi</th>
                                <th>Dimanche</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                //On vérifie le nom du premier jour du mois et on ajoute des cases vide pour les jours précédents de la même semaine.
                                $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $_POST['months'], $_POST['year']);
                                $firstDayName = date("l", mktime(0, 0, 0, $_POST['months'], 1, $_POST['year']));
                                if ($firstDayName == 'Tuesday') {
                                    ?>  <td class="empty"></td> <?php
                                } else if ($firstDayName == 'Wednesday') {
                                    ?>  <td class="empty"></td>
                                    <td class="empty"></td><?php
                                } else if ($firstDayName == 'Thursday') {
                                    ?>  <td class="empty"></td>
                                    <td class="empty"></td>
                                    <td class="empty"></td><?php
                                } else if ($firstDayName == 'Friday') {
                                    $numberOfEmptyCase = 4;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?><td class="empty"></td> <?php
                                    }
                                } else if ($firstDayName == 'Saturday') {
                                    $numberOfEmptyCase = 5;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?><td class="empty"></td> <?php
                                        }
                                    } else if ($firstDayName == 'Sunday') {
                                        $numberOfEmptyCase = 6;
                                        for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                            ?><td class="empty"></td><?php
                                    }
                                }
                                //Pour le calendrier, une boucle ajoute des cases au tableau avec le numéro du jour et si le jour est un dimanche, on ajoute une ligne
                                for ($dayInCalendar = 1; $dayInCalendar <= $numberOfDays; $dayInCalendar++) {
                                    $searchSunday = date("l", mktime(0, 0, 0, $_POST['months'], $dayInCalendar, $_POST['year']));
                                    $dayDate = mktime(0, 0, 0, $_POST['months'], $dayInCalendar, $_POST['year']);
                                    $freeOrNot = 'free';
                                    foreach ($bookings as $booking) {
                                        $startDay = date_format(date_create($booking->startDate), 'j');
                                        $startMonth = date_format(date_create($booking->startDate), 'n');
                                        $startYear = date_format(date_create($booking->startDate), 'Y');
                                        $endDay = date_format(date_create($booking->endDate), 'j');
                                        $endMonth = date_format(date_create($booking->endDate), 'n');
                                        $endYear = date_format(date_create($booking->endDate), 'Y');
                                        $startTimestamp = mktime(0, 0, 0, $startMonth, $startDay, $startYear);
                                        $endTimestamp = mktime(0, 0, 0, $endMonth, $endDay, $endYear);
                                        if ($dayDate >= $startTimestamp && $dayDate <= $endTimestamp) {
                                            $freeOrNot = 'booked';
                                        }
                                    }
                                    if ($searchSunday == 'Sunday') {
                                        ?>
                                        <td class="<?= $freeOrNot ?>"><?= $dayInCalendar ?></td>
                                    </tr>
                                    <tr>
                                        <?php
                                    } else {
                                        ?><td class="<?= $freeOrNot ?>"><?= $dayInCalendar ?></td><?php
                                    }
                                }
                                //On regarde le nom du dernier jour du mois et on complète le tableau avec des cases vides.
                                $lastDayName = date("l", mktime(0, 0, 0, $_POST['months'], $numberOfDays, $_POST['year']));
                                if ($lastDayName == 'Monday') {
                                    $numberOfEmptyCase = 6;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?>  <td class="empty"></td> <?php
                                    }
                                } else if ($lastDayName == 'Tuesday') {
                                    $numberOfEmptyCase = 5;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?>  <td class="empty"></td> <?php
                                    }
                                } else if ($lastDayName == 'Wednesday') {
                                    $numberOfEmptyCase = 4;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?>  <td class="empty"></td> <?php
                                    }
                                } else if ($lastDayName == 'Thursday') {
                                    $numberOfEmptyCase = 3;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?>  <td class="empty"></td> <?php
                                    }
                                } else if ($lastDayName == 'Friday') {
                                    ?>  <td class="empty"></td> 
                                    <td class="empty"></td><?php
                                } else if ($lastDayName == 'Saturday') {
                                    ?>  <td class="empty"></td> <?php
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } else if (!isset($_POST['year']) && !isset($_POST['months'])) {
                ?>
                <h3 class="mt-5">Calendrier de <?= $monthName[date('n')] ?> <?= date('Y') ?></h3>
                <div class="table-responsive-sm">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Lundi</th>
                                <th>Mardi</th>
                                <th>Mercredi</th>
                                <th>Jeudi</th>
                                <th>Vendredi</th>
                                <th>Samedi</th>
                                <th>Dimanche</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                //On vérifie le nom du premier jour du mois et on ajoute des cases vide pour les jours précédents de la même semaine.
                                $numberOfDays = cal_days_in_month(CAL_GREGORIAN, date('n'), date('Y'));
                                $firstDayName = date("l", mktime(0, 0, 0, date('n'), 1, date('Y')));
                                if ($firstDayName == 'Tuesday') {
                                    ?>  <td class="empty"></td> <?php
                                } else if ($firstDayName == 'Wednesday') {
                                    ?>  <td class="empty"></td>
                                    <td class="empty"></td><?php
                                } else if ($firstDayName == 'Thursday') {
                                    ?>  <td class="empty"></td>
                                    <td class="empty"></td>
                                    <td class="empty"></td><?php
                                } else if ($firstDayName == 'Friday') {
                                    $numberOfEmptyCase = 4;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?><td class="empty"></td> <?php
                                    }
                                } else if ($firstDayName == 'Saturday') {
                                    $numberOfEmptyCase = 5;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?><td class="empty"></td> <?php
                                        }
                                    } else if ($firstDayName == 'Sunday') {
                                        $numberOfEmptyCase = 6;
                                        for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                            ?><td class="empty"></td><?php
                                    }
                                }
                                //Pour le calendrier, une boucle ajoute des cases au tableau avec le numéro du jour et si le jour est un dimanche, on ajoute une ligne
                                for ($dayInCalendar = 1; $dayInCalendar <= $numberOfDays; $dayInCalendar++) {
                                    $searchSunday = date("l", mktime(0, 0, 0, date('n'), $dayInCalendar, date('Y')));
                                    $dayDate = mktime(0, 0, 0, date('n'), $dayInCalendar, date('Y'));
                                    $freeOrNot = 'free';
                                    foreach ($bookings as $booking) {
                                        $startDay = date_format(date_create($booking->startDate), 'j');
                                        $startMonth = date_format(date_create($booking->startDate), 'n');
                                        $startYear = date_format(date_create($booking->startDate), 'Y');
                                        $endDay = date_format(date_create($booking->endDate), 'j');
                                        $endMonth = date_format(date_create($booking->endDate), 'n');
                                        $endYear = date_format(date_create($booking->endDate), 'Y');
                                        $startTimestamp = mktime(0, 0, 0, $startMonth, $startDay, $startYear);
                                        $endTimestamp = mktime(0, 0, 0, $endMonth, $endDay, $endYear);
                                        if ($dayDate >= $startTimestamp && $dayDate <= $endTimestamp) {
                                            $freeOrNot = 'booked';
                                        }
                                    }
                                    if ($searchSunday == 'Sunday') {
                                        ?>
                                        <td class="<?= $freeOrNot ?>"><?= $dayInCalendar ?></td>
                                    </tr>
                                    <tr>
                                        <?php
                                    } else {
                                        ?><td class="<?= $freeOrNot ?>"><?= $dayInCalendar ?></td><?php
                                    }
                                }
                                //On regarde le nom du dernier jour du mois et on complète le tableau avec des cases vides.
                                $lastDayName = date("l", mktime(0, 0, 0, date('n'), $numberOfDays, date('Y')));
                                if ($lastDayName == 'Monday') {
                                    $numberOfEmptyCase = 6;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?>  <td class="empty"></td> <?php
                                    }
                                } else if ($lastDayName == 'Tuesday') {
                                    $numberOfEmptyCase = 5;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?>  <td class="empty"></td> <?php
                                    }
                                } else if ($lastDayName == 'Wednesday') {
                                    $numberOfEmptyCase = 4;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?>  <td class="empty"></td> <?php
                                    }
                                } else if ($lastDayName == 'Thursday') {
                                    $numberOfEmptyCase = 3;
                                    for ($emptyCase = 1; $emptyCase <= $numberOfEmptyCase; $emptyCase++) {
                                        ?>  <td class="empty"></td> <?php
                                    }
                                } else if ($lastDayName == 'Friday') {
                                    ?>  <td class="empty"></td> 
                                    <td class="empty"></td><?php
                                } else if ($lastDayName == 'Saturday') {
                                    ?>  <td class="empty"></td> <?php
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php }
            ?>
            <div class="d-flex no-wrap">
                <div class="booked bookedCaption"></div>
                <p class="ml-1">: Salle réservée à cette date</p>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'includes/footer.php';
