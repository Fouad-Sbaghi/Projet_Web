<?php

class Utilisateur {
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $motDePasse;

    public function __construct($id, $nom, $prenom, $email, $motDePasse){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
    }

    public function __get($id){
       return $this->$id;
    }   

}


?>