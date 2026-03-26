<?php
require_once '../class/Autoloader.php';
Autoloader::enregistrer();

use model\FaqModel;

// On instancie le modèle et on récupère les vraies FAQ
$modele = new FaqModel();
$liste_faq = $modele->getAllFaqs();

include "../view/header.php";
include "../view/sidebar.php";
include "../view/faq.php";
include "../view/footer.php";
