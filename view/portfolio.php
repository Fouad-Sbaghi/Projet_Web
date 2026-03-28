
<main class="cv-portf">
    <div class="w3-card-4 w3-center cv-card">
        <h2><?= htmlspecialchars($cv->titre) ?></h2>
        <img src="../view/images/<?= $cv->image ?>" style="width:100%; margin: 16px auto; display: block;">
        <div class="w3-container">
            <p><?= htmlspecialchars($cv->description) ?></p>
        </div>
    </div>
    <div class="w3-display-middle">
        <p> Etudiant a l'univertsitéé d'avignon .................................................................................</p>
    </div>
    <div class="w3-display-middle">
        <a href="">Lien likedin</a>
        <a href="">Lien Projet</a>
    </div>
    
</main>