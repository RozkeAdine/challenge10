<?php
session_start();
require_once 'connec.php';
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
        <title>challenge10</title>
    </head>
    <body>
    
        
    </body>
    </html>
</html>