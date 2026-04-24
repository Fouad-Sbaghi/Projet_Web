<?php
$racine = "../";
require_once '../admin/classes/Autoloader.php';
Autoloader::enregistrer();

use model\ProjetModel;

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;


$projetModel = new ProjetModel();
$cv = $projetModel->getProjetById($id);

include "../view/header.php";
include "../view/portfolio.php";
include "../view/footer.php";