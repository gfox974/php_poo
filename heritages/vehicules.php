<?php

// Ce que tous les vehicules ont en commmun :
class Vehicule {
    protected $nombrederoues;

    public function __construct($n)
    {
        $this->nombrederoues = $n;
    }

    public function nbDeRoues(){
        return $this->nombrederoues;
    }
}


class Automobile extends Vehicule {
    public function __construct()
    {
        parent::__construct(4); // on appelle le construct du parent pour set leurs protected
    }
}

class Sportive extends Automobile {

}

class Moto extends Vehicule {
    public function __construct()
    {
        parent::__construct(2);
    }
}
// Et ainsi de suite.

class Vivant {} // On declare un type
class Vegetal extends Vivant {}
class Fruits extends Vegetal {}
class Pomme extends Fruits {}
class GoldenLady extends Pomme {}

// Exo todo :
// hommes peuvent manger (omnivore -> mangent tout type / vegetarien -> ... / cannibale -> tout + hommes):
// si bouffe mangée() = bon type : miam miam, sinon berk !
class Animal extends Vivant {

    public function manger($nourriture){
        if (is_object($nourriture)){
            echo get_class($this)." mange : ".get_class($nourriture);    
        }
    }
}

class Homme extends Animal {
    
    public function manger($nourriture){
        if ($nourriture instanceOf Homme){
            echo " beurk ";    
        } else {
            parent::manger($nourriture);
        }
    }
    
}

// exec exo :
$adam = new Homme();
$poule = new Animal();
$salade = new Vegetal();
$eve = new Homme();


$adam->manger($poule);
$adam->manger($salade);
$adam->manger($eve);

// Exo todo :
// Banque
// - pouvoir creer des banques, une banque: 
// - peut creer des comptes bancaires
// - Compte bancaire : corresponds a un client
// - Peut afficher le nombre de comptes que la banque a
// - Peut afficher le montant total des comptes detenus
// - Peut afficher les infos d'un client
// - Peut afficher tous les comptes liés à un client
//
// - Peut effectuer des virements entre comptes (et verifier si l'operation est faisable)
// - Peut effectuer des versements et des retraits
// - Peut afficher le solde du compte



// exemple workflow :
// -> créer la banque 'machin'
// -> créer un client
// -> client A ouvre compte chez banque machin ( compte, solde )
// -> client B ouvre un compte en y deposant une somme aussi
// -> client A se plante et fait un virement sur le compte de B


class Banque {
    private $nom;
    private $clients = [];
    private $comptes = [];

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function ajouter($compte){
        $this->comptes[] = $compte;
    }

    public function afficherComptes(){
        print_r($this->comptes);
    }
}

class Compte {
    private $client;
    private $solde;

    public function __construct($client, $solde)
    {
        $this->client = $client;
        $this->solde = $solde;
    }
}

class Client {
    private $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }
}


$banque1 = new Banque('totobank');

// si .= dans ajouter
//$banque1->ajouter('cpt1');
//$banque1->ajouter('cpt2');
//$banque1->ajouter('cpt3');

$clientA = new Client('toto');
$clientB = new Client('gudule');

$banque1->ajouter(new Compte($toto, 235));
$banque1->ajouter(new Compte($clientB, 950));

$banque1->afficherComptes();

/// exec tests

/*
$auto = new Automobile();
$moto = new Moto();

echo $auto->nbDeRoues();
echo $moto->nbDeRoues();

$apple = new Pomme();
$mapomme = new GoldenLady();
var_dump($mapomme instanceof Fruits);
var_dump($apple);

echo get_class($mapomme);
var_dump(is_object($apple));
*/
?>