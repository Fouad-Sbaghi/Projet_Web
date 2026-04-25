<main class="w3-container w3-padding-32 w3-middle form1">
  <h1 class="w3-center w3-text-indigo" id="titrefh1">Nous Contacter !</h1>

  <?= $message_contact ?? '' ?>

  <form method="POST" action="<?= $racine ?>contact" class="w3-card w3-padding w3-white w3-margin-auto fr" style="width:100%; max-width:600px;">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <label class="w3-text-indigo" for="fname">Prénom :</label>
    <input class="w3-input w3-border w3-margin-bottom" type="text" id="fname" name="fname" required>

    <label class="w3-text-indigo" for="lname">Nom de famille :</label>
    <input class="w3-input w3-border w3-margin-bottom" type="text" id="lname" name="lname" required>


    <label class="w3-text-indigo" for="message">Message :</label>
    <textarea class="w3-input w3-border w3-margin-bottom" id="message" name="message" required></textarea>

    <input class="w3-button w3-indigo w3-block" type="submit" value="Valider">
  </form>
</main>