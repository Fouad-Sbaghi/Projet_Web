<?php

$racine = "../";

require_once '../admin/classes/Autoloader.php';
Autoloader::enregistrer();

use model\exceptions\UtilisateurException;
use model\Database;
use model\UtilisateursModel;

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['mot_de_passe']);

    try {

        $db = Database::getConnexion();
        $model = new UtilisateursModel();

        $utilisateur = $model->verifierConnexion($email, $pass);

        if ($utilisateur->role === 'Admin') {
            header("Location: ../admin/control/dashboard.php?id_user=" . $utilisateur->id);
            exit();
        } else {
            header("Location: ../index.php?id=" . $utilisateur->id);
            exit();
        }
    } catch (Exception $e) {
        $erreur = "Identifiants incorrects ou erreur de base de données.";
    }
}

include '../view/header.php';
include '../view/login.php';
include '../view/footer.php';
?>