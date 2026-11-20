<?php
/**
 * Configuration commune à toutes les pages PHP :
 * session, connexion MySQL et petites fonctions utilitaires.
 *
 * Par défaut : configuration XAMPP (utilisateur root sans mot de passe, base « projet »).
 * Chaque paramètre peut être surchargé par une variable d'environnement :
 * DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_port = (int) (getenv('DB_PORT') ?: 3306);
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'projet';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    exit('Connexion à la base de données impossible : vérifiez que MySQL est démarré '
        . 'et que le fichier projet.sql a bien été importé.');
}

/** Échappe une valeur avant de l'afficher dans du HTML (protection XSS). */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/** Redirige vers une autre page et arrête le script. */
function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

/** Réserve la page aux utilisateurs connectés. */
function require_login(): void
{
    if (empty($_SESSION['user_id'])) {
        flash('error', 'Veuillez vous connecter pour accéder à cette page.');
        redirect('login.php');
    }
}

/**
 * Rôle de l'utilisateur connecté : 'admin', 'membre', ou null si personne n'est connecté.
 * Le rôle est relu en base à chaque requête : une promotion (ou rétrogradation)
 * s'applique immédiatement, sans avoir à se reconnecter.
 */
function current_role(): ?string
{
    global $conn;
    static $role = false;
    if ($role !== false) {
        return $role;
    }

    $role = null;
    if (!empty($_SESSION['user_id'])) {
        try {
            $stmt = $conn->prepare('SELECT role FROM user WHERE id = ?');
            $stmt->bind_param('i', $_SESSION['user_id']);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_row();
            $role = $row[0] ?? null;
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1054) { // colonne `role` absente : base créée avec l'ancien projet.sql
                http_response_code(500);
                exit("La base de données doit être mise à jour : exécutez dans phpMyAdmin\n"
                    . "ALTER TABLE user ADD role ENUM('membre','admin') NOT NULL DEFAULT 'membre';");
            }
            throw $e;
        }
    }
    return $role;
}

function is_admin(): bool
{
    return current_role() === 'admin';
}

/** Réserve la page aux administrateurs (gestion des messages de contact). */
function require_admin(): void
{
    require_login();
    if (!is_admin()) {
        http_response_code(403);
        exit('<!DOCTYPE html><html lang="fr"><head><meta charset="utf-8">'
            . '<meta name="viewport" content="width=device-width, initial-scale=1.0">'
            . '<title>Accès refusé</title><link rel="stylesheet" href="css/login.css"></head>'
            . '<body><div class="center"><h1>Accès refusé</h1><form>'
            . '<p class="alert alert-error">Cette page est réservée aux administrateurs de la salle.</p>'
            . '<div class="signup_link"><a href="index.html">Retour à l\'accueil</a> · '
            . '<a href="logout.php">Se déconnecter</a></div></form></div></body></html>');
    }
}

/** Enregistre un message à afficher une seule fois sur la page suivante. */
function flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

/** Récupère (et efface) le message flash en attente. */
function take_flash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

/**
 * Valide les champs d'un message de contact.
 * Retourne [données nettoyées, message d'erreur ou null].
 */
function validate_contact(array $input): array
{
    $data = [
        'nom'   => trim($input['nom'] ?? ''),
        'email' => trim($input['email'] ?? ''),
        'objet' => trim($input['objet'] ?? ''),
        'msg'   => trim($input['msg'] ?? ''),
    ];

    if ($data['nom'] === '' || $data['objet'] === '' || $data['msg'] === '') {
        return [$data, 'Merci de remplir tous les champs.'];
    }
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        return [$data, 'Adresse email invalide.'];
    }
    foreach (['nom' => 100, 'email' => 100, 'objet' => 100, 'msg' => 500] as $field => $max) {
        if (mb_strlen($data[$field]) > $max) {
            return [$data, "Le champ « $field » ne doit pas dépasser $max caractères."];
        }
    }
    return [$data, null];
}
