<main class="w3-container w3-padding-32">
  <h1 class="w3-center w3-text-indigo">Mon Profil</h1>
  <?= $message ?? '' ?>
  <div class="w3-card w3-padding w3-white w3-margin-auto" style="max-width:600px;">
    <form method="POST" action="<?= $racine ?>control/profil.php?id=<?= $utilisateur->id ?>">
      <input type="hidden" name="action" value="modifier">
      <label class="w3-text-indigo">Nom :</label>
      <input class="w3-input w3-border w3-margin-bottom" type="text" name="nom" value="<?= htmlspecialchars($utilisateur->nom) ?>" required>
      <label class="w3-text-indigo">Prénom :</label>
      <input class="w3-input w3-border w3-margin-bottom" type="text" name="prenom" value="<?= htmlspecialchars($utilisateur->prenom) ?>" required>
      <label class="w3-text-indigo">Email :</label>
      <input class="w3-input w3-border w3-margin-bottom" type="email" name="email" value="<?= htmlspecialchars($utilisateur->email) ?>" required>
      <label class="w3-text-indigo">Filière :</label>
      <input class="w3-input w3-border w3-margin-bottom" type="text" name="filiere" value="<?= htmlspecialchars($utilisateur->filiere ?? '') ?>">
      <label class="w3-text-indigo">LinkedIn :</label>
      <input class="w3-input w3-border w3-margin-bottom" type="text" name="linkedin" value="<?= htmlspecialchars($utilisateur->lienLinkedin ?? '') ?>">
      <input class="w3-button w3-indigo w3-block w3-margin-bottom" type="submit" value="Modifier">
    </form>
    <a href="<?= $racine ?>control/profil.php?id=<?= $utilisateur->id ?>&action=supprimer" onclick="return confirm('Supprimer votre compte ?');" class="w3-button w3-red w3-block">Supprimer mon compte</a>
  </div>
</main>
