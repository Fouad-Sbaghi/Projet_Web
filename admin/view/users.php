<div class="w3-container w3-white w3-card w3-padding-24">
    <h2>Gestion des Utilisateurs</h2>

    <?= $message ?? '' ?>

    <!-- Formulaire d'ajout d'utilisateur -->
    <div class="w3-panel w3-light-grey w3-padding-16">
        <h4>Ajouter un utilisateur</h4>
        <form method="POST" action="users.php?id_user=<?= $id_user ?>">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <input type="hidden" name="action" value="ajouter">
            
            <label>Nom</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="nom" required>
            
            <label>Prénom</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="prenom" required>
            
            <label>Email</label>
            <input class="w3-input w3-border w3-margin-bottom" type="email" name="email" required>
            
            <label>Mot de passe</label>
            <input class="w3-input w3-border w3-margin-bottom" type="password" name="mot_de_passe" required>
            
            <label>Rôle</label>
            <select class="w3-select w3-border w3-margin-bottom" name="role">
                <option value="Etudiant">Etudiant</option>
                <option value="Admin">Admin</option>
            </select>
            
            <label>Filière (si étudiant)</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="filiere">

            <label>Lien LinkedIn (si étudiant)</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="linkedin">

            <label>Téléphone pro (si admin)</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="telephone">
            
            <button type="submit" class="w3-button w3-green">Ajouter</button>
        </form>
    </div>

    <div class="w3-responsive">
        <table class="w3-table-all">
            <thead>
                <tr class="w3-dark-grey">
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($liste_users as $u): ?>
                    <tr>
                        <td><?php echo $u->id; ?></td>
                        <td><?php echo htmlspecialchars($u->nom); ?></td>
                        <td><?php echo htmlspecialchars($u->prenom); ?></td>
                        <td><?php echo htmlspecialchars($u->role); ?></td>
                        <td>
                            <a href="users.php?action=supprimer&id_suppr=<?= $u->id ?>&csrf_token=<?= $_SESSION['csrf_token'] ?>" 
                            onclick="return confirm('Supprimer cet utilisateur et tous ses projets ?');"
                            class="w3-button w3-red w3-small">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>