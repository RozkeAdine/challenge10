<?php
session_start();
if(empty($_SESSION['login']))
{
  header('location:login.php');
  exit();
}
?>
<html>
  <div  class="button">
      <button  type="submit" name="submit"><a href="index.php">liste des ouvrages</a></button>
      <button  type="submit" name="submit"><a href="formAddB.php">Ajouter un ouvrage</a></button>
      <button  type="submit" name="submit"><a href="formAddA.php">Ajouter un autheur</a></button>
      <button  type="submit" name="submit"><a href="formDeleteB.php">Supprimer un ouvrage</a></button>
      <button  type="submit" name="submit"><a href="formAlterB.php">Modifier un ouvrage</a></button>    
  </div>

</html>
<?php

require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);
$query = ("SELECT * FROM projet_bibliotheque.books ORDER BY 'title' ASC");
$books = $pdo->query($query)->fetchAll(PDO::FETCH_OBJ);

// modification des données
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // création de la requête
  $sql = "UPDATE books SET saga = :saga, title = :title, editor = :editor, ISBN = :ISBN, tome = :tome, genre = :genre, synopsis = :synopsis, year = :year, WHERE idbook = :idbook" ;
  $statement = $pdo->prepare($sql);
  // envoi des requêtes
  foreach ($_POST['idbook'] as $idbook) {
    $saga = $_POST['saga'][$idbook] ?? '';
    $title = $_POST['title'][$idbook] ?? '';
    $editor = $_POST['editor'][$idbook] ?? '';
    $ISBN = $_POST['ISBN'][$idbook] ?? '';
    $tome = $_POST['tome'][$idbook] ?? '';
    $genre = $_POST['genre'][$idbook] ?? '';
    $synopsis = $_POST['synopsis'][$idbook] ?? '';
    $year = $_POST['year'][$idbook] ?? '';

    $statement->execute(compact('idbook', 'saga', 'title', 'editor', 'ISBN', 'tome', 'genre', 'synopsis', 'year',));
  }
}
// création de la requête
$sql = "SELECT * FROM books";
// envoi de la requête
$statement = $pdo->prepare($sql);
$statement->execute();
$books = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<form action='' method='post'>
  <ul>
    <?php foreach ($books as $book) 
    { ?>
      <li>
        <input type="hidden" value="<?= $book->idbook; ?>" name="idbook[]" />
        <label>SAGA</label><input type="text" value="<?= $book->saga; ?>" name="saga[<?= $book->idbook; ?>]" /><br>
        <label>TITRE</label><input type="text" value="<?= $book->title; ?>" name="title[<?= $book->idbook; ?>]" /><br>
        <label>EDITEUR</label><input type="text" value="<?= $book->editor; ?>" name="editor[<?= $book->idbook; ?>]" /><br>
        <label>ISBN</label><input type="text" value="<?= $book->ISBN; ?>" name="ISBN[<?= $book->idbook; ?>]" /><br>
        <label>TOME</label><input type="text" value="<?= $book->tome; ?>" name="tome[<?= $book->idbook; ?>]" /><br>
        <label>GENRE</label><input type="text" value="<?= $book->genre; ?>" name="genre[<?= $book->idbook; ?>]" /><br>
        <label>SYNOPSIS</label><input type="text" value="<?= $book->synopsis; ?>" name="synopsis[<?= $book->idbook; ?>]"><br>
        <label>ANNEE DE PUBLICATION</label><input type="text" value="<?= $book->year; ?>" name="year[<?= $book->idbook; ?>]" /><br>
      </li>
      <br>
    <?php } ?>
  </ul>
  <div><input type='submit' value='modifier' /></div>
</form>