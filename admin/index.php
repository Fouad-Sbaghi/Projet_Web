<?php
// admin/index.php - Login BackOffice avec vérification mot de passe

require_once 'classes/Autoloader.php';
Autoloader::enregistrer();

use model\UtilisateursModel;
use model\UtilisateurException;

$erreur = "";

// Traitement du formulaire POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['mot_de_passe']);

    try {
        $model = new UtilisateursModel();
        $utilisateur = $model->verifierConnexion($email, $pass);

        // Vérifier que c'est bien un Admin
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

// Affichage de la vue login
include 'view/login.php';
?>