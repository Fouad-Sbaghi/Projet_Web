<?php
$racine = "../";
require_once '../admin/classes/Autoloader.php';
Autoloader::enregistrer();

use model\ProjetModel;

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$projetModel = new ProjetModel();
$cv = $projetModel->getProjetById($id);

// Pense à adapter ta vue view/portfolio.php pour utiliser les propriétés de l'objet ($cv->titre, $cv->image, etc.) au lieu de $cv['nom']
include "../view/header.php";
include "../view/portfolio.php";
include "../view/footer.php";