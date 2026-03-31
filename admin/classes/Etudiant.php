<?php
namespace classes;

use interfaces\EtudiantInterface;

/**
 * Classe Etudiant
 * 
 * Hérite de Utilisateur (extends)
 * Implémente EtudiantInterface
 */
class Etudiant extends Utilisateur implements EtudiantInterface {
	
	protected $filiere;
	protected $lienLinkedin;

	/**
	 * Constructeur : appel du parent::__construct()
	 */
	public function __construct($id="", $nom="", $prenom="", $email="", $motDePasse="", $filiere="", $lienLinkedin="") {
		// Appel du constructeur de la classe mère
		parent::__construct($id, $nom, $prenom, $email, $motDePasse, 'Etudiant');
		$this->filiere = $filiere;
		$this->lienLinkedin = $lienLinkedin;
	}

	////////// Methodes magiques ///////////

	/**
	 * __toString spécialisé
	 */
	function __toString(){
		return "$this->nom/$this->prenom (Etudiant - $this->filiere)";
	}

	/**
	 * __debugInfo spécialisé
	 * appel de __debugInfo de la classe mère + ajout des clés spécifiques
	 */
	function __debugInfo(){
		$debug = parent::__debugInfo();
		$debug["filiere"] = $this->filiere;
		$debug["linkedin"] = $this->lienLinkedin;
		return $debug;
	}

	// Méthode de l'interface EtudiantInterface
	public function modifierProfil() {
	}
}
