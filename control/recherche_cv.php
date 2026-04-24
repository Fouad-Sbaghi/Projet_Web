<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$racine = "";

require_once '../admin/classes/Autoloader.php';
Autoloader::enregistrer();

use model\ProjetModel;

$projetModel = new ProjetModel();
$liste_projets = $projetModel->getAllProjets();

include '../view/header.php'; 

include '../view/cv.php';

include '../view/footer.php'; 

?>