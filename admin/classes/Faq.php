<?php
namespace classes;

use interfaces\FaqInterface;

/**
 * Classe Faq
 * Représente une question/réponse de la FAQ.
 * Implémente FaqInterface.
 */
class Faq implements FaqInterface
{
	/** @var int Identifiant de la FAQ */
	protected $id;
	/** @var string Question */
	protected $question;
	/** @var string Réponse */
	protected $reponse;

	/**
	 * @param string $id Identifiant
	 * @param string $question Question
	 * @param string $reponse Réponse
	 */
	public function __construct($id = "", $question = "", $reponse = "")
	{
		$this->id = $id;
		$this->question = $question;
		$this->reponse = $reponse;
	}

	/**
	 * @return string Représentation textuelle de la FAQ
	 */
	function __toString()
	{
		return "FAQ : $this->question";
	}

	/**
	 * Vérifie si un attribut protégé existe et n'est pas vide
	 * @param string $name Nom de l'attribut
	 * @return bool
	 */
	function __isset($name)
	{
		return property_exists($this, $name) && !empty($this->$name);
	}

	/**
	 * Accesseur magique pour les attributs protégés
	 * @param string $name Nom de la propriété
	 * @return mixed
	 */
	function __get($name)
	{
		if (property_exists($this, $name)) {
			return $this->$name;
		} else {
			echo "$name n'existe pas.";
		}
	}

	/**
	 * Mutateur magique pour les attributs protégés
	 * @param string $name Nom de la propriété
	 * @param mixed $val Nouvelle valeur
	 */
	function __set($name, $val)
	{
		if (property_exists($this, $name)) {
			$this->$name = $val;
		} else {
			echo "Impossible de modifier $name car il n'existe pas.";
		}
	}

	/** @inheritdoc */
	public function ajouterQuestion($question, $reponse)
	{
		$this->question = $question;
		$this->reponse = $reponse;
	}

	/** @inheritdoc */
	public function modifier()
	{
	}

	/** @inheritdoc */
	public function supprimer()
	{
	}
}
?>