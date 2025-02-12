<?php
session_start();
include __DIR__ . '/database.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: ../index.php'); // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté
    exit;
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Récupérez les informations de l'utilisateur connecté
$stmt = $pdo->prepare("
    SELECT u.pseudo, u.photo, u.email, u.nom, u.prenom, u.telephone, u.adresse, u.date_naissance, r.libelle AS role 
    FROM Utilisateur u
    JOIN role r ON u.id_role = r.id_role
    WHERE u.id_utilisateur = :id_utilisateur
");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$utilisateur) {
    echo "Utilisateur non trouvé.";
    exit;
}

$pseudo = htmlspecialchars($utilisateur['pseudo']);
$email = htmlspecialchars($utilisateur['email']);
$nom = htmlspecialchars($utilisateur['nom']);
$prenom = htmlspecialchars($utilisateur['prenom']);
$telephone = htmlspecialchars($utilisateur['telephone']);
$adresse = htmlspecialchars($utilisateur['adresse']);
$date_naissance = htmlspecialchars($utilisateur['date_naissance']);
$role = htmlspecialchars($utilisateur['role']);
$photo = $utilisateur['photo'] ? '../assets/un.png,' . base64_encode($utilisateur['photo']) : '../assets/user icon.jpg';

// Récupérer les avis concernant l'utilisateur
$stmt = $pdo->prepare("
    SELECT a.commentaire, a.note, a.statut 
    FROM avis a
    WHERE a.id_utilisateur = :id_utilisateur
");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer l'historique des voyages de l'utilisateur
$stmt = $pdo->prepare("
    SELECT h.depart, h.arrivee, h.duree 
    FROM historiquevoyages h
    WHERE h.id_utilisateur = :id_utilisateur
");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$historique = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - EcoRide</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <div class="profile-container">
        <h2>Profil de <?= $pseudo ?></h2>
        <img src="<?= $photo ?>" alt="Photo de profil">
        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?= $nom ?>" required>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?= $prenom ?>" required>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?= $email ?>" required>
            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" value="<?= $telephone ?>">
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?= $adresse ?>">
            <label for="date_naissance">Date de naissance :</label>
            <input type="date" id="date_naissance" name="date_naissance" value="<?= $date_naissance ?>">
            <label for="photo">Photo :</label>
            <input type="file" id="photo" name="photo">
            <button type="submit">Mettre à jour</button>
        </form>

        <h3>Véhicules</h3>
        <a href="add_vehicle.php">Ajouter un véhicule</a>
        <!-- Liste des véhicules de l'utilisateur -->

        <h3>Préférences</h3>
        <a href="add_preference.php">Ajouter des préférences</a>
        <!-- Liste des préférences de l'utilisateur -->

        <h3>Rôles</h3>
        <a href="add_role.php">Ajouter un rôle</a>
        <!-- Liste des rôles de l'utilisateur -->

        <h3>Trajets</h3>
        <a href="add_trip.php">Ajouter un trajet</a>
        <!-- Liste des trajets de l'utilisateur -->

        <h3>Avis</h3>
        <?php foreach ($avis as $a): ?>
            <p>Commentaire : <?= htmlspecialchars($a['commentaire']) ?></p>
            <p>Note : <?= htmlspecialchars($a['note']) ?></p>
            <p>Statut : <?= htmlspecialchars($a['statut']) ?></p>
        <?php endforeach; ?>

        <h3>Historique des voyages</h3>
        <?php foreach ($historique as $h): ?>
            <p>Départ : <?= htmlspecialchars($h['depart']) ?></p>
            <p>Arrivée : <?= htmlspecialchars($h['arrivee']) ?></p>
            <p>Durée : <?= htmlspecialchars($h['duree']) ?></p>
        <?php endforeach; ?>

        <a href="delete_account.php">Supprimer mon compte</a>
    </div>
</body>
</html>