<?php
// classe abstraite (a voir comme une definition conceptuelle):
abstract class Animal {
    protected $nom;

    abstract public function crier();

    public function __construct($nom)
    {
        $this->nom = $nom;
    }
}
// une classe abstraite doit contenir au moins une methode abstraite, et n'est pas instanciable ( car non-concrete )
// attention aux heritages, si on n'implemente pas la methode heritée, la classe enfant devient elle aussi abstraite
class Chien extends Animal {

    public function crier() {
        echo "WOOF !";
    }
}

$rex = new Chien('rex');
$rex->crier();

/// Exemple de l'architecte :
// imaginons qu'un architecte utilise un logiciel lui permettant de manipuler et assembler des formes modelisées ( carrés, rectangles, rond)
// à partir de ces elements, le logiciel peut calculer diverses informations à partir des formes utilisées( surface totale, aire, perimetre etc )

// 1) definir une forme
// une forme, sur le concept, est abstraite / indefinie -> interface.
// ( Une interface peut avoir plusieurs parents ! )

interface Forme2D {
    public function obtenirAire();
    public function obtenirPerimetre();
}

// implement != extends, ici on va etre obligé d'implementer ce qui est defini dans l'interface
class Carre implements Forme2D {
    protected $cote;

    public function __construct($cote)
    {
        $this->cote = $cote;
    }

    public function obtenirAire()
    {
        return ($this->cote * $this->cote); 
    }

    public function obtenirPerimetre()
    {
        return ($this->cote * 4); 
    }
}
// Exo : faire la meme pour les rectangles et les cercles
class Rectangle implements Forme2D {
    protected $longueur;
    protected $largeur;

    public function __construct($longueur, $largeur)
    {
        $this->longueur = $longueur;
        $this->largeur = $largeur;
    }

    public function obtenirAire()
    {
        return ($this->longueur * $this->largeur); 
    }

    public function obtenirPerimetre()
    {
        return ($this->longueur + $this->largeur)  * 2; 
    }
}

class Cercle implements Forme2D {
    protected $rayon;

    public function __construct($rayon)
    {
        $this->rayon = $rayon;
    }

    public function obtenirAire()
    {
        return pow($this->rayon,2); 
    }

    public function obtenirPerimetre()
    {
        return 2 * M_PI * $this->rayon; 
    }
}

// Definissons maintenant ce qu'est un plan :
// Un ensemble de formes.
//
// Imaginons cette maison :
// Un donjon rond de 5 metres 
// Une cuisine de 6 sur 4
// Une salle a manger de 7 sur 5
// Un salon de 6 sur 6 
// Une chambre de 3 sur 4
// Une chambre d'amis de 2 sur 3
// Une chambre d'enfant de 3 sur 3
// Un garage de 3 sur 5
//
// A partir de ca, on veut l'aire totale de l'ensemble et le perimetre total des pieces, en un clic.

// Le polymorphisme fait que l'on peut manipuler tous ces objets sur des bases communes (genericité), ici les dimensions ;)

class Plan {

    protected $formes = [];

    public function ajoutForme(Forme2D $forme){
        $this->formes[] = $forme;
    }

    public function aireTotale(){
        $aire = 0;
        foreach($this->formes as $forme){
            $aire += $forme->obtenirAire();
        }
        return $aire; 
    }

    public function perimetreTotal(){
        $perimetre = 0;
        foreach($this->formes as $forme){
            $perimetre += $forme->obtenirPerimetre();
        }
        return $perimetre;
    }
}


$carre = new Carre(2);
$rectangle = new Rectangle(4,5);
$cercle = new Cercle(2.5);

$plan = new Plan();
$plan->ajoutForme(new Cercle(5));
$plan->ajoutForme(new Rectangle(6,4));
$plan->ajoutForme(new Rectangle(7,5));
$plan->ajoutForme(new Carre(6));
$plan->ajoutForme(new Rectangle(3,4));
$plan->ajoutForme(new Rectangle(2,3));
$plan->ajoutForme(new Carre(3,3));
$plan->ajoutForme(new Rectangle(3,5));

echo "<br> aire totale : ".$plan->aireTotale()." m² <br>";
echo " perimetre total : ".$plan->perimetreTotal()." m";

?>