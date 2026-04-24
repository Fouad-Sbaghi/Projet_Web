<?php

$racine = "../";
require_once '../admin/classes/Autoloader.php';
Autoloader::enregistrer();
use model\UtilisateursModel;
use model\exceptions\UtilisateurException;

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Erreur de sécurité CSRF. Veuillez rafraîchir la page.");
}
$id = intval($_GET['id']);
$model = new UtilisateursModel();
$message = "";

if (isset($_GET['action']) && $_GET['action'] === 'supprimer') {
    try {
        $model->supprimerUtilisateur($id);
        header("Location: ../index.php");
        exit();
    } catch (UtilisateurException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier') {
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
