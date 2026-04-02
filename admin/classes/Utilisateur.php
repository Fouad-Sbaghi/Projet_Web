<?php
namespace classes;

use interfaces\UtilisateurInterface;

abstract class Utilisateur implements UtilisateurInterface {
	
	protected $id;
	protected $nom;
	protected $prenom;
	protected $email;
	protected $motDePasse;
	protected $role;

	public static $nb_users = 0;

	public function __construct($id="", $nom="", $prenom="", $email="", $motDePasse="", $role="") {
		$this->id = $id;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->email = $email;
		$this->motDePasse = $motDePasse;
		$this->role = $role;
		self::$nb_users += 1;
	}

	function __isset($name) {
		return property_exists($this, $name) && !empty($this->$name);
	}

	function __toString(){
		return "$this->nom/$this->prenom ($this->role)";
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

	public function seConnecter() {
	}

	public function seDeconnecter() {
	}
}
?>