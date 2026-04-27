<?php
namespace interfaces;

/**
 * Interface ProjetInterface
 * Définit le contrat pour la classe Projet
 */
interface ProjetInterface {
    /** Ajouter un projet */
    public function ajouter();
    /** Modifier un projet */
    public function modifier();
    /** Supprimer un projet */
    public function supprimer();
}
?>