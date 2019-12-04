<?php

class MaClasse {
    // proprietés :
    public $a = 1;
    private $b = "OK";
    protected $c = [];
    var $defmess = "wawah !";
    // methodes :
    protected function wawa() {
        echo $this->defmess.'<br>';
    }
// en php, on peut faire appel a des set / get
    public function setB($newval){
        // on remplace la valeur de la priv b si la nouvelle n'est pas 0
        if($newval != 0){
            echo $this->b;
            $this->b=$newval;
            echo $this->b;
        }
    }

    private function setC($liste){
        $this->c=$liste;
    }
    // par ce biais, on peut appeller setC de l'exterieur:
    public function callSetC($liste){
        $this->setC($liste);
    }
//Types de props : public, private, protected
// accessible depuis l'exterieur / accessible uniquement par une instance de la classe / acces seulement a la classe et sa chaine d'heritage 
////////////////////////////
    
}

class Lecteur{
    private $ressource; //handler renvoyé par fopen

    function __construct($fichier){ // constructeur, appelé quand l'objet est crée
        $this->ressource = fopen($fichier,'r');
    }
    
    public function lireuneligne(){
        return fgets($this->ressource);
    }

    public function __destruct(){ // destructeur, appelé quand l'objet est supprimé
        fclose($this->ressource);
    }
}

class Log{
    // propriété de classe (static)
    public static $prefix = "DEV_";
    // proprieté d'instance
    private $message;

    public function __construct($msg){
        $this->message = $msg;        
    }

    public function afficher(){
        echo self::$prefix.$this->message; // :: operateur de classe
    }

    // methode de classe (pour modifier la proprieté statique par ex):
    public static function definirprefixe($p){
        self::$prefix = $p;
    }

}

// notions d'heritage
class Utils{
    public static function affiche42(){
        echo "42";
    } 
}


// Exo : pondre une classe formulaire pour spawn un formulaire complet
/*
formulaire :
    action ressource.php
    method post/get etc
    add: input text nom
    add: button valider
    afficher() : 
    le bordel en html
*/

class Formulaire{
    private $action = "";
    private $method = "GET";
    private $corps = [];

    public function action($a){
        $this->action = $a;
    }

    public function method($m){
        if ($m == 'GET' || $m == 'POST'){
            $this->method = $m;
        }
    }

    public function add($tag, $type, $name){
        switch($tag){
            case "input":
                $this->corps[] .=('<input type="'.$type.'" name="'.$name.'">');
                break;
            default:
                break;
        }
    }

    public function input($type, $name){
        $this->corps[] .= '<input type="'.$type.'" name="'.$name.'">';
    }

    public function button($texte){
        $this->corps[] .= "<button>$texte</button>";
    }

    public function afficher(){
        $resultat = "";
        $resultat .= "<form action =".$this->action." method=".$this->method.">";
        foreach ($this->corps as $item){
            $resultat .= $item;
        }
        $resultat .= "</form>";
        return $resultat;
    }
}


//////////////////////////////////////////////
$mon_instance_1 = new MaClasse();
$mon_instance_2 = new MaClasse();

//$mon_instance_1->wawa();
$mon_instance_1->defmess="coucou";
//$mon_instance_1->wawa();
$mon_instance_1->setB(12);


$lecture = new Lecteur('README.md');
echo $lecture->lireuneligne().'<br>';
echo $lecture->lireuneligne().'<br>';
echo $lecture->lireuneligne().'<br>';
unset($lecture);

$a = new Log("Bonjour !");
$a->afficher();

// la on change une proprieté sur toute une classe:
Log::definirprefixe("MOD_");
$a->afficher();

Utils::affiche42();


// Exo:
$form = new Formulaire();
$form->input('text','in');


$form->afficher();
?>