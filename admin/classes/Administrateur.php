<?php
namespace classes;

use interfaces\AdministrateurInterface;

class Administrateur extends Utilisateur implements AdministrateurInterface {
	
	protected $telephonePro;

	public function __construct($id="", $nom = "", $prenom = "", $email = "", $motDePasse = "", $telephonePro = "") {

		parent::__construct($id, $nom, $prenom, $email, $motDePasse, 'Admin'); 
		$this->telephonePro = $telephonePro;
	}

	function __toString(){
		return "$this->nom/$this->prenom (Admin)";
	}

	public function gererUtilisateurs() {
	}

	public function envoyerMail() {
	}

	public function supprimerCompte() {
	}
}
?>