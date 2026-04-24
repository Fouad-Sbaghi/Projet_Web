<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<main class="cv-portf" style="padding: 40px;">
    <div class="w3-card-4 w3-white" style="max-width:800px; margin: 0 auto;">
        <h2 class="w3-center w3-padding"><?= htmlspecialchars($cv->titre) ?></h2>
        
        <img src="../view/images/<?= !empty($cv->image) ? htmlspecialchars($cv->image) : 'OIP.jpg' ?>" style="width:100%; max-width:500px; margin: 16px auto; display: block;">
        
        <div class="w3-container w3-padding">
            <p><?= htmlspecialchars($cv->description) ?></p>
        </div>

        <div class="w3-container w3-padding w3-border-top">
            <p><b>Étudiant :</b> <?= htmlspecialchars($cv->prenom . ' ' . $cv->nom) ?></p>
            <?php if (!empty($cv->lien_linkedin)): ?>
                <p><a href="<?= htmlspecialchars($cv->lien_linkedin) ?>" target="_blank" class="w3-button w3-indigo">Voir LinkedIn</a></p>
            <?php endif; ?>
        </div>
    </div>
</main>