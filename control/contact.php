<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$racine = "../";
$message_contact = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Vérification du token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur de sécurité CSRF.");
    }

    // 2. Récupération des données du formulaire
    $prenom = htmlspecialchars($_POST['fname'] ?? '');
    $nom = htmlspecialchars($_POST['lname'] ?? '');
    $contenu = htmlspecialchars($_POST['message'] ?? '');

    // 3. Envoi du mail
    if (!empty($prenom) && !empty($nom) && !empty($contenu)) {
        $to = "poubbelle05@gmail.com";
        $subject = "Nouveau contact de $prenom $nom";
        $headers = "From: contact@votresite.com\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        if (mail($to, $subject, $contenu, $headers)) {
            $message_contact = "<div class='w3-panel w3-green w3-center'><p>Votre message a été envoyé avec succès !</p></div>";
        } else {
            $message_contact = "<div class='w3-panel w3-red w3-center'><p>Erreur lors de l'envoi du mail.</p></div>";
        }
    } else {
        $message_contact = "<div class='w3-panel w3-orange w3-center'><p>Veuillez remplir tous les champs.</p></div>";
    }
}

include '../view/header.php'; 
include '../view/formulaire.php';
include '../view/footer.php'; 
?>
