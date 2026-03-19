<?php

$racine = "../";

// fichier Data
include "../model/data.php";

// Récupérer l'id depuis l'URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Chercher le CV correspondant
$cv = null;
foreach ($cvs as $item) {
    if ($item['id'] === $id) {
        $cv = $item;
        break;
    }
}

include "../view/header.php";

include "../view/portfolio.php";

include "../view/footer.php";
