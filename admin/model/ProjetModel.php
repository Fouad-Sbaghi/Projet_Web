<?php
namespace model;

use PDO;
use classes\Projet;
use model\exceptions\ProjetException;

/**
 * Classe ProjetModel
 * Gère les opérations CRUD sur la table PROJETS via PDO.
 * Utilise des requêtes préparées et des transactions.
 */
class ProjetModel {
    /** @var \PDO Connexion à la base de données */
    private $connexion;

    /**
     * Initialise la connexion à la base de données
     */
    public function __construct() {
        $this->connexion = Database::getConnexion();
    }

    /**
     * Récupère tous les projets sous forme d'objets Projet (FETCH_CLASS)
     * @return Projet[] Tableau d'objets Projet
     */
    public function getAllProjets() {
        $sql = "SELECT id_projet AS id, titre, description, image_url AS image, id_user FROM PROJETS";
        $stmt = $this->connexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'classes\Projet');
    }

    /**
     * Récupère un projet par son identifiant avec les infos de l'étudiant
     * @param int $id Identifiant du projet
     * @return Projet Objet Projet
     * @throws ProjetException Si le projet n'existe pas
     */
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

    /**
     * Insère un nouveau projet en base de données
     * @param \classes\Projet $projet Objet Projet à insérer
     * @param int $id_user Identifiant de l'étudiant propriétaire
     * @return bool true si succès
     * @throws ProjetException En cas d'erreur SQL
     */
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

    /**
     * Modifie un projet existant en base de données
     * @param \classes\Projet $projet Objet Projet avec les nouvelles valeurs
     * @return bool true si succès
     * @throws ProjetException En cas d'erreur SQL
     */
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

    /**
     * Supprime un projet par son identifiant
     * @param int $id_projet Identifiant du projet
     * @return bool true si succès
     * @throws ProjetException En cas d'erreur SQL
     */
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