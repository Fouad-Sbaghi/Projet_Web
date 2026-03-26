<?php
// control/utilisateur.php

$racine = "../";

// 1. Appel de l'Autoloader au tout début !
require_once '../class/Autoloader.php';
Autoloader::enregistrer();

// 2. On indique qu'on va utiliser ces classes
use model\UtilisateursModel;
use model\UtilisateurException;

$erreur = "";

// 3. Traitement du formulaire si la méthode est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On récupère les champs du form (dans view/login.php, les name sont "user" et "pass")
    $email = isset($_POST['user']) ? htmlspecialchars($_POST['user']) : '';
    $pass = isset($_POST['pass']) ? htmlspecialchars($_POST['pass']) : '';

    if (!empty($email) && !empty($pass)) {
        $db = \model\Database::getConnexion();
        $model = new UtilisateursModel($db);
        try {
            // On tente la connexion
            $utilisateur = $model->verifierConnexion($email, $pass);

            // CONNEXION RÉUSSIE ! 
            // Passage de l'id_user en GET (dans l'URL) car $_SESSION est interdit
            if ($utilisateur['role'] === 'Admin') {
                // Redirection vers le back-office si c'est l'admin
                header("Location: ../admin/control/dashboard.php?id_user=" . $utilisateur['id_user']);
                exit();
            } else {
                // Redirection vers le front-office si c'est un client
                header("Location: ../index.php?id_user=" . $utilisateur['id_user']);
                exit();
            }
        } catch (UtilisateurException $e) {
            // On attrape l'erreur si le mot de passe est faux ou si l'utilisateur n'existe pas
            $erreur = $e->getMessage();
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}

// 4. Affichage de la page
include '../view/header.php';

// S'il y a une erreur, on l'affiche au-dessus du formulaire
if (!empty($erreur)) {
    echo "<div class='w3-panel w3-red w3-center w3-padding'><h3>Erreur</h3><p>{$erreur}</p></div>";
}

include '../view/login.php';
include '../view/footer.php';
