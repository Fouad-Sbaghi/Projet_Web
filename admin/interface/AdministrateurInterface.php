<?php
namespace interfaces;

#admin

interface AdministrateurInterface {
    public function gererUtilisateurs();
    public function envoyerMail();
    public function supprimerCompte();
}
?>