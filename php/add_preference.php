<?php
session_start();
include __DIR__ . '/database.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fumeur = $_POST['fumeur'];
    $animaux = $_POST['animaux'];
    $trajets = $_POST['trajets'];
    $pause = $_POST['pause'];
    $id_utilisateur = $_SESSION['id_utilisateur'];

    $stmt = $pdo->prepare("
        INSERT INTO Preferences (fumeur, animaux, trajets, pause, id_utilisateur)
        VALUES (:fumeur, :animaux, :trajets, :pause, :id_utilisateur)
    ");
    $stmt->execute([
        'fumeur' => $fumeur,
        'animaux' => $animaux,
        'trajets' => $trajets,
        'pause' => $pause,
        'id_utilisateur' => $id_utilisateur
    ]);

    header('Location: profile.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des préférences</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Ajouter des préférences</h2>
    <form method="POST">
        <label for="fumeur">Fumeur :</label>
        <input type="text" id="fumeur" name="fumeur" required>
        <label for="animaux">Animaux :</label>
        <input type="text" id="animaux" name="animaux" required>
        <label for="trajets">Trajets :</label>
        <input type="text" id="trajets" name="trajets" required>
        <label for="pause">Pause :</label>
        <input type="text" id="pause" name="pause" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>