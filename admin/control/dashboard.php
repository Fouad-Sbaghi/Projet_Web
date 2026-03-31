<?php
// admin/control/dashboard.php

$racine = "../";

require_once '../classes/Autoloader.php';
Autoloader::enregistrer();

use model\Database;
use model\UtilisateursModel;
use model\UtilisateurException;

// Vérification de la connexion via GET (pas de session !)
if (!isset($_GET['id_user']) || empty($_GET['id_user'])) {
    header("Location: ../index.php");
    exit();
}

$id_user = intval($_GET['id_user']);

// Vérifier que l'utilisateur existe et est Admin
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

// Récupérer les statistiques pour le dashboard
$db = Database::getConnexion();
$stmt = $db->query("SELECT COUNT(*) AS total FROM PROJETS");
$nombre_portfolios = $stmt->fetch(\PDO::FETCH_ASSOC)['total'];

$stmt = $db->query("SELECT COUNT(*) AS total FROM UTILISATEURS");
$nombre_utilisateurs = $stmt->fetch(\PDO::FETCH_ASSOC)['total'];

include "../view/header.php";
include "../view/sidebar.php";
include "../view/dashboard.php";
include "../view/footer.php";
