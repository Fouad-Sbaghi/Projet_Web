<?php
namespace interfaces;

/**
 * Interface FaqInterface
 * Définit le contrat pour la classe Faq
 */
interface FaqInterface {
    /**
     * Ajouter une question à la FAQ
     * @param string $question La question
     * @param string $reponse La réponse
     */
    public function ajouterQuestion($question, $reponse);
    /** Modifier une entrée FAQ */
    public function modifier();
    /** Supprimer une entrée FAQ */
    public function supprimer();
}
?>