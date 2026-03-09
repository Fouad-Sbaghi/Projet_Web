
<main class="cv-portf">
    <div class="w3-card-4 w3-center cv-card">
        <h2><?= htmlspecialchars($cv['nom']) ?></h2>
        <img src="../view/images/<?= $cv['img'] ?>" style="width:100%; margin: 16px auto; display: block;">
        <div class="w3-container">
            <p><?= htmlspecialchars($cv['poste']) ?></p>
        </div>
    </div>
</main>