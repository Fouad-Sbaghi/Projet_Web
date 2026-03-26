<?php
$racine = "../../";

require_once '../classes/Autoloader.php'; 
Autoloader::enregistrer();

use model\Database;
use model\ProjetModel;
use classes\Projet;

$projetModel = new ProjetModel();
$message = "";

// 1. SI LE FORMULAIRE D'AJOUT A ÉTÉ SOUMIS
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'ajouter') {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $image = htmlspecialchars($_POST['image']); // Pour simplifier, on prend juste le nom de l'image (ex: cv1.png)
    
    // On simule l'id_user à 1 pour l'instant (à remplacer par $_GET['id_user'] plus tard)
    $id_user = 1; 

    if (!empty($titre) && !empty($description)) {
        // On crée l'OBJET Projet (Le constructeur attend : id, titre, description, image)
        $nouveauProjet = new Projet("", $titre, $description, $image);
        
        // On demande au modèle d'insérer l'objet
        if ($projetModel->inserer($nouveauProjet, $id_user)) {
            $message = "<div class='w3-panel w3-green'>Projet ajouté avec succès !</div>";
        } else {
            $message = "<div class='w3-panel w3-red'>Erreur lors de l'ajout.</div>";
        }
    } else {
        $message = "<div class='w3-panel w3-orange'>Veuillez remplir le titre et la description.</div>";
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