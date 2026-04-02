<?php
namespace classes;

use interfaces\FaqInterface;

class Faq implements FaqInterface
{

	protected $id;
	protected $question;
	protected $reponse;

	public function __construct($id = "", $question = "", $reponse = "")
	{
		$this->id = $id;
		$this->question = $question;
		$this->reponse = $reponse;
	}

	function __toString()
	{
		return "FAQ : $this->question";
	}

	function __destruct()
	{

	}

	function __isset($name)
	{
		return property_exists($this, $name) && !empty($this->$name);
	}

	function __get($name)
	{
		if (property_exists($this, $name)) {
			return $this->$name;
		} else {
			echo "$name n'existe pas.";
		}
	}

	function __set($name, $val)
	{
		if (property_exists($this, $name)) {
			$this->$name = $val;
		} else {
			echo "Impossible de modifier $name car il n'existe pas.";
		}
	}

	public function ajouterQuestion($question, $reponse)
	{
		$this->question = $question;
		$this->reponse = $reponse;
	}

	public function modifier()
	{
	}

	public function supprimer()
	{
	}
}
?>