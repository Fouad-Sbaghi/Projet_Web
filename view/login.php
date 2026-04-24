<main>
  <form action="utilisateur.php" method="POST" class="form2">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <h1>Connexion</h1>

    <label for="email">Adresse Email :</label><br>
    <input type="email" id="email" name="email" required><br>

    <label for="mot_de_passe">Mot de passe :</label><br>
    <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>
    <br>
    <br>
    <input type="submit" value="Se connecter">
  </form>
</main>