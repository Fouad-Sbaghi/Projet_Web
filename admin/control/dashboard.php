<?php


$racine = "../";

/*
if (!isset($_GET['id_user']) || empty($_GET['id_user'])) {
    header("Location: ../../control/utilisateur.php");
    exit();
}
    */

require_once '../classes/Autoloader.php';
Autoloader::enregistrer();
use model\Database;

$db = Database::getConnexion();
$stmt = $db->query("SELECT COUNT(*) AS total FROM PROJETS");
$nombre_portfolios = $stmt->fetch(\PDO::FETCH_ASSOC)['total'];

$stmt = $db->query("SELECT COUNT(*) AS total FROM UTILISATEURS");
$nombre_utilisateurs = $stmt->fetch(\PDO::FETCH_ASSOC)['total'];

include "../view/header.php";

include "../view/sidebar.php";

include "../view/dashboard.php";

include "../view/footer.php";
