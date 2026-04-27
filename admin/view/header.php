<!DOCTYPE html>
<html lang="fr">

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Récupération de l'ID via la session
$id_connecte = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Portfolios</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../view/css/style_admin.css">
</head>

<body class="w3-light-grey">
    <div class="w3-bar w3-dark-grey w3-padding barre-haut">
        <span class="w3-bar-item w3-large">Administration</span>
        <a href="../index.php?logout=1" class="w3-bar-item w3-button w3-right">Déconnexion</a>
    </div>