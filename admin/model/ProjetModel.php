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
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'classes\Projet');
        
        return $stmt->fetchAll(); // Retourne un tableau d'objets Projet
    }

    
    public function inserer(\classes\Projet $projet, $id_user) {
    try {
        $this->connexion->beginTransaction();

        $sql = "INSERT INTO PROJETS (id_user, titre, description, image_url) 
                VALUES (:id_user, :titre, :description, :image_url)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id_user', $id_user);
        $stmt->bindValue(':titre', $projet->titre);
        $stmt->bindValue(':description', $projet->description);
        $stmt->bindValue(':image_url', $projet->image);
        $stmt->execute();

        $this->connexion->commit();
        return true;
    } catch (\Exception $e) {
        $this->connexion->rollBack();
        return false;
    }
}


    /**
     * Supprime un projet de la base de données via son ID
     */
    public function supprimer($id_projet) {
        $sql = "DELETE FROM PROJETS WHERE id_projet = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id', $id_projet);
        
        return $stmt->execute();
    }

    public function getProjetById($id) {
    $sql = "SELECT p.id_projet AS id, p.titre, p.description, p.image_url AS image,
                   u.lien_linkedin, u.nom, u.prenom
            FROM PROJETS p
            JOIN UTILISATEURS u ON p.id_user = u.id_user
            WHERE p.id_projet = :id";
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    

}
?>