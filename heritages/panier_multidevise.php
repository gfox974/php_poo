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

class Panier {
    protected $contenu = [];
    protected $selectedDevise = 'EUR';
    protected $nbarticles = 0;
    protected $total = 0;

    public function __construct($devise)
    {
        $this->selectedDevise = $devise;
    }

// todo
    public function convertPrix(Produit $produit){
        $devTo = $this->selectedDevise;
        $devSrc = $produit->devisesrc;
        if ($devTo != $devSrc){
            $api_url = file_get_contents('https://api.exchangeratesapi.io/latest');
            $data = json_decode($api_url);
            $valSrc = $data->rates->$devSrc;
            $produit->prix = $valSrc * $produit->prix;    
        }
        return $produit->prix;

    }

    public function ajoutProduit(Produit $produit){
        $produit->prix = $this->convertPrix($produit);

        $this->contenu[] = $produit;
        $this->nbarticles = $this->nbarticles +1;
        $this->total = $this->total + $produit->prix; // + prix du produit ajouté converti ;
        // todo : do the math avec les props selected / prix / devise
    }

    public function affichePanier(){
        echo "<br> articles dans le panier :".$this->nbarticles;
        foreach ($this->contenu as $items) {
            echo "<br> Vous avez: ".$items->name." à ".$items->prix." ".$items->devisesrc;
        }
        echo "<br>  pour un total de :".$this->total." ".$this->selectedDevise;
    }
}

class Produit extends Panier {
    public $name;
    public $devisesrc;
    public $prix;

    public function __construct($name, $dev, $prix)
    {
        $this->name = $name;
        $this->devisesrc = $dev;
        $this->prix = $prix;
    }

}

//

// TESTS FUNCS

/*$devTo = "EUR";
$api_url = file_get_contents('https://api.exchangeratesapi.io/latest');
$data = json_decode($api_url);
$valTo = $data->rates->$devTo;

echo "TEST : ".$valTo;
*/
//

$monpanier = new Panier('EUR');
$bricole = new Produit('test', 'USD', 123);

$monpanier->affichePanier();
$monpanier->ajoutProduit($bricole);
$monpanier->affichePanier();

$bricole2 = new Produit('test2', 'JPY', 456);
$monpanier->ajoutProduit($bricole2);
$monpanier->affichePanier();
?>