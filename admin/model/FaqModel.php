<?php
namespace model;

use PDO;
use classes\Faq;
use model\FaqException;

class FaqModel {
    private $connexion;

    public function __construct() {
        $this->connexion = Database::getConnexion();
    }

    public function getAllFaqs() {
        $sql = "SELECT id_faq AS id, question, reponse FROM FAQ";
        $stmt = $this->connexion->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'classes\Faq');
        return $stmt->fetchAll();
    }

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