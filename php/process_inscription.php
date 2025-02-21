<?php
session_start();
include __DIR__ . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirm_password) {
        die("Erreur : Les mots de passe ne correspondent pas.");
    }

    // Vérifier si l'email est déjà utilisé
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        die("Erreur : Cet email est déjà utilisé.");
    }

    // Hacher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insérer l'utilisateur dans la base de données
    $stmt = $pdo->prepare("
        INSERT INTO Utilisateur (pseudo, email, mot_de_passe, id_role)
        VALUES (:username, :email, :password, 2) -- Assurez-vous que 2 est l'ID du rôle utilisateur
    ");
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'password' => $hashed_password
    ]);

    // Récupérer l'ID de l'utilisateur nouvellement créé
    $user_id = $pdo->lastInsertId();

    // Ajouter 20 crédits à l'utilisateur
    $stmt = $pdo->prepare("INSERT INTO Credit (id_utilisateur, solde) VALUES (?, 20)");
    $stmt->execute([$user_id]);

    // Connecter l'utilisateur
    $_SESSION['id_utilisateur'] = $user_id;

    // Rediriger vers le profil
    header('Location: profile.php');
    exit;
}
?>