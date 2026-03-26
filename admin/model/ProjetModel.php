<?php
namespace model;

use PDO;
use classes\Projet;

class ProjetModel {
    private $connexion;

    public function __construct() {
        $this->connexion = Database::getConnexion();
    }

    public function getAllProjets() {
        // L'astuce : on renomme les colonnes SQL pour qu'elles collent avec les attributs de l'objet Projet
        $sql = "SELECT id_projet AS id, titre, description, image_url AS image FROM PROJETS";
        
        $stmt = $this->connexion->query($sql);
        
        // On demande à PDO de créer des objets "Projet"
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'classes\Projet');
        
        return $stmt->fetchAll(); // Retourne un tableau d'objets Projet
    }
}
?>