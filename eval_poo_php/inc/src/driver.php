<?php
require_once 'car.php';

class Driver {
    public $prenom;
    public $nom;
    public $registeredCars[];

    public function __construct(string $prenom, string $nom){
        $this->prenom = $prenom;
        $this->nom = $nom;
    }

    public function addVehicle(Car $car){
        $this->$registeredCars[] = $newval;
        
    }
}
?>