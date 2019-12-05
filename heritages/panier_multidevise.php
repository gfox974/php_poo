<?php
//Exo: panier multi-devises
//
// On a un panier d'articles, leur prix peut etre affiché en euros, yens, dollars, etc
// le panier : 
// Produit: Quantité: Prix: Total:
// Ducky channel 1 99,99€ 99,99€
// Echo     2      69,99$   139,98$
//
//                  TOTAL en yens, au taux de change actuel: 2135464Y  

// Taux de conversion dispos via une api : https://exchangeratesapi.io/
// -------> https://api.exchangeratesapi.io/latest On peut la taper en json, la base est l'euro
//
// Modifier l'ini de conf php pour parser a l'exterieur sans client 
ini_set("allow_url_fopen", 1);

/// On va set la ressource a consommer
$json = file_get_contents('https://api.exchangeratesapi.io/latest');
$obj = json_decode($json); // Là, il le parse et le transforme en objet json

var_dump($obj->rates);

echo "<br> Rate en $ = <br>";
var_dump($obj->rates->USD);

// -------------    Let's go !      ---------------------------

abstract class Produit {
    protected $nom;
    protected $prix;
    protected $devise;
}



?>