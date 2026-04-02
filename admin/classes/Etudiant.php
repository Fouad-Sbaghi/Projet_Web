<?php
namespace classes;

use interfaces\EtudiantInterface;

class Etudiant extends Utilisateur implements EtudiantInterface {
	
	protected $filiere;
	protected $lienLinkedin;

	public function __construct($id="", $nom="", $prenom="", $email="", $motDePasse="", $filiere="", $lienLinkedin="") {

		parent::__construct($id, $nom, $prenom, $email, $motDePasse, 'Etudiant');
		$this->filiere = $filiere;
		$this->lienLinkedin = $lienLinkedin;
	}

	function __toString(){
		return "$this->nom/$this->prenom (Etudiant - $this->filiere)";
	}

	public function modifierProfil() {
	}
}
