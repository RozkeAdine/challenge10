<?php
session_start();

require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);
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
    <button  type="submit" name="submit"><a href="index.php">Liste des ouvrages</a></button>
    <button  type="submit" name="submit"><a href="formModificationB.php">Modifier un ouvrage</a></button>
    </div>
    <body>
        <ul>
        <?php foreach($books as $book)
        { ?>
            <li>
                <h3>
                <?= "{$book->saga} - {$book->title}"; ?>
                </h3>
            </li>
        <?php } ?>
        </ul>
    </body>
</html>