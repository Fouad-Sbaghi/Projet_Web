<div class="w3-container w3-white w3-card w3-padding">
    <h2>Gestion de la FAQ</h2>

    <?= $message ?? '' ?>

    <!-- Formulaire de modification (affiché si on édite) -->
    <?php if(isset($faq_a_modifier) && $faq_a_modifier): ?>
    <div class="w3-panel w3-pale-yellow w3-padding-16">
        <h4>Modifier la FAQ</h4>
        <form method="POST" action="faq.php?id_user=<?= $id_user ?>">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="id_faq" value="<?= $faq_a_modifier->id ?>">
            
            <label>Question</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="question" value="<?= htmlspecialchars($faq_a_modifier->question) ?>" required>
            
            <label>Réponse</label>
            <textarea class="w3-input w3-border w3-margin-bottom" name="reponse" required><?= htmlspecialchars($faq_a_modifier->reponse) ?></textarea>
            
            <button type="submit" class="w3-button w3-blue">Enregistrer</button>
            <a href="faq.php?id_user=<?= $id_user ?>" class="w3-button w3-grey">Annuler</a>
        </form>
    </div>
    <?php else: ?>
    <!-- Formulaire d'ajout -->
    <div class="w3-panel w3-light-grey w3-padding-16">
        <h4>Ajouter une question</h4>
        <form method="POST" action="faq.php?id_user=<?= $id_user ?>">
            <input type="hidden" name="action" value="ajouter">
            
            <label>Question</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="question" required>
            
            <label>Réponse</label>
            <textarea class="w3-input w3-border w3-margin-bottom" name="reponse" required></textarea>
            
            <button type="submit" class="w3-button w3-green">Ajouter</button>
        </form>
    </div>
    <?php endif; ?>

    <div class="w3-responsive">
        <table class="w3-table-all">
            <thead>
                <tr class="w3-dark-grey">
                    <th>Question</th>
                    <th>Réponse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($liste_faq as $f): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($f->question); ?></td>
                        <td><?php echo htmlspecialchars($f->reponse); ?></td>
                        <td>
                            <a href="faq.php?id_user=<?= $id_user ?>&action=editer&id_faq=<?= $f->id ?>" 
                               class="w3-button w3-blue w3-small">Modifier</a>
                            <a href="faq.php?id_user=<?= $id_user ?>&action=supprimer&id_faq=<?= $f->id ?> &csrf_token=<?= $_SESSION['csrf_token'] ?>" 
                               onclick="return confirm('Supprimer cette FAQ ?');"
                               class="w3-button w3-red w3-small">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>