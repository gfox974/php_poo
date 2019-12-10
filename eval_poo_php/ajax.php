<?php
require_once 'inc/init.php';
//test listener central pour les fonctions jquery
if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'driverscount' :
          printDriversNumber();
        break;
        case 'freedriverscount' :
            printFreeDriversNumber();
        break;
        case 'carscount' :
            printCarsNumber();
        break;
        case 'freecarscount' :
            printFreeCarsNumber();
        break;
        case 'assoscount' :
            printAssosNumber();
        break;
        default:
        break;
    }
}
//
?>