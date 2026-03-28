<?php

/*
if (!isset($_GET['id_user']) || empty($_GET['id_user'])) {
    header("Location: ../../control/utilisateur.php");
    exit();
}
    */

$racine = "../../";

$nombre_portfolios = 10;
$nombre_utilisateurs = 5;

include "../view/header.php";

include "../view/sidebar.php";

include "../view/dashboard.php";

include "../view/footer.php";
