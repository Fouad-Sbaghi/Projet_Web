<?php
namespace classes;

use interfaces\EtudiantInterface;

/**
 * Classe Etudiant
 * Hérite de Utilisateur, implémente EtudiantInterface.
 * Représente un étudiant avec sa filière et son lien LinkedIn.
 */
class Etudiant extends Utilisateur implements EtudiantInterface {
	
	/** @var string Filière de l'étudiant */
	protected $filiere;
	/** @var string Lien vers le profil LinkedIn */
	protected $lienLinkedin;

	/**
	 * @param string $id Identifiant
	 * @param string $nom Nom
	 * @param string $prenom Prénom
	 * @param string $email Email
	 * @param string $motDePasse Mot de passe
	 * @param string $filiere Filière
	 * @param string $lienLinkedin URL LinkedIn
	 */
	public function __construct($id="", $nom="", $prenom="", $email="", $motDePasse="", $filiere="", $lienLinkedin="") {
		parent::__construct($id, $nom, $prenom, $email, $motDePasse, 'Etudiant');
		$this->filiere = $filiere;
		$this->lienLinkedin = $lienLinkedin;
	}

	/**
	 * @return string Représentation textuelle de l'étudiant
	 */
	function __toString(){
		return "$this->nom/$this->prenom (Etudiant - $this->filiere)";
	}

	/** @inheritdoc */
	public function modifierProfil() {
	}
}
