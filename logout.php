<?php
// Déconnecte l'utilisateur et le renvoie vers la page de connexion.
require 'config.php';

$_SESSION = [];
session_regenerate_id(true);
flash('success', 'Vous êtes déconnecté.');
redirect('login.php');
