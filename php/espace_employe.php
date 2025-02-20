<?php
session_start();
include __DIR__ . '/database.php';

// Vérifiez si l'utilisateur est connecté et est un employé
if (!isset($_SESSION['id_employe']) || $_SESSION['role'] !== 'employe') {
    header('Location: ../index.php'); // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté ou n'est pas un employé
    exit;
}

$id_employe = $_SESSION['id_employe'];

// Récupérer le pseudo de l'employé connecté
$stmt = $pdo->prepare("SELECT pseudo FROM employe WHERE id_employe = :id_employe");
$stmt->execute(['id_employe' => $id_employe]);
$employe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employe) {
    // Si l'employé n'est pas trouvé, rediriger vers une page d'erreur ou afficher un message
    echo "Erreur : Employé non trouvé.";
    exit;
}

// Récupérer les avis en attente de validation
$stmt = $pdo->prepare("
    SELECT a.id_avis, a.commentaire, a.note, a.statut, u.pseudo AS chauffeur, u.email AS chauffeur_email
    FROM avis a
    JOIN utilisateur u ON a.id_utilisateur = u.id_utilisateur
    WHERE a.statut = 'en attente'
");
$stmt->execute();
$avis_en_attente = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les covoiturages qui se sont mal passés
$stmt = $pdo->prepare("
    SELECT c.id_covoiturage, u1.pseudo AS chauffeur, u1.email AS chauffeur_email, u2.pseudo AS passager, u2.email AS passager_email, c.date_depart, c.heure_depart, c.lieu_depart, c.date_arrivee, c.heure_arrivee, c.lieu_arrivee
    FROM covoiturage c
    JOIN utilisateur u1 ON c.id_utilisateur = u1.id_utilisateur
    JOIN avis a ON c.id_covoiturage = a.id_covoiturage
    JOIN utilisateur u2 ON a.id_utilisateur = u2.id_utilisateur
    WHERE a.note <= 2
");
$stmt->execute();
$covoiturages_mal_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Employe - EcoRide</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/employe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Bienvenue, <?= htmlspecialchars($employe['pseudo']) ?></h1>
            <nav>
                <ul>
                    <li><a href="espace_employe.php">Accueil</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <h1>Espace Employé</h1>

    <h2>Valider ou Refuser les Avis</h2>
    <div class="avis-en-attente">
        <?php foreach ($avis_en_attente as $avis): ?>
            <div class="avis">
                <p>Commentaire : <?= htmlspecialchars($avis['commentaire']) ?></p>
                <p>Note : <?= htmlspecialchars($avis['note']) ?></p>
                <p>Chauffeur : <?= htmlspecialchars($avis['chauffeur']) ?> (<?= htmlspecialchars($avis['chauffeur_email']) ?>)</p>
                <button onclick="validerAvis(<?= $avis['id_avis'] ?>)">Valider</button>
                <button onclick="refuserAvis(<?= $avis['id_avis'] ?>)">Refuser</button>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Covoiturages qui se sont mal passés</h2>
    <div class="covoiturages-mal-passes">
        <?php foreach ($covoiturages_mal_passes as $covoiturage): ?>
            <div class="covoiturage">
                <p>Numéro de covoiturage : <?= htmlspecialchars($covoiturage['id_covoiturage']) ?></p>
                <p>Chauffeur : <?= htmlspecialchars($covoiturage['chauffeur']) ?> (<?= htmlspecialchars($covoiturage['chauffeur_email']) ?>)</p>
                <p>Passager : <?= htmlspecialchars($covoiturage['passager']) ?> (<?= htmlspecialchars($covoiturage['passager_email']) ?>)</p>
                <p>Date de départ : <?= htmlspecialchars($covoiturage['date_depart']) ?> à <?= htmlspecialchars($covoiturage['heure_depart']) ?> de <?= htmlspecialchars($covoiturage['lieu_depart']) ?></p>
                <p>Date d'arrivée : <?= htmlspecialchars($covoiturage['date_arrivee']) ?> à <?= htmlspecialchars($covoiturage['heure_arrivee']) ?> à <?= htmlspecialchars($covoiturage['lieu_arrivee']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function validerAvis(id_avis) {
            fetch('valider_avis.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id_avis: id_avis })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Avis validé avec succès.');
                    window.location.reload();
                } else {
                    alert('Erreur lors de la validation de l\'avis.');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de la validation de l\'avis.');
            });
        }

        function refuserAvis(id_avis) {
            fetch('refuser_avis.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id_avis: id_avis })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Avis refusé avec succès.');
                    window.location.reload();
                } else {
                    alert('Erreur lors du refus de l\'avis.');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors du refus de l\'avis.');
            });
        }
    </script>
</body>
</html>