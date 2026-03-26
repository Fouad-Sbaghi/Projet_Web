<?php
namespace classes;

use interfaces\AdministrateurInterface;


class Administrateur extends Utilisateur implements AdministrateurInterface {
    
    protected $telephonePro;


    public function __construct($nom = "", $prenom = "", $email = "", $motDePasse = "", $telephonePro = "") {
        parent::__construct($nom, $prenom, $email, $motDePasse); 
        $this->telephonePro = $telephonePro;
    }

    public function gererUtilisateurs() {

    }

    public function envoyerMail() {

    }

    public function supprimerCompte() {
    }
}
?>