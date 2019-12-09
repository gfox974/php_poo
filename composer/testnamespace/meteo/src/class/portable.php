<?php
namespace wf3\Meteo;

class Portable implements Observer {

    public function notify($temperature, $pression, $humidite){
        echo "SMS: C°=$temperature, HPa=$pression, h=$humidite % \n";
    }
}