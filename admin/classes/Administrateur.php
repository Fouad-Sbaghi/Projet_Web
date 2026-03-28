<?php
namespace classes;

use interfaces\AdministrateurInterface;


class Administrateur extends Utilisateur implements AdministrateurInterface {
    
    protected $telephonePro;


    public function __construct($id="", $nom = "", $prenom = "", $email = "", $motDePasse = "", $telephonePro = "") {
        parent::__construct($id, $nom, $prenom, $email, $motDePasse, 'Admin'); 
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