<div class="w3-container w3-white w3-card w3-padding-24">
    <h2>Gestion des Portfolios</h2>
    <button class="w3-button w3-green w3-margin-bottom">Ajouter</button>

    <table class="w3-table-all">
        <thead>
            <tr class="w3-dark-grey">
                <th>ID</th>
                <th>Titre</th>
                <th>Étudiant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($liste_portfolios as $p): ?>
                <tr>
                    <td><b>ID : </b><?php echo $p['id']; ?></td>
                    <td><b>Titre : </b><?php echo $p['titre']; ?></td>
                    <td><b>Étudiant : </b><?php echo $p['etudiant']; ?></td>
                    <td>
                        <button class="w3-button w3-blue w3-small">Modifier</button>
                        <button class="w3-button w3-red w3-small">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>