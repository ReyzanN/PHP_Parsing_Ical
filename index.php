<?php
include 'icalGenerator.php';
$link = '';
$from = 'Booking.com';
$ical = new iCalGenerator(array('fileLink' => $link, 'icalFrom' => $from));
echo '<pre>';
$ical->displayEvent();
echo '</pre>';