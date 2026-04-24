<?php

require_once 'classes/Autoloader.php';
Autoloader::enregistrer();

use model\UtilisateursModel;
use model\exceptions\UtilisateurException;

if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['mot_de_passe']);

    try {
        $model = new UtilisateursModel();
        $utilisateur = $model->verifierConnexion($email, $pass);

        if ($utilisateur->role === 'Admin') {
            header("Location: control/dashboard.php");
            exit();
        } else {
            $erreur = "Accès réservé aux administrateurs.";
        }
    } catch (UtilisateurException $e) {
        $erreur = $e->getMessage();
    } catch (\Exception $e) {
        $erreur = "Erreur de connexion.";
    }
}

include 'view/login.php';
?>