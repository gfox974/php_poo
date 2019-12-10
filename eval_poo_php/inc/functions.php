<?php

function debug($param){
    echo '<pre>';
        var_dump($param);
    echo '</pre>';
}

function execute_Requete($requete, $params = array()){
    if (!empty($params)){
        foreach($params as $indice => $valeur){
            $params[$indice] = htmlspecialchars($valeur);
        }
    }
    global $pdo;
    $resultat= $pdo->prepare($requete);
    $succes = $resultat->execute($params);
    if($succes){
        return $resultat;
    } else {
        return FALSE;
    }
}

// wip, appel via jquery / ajax
function modifyDriver($driverid){
    echo "modify: $driverid";
}

function deleteDriver($driverid){
    echo "delete: $driverid";
}

function printDriversNumber(){
    $resultat = $pdo->query('SELECT COUNT(*) FROM conducteur');
      //  echo $resultat->fetch(PDO::FETCH_  
      echo "Drivers total !";      
}

function printFreeDriversNumber(){
    echo "Free Drivers total !";
}

function printCarsNumber(){
    echo "Cars total !";
}

function printFreeCarsNumber(){
    echo "Free cars total !";
}

function printAssosNumber(){
    echo "Assocs total !";
}

?>