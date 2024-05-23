<?php
include('config.php');

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>signup</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
  
    <div class="center">
      <h1>Signup</h1>
      <form method="post" action="creatuser.php">
        <div class="txt_field">
          <input type="text" name="nom"Placeholder="Username" required>
          <span></span>
        </div>
        <div class="txt_field">
          <input type="text" name="email" Placeholder="Email"required>
          <span></span>
        </div>
        <div class="txt_field">
          <input type="password" name="mdp" Placeholder="Password" required>
        </div>
        <input  name="submit" type="submit" value="Signup">
        <div class="signup_link">
          Vous avez un compte ? <a href="login.php">Login</a>
        </div>
      </form>
     
    </div>

  </body>
</html>
