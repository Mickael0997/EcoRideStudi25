<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'database.php'; // Connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    echo "<p>Veuillez vous connecter pour voir votre historique de voyages.</p>";
    exit;
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Récupérer l'historique des voyages de l'utilisateur
$stmt = $pdo->prepare("
    SELECT h.id_historique, h.depart, h.arrivee, h.duree, h.statut, h.avis_donné
    FROM historiquevoyages h
    WHERE h.id_utilisateur = :id_utilisateur
");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$historique = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="historique-container">
    <?php if (empty($historique)): ?>
        <p>Aucun historique de voyage disponible.</p>
    <?php else: ?>
        <?php foreach ($historique as $h): ?>
            <div class="historique-item">
                <p><strong>Départ :</strong> <?= htmlspecialchars($h['depart']) ?></p>
                <p><strong>Arrivée :</strong> <?= htmlspecialchars($h['arrivee']) ?></p>
                <p><strong>Durée :</strong> <?= htmlspecialchars($h['duree']) ?></p>
                <p><strong>Statut :</strong> <?= htmlspecialchars($h['statut']) ?></p>
                
                <?php if ($h['statut'] == 'terminé' && !$h['avis_donné']): ?>
                    <button onclick='openAvisModal(<?= json_encode($h, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>Donner un avis</button>
                <?php elseif ($h['avis_donné']): ?>
                    <p><strong>Avis :</strong> Déjà donné</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>