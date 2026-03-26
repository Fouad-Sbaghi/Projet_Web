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

    
    public function inserer(\classes\Projet $projet, $id_user) {
        $sql = "INSERT INTO PROJETS (id_user, titre, description, image_url) 
                VALUES (:id_user, :titre, :description, :image_url)";
        
        $stmt = $this->connexion->prepare($sql);
        
        // On lie les attributs de l'objet Projet à la requête SQL
        $stmt->bindValue(':id_user', $id_user);
        $stmt->bindValue(':titre', $projet->titre);
        $stmt->bindValue(':description', $projet->description);
        $stmt->bindValue(':image_url', $projet->image);
        
        return $stmt->execute();
    }
}
?>