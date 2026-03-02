<div class="w3-container w3-white w3-card w3-padding-24">
    <h2>Gestion des Utilisateurs</h2>
    <button class="w3-button w3-green w3-margin-bottom">Ajouter</button>

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
                    <td><b>ID : </b><?php echo $u['id']; ?></td>
                    <td><b>Nom : </b><?php echo $u['nom']; ?></td>
                    <td><b>Prénom : </b><?php echo $u['prenom']; ?></td>
                    <td><b>Rôle : </b><?php echo $u['role']; ?></td>
                    <td>
                        <button class="w3-button w3-blue w3-small">Modifier</button>
                        <button class="w3-button w3-red w3-small">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>