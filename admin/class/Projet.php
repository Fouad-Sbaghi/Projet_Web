<?php
namespace classes;

use interfaces\ProjetInterface;

class Projet implements ProjetInterface {

    protected $id;
    protected $titre;
    protected $description;
    protected $image;


    public function __construct($id = "", $titre = "", $description = "", $image = "") {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->image = $image;
    }

    public function __get($name) {
        if(isset($this->$name)) {
            return $this->$name;
        } else {
            echo "$name n'existe pas ou n'est pas initialisé.";
        }
    }

    public function __set($name, $val) {
        if(isset($this->$name)) {
            $this->$name = $val;
        } else {
            echo "Impossible de modifier $name car il n'existe pas.";
        }
    }


    public function ajouter() {

    }

    public function modifier() {

    }

    public function supprimer() {
    }
}
?>