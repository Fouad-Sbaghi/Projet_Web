<?php
// admin/control/faq.php

require_once '../classes/Autoloader.php';
Autoloader::enregistrer();

use model\FaqModel;
use model\FaqException;
use classes\Faq;

// Vérification de la connexion via GET
if (!isset($_GET['id_user']) || empty($_GET['id_user'])) {
    header("Location: ../index.php");
    exit();
}
$id_user = intval($_GET['id_user']);

$modele = new FaqModel();
$message = "";

// AJOUT d'une FAQ (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'ajouter') {
    $question = htmlspecialchars($_POST['question']);
    $reponse = htmlspecialchars($_POST['reponse']);

    try {
        $nouvelleFaq = new Faq("", $question, $reponse);
        $modele->insererFaq($nouvelleFaq);
        $message = "<div class='w3-panel w3-green'><p>FAQ ajoutée avec succès !</p></div>";
    } catch (FaqException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

// MODIFICATION d'une FAQ (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier') {
    $id_faq = intval($_POST['id_faq']);
    $question = htmlspecialchars($_POST['question']);
    $reponse = htmlspecialchars($_POST['reponse']);

    try {
        $faqModif = new Faq($id_faq, $question, $reponse);
        $modele->modifierFaq($faqModif);
        $message = "<div class='w3-panel w3-green'><p>FAQ modifiée avec succès !</p></div>";
    } catch (FaqException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

// SUPPRESSION d'une FAQ (GET)
if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id_faq'])) {
    $id_faq_suppr = intval($_GET['id_faq']);
    try {
        $modele->supprimerFaq($id_faq_suppr);
        $message = "<div class='w3-panel w3-green'><p>FAQ supprimée avec succès !</p></div>";
    } catch (FaqException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

// Récupérer toutes les FAQ
$liste_faq = $modele->getAllFaqs();

// Récupérer la FAQ à modifier si demandé
$faq_a_modifier = null;
if (isset($_GET['action']) && $_GET['action'] === 'editer' && isset($_GET['id_faq'])) {
    try {
        $faq_a_modifier = $modele->getFaqById(intval($_GET['id_faq']));
    } catch (FaqException $e) {
        $message = "<div class='w3-panel w3-red'><p>" . $e->getMessage() . "</p></div>";
    }
}

include "../view/header.php";
include "../view/sidebar.php";
include "../view/faq.php";
include "../view/footer.php";
