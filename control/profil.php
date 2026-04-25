<?php

$racine = "../";
require_once '../admin/classes/Autoloader.php';
Autoloader::enregistrer();
use model\UtilisateursModel;
use model\exceptions\UtilisateurException;


$id = intval($_GET['id']);

if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== $id) {
    die("Accès refusé. Vous ne pouvez modifier que votre propre profil.");
}

$model = new UtilisateursModel();
$message = "";

if (isset($_GET['action']) && $_GET['action'] === 'supprimer') {
    if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur de sécurité CSRF.");
    }
    
    try {
        $model->supprimerUtilisateur($id);
        header("Location: ../index.php");
        exit();
    } catch (UtilisateurException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Erreur de sécurité CSRF. Veuillez rafraîchir la page.");
    }
    try {
        $utilisateur = $model->getUtilisateurById($id);
        $utilisateur->nom = htmlspecialchars($_POST['nom']);
        $utilisateur->prenom = htmlspecialchars($_POST['prenom']);
        $utilisateur->email = htmlspecialchars($_POST['email']);
        $utilisateur->filiere = htmlspecialchars($_POST['filiere'] ?? '');
        $utilisateur->lienLinkedin = htmlspecialchars($_POST['linkedin'] ?? '');
        $model->modifierUtilisateur($utilisateur);
        $message = "<div class='w3-panel w3-green'><p>Profil modifié !</p></div>";
    } catch (UtilisateurException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

try {
    $utilisateur = $model->getUtilisateurById($id);
} catch (UtilisateurException $e) {
    header("Location: utilisateur.php");
    exit();
}

include '../view/header.php';
include '../view/profil.php';
include '../view/footer.php';
?>
