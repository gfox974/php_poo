<?php

class Client {
    private $nom;

    public function __construct($nom) {
        $this->nom = $nom;
    }
}

class Compte {
    private $client;
    private $solde;

    public function __construct(Client $client, $solde)
    {
        $this->client = $client;
        $this->solde = $solde;
    }
}

class Banque {
    private $nom;
    private $comptes = [];
    private $clients = [];

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function nbClients() {
        return count($this->clients);
    }

    public function nbComptes() {
        return count($this->comptes);
    }

    public function ajouterClient(Client $client) {
        $this->clients[] = $client;
    }

    public function ajouterCompte(Compte $compte) {
        $this->comptes[] = $compte;
    }

    public function soldeTotal() {
        
    }

}

$banque = new Banque("Banque Desjardins");


$durand = new Client("Durand");
$compte_durand = new Compte($durand, 500);

$a = new Client("A");
$compte_a = new Compte($a, 125);

$compte_a_bis = new Compte($a, 511.25);

$banque->ajouterClient($durand);
$banque->ajouterClient($a);
$banque->ajouterCompte($compte_durand);
$banque->ajouterCompte($compte_a);
$banque->ajouterCompte($compte_a_bis);



echo "Nombre de client(s) = " . $banque->nbClients() . "<br>";
echo "Nombre de compte(s) = " . $banque->nbComptes() . "<br>";

class Client {
    private $nom;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    public function getNom() { // getter
        return $this->nom;
    }
}

class Compte {
    private $client;
    private $solde;

    public function __construct(Client $client, $solde)
    {
        $this->client = $client;
        $this->solde = $solde;
    }

    public function getSolde() { // getter
        return $this->solde;
    }

    public function infos() {
        return ['nom' => $this->client->getNom(), 'solde' => $this->solde];
    }
}

class Banque {
    private $nom;
    private $comptes = [];
    private $clients = [];

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function nbClients() {
        return count($this->clients);
    }

    public function nbComptes() {
        return count($this->comptes);
    }

    public function ajouterClient(Client $client) {
        $this->clients[] = $client;
        return $this;
    }

    public function ajouterCompte(Compte $compte) {
        $this->comptes[] = $compte;
        return $this;
    }

    public function soldeTotal() {
        //return array_reduce($this->comptes, function($a, $c) { return $a + $c->getSolde(); }, 0);
        $somme = 0;
        foreach ($this->comptes as $compte) {
            $somme += $compte->getSolde();
        }
        return $somme;
    }

}

$banque = new Banque("Banque Desjardins");


$durand = new Client("Durand");
$compte_durand = new Compte($durand, 500);

$a = new Client("A");
$compte_a = new Compte($a, 125);

$compte_a_bis = new Compte($a, 511.25);

// $banque->ajouterClient($durand);
// $banque->ajouterClient($a);

$banque->ajouterClient($durand)->ajouterClient($a);

$banque->ajouterCompte($compte_durand)->ajouterCompte($compte_a)->ajouterCompte($compte_a_bis);

echo "la banque détient " . $banque->soldeTotal() . " €<br>";

echo "Nombre de client(s) = " . $banque->nbClients() . "<br>";
echo "Nombre de compte(s) = " . $banque->nbComptes() . "<br>";

$infos = $compte_durand->infos();
echo "Compte = nom : " . $infos['nom'] . ", solde : " . $infos['solde'] . " €<br>";

class Client {
    private $nom;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    public function getNom() { // getter
        return $this->nom;
    }
}

class Compte {
    private $client;
    private $solde;

    public function __construct(Client $client, $solde)
    {
        $this->client = $client;
        $this->solde = $solde;
    }

    public function getSolde() { // getter
        return $this->solde;
    }

    public function getClient() { // getter
        return $this->client;
    }

    public function infos() {
        return ['nom' => $this->client->getNom(), 'solde' => $this->solde];
    }

    public function retrait($montant) {
        if ($this->solde >= $montant && $montant >= 0) {
            $this->solde -= $montant;
        }
        return $this->solde;
    }

    public function versement($montant) {
        if ($montant >= 0) {
            $this->solde += $montant;
        }
        return $this->solde;
    }

    public function virement(Compte $compte, $montant) {
        if ($this->solde >= $montant && $montant >= 0) {
            $this->retrait($montant);
            $compte->versement($montant);
        }
    }
}

class Banque {
    private $nom;
    private $comptes = [];
    private $clients = [];

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function nbClients() {
        return count($this->clients);
    }

    public function nbComptes() {
        return count($this->comptes);
    }

    public function ajouterClient(Client $client) {
        $this->clients[] = $client;
        return $this;
    }

    public function ajouterCompte(Compte $compte) {
        $this->comptes[] = $compte;
        return $this;
    }

    public function soldeTotal() {
        //return array_reduce($this->comptes, function($a, $c) { return $a + $c->getSolde(); }, 0);
        $somme = 0;
        foreach ($this->comptes as $compte) {
            $somme += $compte->getSolde();
        }
        return $somme;
    }

    public function listerLesComptes(Client $client) {
        $liste = [];
        foreach ($this->comptes as $compte) {
            if ($compte->getClient() === $client) {
                $liste[] = $compte;
            }
        }
        return $liste;
    }

}

$banque = new Banque("Banque Desjardins");


$durand = new Client("Durand");
$durant = new Client("Durand");

$compte_durand = new Compte($durand, 500);

$a = new Client("A");
$compte_a = new Compte($a, 125);

$compte_a_bis = new Compte($a, 511.25);

// $banque->ajouterClient($durand);
// $banque->ajouterClient($a);

$banque->ajouterClient($durand)->ajouterClient($a);

$banque->ajouterCompte($compte_durand)->ajouterCompte($compte_a)->ajouterCompte($compte_a_bis);

echo "la banque détient " . $banque->soldeTotal() . " €<br>";

echo "Nombre de client(s) = " . $banque->nbClients() . "<br>";
echo "Nombre de compte(s) = " . $banque->nbComptes() . "<br>";

$infos = $compte_durand->infos();
echo "Compte = nom : " . $infos['nom'] . ", solde : " . $infos['solde'] . " €<br>";

var_dump($durand);
var_dump($durant);

print_r($banque->listerLesComptes($a));

?>