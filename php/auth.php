<?php
session_start();
include __DIR__ . '/database.php';

$error = '';
$redirectTo = isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : null;
unset($_SESSION['redirect_to']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = $_POST['identifier']; // Peut être un email ou un pseudo
    $password = $_POST['password'];

    // Requête pour vérifier les informations d'identification de l'utilisateur
    $stmt = $pdo->prepare("SELECT id_utilisateur, pseudo, mot_de_passe FROM Utilisateur WHERE pseudo = :identifier OR email = :identifier");
    $stmt->execute(['identifier' => $identifier]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur && $password === $utilisateur['mot_de_passe']) {
        // Les informations d'identification sont correctes, démarrez la session
        $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
        $_SESSION['pseudo'] = $utilisateur['pseudo'];

        // Redirigez l'utilisateur vers la page appropriée
        if ($redirectTo) {
            header("Location: $redirectTo");
        } else {
            header('Location: profile.php');
        }
        exit;
    } else {
        // Les informations d'identification sont incorrectes, définissez un message d'erreur
        $_SESSION['error'] = 'Identifiant ou mot de passe incorrect';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>