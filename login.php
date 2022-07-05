<?php
define('LOGIN', 'rozke');
if(!empty($_POST)) 
{
  if(!empty($_POST['login'])) 
  {
    if($_POST['login'] !== LOGIN) 
    {
      $errorMessage = 'Mauvais login !';
    }
      else
    {
      session_start();
      $_SESSION['login'] = LOGIN;
      header('Location: challenge10.php');
      exit();
    }
  }
    else
  {
    $errorMessage = 'Veuillez inscrire vos identifiants svp !';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge 10</title>
    <head>
    <title>Formulaire d'authentification</title>
  </head>
  <body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <fieldset>
        <legend>Identifiez-vous</legend>
        <?php
          // Rencontre-t-on une erreur ?
          if(!empty($errorMessage)) 
          {
            echo '<p>', htmlspecialchars($errorMessage) ,'</p>';
          }
        ?>
       <p>
          <label for="login">Login :</label> 
          <input type="text" name="login" id="login" value="" />
          <input type="submit" name="submit" value="Se logguer" />
        </p>
      </fieldset>        
    </form>
</body>
</html>