<?php 
// On récupère l'ID actuel pour l'accrocher à tous les liens
$id_user_actuel = isset($_GET['id_user']) ? htmlspecialchars($_GET['id_user']) : '';
$url_param = !empty($id_user_actuel) ? "?id_user=" . $id_user_actuel : "";
?>

<div class="w3-sidebar w3-bar-block w3-white w3-card sidebar">
    <h4 class="w3-bar-item w3-padding"><b>Menu</b></h4>
    <a href="../control/dashboard.php<?= $url_param ?>" class="w3-bar-item w3-button w3-padding">Tableau de bord</a>
    <a href="../control/portfolios.php<?= $url_param ?>" class="w3-bar-item w3-button w3-padding">Gestion Portfolios</a>
    <a href="../control/users.php<?= $url_param ?>" class="w3-bar-item w3-button w3-padding">Utilisateurs</a>
    <a href="../control/faq.php<?= $url_param ?>" class="w3-bar-item w3-button w3-padding">FAQ</a>
    <a href="../control/mail.php<?= $url_param ?>" class="w3-bar-item w3-button w3-padding">Envoyer un mail</a>
</div>
<div class="main-content">
    <div class="w3-container w3-padding"></div>