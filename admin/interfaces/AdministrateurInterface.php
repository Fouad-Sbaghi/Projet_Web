<?php
namespace interfaces;

/**
 * Interface AdministrateurInterface
 * Définit le contrat pour la classe Administrateur
 */
interface AdministrateurInterface {
    /** Gérer les utilisateurs du système */
    public function gererUtilisateurs();
    /** Envoyer un mail aux utilisateurs */
    public function envoyerMail();
    /** Supprimer un compte utilisateur */
    public function supprimerCompte();
}
?>