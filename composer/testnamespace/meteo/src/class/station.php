<?php
namespace wf3\Meteo;

// Comme on utilise un namespace avec de l'autoload, on a pas besoin de caler des require partout
class Station implements Subject {
    private $abonnes = [];
    private $temperature = 0;
    private $pression = 0;
    private $humidite = 0;

    // On alimente sa liste d'observateurs
    public function registerObserver(Observer $o){
        $this->abonnes[] = $o;

    }
    public function unregisterObserver(Observer $o){

    }
    // l'objet station va push ses modifs a ses observateurs, il est le sujet.
    public function notifyObserver(){
        foreach($this->abonnes as $abonne){
            $abonne->notify($this->temperature,$this->pression,$this->humidite);
        }
    }

    // Setters -> si modif d'un indicateur, notif.
    public function setTemperature(Int $newval){
        $this->temperature = $newval;
        $this->notifyObserver();
    }
    public function setPression(Int $newval){
        $this->pression = $newval;
        $this->notifyObserver();
    }
    public function setHumidite(Int $newval){
        $this->humidite = $newval;
        $this->notifyObserver();
    }

}