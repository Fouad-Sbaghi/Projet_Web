<?php

$racine = "../../";

require_once '../classes/Autoloader.php';
Autoloader::enregistrer();

use model\ProjetModel;
use model\exceptions\ProjetException;
use model\UtilisateursModel;
use classes\Projet;

if (!isset($_GET['id_user']) || empty($_GET['id_user'])) {
    header("Location: ../index.php");
    exit();
}
$id_user = intval($_GET['id_user']);

$projetModel = new ProjetModel();
$modelUser = new UtilisateursModel();
$message = "";

$liste_etudiants = $modelUser->getAllUtilisateurs();

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

if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id_projet'])) {
    $id_projet_a_supprimer = intval($_GET['id_projet']);
    
    try {
        $projetModel->supprimer($id_projet_a_supprimer);
        $message = "<div class='w3-panel w3-green'><p>Projet supprimé</p></div>";
    } catch (ProjetException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

$liste_portfolios = $projetModel->getAllProjets();

$projet_a_modifier = null;
if (isset($_GET['action']) && $_GET['action'] === 'editer' && isset($_GET['id_projet'])) {
    try {
        $projet_a_modifier = $projetModel->getProjetById(intval($_GET['id_projet']));
    } catch (ProjetException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

include "../view/header.php";
include "../view/sidebar.php";
include "../view/portfolios.php";
include "../view/footer.php";
?>