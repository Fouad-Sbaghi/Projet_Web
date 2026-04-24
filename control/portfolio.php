<?php
$racine = "../";
require_once '../admin/classes/Autoloader.php';
Autoloader::enregistrer();

use model\ProjetModel;

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Erreur de sécurité CSRF. Veuillez rafraîchir la page.");
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;


$projetModel = new ProjetModel();
$cv = $projetModel->getProjetById($id);

include "../view/header.php";
include "../view/portfolio.php";
include "../view/footer.php";