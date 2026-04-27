<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$racine = "";

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
        $model = new UtilisateursModel();
                
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erreur de sécurité CSRF.");
        }

        $utilisateur = $model->verifierConnexion($email, $pass);

        // Enregistrement dans la session
        $_SESSION['user_id'] = $utilisateur->id;
        $_SESSION['role'] = $utilisateur->role;
        $_SESSION['prenom'] = $utilisateur->prenom;

        if(isset($_COOKIE['cookie_consent']) && $_COOKIE['cookie_consent'] == 'accept') {
            setcookie("user_name", $utilisateur->prenom, time() + (86400 * 30), "/");
        }

        if ($utilisateur->role === 'Admin') {
            header("Location: ../admin/control/dashboard.php");
            exit();
        } else {
            header("Location: " . $racine . "accueil");
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