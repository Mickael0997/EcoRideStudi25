<?php
// Démarrer la session avant toute sortie HTML
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtenir les informations de connexion à partir des variables d'environnement
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$host = $cleardb_url["host"];
$username = $cleardb_url["user"];
$password = $cleardb_url["pass"];
$dbname = substr($cleardb_url["path"], 1);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>