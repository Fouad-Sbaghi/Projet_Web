<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="view/css/style_admin.css">
  <title>Login Administration</title>
</head>

<body>
  <!-- Simple login form sans verif -->
  <form action="control/dashboard.php">
    <h1>Connexion BackOffice</h1>

    <label for="user">Nom Utilisateur:</label><br>
    <input type="text" id="user" name="user"><br>

    <label for="pass">Mot de passe:</label><br>
    <input type="password" id="pass" name="pass"><br>
    <br>
    <br>
    <input type="submit" value="Se connecter">
  </form>

</body>

</html>