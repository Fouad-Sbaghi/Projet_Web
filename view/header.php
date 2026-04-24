<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$id_connecte = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="<?php echo $racine ?>view/css/style.css">
  <script src="<?php echo $racine ?>view/javascript/menu.js"></script>
</head>
<body>
<div class="w3-bar w3-indigo w3-card banniere">
  <a class="w3-bar-item w3-button w3-hide-large w3-hide-medium" onclick="toggleMobileMenu()">&#9776;</a>
  
  <a href="<?php echo $racine ?>accueil" class="w3-bar-item w3-hide-small">Accueil</a>
  <a href="<?php echo $racine ?>cv" class="w3-bar-item w3-hide-small">Recherche des CV</a>
  <a href="<?php echo $racine ?>contact" class="w3-bar-item w3-hide-small">Contact</a>
  
  <?php if($id_connecte > 0): ?>
    <a href="<?php echo $racine ?>control/profil.php?id=<?= $id_connecte ?>" class="w3-bar-item w3-hide-small">Mon Profil</a>
    <a href="<?php echo $racine ?>admin/index.php?logout=1" class="w3-bar-item w3-hide-small">Déconnexion</a>
  <?php else: ?>
    <a href="<?php echo $racine ?>control/utilisateur.php" class="w3-bar-item w3-hide-small">Login</a>
  <?php endif; ?>
</div>

<div id="mobileMenu" class="w3-bar-block w3-indigo w3-hide w3-hide-large w3-hide-medium">
  <a href="<?php echo $racine ?>accueil" class="w3-bar-item w3-button">Accueil</a>
  <a href="<?php echo $racine ?>cv" class="w3-bar-item w3-button">Recherche des CV</a>
  <a href="<?php echo $racine ?>contact" class="w3-bar-item w3-button">Contact</a>
  <?php if($id_connecte > 0): ?>
    <a href="<?php echo $racine ?>control/profil.php?id=<?= $id_connecte ?>" class="w3-bar-item w3-button">Mon Profil</a>
    <a href="<?php echo $racine ?>admin/index.php?logout=1" class="w3-bar-item w3-button">Déconnexion</a>
  <?php else: ?>
    <a href="<?php echo $racine ?>control/utilisateur.php" class="w3-bar-item w3-button">Login</a>
  <?php endif; ?>
</div>

