<?php
namespace classes;

use interfaces\ProjetInterface;

class Projet implements ProjetInterface {

	protected $id;
	protected $titre;
	protected $description;
	protected $image;
	protected $id_user;

	public function __construct($id = "", $titre = "", $description = "", $image = "", $id_user = "") {
		$this->id = $id;
		$this->titre = $titre;
		$this->description = $description;
		$this->image = $image;
		$this->id_user = $id_user;
	}

	function __toString(){
		return "Projet : $this->titre (id=$this->id)";
	}

	function __isset($name) {
		return property_exists($this, $name) && !empty($this->$name);
	}

	function __get($name) {
		if(property_exists($this, $name)) {
			return $this->$name;
		}
		return null;
	}

	function __set($name, $val) {
		$this->$name = $val;
	}

	public function ajouter() {
	}

	public function modifier() {
	}

	public function supprimer() {
	}
}
?>