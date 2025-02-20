<?php
session_start();
include __DIR__ . '/database.php';

// Vérifiez si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['id_admin']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php'); // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté ou n'est pas un administrateur
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Insérer l'employé dans la base de données
    $stmt = $pdo->prepare("INSERT INTO employe (pseudo, email, mot_de_passe) VALUES (:pseudo, :email, :mot_de_passe)");
    $stmt->execute(['pseudo' => $pseudo, 'email' => $email, 'mot_de_passe' => $mot_de_passe]);

    // Rediriger vers l'espace administrateur
    header('Location: admin.php');
    exit;
}
?>