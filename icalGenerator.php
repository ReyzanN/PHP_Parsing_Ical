<?php
/*
 * Regex
 * https://www.w3schools.com/php/php_regex.asp
 */

/**
 * @usage Sert à avoir les dates de location d'un fichier Ical.
 */
class iCalGenerator{
    private $File = null;
    private $FileContent;
    private $IcalFrom;
    private $Title = null;
    private $Version;
    private $EventTemp = array();
    public $Event = array();

    /**
     * @param $Data - Ical file content
     * @throws Exception - Custom No array
     */
    function __construct(array $Data){
        if (empty($Data['fileLink'])){
            throw new Exception('Erreur lien fichier');
        }
        if (empty($Data['icalFrom'])){
            throw new Exception('Merci de renseigner la provenance du fichier Ical');
        }
        $this->File = $Data['fileLink'];
        $this->FileContent = file_get_contents($this->File);
        $this->IcalFrom = $Data['icalFrom'];
        // Parsing Event
        $this->EventTemp = $this->parsingEvent($this->FileContent);
        for ($i = 0; $i < count($this->EventTemp[1]); $i++){
            $this->Event[] = $this->parsingEventAll($this->EventTemp[0][$i]);
        }
    }

    /**
     * @return var_durmp of file
     */
    public function displayFile(){
        return var_dump($this->FileContent);
    }

    /**
     * @return var_dump of events
     */
    public function displayEvent(){
        return var_dump($this->Event);
    }

    /**
     * @param $DataIcal Array of one event none parsed
     * @throws Exception
     * @return array of params of event parsed
     */
    private function parsingEventAll($DataIcal):array{
        $DateStart =  new DateTime($this->parseEventBegin($DataIcal));
        $DateEnd =  new DateTime($this->parseEventEnd($DataIcal));
        return array(
            'Summary' => $this->parsingSummary($DataIcal),
            'UID' => $this->parsingUID($DataIcal),
            'DateStart' => $DateStart->format('d-m-Y'),
            'DateEnd' => $DateEnd->format('d-m-Y')
        );
    }

    /**
     * @param $DataIcal Array of one event none parsed
     * @return string - Summary of calendar ( CLOSED - Gloria )
     */
    private function parsingSummary($DataIcal){
        preg_match('`^SUMMARY:(.*)$`m', $DataIcal, $Summary);
        return trim($Summary[1]);
    }

    /**
     * @param $DataIcal Array of one event none parsed
     * @return string - DateValue
     */
    private function parsingUID($DataIcal){
        preg_match('`^UID:(.*)$`m', $DataIcal, $UID);
        return $UID[1];
    }

    /**
     * @param $DataIcal Array of one event none parsed
     * @return Array with version [0] => All data | [1] => Data Searched
     */
    private function parseVersion($DataIcal):array{
        preg_match('`^VERSION:(.*)$`m', $DataIcal, $Version);
        return $Version;
    }

    /**
     * @param $DataIcal Array of one event none parsed
     * @return Array with event [0] => Event width description | [1] => Event with datetime value only
     */
    private function parsingEvent($DataIcal):array{
        preg_match_all('`BEGIN:VEVENT(.+)END:VEVENT`Us', $DataIcal, $Event);
        return $Event;
    }

    /**
     * @param $DataIcal Array of one event none parsed
     * @return Array with event date begin [0] => All data | [1] => Date Time value of event
     */
    private function parseEventBegin($DateIcal){
        preg_match('`^DTSTART;VALUE=DATE:(.*)`m', $DateIcal, $EventBegin);
        return $EventBegin[1];
    }

    /**
     * @param $DataIcal Array of one event none parsed
     * @return Array with event date ending [0] => All data | [1] => Date Time value of event
     */
    private function parseEventEnd($DateIcal){
        preg_match('`^DTEND;VALUE=DATE:(.*)`m', $DateIcal, $EventEnd);
        return $EventEnd[1];
    }
}