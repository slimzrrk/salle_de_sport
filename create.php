<?php
// Enregistre un message envoyé depuis le formulaire de contact (contact.php).
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('contact.php');
}

[$data, $error] = validate_contact($_POST);
if ($error) {
    flash('error', $error);
    redirect('contact.php#contact-form');
}

// L'id est généré automatiquement (AUTO_INCREMENT).
$stmt = $conn->prepare('INSERT INTO contact (nom, email, objet, msg) VALUES (?, ?, ?, ?)');
$stmt->bind_param('ssss', $data['nom'], $data['email'], $data['objet'], $data['msg']);
$stmt->execute();

flash('success', 'Merci ! Votre message a bien été envoyé.');
redirect('contact.php#contact-form');
