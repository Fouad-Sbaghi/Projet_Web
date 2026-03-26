<?php

$racine = "../";


require_once '../admin/classes/Autoloader.php';
Autoloader::enregistrer();


use model\ProjetModel;


$projetModel = new ProjetModel();
$liste_projets = $projetModel->getAllProjets();

include "../model/data.php";

include '../view/header.php'; 

include '../view/cv.php';

include '../view/footer.php'; 

?>