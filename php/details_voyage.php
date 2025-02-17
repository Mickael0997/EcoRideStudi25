<?php
// Connexion à la base de données
include './database.php'; // Vérifie que le chemin est correct

// Vérification et récupération de l'ID du trajet
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Trajet introuvable.");
}
$id_covoiturage = intval($_GET['id']);

// Requête pour récupérer les détails du trajet
$query = "SELECT c.*, u.pseudo, u.email, u.photo, 
                    p.fumeur, p.animaux, p.trajets, p.pause,
                    (SELECT AVG(a.note) FROM Avis a WHERE a.id_utilisateur = u.id_utilisateur) AS note_moyenne,
                    v.modele, v.couleur, v.energie, v.date_premiere_immatriculation, m.libelle AS marque
            FROM Covoiturage c
            JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur
            LEFT JOIN Preferences p ON u.id_utilisateur = p.id_utilisateur
            JOIN Voiture v ON c.id_voiture = v.id_voiture
            JOIN Marque m ON v.id_marque = m.id_marque
            WHERE c.id_covoiturage = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id_covoiturage]);
$trajet = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$trajet) {
    die("Détails du trajet non disponibles.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Trajet</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/covoiturage.css">
    <style>
        .back-link {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            text-decoration: none;
            color: #38ddcc;
        }
        .back-link svg {
            margin-right: 8px;
        }
    </style>
</head>
<body class="covoiturage-body">
<?php include 'header.php'; ?>
<div class="covoiturage-container">
    <a href="covoiturage.php" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Retour au covoiturage
    </a>
    <h1>Détails du Trajet</h1>
    <div class="covoiturage-result">
        <div class="covoiturage-result-left">
            <img src="../assets/<?= htmlspecialchars($trajet['photo']) ?>" alt="Conducteur">
        </div>
        <div class="covoiturage-result-details">
            <a href="./users_fiche.php?user=<?= htmlspecialchars($trajet['pseudo']) ?>" class="profile-link"><strong><?= htmlspecialchars($trajet['pseudo']) ?></strong></a>
            <p><strong>Départ :</strong> <?= htmlspecialchars($trajet['lieu_depart']) ?> - <?= htmlspecialchars($trajet['heure_depart']) ?></p>
            <p><strong>Arrivée :</strong> <?= htmlspecialchars($trajet['lieu_arrivee']) ?> - <?= htmlspecialchars($trajet['heure_arrivee']) ?></p>
            <p><strong>Date :</strong> <?= htmlspecialchars($trajet['date_depart']) ?></p>
            <p><strong>Durée :</strong> <?= calculateDuration($trajet['date_depart'], $trajet['heure_depart'], $trajet['date_arrivee'], $trajet['heure_arrivee']) ?></p>
            <p><strong>Note Moyenne :</strong> <?= number_format($trajet['note_moyenne'], 1) ?> ★</p>
        </div>
        <div class="covoiturage-result-price">
            <span><?= htmlspecialchars($trajet['prix_par_personne']) ?>€</span>
            <p>Places disponibles : <?= htmlspecialchars($trajet['nb_place']) ?></p>
        </div>
    </div>
    
    <h2>Préférences du Conducteur</h2>
    <div class="preferences">
        <p><strong>Fumeur :</strong> <?= htmlspecialchars($trajet['fumeur']) ?></p>
        <p><strong>Animaux :</strong> <?= htmlspecialchars($trajet['animaux']) ?></p>
        <p><strong>Type de trajet :</strong> <?= htmlspecialchars($trajet['trajets']) ?></p>
        <p><strong>Pause :</strong> <?= htmlspecialchars($trajet['pause']) ?></p>
    </div>

    <h2>Informations sur le Véhicule</h2>
    <div class="vehicle-details">
        <p><strong>Marque :</strong> <?= htmlspecialchars($trajet['marque']) ?></p>
        <p><strong>Modèle :</strong> <?= htmlspecialchars($trajet['modele']) ?></p>
        <p><strong>Couleur :</strong> <?= htmlspecialchars($trajet['couleur']) ?></p>
        <p><strong>Énergie :</strong> <?= htmlspecialchars($trajet['energie']) ?></p>
        <p><strong>Date de première immatriculation :</strong> <?= htmlspecialchars($trajet['date_premiere_immatriculation']) ?></p>
    </div>
    
    <a href="mailto:<?= htmlspecialchars($trajet['email']) ?>" class="contact-button">Contacter par Email</a>
</div>
</body>
</html>

<?php
function calculateDuration($dateDepart, $heureDepart, $dateArrivee, $heureArrivee) {
    if (!$dateDepart || !$heureDepart || !$dateArrivee || !$heureArrivee) {
        return 'Inconnu';
    }
    $depart = new DateTime("$dateDepart $heureDepart");
    $arrivee = new DateTime("$dateArrivee $heureArrivee");
    if ($arrivee < $depart) {
        return 'Incohérent';
    }
    $diff = $depart->diff($arrivee);
    return $diff->format('%h heures %i minutes');
}
?>