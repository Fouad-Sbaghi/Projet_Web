<?php

require_once '../classes/Autoloader.php';
Autoloader::enregistrer();

use model\UtilisateursModel;

if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../index.php");
    exit();
}
$id_user = $_SESSION['user_id'];

$message = "";
$model_user = new UtilisateursModel();
$liste_users = $model_user->getAllUtilisateurs();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur CSRF. Veuillez rafraîchir la page.");
    }
    $sujet = htmlspecialchars($_POST['sujet']);
    $contenu = htmlspecialchars($_POST['message']);

    if (!empty($sujet) && !empty($contenu)) {

        foreach ($liste_users as $u) {
            @mail($u->email, $sujet, $contenu);
        }
        $message = "<div class='w3-panel w3-green'><p>Mail envoyé</p></div>";
    } else {
        $message = "<div class='w3-panel w3-orange'><p>Veuillez remplir tous les champs.</p></div>";
    }
}

include "../view/header.php";
include "../view/sidebar.php";
include "../view/mail.php";
include "../view/footer.php";
