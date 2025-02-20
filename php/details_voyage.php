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

$id_conducteur = $trajet['id_utilisateur']; // Récupération de l'ID du conducteur

// Requête pour récupérer les avis du conducteur
$queryAvis = "SELECT a.commentaire, a.note, u.pseudo AS auteur 
            FROM Avis a
            JOIN Utilisateur u ON a.id_auteur = u.id_utilisateur
            WHERE a.id_utilisateur = ?";
$stmtAvis = $pdo->prepare($queryAvis);
$stmtAvis->execute([$id_conducteur]);
$avis = $stmtAvis->fetchAll(PDO::FETCH_ASSOC);
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
            color: #1b5e20;
        }
        .back-link svg {
            margin-right: 8px;
        }
        .avis {
            margin-top: 20px;
        }
        .avis-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .avis-item:last-child {
            border-bottom: none;
        }
        .modal {
            display: none;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-oui, .btn-non {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-oui {
            background-color: #38ddcc;
            color: #fff;
        }
        .btn-non {
            background-color: #f44336;
            color: #fff;
        }
        .btn-oui:hover {
            background-color: #32c7b5;
        }
        .btn-non:hover {
            background-color: #d32f2f;
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
            <?php if ($trajet['nb_place'] > 0): ?>
                <button onclick="openModal()">Participer</button>
            <?php endif; ?>
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
    
    <h2>Avis sur le conducteur</h2>
    <div class="avis">
        <?php if (empty($avis)): ?>
            <p>Aucun avis disponible.</p>
        <?php else: ?>
            <?php foreach ($avis as $a): ?>
                <div class="avis-item">
                    <p><strong><?= htmlspecialchars($a['auteur']) ?></strong> - <?= htmlspecialchars($a['note']) ?> ★</p>
                    <p><?= htmlspecialchars($a['commentaire']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <a href="mailto:<?= htmlspecialchars($trajet['email']) ?>" class="contact-button">Contacter par Email</a>
</div>

<!-- Fenêtre modale pour la confirmation -->
<div id="confirmation-modal" class="modal">
    <div class="modal-content">
        <p>Êtes-vous sûr de vouloir utiliser 1 crédit pour participer à ce covoiturage ?</p>
        <form method="post" action="participer.php">
            <input type="hidden" name="id_covoiturage" value="<?= htmlspecialchars($id_covoiturage) ?>">
            <input type="hidden" name="confirm" value="1">
            <button type="submit" class="btn-oui">Oui</button>
            <button type="button" class="btn-non" onclick="closeModal()">Non</button>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('confirmation-modal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('confirmation-modal').style.display = 'none';
    }
</script>
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