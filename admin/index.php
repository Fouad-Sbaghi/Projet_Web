<?php

require_once 'classes/Autoloader.php';
Autoloader::enregistrer();

use model\UtilisateursModel;
use model\UtilisateurException;

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['mot_de_passe']);

    try {
        $model = new UtilisateursModel();
        $utilisateur = $model->verifierConnexion($email, $pass);

        if ($utilisateur->role === 'Admin') {
            header("Location: control/dashboard.php?id_user=" . $utilisateur->id);
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