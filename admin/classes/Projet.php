<?php
namespace classes;

use interfaces\ProjetInterface;

/**
 * Classe Projet
 * Représente un projet/portfolio étudiant.
 * Implémente ProjetInterface.
 */
class Projet implements ProjetInterface {

	/** @var int Identifiant du projet */
	protected $id;
	/** @var string Titre du projet */
	protected $titre;
	/** @var string Description du projet */
	protected $description;
	/** @var string Nom du fichier image */
	protected $image;
	/** @var int Identifiant de l'étudiant propriétaire */
	protected $id_user;

	/**
	 * @param string $id Identifiant
	 * @param string $titre Titre
	 * @param string $description Description
	 * @param string $image Image
	 * @param string $id_user ID de l'étudiant
	 */
	public function __construct($id = "", $titre = "", $description = "", $image = "", $id_user = "") {
		$this->id = $id;
		$this->titre = $titre;
		$this->description = $description;
		$this->image = $image;
		$this->id_user = $id_user;
	}

	/**
	 * @return string Représentation textuelle du projet
	 */
	function __toString(){
		return "Projet : $this->titre (id=$this->id)";
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
	 * Accesseur magique pour les attributs protégés
	 * @param string $name Nom de la propriété
	 * @return mixed|null
	 */
	function __get($name) {
		if(property_exists($this, $name)) {
			return $this->$name;
		}
		return null;
	}

	/**
	 * Mutateur magique pour les attributs protégés
	 * @param string $name Nom de la propriété
	 * @param mixed $val Nouvelle valeur
	 */
	function __set($name, $val) {
		$this->$name = $val;
	}

	/** @inheritdoc */
	public function ajouter() {
	}

	/** @inheritdoc */
	public function modifier() {
	}

	/** @inheritdoc */
	public function supprimer() {
	}
}
?>