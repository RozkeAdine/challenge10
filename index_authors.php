<?php
require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);?>
<html>
    <button  type="submit" name="submit"><a href="index.php">retour à la liste d'ouvrage</a></button><br><br>
</html>
<?php
try{
    $dbco = new \PDO(DSN, USER, PASS);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
  
    //$sth appartient à la classe PDOStatement
    $sth = $dbco->prepare("
        INSERT INTO projet_bibliotheque.authors (firstname,lastname,birthday)
        VALUES (:firstname, :lastname, :birthday)
    ");
    $sth->execute(array(
                        ':firstname' => $firstname,
                        ':lastname' => $lastname,
                        ':birthday' => $birthday));
    echo "Nouvel AUTEUR ajoutée",'<br>', 'Merci';
}
      
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
?><br><br>
<html>
<div  class="button">
    <button  type="submit" name="submit"><a href="formAddB.php">entrer un ouvrage</a></button>
  <br>
  <br>
  <button  type="submit" name="submit"><a href="formAddA.php">ajouter un nouvel auteur</a></button>
</div>
</html>