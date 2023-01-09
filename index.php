<?php
include 'icalGenerator.php';
$link = 'YOUR_ICAL_FILE';
$from = 'YOUR_ORIGIN';
$ical = new iCalGenerator(array('fileLink' => $link, 'icalFrom' => $from));
echo '<pre>';
$ical->displayEvent();
echo '</pre>';