<?php

// singleton exemple
class Service {
    private static $_instance;

    private function __constuct() { // on rends privé le construct
        $json = file_get_contents('https://api.exchangeratesapi.io/latest');
        $obj = json_decode($json);
        $this->devises = $obj->rates;
    
    }

    private function __clone(){ // et le clonage 

    }
    // Comme le singleton represente une instance unique, faut pouvoir verifier si il y en a une, si pas crée -> crea et ret, sinon ret
    public static function getInstance(){
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

}

?>