<?php
namespace wf3\Meteo;
require __DIR__.'/vendor/autoload.php';

// on crée une sonde
$station = new Station();
// des clients
$ios = new Portable();
$android = new Portable();

// on les cale en tant qu'observateurs de la source
$station->registerObserver($ios);
$station->registerObserver($android);

// on modifie une donnee sujete 
$station->setTemperature(25);


// notes diverses
$a = "$i"; // interpolation

$i = [1,2,3]; // de base l'index est a 0
$i = [10 => 1,2,3]; // là, on force l'array a commencer son index à 10.
$i = ["nom" => "dudule"]; // associatif
$i['nom']; // == dudule

// print_r();
// die("stopping"); -> interrompt le script