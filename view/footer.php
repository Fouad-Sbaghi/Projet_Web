<?php if (isset($_COOKIE['cookie_perso']) && $_COOKIE['cookie_perso'] === 'accept' && isset($_COOKIE['user_name'])): ?>
    <div class="w3-panel w3-light-blue w3-center" style="margin-bottom:0;">
        <p>Bonjour <?= htmlspecialchars($_COOKIE['user_name']) ?> !</p>
    </div>
<?php endif; ?>

<?php if (!isset($_COOKIE['cookie_consent'])): ?>
    <div id="cookieBanner"
        style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #3f51b5; color: white; padding: 20px; text-align: center; z-index: 99999; box-shadow: 0 -5px 15px rgba(0,0,0,0.3);">
        <p style="margin: 0 0 15px 0; font-size: 16px;">Ce site utilise des cookies pour améliorer votre expérience.
            Choisissez les cookies que vous acceptez :</p>

        <div style="margin-bottom: 15px; display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;">
            <label style="cursor: pointer;">
                <input type="checkbox" id="cookieNecessaire" checked disabled>
                <strong>Nécessaires</strong>
            </label>
            <label style="cursor: pointer;">
                <input type="checkbox" id="cookiePerso">
                <strong>Prénom utilisé</strong>
            </label>
        </div>

        <button onclick="validerCookies()"
            style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; font-weight: bold; cursor: pointer; margin-right: 10px; border-radius: 5px;">Valider
            mes choix</button>
        <button onclick="accepterTous()"
            style="background-color: #2196F3; color: white; border: none; padding: 10px 20px; font-weight: bold; cursor: pointer; margin-right: 10px; border-radius: 5px;">Tout
            accepter</button>
        <button onclick="refuserTous()"
            style="background-color: #f44336; color: white; border: none; padding: 10px 20px; font-weight: bold; cursor: pointer; border-radius: 5px;">Tout
            refuser</button>
    </div>
    <script>
        function validerCookies() {
            var perso = document.getElementById('cookiePerso').checked;
            document.cookie = "cookie_consent=custom; path=/; max-age=" + (60 * 60 * 24 * 30);
            document.cookie = "cookie_perso=" + (perso ? "accept" : "reject") + "; path=/; max-age=" + (60 * 60 * 24 * 30);
            document.getElementById('cookieBanner').style.display = 'none';
        }
        function accepterTous() {
            document.cookie = "cookie_consent=accept; path=/; max-age=" + (60 * 60 * 24 * 30);
            document.cookie = "cookie_perso=accept; path=/; max-age=" + (60 * 60 * 24 * 30);
            document.getElementById('cookieBanner').style.display = 'none';
        }
        function refuserTous() {
            document.cookie = "cookie_consent=reject; path=/; max-age=" + (60 * 60 * 24 * 30);
            document.cookie = "cookie_perso=reject; path=/; max-age=" + (60 * 60 * 24 * 30);
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