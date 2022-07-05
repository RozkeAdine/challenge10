<?php
// ouverture de la connexion
session_start();

require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);
// traitement
$rech = ("SELECT *, CONCAT(firstname, ' ', lastname) as author FROM projet_bibliotheque.authors ORDER BY 'Name' ASC");
$resultat = $pdo->prepare($rech);
$resultat->execute();                

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // création de la requête
  $sql = "INSERT INTO books
              (saga, title, editor, ISBN, tome, genre, synopsis, year, idauthor)
            VALUES
            (:saga, :title, :editor, :ISBN, :tome, :genre, :synopsis, :year, :idauthor)";
  //récupération des données
  $saga = $_POST['saga'] ?? '';
  $title = $_POST['title'] ?? '';
  $editor = $_POST['editor'] ?? '';
  $ISBN = $_POST['ISBN'] ?? '';
  $tome = $_POST['tome'] ?? '';
  $genre = $_POST['genre'] ?? '';
  $synopsis = $_POST['synopsis'] ?? '';
  $year = $_POST['year'] ?? '';
  $idauthor = $_POST['idauthor'] ?? '';
  // envoi de la requête      
  $statement = $pdo->prepare($sql);
  $statement->execute(compact('saga', 'title', 'editor', 'ISBN', 'tome', 'genre', 'synopsis', 'year', 'idauthor'));
  //  redirection
  header("Location:index.php");
  exit();
}
?>
<form action='' method='post'>
  <div>
    <label for='saga'>Saga</label>
    <input type='text' name='saga' />
  </div>
  <div>
    <label for='title'>title</label>
    <input type='text' name='title' />
  </div>
  <div>
    <label for='editor'>Editeur</label>
    <input type='text' name='editor' />
  </div>
  <div>
    <label for='ISBN'>ISBN</label>
    <input type='text' name='ISBN' />
  </div>
  <div>
    <label for='tome'>Tome</label>
    <input type='text' name='tome' />
  </div>
  <div>
  <div>
    <label  for='genre'>Genre :</label><br>
    <select type='text' name='genre' id='genre' size='1'>
      <option value='Horreur'>Horreur</option>
      <option value='Science-Fiction'>Science-Fiction</option>
      <option value='Policier'>Policier</option>
    </select>
    </div>
    <div>
    <label  for='synopsis'>Synopsis :</label><br>
    <textarea  type='text' id='message'  name='synopsis'></textarea>
  </div>
  <div>
    <label for='year'>Année de publication</label>
    <input type='text' name='year' />
  </div>
  <div>
    <label  for="idauthor">Nom de l'auteur:</label><br>
    <select type="integer" id="idauthor" name="idauthor" size="1" required>
                <?php
                while ($ligne = $resultat->fetch())
                    echo "<option value='" . $ligne['idauthor'] . "'>" . $ligne['author'] . "</option>";
                ?>
    </select>
    <label  for="firstname"><a href="form_author.php">Auteur inconnu ?</a></label><br>
  </div>
    <label for='submit'>Enregistrer</label>
    <input type='submit' value='cliquez pour enregistrer' />
  </div>
</form>