<?php
ini_set("allow_url_fopen", 1);

// Panier multi-devises :

// Produit              Quantité           Prix          Total
// Ducky Channel           1               99.99 €       99.99 €
// Echo                    2               $69.99        $139.98
//                                         TOTAL en Y    28015.33 Y

// Foreign exchange rates API : https://exchangeratesapi.io

// // Design Pattern : Singleton

class Panier {
    protected $liste = [];
    private $devises;

    public function __construct()
    {
        $json = file_get_contents("https://api.exchangeratesapi.io/latest");
        $obj = json_decode($json);
        $this->devises = $obj->rates;
    }

    public function ajouter(Produit $produit) {
        $this->liste[] = $produit;
    }

    public function calculerTotalEn($devise) {
        $total = 0;
        foreach($this->liste as $produit) {
            if ($produit->getDevise() !== "EUR") {
                $total += ($produit->getPrix() * $produit->getQuantite()) / $this->devises->{$produit->getDevise()};
            } else {
                $total += ($produit->getPrix() * $produit->getQuantite());
            }
        }
        if ($devise !== "EUR") {
            return $total * $this->devises->{$devise};
        }
        return $total;
    }

}

class Produit {
    private $nom;
    private $quantite;
    private $prix;
    private $devise;

    public function __construct($nom, $quantite, $prix, $devise) {
        $this->nom = $nom;
        $this->quantite = $quantite;
        $this->prix = $prix;
        $this->devise = $devise;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getDevise() {
        return $this->devise;
    }

}

$panier = New Panier();
$panier->ajouter(new Produit("Ducky Channel One", 1, 99.99, "EUR"));
$panier->ajouter(new Produit("Echo", 2, 69.99, "USD"));

echo $panier->calculerTotalEn("EUR");
___________________________________________________________________