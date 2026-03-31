<?php
namespace classes;

use interfaces\FaqInterface;

/**
 * Classe Faq
 * 
 * Implémente FaqInterface
 */
class Faq implements FaqInterface {

	protected $id;
	protected $question;
	protected $reponse;

	/**
	 * Constructeur
	 */
	public function __construct($id = "", $question = "", $reponse = "") {
		$this->id = $id;
		$this->question = $question;
		$this->reponse = $reponse;
	}

	////////// Methodes magiques ///////////

	/**
	 * __toString
	 */
	function __toString(){
		return "FAQ : $this->question";
	}

	/**
	 * __debugInfo
	 */
	function __debugInfo(){
		return [
			'id' => $this->id,
			'question' => $this->question,
			'reponse' => substr($this->reponse, 0, 50)
		];
	}

	/**
	 * __destruct
	 */
	function __destruct(){
		// echo "</br> Delete FAQ id=$this->id </br>";
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
	 */
	function __get($name) {
		if(property_exists($this, $name)) {
			return $this->$name;
		} else {
			echo "$name n'existe pas.";
		}
	}

	/**
	 * __set
	 */
	function __set($name, $val) {
		if(property_exists($this, $name)) {
			$this->$name = $val;
		} else {
			echo "Impossible de modifier $name car il n'existe pas.";
		}
	}

	// Méthodes de l'interface
	public function ajouterQuestion($question, $reponse){
		$this->question = $question;
		$this->reponse = $reponse;
	}

	public function modifier() {
	}

	public function supprimer() {
	}
}
?>