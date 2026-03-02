<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="view/css/style_admin.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <title>Login Utilisateur</title>
</head>

<body>

  <form action="utilisateur.php" method="POST" class="form2">
    <h1>Connexion Client</h1>

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