<?php
namespace interfaces;

interface AdministrateurInterface {
    public function gererUtilisateurs();
    public function envoyerMail();
    public function supprimerCompte();
}
?>