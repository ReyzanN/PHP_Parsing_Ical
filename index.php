<?php
include 'icalGenerator.php';
$link = 'maison_au_loup_chambre_bromelia.ics';
$from = 'Booking.com';
$ical = new iCalGenerator(array('fileLink' => $link, 'icalFrom' => $from));
echo '<pre>';
$ical->displayEvent();
echo '</pre>';