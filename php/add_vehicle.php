<?php
session_start();
include __DIR__ . '/database.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modele = $_POST['modele'];
    $immatriculation = $_POST['immatriculation'];
    $energie = $_POST['energie'];
    $couleur = $_POST['couleur'];
    $date_premiere_immatriculation = $_POST['date_premiere_immatriculation'];
    $id_marque = $_POST['id_marque'];
    $id_utilisateur = $_SESSION['id_utilisateur'];

    $stmt = $pdo->prepare("
        INSERT INTO Voiture (modele, immatriculation, energie, couleur, date_premiere_immatriculation, id_marque, id_utilisateur)
        VALUES (:modele, :immatriculation, :energie, :couleur, :date_premiere_immatriculation, :id_marque, :id_utilisateur)
    ");
    $stmt->execute([
        'modele' => $modele,
        'immatriculation' => $immatriculation,
        'energie' => $energie,
        'couleur' => $couleur,
        'date_premiere_immatriculation' => $date_premiere_immatriculation,
        'id_marque' => $id_marque,
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
    <title>Ajouter un véhicule</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Ajouter un véhicule</h2>
    <form method="POST">
        <label for="modele">Modèle :</label>
        <input type="text" id="modele" name="modele" required>
        <label for="immatriculation">Immatriculation :</label>
        <input type="text" id="immatriculation" name="immatriculation" required>
        <label for="energie">Énergie :</label>
        <input type="text" id="energie" name="energie" required>
        <label for="couleur">Couleur :</label>
        <input type="text" id="couleur" name="couleur" required>
        <label for="date_premiere_immatriculation">Date de première immatriculation :</label>
        <input type="date" id="date_premiere_immatriculation" name="date_premiere_immatriculation" required>
        <label for="id_marque">Marque :</label>
        <select id="id_marque" name="id_marque" required>
            <!-- Options de marques à remplir dynamiquement -->
        </select>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>