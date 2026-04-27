<?php
namespace model;

use PDO;
use classes\Faq;
use model\exceptions\FaqException;

/**
 * Classe FaqModel
 * Gère les opérations CRUD sur la table FAQ via PDO.
 * Utilise des requêtes préparées et des transactions.
 */
class FaqModel {
    /** @var \PDO Connexion à la base de données */
    private $connexion;

    /**
     * Initialise la connexion à la base de données
     */
    public function __construct() {
        $this->connexion = Database::getConnexion();
    }

    /**
     * Récupère toutes les FAQ sous forme d'objets Faq (FETCH_CLASS)
     * @return Faq[] Tableau d'objets Faq
     */
    public function getAllFaqs() {
        $sql = "SELECT id_faq AS id, question, reponse FROM FAQ";
        $stmt = $this->connexion->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'classes\Faq');
        return $stmt->fetchAll();
    }

    /**
     * Récupère une FAQ par son identifiant
     * @param int $id Identifiant de la FAQ
     * @return Faq Objet Faq
     * @throws FaqException Si la FAQ n'existe pas
     */
    public function getFaqById($id) {
        $sql = "SELECT id_faq AS id, question, reponse FROM FAQ WHERE id_faq = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'classes\Faq');
        $stmt->execute();
        $faq = $stmt->fetch();

        if (!$faq) {
            throw new FaqException("FAQ non trouvée.", 404);
        }
        return $faq;
    }

    /**
     * Insère une nouvelle FAQ en base de données
     * @param \classes\Faq $faq Objet Faq à insérer
     * @return bool true si succès
     * @throws FaqException En cas d'erreur SQL
     */
    public function insererFaq(\classes\Faq $faq) {
        try {
            $this->connexion->beginTransaction();

            $sql = "INSERT INTO FAQ (question, reponse) VALUES (:question, :reponse)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':question', $faq->question);
            $stmt->bindValue(':reponse', $faq->reponse);
            $stmt->execute();

            $this->connexion->commit();
            return true;
        } catch (\Exception $e) {
            $this->connexion->rollBack();
            throw new FaqException("Erreur : impossible d'ajouter la question. Vérifiez qu'elle ne soit pas trop longue.", 500);
        }
    }

    /**
     * Modifie une FAQ existante en base de données
     * @param \classes\Faq $faq Objet Faq avec les nouvelles valeurs
     * @return bool true si succès
     * @throws FaqException En cas d'erreur SQL
     */
    public function modifierFaq(\classes\Faq $faq) {
        try {
            $this->connexion->beginTransaction();

            $sql = "UPDATE FAQ SET question = :question, reponse = :reponse WHERE id_faq = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':question', $faq->question);
            $stmt->bindValue(':reponse', $faq->reponse);
            $stmt->bindValue(':id', $faq->id);
            $stmt->execute();

            $this->connexion->commit();
            return true;
        } catch (\Exception $e) {
            $this->connexion->rollBack();
            throw new FaqException("Erreur : impossible de modifier cette question. Vérifiez les informations saisies.", 500);
        }
    }

    /**
     * Supprime une FAQ par son identifiant
     * @param int $id Identifiant de la FAQ
     * @return bool true si succès
     * @throws FaqException En cas d'erreur SQL
     */
    public function supprimerFaq($id) {
        try {
            $this->connexion->beginTransaction();

            $sql = "DELETE FROM FAQ WHERE id_faq = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $this->connexion->commit();
            return true;
        } catch (\Exception $e) {
            $this->connexion->rollBack();
            throw new FaqException("Erreur : impossible de supprimer cette question de la FAQ.", 500);
        }
    }
}
?>