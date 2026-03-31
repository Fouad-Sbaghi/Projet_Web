<?php
// admin/control/mail.php

require_once '../classes/Autoloader.php';
Autoloader::enregistrer();

use model\UtilisateursModel;

// Vérification de la connexion via GET
if (!isset($_GET['id_user']) || empty($_GET['id_user'])) {
    header("Location: ../index.php");
    exit();
}
$id_user = intval($_GET['id_user']);

$message = "";
$model_user = new UtilisateursModel();
$liste_users = $model_user->getAllUtilisateurs();

// Traitement POST pour envoyer un mail
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sujet = htmlspecialchars($_POST['sujet']);
    $contenu = htmlspecialchars($_POST['message']);

    if (!empty($sujet) && !empty($contenu)) {
        // Envoyer un mail à tous les utilisateurs
        foreach ($liste_users as $u) {
            @mail($u->email, $sujet, $contenu);
        }
        $message = "<div class='w3-panel w3-green'><p>Mail envoyé aux utilisateurs !</p></div>";
    } else {
        $message = "<div class='w3-panel w3-orange'><p>Veuillez remplir tous les champs.</p></div>";
    }
}

include "../view/header.php";
include "../view/sidebar.php";
include "../view/mail.php";
include "../view/footer.php";
