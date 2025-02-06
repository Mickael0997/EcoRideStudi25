<?php
// Connexion à la base de données
include './database.php'; // Assurez-vous que le chemin est correct

// Récupérer l'ID du trajet depuis l'URL
$idTrajet = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Requête pour récupérer les détails du trajet
$query = "SELECT c.*, u.pseudo, u.email, 
                    m.libelle AS marque, v.modele, v.couleur, v.energie, v.date_premiere_immatriculation, 
                    (SELECT AVG(a.note) FROM Avis a WHERE a.id_utilisateur = u.id_utilisateur) AS note_moyenne,
                    (SELECT GROUP_CONCAT(CONCAT('Fumeur: ', p.fumeur, ', Animaux: ', p.animaux, ', Trajets: ', p.trajets, ', Pause: ', p.pause) SEPARATOR ', ') FROM Preferences p WHERE p.id_utilisateur = u.id_utilisateur) AS preferences
            FROM Covoiturage c
            JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur
            JOIN Voiture v ON c.id_voiture = v.id_voiture
            JOIN Marque m ON v.id_marque = m.id_marque
            WHERE c.id_covoiturage = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $idTrajet]);
$trajet = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$trajet) {
    echo "Trajet non trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Voyage</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/details_voyage.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
    <h1>Détails du Voyage</h1>
    <div class="voyage-details">
        <h2>Informations du Voyage</h2>
        <p><strong>Départ :</strong> <?= htmlspecialchars($trajet['lieu_depart']) ?> à <?= htmlspecialchars($trajet['heure_depart']) ?> le <?= htmlspecialchars($trajet['date_depart']) ?></p>
        <p><strong>Arrivée :</strong> <?= htmlspecialchars($trajet['lieu_arrivee']) ?> à <?= htmlspecialchars($trajet['heure_arrivee']) ?> le <?= htmlspecialchars($trajet['date_arrivee']) ?></p>
        <p><strong>Durée :</strong> <?= calculateDuration($trajet['date_depart'], $trajet['heure_depart'], $trajet['date_arrivee'], $trajet['heure_arrivee']) ?></p>
        <p><strong>Prix par personne :</strong> <?= htmlspecialchars($trajet['prix_par_personne']) ?>€</p>
        <p><strong>Places disponibles :</strong> <?= htmlspecialchars($trajet['nb_place']) ?></p>
    </div>

    <div class="user-details">
        <h2>Informations sur l'Utilisateur</h2>
        <p><strong>Pseudo :</strong> <?= htmlspecialchars($trajet['pseudo']) ?></p>
        <p><strong>Préférences :</strong> <?= htmlspecialchars($trajet['preferences']) ?></p>
    </div>

    <div class="vehicle-details">
        <h2>Informations sur le Véhicule</h2>
        <p><strong>Marque :</strong> <?= htmlspecialchars($trajet['marque']) ?></p>
        <p><strong>Modèle :</strong> <?= htmlspecialchars($trajet['modele']) ?></p>
        <p><strong>Couleur :</strong> <?= htmlspecialchars($trajet['couleur']) ?></p>
        <p><strong>Énergie :</strong> <?= htmlspecialchars($trajet['energie']) ?></p>
        <p><strong>Date de première immatriculation :</strong> <?= htmlspecialchars($trajet['date_premiere_immatriculation']) ?></p>
    </div>

    <button onclick="window.location.href='mailto:<?= htmlspecialchars($trajet['email']) ?>'">Envoyer un mail</button>
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