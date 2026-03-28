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

    public function __construct($id="", $nom="", $prenom="", $email="", $motDePasse="", $role="") {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->role = $role;
    }

    public function __get($propriete) {
        if (property_exists($this, $propriete)) {
            return $this->$propriete;
        }
    }

    public function __set($propriete, $valeur) {
        if (property_exists($this, $propriete)) {
            $this->$propriete = $valeur;
        }
    }

    public function seConnecter() {
    }

    public function seDeconnecter() {
    }
}
?>