<div class="w3-container w3-white w3-card w3-padding">
    <h2>Gestion de la FAQ</h2>
    <button class="w3-button w3-green w3-margin-bottom">Ajouter une question</button>

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
                        <td><?php echo $f->question; ?></td>
                        <td><?php echo $f->reponse; ?></td>
                        <td>
                            <button class="w3-button w3-blue w3-small">Modifier</button>
                            <button class="w3-button w3-red w3-small">Supprimer</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>