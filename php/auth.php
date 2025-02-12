<?php
session_start();
include __DIR__ . '/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifiez les informations de connexion
    $stmt = $pdo->prepare("
        SELECT u.id_utilisateur, u.mot_de_passe, r.libelle AS role 
        FROM Utilisateur u
        JOIN role r ON u.id_role = r.id_role
        WHERE u.email = :email
    ");
    $stmt->execute(['email' => $email]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur && $password === $utilisateur['mot_de_passe']) {
        // Connexion réussie
        $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
        $_SESSION['role'] = $utilisateur['role'];
        header('Location: profile.php');
        exit;
    } else {
        $error = 'Email ou mot de passe incorrect';
        $_SESSION['error'] = $error;
        header('Location: ../index.php');
        exit;
    }
}
?>