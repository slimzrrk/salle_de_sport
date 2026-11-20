<?php
require 'config.php';

if (!empty($_SESSION['user_id'])) {
    redirect('index.html');
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $mdp   = $_POST['mdp'] ?? '';

    $stmt = $conn->prepare('SELECT id, nom, mdp FROM user WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    $valid = false;
    if ($user) {
        if (password_get_info($user['mdp'])['algoName'] === 'unknown') {
            // Ancien compte dont le mot de passe était stocké en clair :
            // on le vérifie une dernière fois puis on le remplace par son hash.
            $valid = hash_equals($user['mdp'], $mdp);
            if ($valid) {
                $hash = password_hash($mdp, PASSWORD_DEFAULT);
                $upd = $conn->prepare('UPDATE user SET mdp = ? WHERE id = ?');
                $upd->bind_param('si', $hash, $user['id']);
                $upd->execute();
            }
        } else {
            $valid = password_verify($mdp, $user['mdp']);
        }
    }

    if ($valid) {
        session_regenerate_id(true); // évite la fixation de session
        $_SESSION['user_id']  = (int) $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        redirect('index.html');
    }
    // Message volontairement identique dans les deux cas (email inconnu / mauvais mot de passe).
    $error = 'Email ou mot de passe incorrect.';
}
$flash = take_flash();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>

    <div class="center">
      <h1>Login</h1>
      <form method="post">
        <?php if ($error): ?>
          <p class="alert alert-error"><?= e($error) ?></p>
        <?php elseif ($flash): ?>
          <p class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></p>
        <?php endif; ?>
        <div class="txt_field">
          <input type="email" name="email" placeholder="Email" value="<?= e($_POST['email'] ?? '') ?>" required>
        </div>
        <div class="txt_field">
          <input type="password" name="mdp" placeholder="Password" required>
        </div>
        <input name="submit" type="submit" value="Login">
        <div class="signup_link">
          Not a member? <a href="signup.php">Sign up</a>
        </div>
      </form>
    </div>

  </body>
</html>
