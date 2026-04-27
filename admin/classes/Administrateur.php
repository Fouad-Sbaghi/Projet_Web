<?php
namespace classes;

use interfaces\AdministrateurInterface;

/**
 * Classe Administrateur
 * Hérite de Utilisateur, implémente AdministrateurInterface.
 * Représente un administrateur avec son téléphone professionnel.
 */
class Administrateur extends Utilisateur implements AdministrateurInterface {
	
	/** @var string Numéro de téléphone professionnel */
	protected $telephonePro;

	/**
	 * @param string $id Identifiant
	 * @param string $nom Nom
	 * @param string $prenom Prénom
	 * @param string $email Email
	 * @param string $motDePasse Mot de passe
	 * @param string $telephonePro Téléphone professionnel
	 */
	public function __construct($id="", $nom = "", $prenom = "", $email = "", $motDePasse = "", $telephonePro = "") {
		parent::__construct($id, $nom, $prenom, $email, $motDePasse, 'Admin'); 
		$this->telephonePro = $telephonePro;
	}

	/**
	 * @return string Représentation textuelle de l'administrateur
	 */
	function __toString(){
		return "$this->nom/$this->prenom (Admin)";
	}

	/** @inheritdoc */
	public function gererUtilisateurs() {
	}

	/** @inheritdoc */
	public function envoyerMail() {
	}

	/** @inheritdoc */
	public function supprimerCompte() {
	}
}
?>