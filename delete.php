<?php
// Supprime un message de contact (bouton « Supprimer » de afficher.php).
require 'config.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('afficher.php');
}

$id = (int) ($_POST['id'] ?? 0);
$stmt = $conn->prepare('DELETE FROM contact WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    flash('success', 'Message supprimé avec succès.');
} else {
    flash('error', 'Message introuvable.');
}
redirect('afficher.php');
