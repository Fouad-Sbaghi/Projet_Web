</div>
<footer class="w3-container w3-indigo w3-center w3-padding-16">
  <p class="w3-text-white">&copy; 2026 Fouad SBAGHI - Nassim Benchenni</p>
  <p>
      <a href="<?php echo $racine ?>mentions_legales" class="w3-text-white">Mentions Légales & CGV</a> | 
      <a href="<?php echo $racine ?>sitemap_" class="w3-text-white">Plan du site</a>
  </p>
</footer>
<?php if(!isset($_COOKIE['cookie_consent'])): ?>
<div id="cookieBanner" class="w3-panel w3-indigo w3-display-bottommiddle w3-card-4 w3-padding" style="position:fixed; bottom:0; width:100%; margin:0; z-index:999; text-align:center;">
    <p>Ce site utilise des cookies pour améliorer votre expérience (ex: retenir votre prénom pour vous dire Bonjour). Acceptez-vous ?</p>
    <button onclick="setCookieConsent('accept')" class="w3-button w3-green">Accepter</button>
    <button onclick="setCookieConsent('reject')" class="w3-button w3-red">Refuser</button>
</div>
<script>
function setCookieConsent(status) {
    document.cookie = "cookie_consent=" + status + "; max-age=" + (60*60*24*30) + "; path=/";
    document.getElementById('cookieBanner').style.display = 'none';
}
</script>
<?php endif; ?>

<?php if(isset($_COOKIE['user_name'])): ?>
    <div class="w3-panel w3-pale-green w3-center"><p>Bonjour <?= htmlspecialchars($_COOKIE['user_name']) ?> !</p></div>
<?php endif; ?>
</body>

</html>