<?php
namespace interfaces;

/**
 * Interface UtilisateurInterface
 * Définit le contrat pour la classe Utilisateur
 */
interface UtilisateurInterface {
    /** Se connecter au système */
    public function seConnecter();
    /** Se déconnecter du système */
    public function seDeconnecter();
}
?>