<?php

$racine = "../";

$message_contact = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = htmlspecialchars($_POST['fname'] ?? '');
    $nom = htmlspecialchars($_POST['lname'] ?? '');
    $mail = htmlspecialchars($_POST['mail'] ?? '');
    $contenu = htmlspecialchars($_POST['message'] ?? '');

    if (!empty($prenom) && !empty($nom) && !empty($mail) && !empty($contenu)) {
        // La fonction mail a été retirée à la demande de l'utilisateur.
        // Le formulaire fait maintenant simplement semblant d'être envoyé.
        $message_contact = "<div class='w3-panel w3-green w3-center'><p>Votre message a été envoyé avec succès !</p></div>";
    } else {
        $message_contact = "<div class='w3-panel w3-orange w3-center'><p>Veuillez remplir tous les champs.</p></div>";
    }
}

include '../view/header.php'; 
include '../view/formulaire.php';
include '../view/footer.php'; 
?>
