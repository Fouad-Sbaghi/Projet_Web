<?php
namespace classes;

use interfaces\UtilisateurInterface;

/**
 * Classe abstraite Utilisateur
 * 
 * Classe mère pour Administrateur et Etudiant
 * Utilise le namespace classes et implémente UtilisateurInterface
 */
abstract class Utilisateur implements UtilisateurInterface {
	
	protected $id;
	protected $nom;
	protected $prenom;
	protected $email;
	protected $motDePasse;
	protected $role;

	// compteur d'utilisateurs (attribut de classe)
	public static $nb_users = 0;

	/**
	 * Constructeur
	 */
	public function __construct($id="", $nom="", $prenom="", $email="", $motDePasse="", $role="") {
		$this->id = $id;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->email = $email;
		$this->motDePasse = $motDePasse;
		$this->role = $role;
		self::$nb_users += 1;
	}


	function __destruct(){
	}

	function __isset($name) {
		return property_exists($this, $name) && !empty($this->$name);
	}


	function __toString(){
		return "$this->nom/$this->prenom ($this->role)";
	}


	function __debugInfo(){
		return ['identite' => "$this->nom/$this->prenom", 'role' => $this->role];
	}


	public function __get($propriete) {
		if (property_exists($this, $propriete)) {
			return $this->$propriete;
		}
		return null;
	}


	public function __set($propriete, $valeur) {
		$this->$propriete = $valeur;
	}

	// Méthodes de l'interface
	public function seConnecter() {
	}

	public function seDeconnecter() {
	}
}
?>