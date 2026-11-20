<?php
// Enregistre les modifications d'un message (formulaire de update.php).
require 'config.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('afficher.php');
}

$id = (int) ($_POST['id'] ?? 0);
[$data, $error] = validate_contact($_POST);
if ($error) {
    flash('error', $error);
    redirect('update.php?id=' . $id);
}

$stmt = $conn->prepare('UPDATE contact SET nom = ?, email = ?, objet = ?, msg = ? WHERE id = ?');
$stmt->bind_param('ssssi', $data['nom'], $data['email'], $data['objet'], $data['msg'], $id);
$stmt->execute();

flash('success', 'Message modifié avec succès.');
redirect('afficher.php');
