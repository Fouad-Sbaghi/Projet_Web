<?php if(isset($_COOKIE['user_name'])): ?>
    <div class="w3-panel w3-red w3-center" style="margin-bottom:0;">
        <p>Bonjour <?= htmlspecialchars($_COOKIE['user_name']) ?> !</p>
    </div>
<?php endif; ?>

<?php if(!isset($_COOKIE['cookie_consent'])): ?>
<div id="cookieBanner" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #3f51b5; color: white; padding: 20px; text-align: center; z-index: 99999; box-shadow: 0 -5px 15px rgba(0,0,0,0.3);">
    <p style="margin: 0 0 15px 0; font-size: 16px;">Ce site utilise des cookies pour améliorer votre expérience (ex: retenir votre prénom pour vous dire Bonjour). Acceptez-vous ?</p>
    <button onclick="setCookieConsent('accept')" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; font-weight: bold; cursor: pointer; margin-right: 10px; border-radius: 5px;">Accepter</button>
    <button onclick="setCookieConsent('reject')" style="background-color: #f44336; color: white; border: none; padding: 10px 20px; font-weight: bold; cursor: pointer; border-radius: 5px;">Refuser</button>
</div>
<script>
function setCookieConsent(status) {
    document.cookie = "cookie_consent=" + status + "; max-age=" + (60*60*24*30);
    document.getElementById('cookieBanner').style.display = 'none';
}
</script>
<?php endif; ?>


<footer class="w3-container w3-indigo w3-center w3-padding-16">
  <p class="w3-text-white">&copy; 2026 Fouad SBAGHI - Nassim Benchenni</p>
  <p>
      <a href="<?php echo $racine ?>mentions_legales" class="w3-text-white">Mentions Légales & CGV</a> | 
      <a href="<?php echo $racine ?>sitemap_" class="w3-text-white">Plan du site</a>
  </p>
</footer>
</body>

</html>