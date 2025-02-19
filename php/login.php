<?php
session_start();
include __DIR__ . './database.php'; // Utilisez __DIR__ pour obtenir le chemin absolu

// Vérifiez si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requête pour vérifier les informations d'identification de l'utilisateur
    $stmt = $pdo->prepare("SELECT id_utilisateur, pseudo, mot_de_passe FROM Utilisateur WHERE pseudo = :pseudo");
    $stmt->execute(['pseudo' => $username]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur && password_verify($password, $utilisateur['mot_de_passe'])) {
        // Les informations d'identification sont correctes, démarrez la session
        $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
        $_SESSION['pseudo'] = $utilisateur['pseudo'];

        // Redirigez l'utilisateur vers la page actuelle
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // Les informations d'identification sont incorrectes, définissez un message d'erreur
        $_SESSION['error'] = 'Nom d\'utilisateur ou mot de passe incorrect';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>