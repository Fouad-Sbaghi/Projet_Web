<?php
namespace model;

use PDO;
use classes\Projet;
use model\ProjetException;

class ProjetModel {
    private $connexion;

    public function __construct() {
        $this->connexion = Database::getConnexion();
    }

    public function getAllProjets() {
        $sql = "SELECT id_projet AS id, titre, description, image_url AS image, id_user FROM PROJETS";
        $stmt = $this->connexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'classes\Projet');
    }

    public function getProjetById($id) {
        $sql = "SELECT p.id_projet AS id, p.titre, p.description, p.image_url AS image,
                       u.lien_linkedin, u.nom, u.prenom, p.id_user
                FROM PROJETS p
                JOIN UTILISATEURS u ON p.id_user = u.id_user
                WHERE p.id_projet = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'classes\Projet');
        $stmt->execute();
        $projet = $stmt->fetch();

        if (!$projet) {
            throw new ProjetException("Projet non trouvé.", 404);
        }
        return $projet;
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
            throw new ProjetException("Erreur : impossible de sauvegarder le projet. Le texte est peut-être trop long !", 500);
        }
    }

    public function modifierProjet(\classes\Projet $projet) {
        try {
            $this->connexion->beginTransaction();

            $sql = "UPDATE PROJETS SET titre = :titre, description = :description, image_url = :image WHERE id_projet = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':titre', $projet->titre);
            $stmt->bindValue(':description', $projet->description);
            $stmt->bindValue(':image', $projet->image);
            $stmt->bindValue(':id', $projet->id);
            $stmt->execute();

            $this->connexion->commit();
            return true;
        } catch (\Exception $e) {
            $this->connexion->rollBack();
            throw new ProjetException("Erreur : impossible de modifier le projet. Vérifiez les informations saisies.", 500);
        }
    }

    public function supprimer($id_projet) {
        try {
            $this->connexion->beginTransaction();

            $sql = "DELETE FROM PROJETS WHERE id_projet = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':id', $id_projet);
            $stmt->execute();

            $this->connexion->commit();
            return true;
        } catch (\Exception $e) {
            $this->connexion->rollBack();
            throw new ProjetException("Erreur : impossible de supprimer ce projet.", 500);
        }
    }
}
?>