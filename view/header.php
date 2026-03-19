<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <link rel="stylesheet" href="<?php echo $racine ?>view/css/style.css">
  <script src="<?php echo $racine ?>view/javascript/menu.js"></script>
</head>
<body>

<div class="w3-bar w3-indigo w3-card banniere">
  <a class="w3-bar-item w3-button w3-hide-large w3-hide-medium" onclick="toggleMobileMenu()">&#9776;</a>
  
  <a href="<?php echo $racine ?>index.php" class="w3-bar-item  w3-hide-small">Accueil</a>
  <a href="<?php echo $racine ?>control/recherche_cv.php" class="w3-bar-item w3-hide-small">Recherche des CV</a>
  <a href="<?php echo $racine ?>control/contact.php" class="w3-bar-item w3-hide-small">Contact</a>
  <a href="<?php echo $racine ?>control/utilisateur.php" class="w3-bar-item w3-hide-small">Login</a>
  
</div>

<div id="mobileMenu" class="w3-bar-block w3-indigo w3-hide w3-hide-large w3-hide-medium">
  <a href="<?php echo $racine ?>index.php" class="w3-bar-item w3-button">Accueil</a>
  <a href="<?php echo $racine ?>control/recherche_cv.php" class="w3-bar-item w3-button">Recherche des CV</a>
  <a href="<?php echo $racine ?>control/contact.php" class="w3-bar-item w3-button">Contact</a>
  <a href="<?php echo $racine ?>control/utilisateur.php" class="w3-bar-item w3-button">Login</a>
</div>

