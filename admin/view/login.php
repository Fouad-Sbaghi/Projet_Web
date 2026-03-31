<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style_admin.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <title>Login Administration</title>
</head>
<body>
  <form action="../admin/index.php" method="POST" class="w3-card w3-padding w3-white" style="max-width:400px; margin: 100px auto;">
    <h1 class="w3-center">Connexion BackOffice</h1>

    <?php if(!empty($erreur)): ?>
      <div class="w3-panel w3-red w3-padding">
        <p><?= htmlspecialchars($erreur) ?></p>
      </div>
    <?php endif; ?>

    <label for="email">Adresse Email :</label>
    <input class="w3-input w3-border w3-margin-bottom" type="email" id="email" name="email" required>

    <label for="mot_de_passe">Mot de passe :</label>
    <input class="w3-input w3-border w3-margin-bottom" type="password" id="mot_de_passe" name="mot_de_passe" required>

    <input class="w3-button w3-dark-grey w3-block w3-margin-top" type="submit" value="Se connecter">
  </form>
</body>
</html>