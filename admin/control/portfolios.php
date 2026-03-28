<?php
$racine = "../../";

require_once '../classes/Autoloader.php';
Autoloader::enregistrer();

use model\Database;
use model\ProjetModel;
use classes\Projet;

$projetModel = new ProjetModel();
$message = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'ajouter') {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $image = htmlspecialchars($_POST['image']);     

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    var_dump($id); // ← affiche l'ID reçu
    $cv = $projetModel->getProjetById($id);
    var_dump($cv); // ← affiche ce que la BD retourne

    // On vérifie que le titre, la description ET un id_user valide existent
    if (!empty($titre) && !empty($description) && $id_user > 0) {
        
        $nouveauProjet = new Projet("", $titre, $description, $image);
        
        // On insère avec le VRAI id_user de la personne connectée
        if ($projetModel->inserer($nouveauProjet, $id_user)) {
            $message = "<div class='w3-panel w3-green'>Projet ajouté avec succès !</div>";
        } else {
            $message = "<div class='w3-panel w3-red'>Erreur lors de l'ajout.</div>";
        }
    } else {
        $message = "<div class='w3-panel w3-orange'>Erreur : Informations manquantes ou vous n'êtes pas connecté avec un ID valide.</div>";
    }
}


// 1.5 SI ON DEMANDE UNE SUPPRESSION (via l'URL en GET)
if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id_projet'])) {
    $id_projet_a_supprimer = intval($_GET['id_projet']);
    
    // On appelle notre nouvelle méthode du modèle
    if ($projetModel->supprimer($id_projet_a_supprimer)) {
        $message = "<div class='w3-panel w3-green'>Projet supprimé avec succès !</div>";
    } else {
        $message = "<div class='w3-panel w3-red'>Erreur lors de la suppression.</div>";
    }
}

// 2. ON RÉCUPÈRE LA LISTE DES PROJETS POUR LE TABLEAU
$liste_portfolios = $projetModel->getAllProjets();

// 3. ON AFFICHE LA VUE
include "../view/header.php";
include "../view/sidebar.php";
include "../view/portfolios.php";
include "../view/footer.php";
?>