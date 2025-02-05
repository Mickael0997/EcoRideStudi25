<?php
// Démarrer la session avant toute sortie HTML
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
$host = "127.0.0.1";
$port = "3306";
$dbname = "ecoride";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>