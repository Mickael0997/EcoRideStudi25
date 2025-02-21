<?php
// Récupérer les avis concernant l'utilisateur
$stmt = $pdo->prepare("
    SELECT a.commentaire, a.note, a.statut, u.pseudo AS auteur
    FROM avis a
    JOIN utilisateur u ON a.id_auteur = u.id_utilisateur
    WHERE a.id_utilisateur = :id_utilisateur
");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$avis_pour_utilisateur = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les avis laissés par l'utilisateur
$stmt = $pdo->prepare("
    SELECT a.commentaire, a.note, a.statut, u.pseudo AS cible
    FROM avis a
    JOIN utilisateur u ON a.id_utilisateur = u.id_utilisateur
    WHERE a.id_auteur = :id_utilisateur
");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$avis_par_utilisateur = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculer la note globale de l'utilisateur
$stmt = $pdo->prepare("
    SELECT AVG(a.note) AS note_globale
    FROM avis a
    WHERE a.id_utilisateur = :id_utilisateur
");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$note_globale = $stmt->fetchColumn();
?>

<div class="avis-container">
    <h4>Les avis laissés sur vous</h4>
    <?php foreach ($avis_pour_utilisateur as $avis): ?>
        <p>Auteur : <?= htmlspecialchars($avis['auteur']) ?></p>
        <p>Commentaire : <?= htmlspecialchars($avis['commentaire']) ?></p>
        <p>Note : <?= htmlspecialchars($avis['note']) ?> étoiles</p>
        <p>Statut : <?= htmlspecialchars($avis['statut']) ?></p>
    <?php endforeach; ?>

    <h4>Les avis que vous avez laissés</h4>
    <?php foreach ($avis_par_utilisateur as $avis): ?>
        <p>Cible : <?= htmlspecialchars($avis['cible']) ?></p>
        <p>Commentaire : <?= htmlspecialchars($avis['commentaire']) ?></p>
        <p>Note : <?= htmlspecialchars($avis['note']) ?> étoiles</p>
        <p>Statut : <?= htmlspecialchars($avis['statut']) ?></p>
    <?php endforeach; ?>
</div>