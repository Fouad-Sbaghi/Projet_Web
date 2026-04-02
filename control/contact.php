<?php

$racine = "../";

$message_contact = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = htmlspecialchars($_POST['fname'] ?? '');
    $nom = htmlspecialchars($_POST['lname'] ?? '');
    $contenu = htmlspecialchars($_POST['message'] ?? '');

    if (!empty($prenom) && !empty($nom) && !empty($contenu)) {
        $message_contact = "<div class='w3-panel w3-green w3-center'><p>Votre message a été envoyé avec succès !</p></div>";
    } else {
        $message_contact = "<div class='w3-panel w3-orange w3-center'><p>Veuillez remplir tous les champs.</p></div>";
    }
}

include '../view/header.php'; 
include '../view/formulaire.php';
include '../view/footer.php'; 
?>
