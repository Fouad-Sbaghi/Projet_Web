<?php
// control/contact.php
$racine = "../";

$message_contact = "";

// Traitement du formulaire de contact (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = htmlspecialchars($_POST['fname'] ?? '');
    $nom = htmlspecialchars($_POST['lname'] ?? '');
    $mail = htmlspecialchars($_POST['mail'] ?? '');
    $contenu = htmlspecialchars($_POST['message'] ?? '');

    if (!empty($prenom) && !empty($nom) && !empty($mail) && !empty($contenu)) {
        // Envoi du mail de contact
        $sujet = "Contact de $prenom $nom";
        $body = "De : $prenom $nom ($mail)\n\nMessage :\n$contenu";
        @mail("fouad.sbaghi7@gmail.com", $sujet, $body, "From: $mail");
        $message_contact = "<div class='w3-panel w3-green w3-center'><p>Votre message a été envoyé !</p></div>";
    } else {
        $message_contact = "<div class='w3-panel w3-orange w3-center'><p>Veuillez remplir tous les champs.</p></div>";
    }
}

include '../view/header.php'; 
include '../view/formulaire.php';
include '../view/footer.php'; 
?>
