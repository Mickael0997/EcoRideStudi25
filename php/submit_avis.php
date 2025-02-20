<?php
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id_utilisateur'])) {
    $id_historique = intval($_POST['id_historique']);
    $commentaire = trim($_POST['commentaire']);
    $note = intval($_POST['note']);
    $id_utilisateur = $_SESSION['id_utilisateur'];

    if ($id_historique > 0 && $note >= 1 && $note <= 5) {
        $stmt = $pdo->prepare("UPDATE historiquevoyages SET avis_donné = 1 WHERE id_historique = :id_historique AND id_utilisateur = :id_utilisateur");
        $stmt->execute(['id_historique' => $id_historique, 'id_utilisateur' => $id_utilisateur]);

        $stmtAvis = $pdo->prepare("INSERT INTO avis (commentaire, note, id_utilisateur, id_historique) VALUES (:commentaire, :note, :id_utilisateur, :id_historique)");
        $stmtAvis->execute([
            'commentaire' => $commentaire,
            'note' => $note,
            'id_utilisateur' => $id_utilisateur,
            'id_historique' => $id_historique
        ]);

        echo "Avis enregistré avec succès.";
    } else {
        echo "Données invalides.";
    }
} else {
    echo "Accès interdit.";
}
?>
