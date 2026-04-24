<?php

$racine = "../";

require_once '../classes/Autoloader.php';
Autoloader::enregistrer();

use model\Database;
use model\UtilisateursModel;
use model\exceptions\UtilisateurException;

if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../index.php");
    exit();
}
$id_user = $_SESSION['user_id'];

try {
    $model = new UtilisateursModel();
    $utilisateur = $model->getUtilisateurById($id_user);
    if ($utilisateur->role !== 'Admin') {
        header("Location: ../index.php");
        exit();
    }
} catch (UtilisateurException $e) {
    header("Location: ../index.php");
    exit();
}

$db = Database::getConnexion();
$stmt = $db->query("SELECT COUNT(*) AS total FROM PROJETS");
$nombre_portfolios = $stmt->fetch(\PDO::FETCH_ASSOC)['total'];

$stmt = $db->query("SELECT COUNT(*) AS total FROM UTILISATEURS");
$nombre_utilisateurs = $stmt->fetch(\PDO::FETCH_ASSOC)['total'];

include "../view/header.php";
include "../view/sidebar.php";
include "../view/dashboard.php";
include "../view/footer.php";
