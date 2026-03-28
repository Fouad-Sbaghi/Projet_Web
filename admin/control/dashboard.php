<?php

// Si l'id_user n'est pas dans l'URL, on le renvoie à la page de connexion !
if (!isset($_GET['id_user']) || empty($_GET['id_user'])) {
    header("Location: ../../control/utilisateur.php");
    exit();
}

$racine = "../../";

$nombre_portfolios = 10;
$nombre_utilisateurs = 5;

include "../view/header.php";

include "../view/sidebar.php";

include "../view/dashboard.php";

include "../view/footer.php";
