<?php

require_once '../classes/Autoloader.php';
Autoloader::enregistrer();

use model\UtilisateursModel;
use model\exceptions\UtilisateurException;
use classes\Etudiant;
use classes\Administrateur;

if (!isset($_GET['id_user']) || empty($_GET['id_user'])) {
    header("Location: ../index.php");
    exit();
}
$id_user = intval($_GET['id_user']);

$model_user = new UtilisateursModel();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'ajouter') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $mdp = $_POST['mot_de_passe'];
    $role = htmlspecialchars($_POST['role']);
    $filiere = htmlspecialchars($_POST['filiere'] ?? '');
    $linkedin = htmlspecialchars($_POST['linkedin'] ?? '');
    $tel = htmlspecialchars($_POST['telephone'] ?? '');

    try {
        if ($role === 'Admin') {
            $newUser = new Administrateur("", $nom, $prenom, $email, $mdp, $tel);
        } else {
            $newUser = new Etudiant("", $nom, $prenom, $email, $mdp, $filiere, $linkedin);
        }
        $model_user->insererUtilisateur($newUser);
        $message = "<div class='w3-panel w3-green'><p>Utilisateur ajouté</p></div>";
    } catch (UtilisateurException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id_suppr'])) {
    $id_suppr = intval($_GET['id_suppr']);
    try {
        $model_user->supprimerUtilisateur($id_suppr);
        $message = "<div class='w3-panel w3-green'><p>Utilisateur supprimé</p></div>";
    } catch (UtilisateurException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

$liste_users = $model_user->getAllUtilisateurs();

include "../view/header.php";
include "../view/sidebar.php";
include "../view/users.php";
include "../view/footer.php";
