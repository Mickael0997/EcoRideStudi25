<?php
session_start();
include __DIR__ . '/database.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $libelle = $_POST['libelle'];

    $stmt = $pdo->prepare("
        INSERT INTO Role (libelle)
        VALUES (:libelle)
    ");
    $stmt->execute(['libelle' => $libelle]);

    header('Location: profile.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un rôle</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Ajouter un rôle</h2>
    <form method="POST">
        <label for="libelle">Libellé :</label>
        <input type="text" id="libelle" name="libelle" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>