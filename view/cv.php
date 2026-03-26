<main class="cv-tissu" style="padding: 40px;">
  <div class="cv-main">
    
    <?php foreach ($liste_projets as $projet): ?>
    
      <a href="<?php echo $racine?>control/portfolio.php?id=<?= $projet->id ?>" class="w3-card-4 w3-center cv-card">
        
        <h2><?= htmlspecialchars($projet->titre) ?></h2>
        
        <img src="../view/images/<?= !empty($projet->image) ? htmlspecialchars($projet->image) : 'OIP.jpg' ?>" style="width:70%; margin: 16px auto; display: block;">
        
        <div class="w3-container">
          <p><?= htmlspecialchars(substr($projet->description, 0, 50)) ?>...</p>
        </div>
        
      </a>
      
    <?php endforeach; ?>

  </div>
</main>