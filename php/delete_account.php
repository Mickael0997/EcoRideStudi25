<?php
session_start();
include __DIR__ . '/database.php';

$id_utilisateur = $_SESSION['id_utilisateur'];

// Supprimer l'utilisateur
$stmt = $pdo->prepare("DELETE FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);

// Détruire la session
session_destroy();

header('Location: ../index.php');
exit;
?>