<?php
session_start();
if(empty($_SESSION['login']))
{
  header('location:login.php');
  exit();
}

  require_once 'connec.php';
  $pdo = new \PDO(DSN, USER, PASS);  
  // suppression des données
?>

<?php
$query = ("SELECT * FROM projet_bibliotheque.books ORDER BY 'title' ASC");
$books = $pdo->query($query)->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
    <HEAD>
        <title> challenge 10</title>
    </HEAD>
    <?php if (isset($_SESSION['login'])): ?>
    hello, <?=$_SESSION['login'] ?>!
    <a href="logout.php">Log out</a>
    <?php else:?>
        <a href="login.php">Log in</a>
    <?php endif; ?><br>
    <br>
    <div  class="button">
    <button  type="submit" name="submit"><a href="formAddB.php">Ajouter un ouvrage</a></button>
    <button  type="submit" name="submit"><a href="formAddA.php">Ajouter un autheur</a></button>
    <button  type="submit" name="submit"><a href="index.php">retour à la liste d'ouvrage</a></button><br><br>
    </div>
    <body>
        <form action="" method="POST">
        <ul>
        <?php foreach($books as $book)
        { ?>
            <li>
                <h3>
                <?= "{$book->saga} - {$book->title}"; ?>
                <input type='checkbox' name='supp[]' value='<?= $book->idbook; ?>' />
                </h3>
            </li>
        <?php } ?>
        </ul>
        <div><input type='submit' value='supprimer' /></div>
        <?php  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // création de la requête
    $sql = "DELETE FROM projet_bibliotheque.books WHERE idbook=:idbook";
    $statement = $pdo->prepare($sql);
    // envoi des requêtes
    foreach ($_POST['supp'] as $idbook) {
      $statement->execute(['idbook' => $idbook]);
    }
  }?>
    </form>
    </body>
</html>