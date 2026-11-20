<?php
// Crée un compte utilisateur à partir du formulaire d'inscription (signup.php).
require 'config.php';

if (!empty($_SESSION['user_id'])) {
    redirect('index.html');
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('signup.php');
}

$nom   = trim($_POST['nom'] ?? '');
$email = trim($_POST['email'] ?? '');
$mdp   = $_POST['mdp'] ?? '';

if ($nom === '' || mb_strlen($nom) > 100) {
    flash('error', "Nom d'utilisateur invalide (100 caractères maximum).");
    redirect('signup.php');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 100) {
    flash('error', 'Adresse email invalide.');
    redirect('signup.php');
}
if (strlen($mdp) < 8) {
    flash('error', 'Le mot de passe doit contenir au moins 8 caractères.');
    redirect('signup.php');
}

$stmt = $conn->prepare('SELECT 1 FROM user WHERE nom = ? OR email = ?');
$stmt->bind_param('ss', $nom, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    flash('error', "Ce nom d'utilisateur ou cet email est déjà utilisé.");
    redirect('signup.php');
}

// Le mot de passe n'est jamais stocké en clair : on enregistre uniquement son hash.
$hash = password_hash($mdp, PASSWORD_DEFAULT);
$stmt = $conn->prepare('INSERT INTO user (nom, email, mdp) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $nom, $email, $hash);
$stmt->execute();

flash('success', 'Compte créé ! Vous pouvez maintenant vous connecter.');
redirect('login.php');
