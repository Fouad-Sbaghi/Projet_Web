<?php
namespace interfaces;

interface FaqInterface {
    public function ajouterQuestion($question, $reponse);
    public function modifier();
    public function supprimer();
}
?>