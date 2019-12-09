<?php
namespace wf3\Meteo;

interface Observer {
    public function notify($temperature, $pression, $humidite);
}