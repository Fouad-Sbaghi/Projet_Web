<?php
namespace classes;

use interfaces\AdministrateurInterface;

/**
 * Classe Administrateur
 * 
 * Hérite de Utilisateur (extends)
 * Implémente AdministrateurInterface
 */
class Administrateur extends Utilisateur implements AdministrateurInterface {
	
	protected $telephonePro;

	/**
	 * Constructeur : appel du parent::__construct()
	 */
	public function __construct($id="", $nom = "", $prenom = "", $email = "", $motDePasse = "", $telephonePro = "") {
		// Appel du constructeur de la classe mère
		parent::__construct($id, $nom, $prenom, $email, $motDePasse, 'Admin'); 
		$this->telephonePro = $telephonePro;
	}

	////////// Methodes magiques ///////////

	/**
	 * __toString spécialisé
	 */
	function __toString(){
		return "$this->nom/$this->prenom (Admin)";
	}

	/**
	 * __debugInfo spécialisé
	 * appel de __debugInfo de la classe mère + ajout des clés spécifiques
	 */
	function __debugInfo(){
		// appel de __debugInfo de la classe mère
		$debug = parent::__debugInfo();
		// ajout de clés dans l'Array
		$debug["tel"] = $this->telephonePro;
		// renvoie de l'Array
		return $debug;
	}

	// Méthodes de l'interface AdministrateurInterface
	public function gererUtilisateurs() {
	}

	public function envoyerMail() {
	}

	public function supprimerCompte() {
	}
}
?>