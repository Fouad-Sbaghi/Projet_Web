<div class="w3-container w3-white w3-card w3-padding-24">
    <h2>Gestion des Portfolios</h2>
    
    <?= $message ?? '' ?>

    <div class="w3-panel w3-light-grey w3-padding-16">
        <h4>Ajouter un nouveau projet</h4>
        
        <form method="POST" action="portfolios.php?id_user=<?= isset($_GET['id_user']) ? htmlspecialchars($_GET['id_user']) : '' ?>">
            
            <input type="hidden" name="action" value="ajouter">
            
            <label>Titre du projet</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="titre" required>
            
            <label>Description longue</label>
            <textarea class="w3-input w3-border w3-margin-bottom" name="description" required></textarea>
            
            <label>Nom de l'image (ex: cv1.png)</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="image">
            
            <button type="submit" class="w3-button w3-green">Enregistrer le projet</button>
        </form>
    </div>

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
                                <button class="w3-button w3-blue w3-small">Modifier</button>
                              
                                <a href="portfolios.php?id_user=<?= isset($_GET['id_user']) ? htmlspecialchars($_GET['id_user']) : '' ?>&action=supprimer&id_projet=<?= $p->id ?>" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce projet ?');" 
                                   class="w3-button w3-red w3-small">
                                   Supprimer
                                </a>
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

