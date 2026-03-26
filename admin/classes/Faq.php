<?php

namespace classes;

use interfaces\FaqInterface;

class Faq implements FaqInterface {

    protected $id;
    protected $question;
    protected $reponse;

    public function __construct($id = "", $question = "", $reponse = "") {
        $this->id = $id;
        $this->question = $question;
        $this->reponse = $reponse;
    }

    public function ajouterQuestion($question, $reponse){
        $this->question = $question;
        $this->reponse = $reponse;
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

    public function modifier() {
    }

    public function supprimer() {
    }
}




?>