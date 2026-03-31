<?php
namespace classes;

use interfaces\ProjetInterface;

/**
 * Classe Projet
 * 
 * Implémente ProjetInterface
 */
class Projet implements ProjetInterface {

	protected $id;
	protected $titre;
	protected $description;
	protected $image;
	protected $id_user;

	/**
	 * Constructeur
	 */
	public function __construct($id = "", $titre = "", $description = "", $image = "", $id_user = "") {
		$this->id = $id;
		$this->titre = $titre;
		$this->description = $description;
		$this->image = $image;
		$this->id_user = $id_user;
	}

	////////// Methodes magiques ///////////

	/**
	 * __toString
	 * appelée par echo
	 */
	function __toString(){
		return "Projet : $this->titre (id=$this->id)";
	}

	/**
	 * __debugInfo
	 * appelée par var_dump
	 */
	function __debugInfo(){
		return [
			'id' => $this->id,
			'titre' => $this->titre,
			'description' => substr($this->description, 0, 50).'...',
			'image' => $this->image
		];
	}

	/**
	 * __destruct
	 */
	function __destruct(){
		// echo "</br> Delete du projet $this->titre </br>";
	}

	/**
	 * __isset
	 * appelée si on teste l'existence ou la vacuité d'un attribut protégé avec isset() ou empty()
	 */
	function __isset($name) {
		return property_exists($this, $name) && !empty($this->$name);
	}

	/**
	 * __get
	 * appelée si un attribut n'existe pas ou est protégé
	 */
	function __get($name) {
		if(property_exists($this, $name)) {
			return $this->$name;
		}
		return null;
	}

	/**
	 * __set
	 * appelée si un attribut n'existe pas ou est protégé
	 */
	function __set($name, $val) {
		$this->$name = $val;
	}

	// Méthodes de l'interface ProjetInterface
	public function ajouter() {
	}

	public function modifier() {
	}

	public function supprimer() {
	}
}
?>