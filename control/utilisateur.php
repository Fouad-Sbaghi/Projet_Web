<?php
// control/utilisateur.php
$racine = "../";


require_once '../admin/classes/Autoloader.php';
Autoloader::enregistrer();

use model\UtilisateurException;
use model\Database;
use model\UtilisateursModel;


$erreur = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['mot_de_passe']);

    try {
        // 2. Connexion PDO
        $db = Database::getConnexion();
        $model = new UtilisateursModel();

        // 3. Vérification
        $utilisateur = $model->verifierConnexion($email, $pass);

        // 4. Redirection stricte avec l'ID dans l'URL
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

// 5. Affichage de la vue
include '../view/header.php';
include '../view/login.php';
include '../view/footer.php';
?>