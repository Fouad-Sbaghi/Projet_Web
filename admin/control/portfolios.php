<?php
// admin/control/portfolios.php
$racine = "../../";

require_once '../classes/Autoloader.php';
Autoloader::enregistrer();

use model\ProjetModel;
use model\ProjetException;
use model\UtilisateursModel;
use classes\Projet;

// Vérification de la connexion via GET
if (!isset($_GET['id_user']) || empty($_GET['id_user'])) {
    header("Location: ../index.php");
    exit();
}
$id_user = intval($_GET['id_user']);

$projetModel = new ProjetModel();
$modelUser = new UtilisateursModel();
$message = "";

// Récupérer la liste des étudiants pour le formulaire d'ajout
$liste_etudiants = $modelUser->getAllUtilisateurs();

// AJOUT d'un projet (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'ajouter') {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $image = htmlspecialchars($_POST['image']);     

    $id_etudiant = intval($_POST['id_etudiant'] ?? $id_user);

    if (!empty($titre) && !empty($description) && $id_etudiant > 0) {
        try {
            $nouveauProjet = new Projet("", $titre, $description, $image);
            $projetModel->inserer($nouveauProjet, $id_etudiant);
            $message = "<div class='w3-panel w3-green'><p>Projet ajouté</p></div>";
        } catch (ProjetException $e) {
            $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
        }
    } else {
        $message = "<div class='w3-panel w3-orange'><p>Erreur : Informations manquantes.</p></div>";
    }
}

// MODIFICATION d'un projet (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier') {
    $id_projet = intval($_POST['id_projet']);
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $image = htmlspecialchars($_POST['image']);     

    try {
        $projetModif = new Projet($id_projet, $titre, $description, $image);
        $projetModel->modifierProjet($projetModif);
        $message = "<div class='w3-panel w3-green'><p>Projet modifié</p></div>";
    } catch (ProjetException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

// SUPPRESSION d'un projet (GET)
if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id_projet'])) {
    $id_projet_a_supprimer = intval($_GET['id_projet']);
    
    try {
        $projetModel->supprimer($id_projet_a_supprimer);
        $message = "<div class='w3-panel w3-green'><p>Projet supprimé</p></div>";
    } catch (ProjetException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

// Récupérer la liste des projets pour le tableau
$liste_portfolios = $projetModel->getAllProjets();

// Récupérer le projet à modifier si demandé
$projet_a_modifier = null;
if (isset($_GET['action']) && $_GET['action'] === 'editer' && isset($_GET['id_projet'])) {
    try {
        $projet_a_modifier = $projetModel->getProjetById(intval($_GET['id_projet']));
    } catch (ProjetException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

// Affichage des vues
include "../view/header.php";
include "../view/sidebar.php";
include "../view/portfolios.php";
include "../view/footer.php";
?>