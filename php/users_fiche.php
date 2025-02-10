<?php
include 'database.php'; // Connexion à la base de données

// Récupérer l'utilisateur à partir du paramètre GET
$pseudo = isset($_GET['user']) ? $_GET['user'] : '';

if ($pseudo) {
    // Récupérer les informations de l'utilisateur
    $stmt = $pdo->prepare("SELECT u.*, r.libelle AS role, m.libelle AS marque, v.modele, v.couleur, v.energie, v.date_premiere_immatriculation,
                                (SELECT AVG(a.note) FROM AvisClients a WHERE a.id_utilisateur = u.id_utilisateur) AS note_moyenne
                            FROM Utilisateur u
                            JOIN Role r ON u.id_role = r.id_role
                            LEFT JOIN Voiture v ON u.id_utilisateur = v.id_utilisateur
                            LEFT JOIN Marque m ON v.id_marque = m.id_marque
                            WHERE u.pseudo = :pseudo");
    $stmt->execute(['pseudo' => $pseudo]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer les préférences de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM Preferences WHERE id_utilisateur = :id_utilisateur");
    $stmt->execute(['id_utilisateur' => $utilisateur['id_utilisateur']]);
    $preferences = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer les voyages de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM Voyages WHERE id_utilisateur = :id_utilisateur");
    $stmt->execute(['id_utilisateur' => $utilisateur['id_utilisateur']]);
    $voyages = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer l'historique des voyages de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM HistoriqueVoyages WHERE id_utilisateur = :id_utilisateur");
    $stmt->execute(['id_utilisateur' => $utilisateur['id_utilisateur']]);
    $historique = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les avis des clients sur l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM AvisClients WHERE id_utilisateur = :id_utilisateur");
    $stmt->execute(['id_utilisateur' => $utilisateur['id_utilisateur']]);
    $avis_clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Utilisateur</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/users.css">
</head>
<body>
    <?php include './header.php';?>
<?php if ($utilisateur): ?>
    <div class="container">
        <div class="header">
            <img src="../assets/un.png" alt="Photo de profil" class="profile-pic">
            <h1><?= htmlspecialchars($utilisateur["pseudo"]) ?> est <?= htmlspecialchars($utilisateur["role"]) ?></h1>
            <div class="rating">
                <?php if (isset($utilisateur["note_moyenne"])): ?>
                    <?php for ($i = 0; $i < round($utilisateur["note_moyenne"]); $i++) { ?>
                        <span class="star">&#9733;</span>
                    <?php } ?>
                <?php endif; ?>
                <p><?= isset($utilisateur["note_moyenne"]) ? round($utilisateur["note_moyenne"], 1) : '0' ?> / 5</p>
            </div>
        </div>

        <div class="vehicle-info">
            <h2>Détails du véhicule</h2>
            <p>Marque : <?= htmlspecialchars($utilisateur["marque"]) ?></p>
            <p>Modèle : <?= htmlspecialchars($utilisateur["modele"]) ?></p>
            <p>Couleur : <?= htmlspecialchars($utilisateur["couleur"]) ?></p>
            <p>Énergie : <?= htmlspecialchars($utilisateur["energie"]) ?></p>
            <p>Date de première immatriculation : <?= htmlspecialchars($utilisateur["date_premiere_immatriculation"]) ?></p>
        </div>

        <div class="preferences">
            <h2>Préférences</h2>
            <p>Fumeur : <?= isset($preferences["fumeur"]) ? htmlspecialchars($preferences["fumeur"]) : 'Non spécifié' ?></p>
            <p>Animaux : <?= isset($preferences["animaux"]) ? htmlspecialchars($preferences["animaux"]) : 'Non spécifié' ?></p>
            <p>Trajets : <?= isset($preferences["trajets"]) ? htmlspecialchars($preferences["trajets"]) : 'Non spécifié' ?></p>
            <p>Pause : <?= isset($preferences["pause"]) ? htmlspecialchars($preferences["pause"]) : 'Non spécifié' ?></p>
        </div>

        <div class="voyages">
            <h2>Voyages</h2>
            <p>Nombre : <?= isset($voyages["nombre"]) ? htmlspecialchars($voyages["nombre"]) : '0' ?></p>
            <p>Kilomètres : <?= isset($voyages["kilometres"]) ? htmlspecialchars($voyages["kilometres"]) : '0' ?> km</p>
        </div>

        <div class="historique">
            <h2>Historique Voyages</h2>
            <ul>
                <?php if (isset($historique) && is_array($historique)): ?>
                    <?php foreach ($historique as $trajet) { ?>
                        <li><?= htmlspecialchars($trajet["depart"]) ?> -> <?= htmlspecialchars($trajet["arrivee"]) ?> : <?= htmlspecialchars($trajet["duree"]) ?></li>
                    <?php } ?>
                <?php else: ?>
                    <li>Aucun historique disponible.</li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="avis">
            <h2>Avis clients</h2>
            <?php if (isset($avis_clients) && is_array($avis_clients)): ?>
                <?php foreach ($avis_clients as $avis) { ?>
                    <div class="avis-client">
                        <h3><?= htmlspecialchars($avis["nom"]) ?></h3>
                        <p>Note : 
                            <?php for ($i = 0; $i < $avis["note"]; $i++) { ?>
                                <span class="star">&#9733;</span>
                            <?php } ?>
                        </p>
                        <p><?= htmlspecialchars($avis["commentaire"]) ?></p>
                    </div>
                <?php } ?>
            <?php else: ?>
                <p>Aucun avis disponible.</p>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <p>Utilisateur non trouvé.</p>
<?php endif; ?>

<?php include './footer.php'; ?>
</body>
</html>