<div class="w3-container w3-white w3-card w3-padding">
    <h2>Envoyer un mail aux utilisateurs</h2>

    <?= $message ?? '' ?>

    <form class="w3-container" method="POST" action="mail.php?id_user=<?= $id_user ?>">
        <label>Sujet du mail</label>
        <input class="w3-input w3-border w3-margin-bottom" type="text" name="sujet" required>

        <label>Message</label>
        <textarea class="w3-input w3-border w3-margin-bottom" name="message" rows="5" required></textarea>

        <button type="submit" class="w3-button w3-green">Envoyer le mail</button>
    </form>

    <hr>
    <h4>Liste des destinataires :</h4>
    <ul class="w3-ul">
        <?php foreach ($liste_users as $u): ?>
            <li><?= htmlspecialchars($u['nom'] . ' ' . $u['prenom']) ?> - <?= htmlspecialchars($u['email']) ?></li>
        <?php endforeach; ?>
    </ul>
</div>