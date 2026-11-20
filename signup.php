<?php
require 'config.php';
$flash = take_flash();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>

    <div class="center">
      <h1>Signup</h1>
      <form method="post" action="creatuser.php">
        <?php if ($flash): ?>
          <p class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></p>
        <?php endif; ?>
        <div class="txt_field">
          <input type="text" name="nom" placeholder="Username" maxlength="100" required>
          <span></span>
        </div>
        <div class="txt_field">
          <input type="email" name="email" placeholder="Email" maxlength="100" required>
          <span></span>
        </div>
        <div class="txt_field">
          <input type="password" name="mdp" placeholder="Password (8 caractères min.)" minlength="8" required>
        </div>
        <input name="submit" type="submit" value="Signup">
        <div class="signup_link">
          Vous avez un compte ? <a href="login.php">Login</a>
        </div>
      </form>

    </div>

  </body>
</html>
