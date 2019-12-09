<?php
namespace wf3\Meteo;
// a la mano pour comprendre, mais les langages ont des classes par defaut.
// on definis une classe abstraite pour definir des methodes, elle va servir d'interface observatrice

interface Subject {
    public function registerObserver(Observer $o); // abo
    public function unregisterObserver(Observer $o); // désabo
    public function notifyObserver(); // notif changements
}