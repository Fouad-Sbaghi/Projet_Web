
<main class="cv-tissu" style="padding: 40px;">
  <div class="cv-main">
    
    <?php foreach ($cvs as $cv): ?>
      <a href="<?php echo $racine?>control/portfolio.php?id=<?= $cv['id'] ?>" class="w3-card-4 w3-center cv-card">
        <h2><?= htmlspecialchars($cv['nom']) ?></h2>
        <img src="../view/images/<?= $cv['img'] ?>" style="width:70%; margin: 16px auto; display: block;">
        <div class="w3-container">
          <p><?= htmlspecialchars($cv['poste']) ?></p>
        </div>
      </a>
    <?php endforeach; ?>

  </div>
</main>