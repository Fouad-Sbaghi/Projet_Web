<?php
namespace classes;

use interfaces\UtilisateurInterface;

/**
 * Classe abstraite Utilisateur
 * Classe mère pour Etudiant et Administrateur.
 * Implémente UtilisateurInterface.
 */
abstract class Utilisateur implements UtilisateurInterface {
	
	/** @var int Identifiant de l'utilisateur */
	protected $id;
	/** @var string Nom de l'utilisateur */
	protected $nom;
	/** @var string Prénom de l'utilisateur */
	protected $prenom;
	/** @var string Adresse email */
	protected $email;
	/** @var string Mot de passe hashé */
	protected $motDePasse;
	/** @var string Rôle (Admin ou Etudiant) */
	protected $role;

	/** @var int Compteur d'instances */
	public static $nb_users = 0;

	/**
	 * @param string $id Identifiant
	 * @param string $nom Nom
	 * @param string $prenom Prénom
	 * @param string $email Email
	 * @param string $motDePasse Mot de passe
	 * @param string $role Rôle
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

	/**
	 * Vérifie si un attribut protégé existe et n'est pas vide
	 * @param string $name Nom de l'attribut
	 * @return bool
	 */
	function __isset($name) {
		return property_exists($this, $name) && !empty($this->$name);
	}

	/**
	 * Représentation textuelle de l'utilisateur
	 * @return string
	 */
	function __toString(){
		return "$this->nom/$this->prenom ($this->role)";
	}

	/**
	 * Accesseur magique pour les attributs protégés
	 * @param string $propriete Nom de la propriété
	 * @return mixed|null
	 */
	public function __get($propriete) {
		if (property_exists($this, $propriete)) {
			return $this->$propriete;
		}
		return null;
	}

	/**
	 * Mutateur magique pour les attributs protégés
	 * @param string $propriete Nom de la propriété
	 * @param mixed $valeur Nouvelle valeur
	 */
	public function __set($propriete, $valeur) {
		$this->$propriete = $valeur;
	}

	/** @inheritdoc */
	public function seConnecter() {
	}

	/** @inheritdoc */
	public function seDeconnecter() {
	}
}
?>