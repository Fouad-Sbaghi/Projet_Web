<?php

namespace classes;

use interfaces\EtudiantInterface;

class Etudiant extends Utilisateur implements EtudiantInterface
{
    protected $filiere;
    protected $lienLinkedin;

    public function __construct($id, $nom, $prenom, $email, $motDePasse, $filiere, $lienLinkedin)
    {
        parent::__construct($id, $nom, $prenom, $email, $motDePasse);
        $this->filiere = $filiere;
        $this->lienLinkedin = $lienLinkedin;
    }

    public function modifierProfil() {}
}
