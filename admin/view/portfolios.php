<div class="w3-container w3-white w3-card w3-padding-24">
    <h2>Gestion des Portfolios</h2>
    
    <?= $message ?? '' ?>

    <!-- Formulaire de modification (affiché si on édite) -->
    <?php if(isset($projet_a_modifier) && $projet_a_modifier): ?>
    <div class="w3-panel w3-pale-yellow w3-padding-16">
        <h4>Modifier le projet</h4>
        <form method="POST" action="portfolios.php?id_user=<?= $id_user ?>">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="id_projet" value="<?= htmlspecialchars($projet_a_modifier->id) ?>">
            
            <label>Titre du projet</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="titre" value="<?= htmlspecialchars($projet_a_modifier->titre) ?>" required>
            
            <label>Description</label>
            <textarea class="w3-input w3-border w3-margin-bottom" name="description" required><?= htmlspecialchars($projet_a_modifier->description) ?></textarea>
            
            <label>Nom de l'image (ex: cv1.png)</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="image" value="<?= htmlspecialchars($projet_a_modifier->image ?? '') ?>">
            
            <button type="submit" class="w3-button w3-blue">Enregistrer la modification</button>
            <a href="portfolios.php?id_user=<?= $id_user ?>" class="w3-button w3-grey">Annuler</a>
        </form>
    </div>
    <?php else: ?>
    <!-- Formulaire d'ajout -->
    <div class="w3-panel w3-light-grey w3-padding-16">
        <h4>Ajouter un nouveau projet</h4>
        <form method="POST" action="portfolios.php?id_user=<?= $id_user ?>">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="hidden" name="action" value="ajouter">
            
            <label>Étudiant (propriétaire du CV)</label>
            <select class="w3-select w3-border w3-margin-bottom" name="id_etudiant" required>
                <option value="">-- Choisir un étudiant --</option>
                <?php foreach ($liste_etudiants as $etu): ?>
                    <option value="<?= $etu->id ?>"><?= htmlspecialchars($etu->nom . ' ' . $etu->prenom) ?> (<?= $etu->role ?>)</option>
                <?php endforeach; ?>
            </select>

            <label>Titre du projet</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="titre" required>
            
            <label>Description longue</label>
            <textarea class="w3-input w3-border w3-margin-bottom" name="description" required></textarea>
            
            <label>Nom de l'image (ex: cv1.png)</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="image">
            
            <button type="submit" class="w3-button w3-green">Enregistrer le projet</button>
        </form>
    </div>
    <?php endif; ?>

    <div class="w3-responsive">
        <table class="w3-table-all">
            <thead>
                <tr class="w3-dark-grey">
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($liste_portfolios)): ?>
                    <?php foreach ($liste_portfolios as $p): ?>
                        <tr>
                            <td><?php echo $p->id; ?></td>
                            <td><?php echo htmlspecialchars($p->titre); ?></td>
                            <td><?php echo htmlspecialchars(substr($p->description, 0, 30)) . '...'; ?></td>
                            <td><?php echo htmlspecialchars($p->image); ?></td>
                            <td>
                                <a href="portfolios.php?id_user=<?= $id_user ?>&action=editer&id_projet=<?= $p->id ?>&csrf_token=<?= $_SESSION['csrf_token'] ?>" 
                                   class="w3-button w3-blue w3-small">Éditer</a>
                                
                                <a href="portfolios.php?id_user=<?= $id_user ?>&action=supprimer&id_projet=<?= $p->id ?> &csrf_token=<?= $_SESSION['csrf_token'] ?>" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?');"
                                   class="w3-button w3-red w3-small">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="w3-center">Aucun projet trouvé.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
