<?php

$racine = "../";
$racine = "";

require_once '../admin/classes/Autoloader.php';
Autoloader::enregistrer();

use model\ProjetModel;

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Erreur de sécurité CSRF. Veuillez rafraîchir la page.");
}

$projetModel = new ProjetModel();
$liste_projets = $projetModel->getAllProjets();

include '../view/header.php'; 

include '../view/cv.php';

include '../view/footer.php'; 

?>