<?php
namespace class;

use interface\EtudiantInterface;

class Etudiant extends Utilisateur implements EtudiantInterface {
    private $filiere;
    private $lienLinkedin;

    public function __construct($nom, $prenom, $email, $motDePasse, $filiere, $lienLinkedin) {
        // Appel du constructeur de la classe mère Utilisateur
        parent::__construct($nom, $prenom, $email, $motDePasse); 
        $this->filiere = $filiere;
        $this->lienLinkedin = $lienLinkedin;
    }

    public function modifierProfil() {
        // Logique à venir
    }
}   