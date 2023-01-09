# PHP_Parsing_Ical
* Utility : Parse Ical file in php to have data in array of all envent.
* Requirement : PHP 5.2 > | WebServer

# How To use : 
* Include icalGenerator.php to your file
```
include 'icalGenerator.php';
```

* Define link of Ical file :
```
$link = 'YOUR_ICAL_FILE.ics';
```

* Define origin :
```
$from = 'YOUR_ORIGIN';
```

* Define a new Ical Generator 
```
$ical = new iCalGenerator(array('fileLink' => $link, 'icalFrom' => $from));
```

* Tools to display
```
$ical->displayEvent(); --> var_dump off all event
```

* GetAll Event 
```
$ical->getEvent();
```
