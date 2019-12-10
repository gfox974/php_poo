<?php
require_once 'driver.php';

class Car {
    public $marque;
    public $modele;
    public $immatriculation;
    public $drivedBy[];

    public function __construct(string $marque, string $modele, string $immatriculation){
        $this->marque = $marque;
        $this->modele = $modele;
        $this->immatriculation = $immatriculation;
    }

    public function addDriver(Driver $driver){
        $this->$drivedBy[] = $driver;
    }
}
?>