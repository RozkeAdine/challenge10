<?php
session_start();
if(empty($_SESSION['login']))
{
  header('location:login.php');
  exit();
}?>
<html>
<?php if (isset($_SESSION['login'])): ?>
  hello, <?=$_SESSION['login'] ?>!
  <a href="logout.php">Log out</a>
  <?php else:?>
      <a href="login.php">Log in</a>
  <?php endif; ?><br><br>
</html>
<html>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>challenge 10</title>
  </head>
  <body>
  <form  action="index_authors.php" method="post">
  <div  class="button">
    <button  type="submit" name="submit"><a href="index.php">retour à la liste d'ouvrage</a></button>
  </div>

    <div>
        <h1>nouvelle entrée auteur</h1>
    </div>
  <div>
    <label  for="firstname">Nom :</label><br>
    <input  type="text"  id="firstname"  name="firstname" required>
  </div>
  <div>
    <label  for="lastname">Prénom :</label><br >
    <input  type="text"  id="lastname"  name="lastname" required>
  </div>
  <div>
    <label  for="birthday">Année de naissance :</label><br>
    <input  type="int"  id="birthday"  name="birthday" required>
    <br>
    <br>
  </div>
  <div  class="button">
    <button  type="submit" name="submit">Envoyer votre message</button>
  </div>
</form>
  </body>
  </html>