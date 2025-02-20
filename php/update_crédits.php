<?php

session_start();
include __DIR__ . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_utilisateur = $_POST['id_utilisateur'];
    $credits = $_POST['credits'];

    // Vérifier que l'utilisateur a suffisamment de crédits
    $stmt = $pdo->prepare("SELECT solde FROM Credit WHERE id_utilisateur = :id_utilisateur");
    $stmt->execute(['id_utilisateur' => $id_utilisateur]);
    $solde = $stmt->fetchColumn();

    if ($solde >= $credits) {
        // Mettre à jour le solde de crédits
        $stmt = $pdo->prepare("UPDATE Credit SET solde = solde - :credits WHERE id_utilisateur = :id_utilisateur");
        $stmt->execute(['credits' => $credits, 'id_utilisateur' => $id_utilisateur]);

        echo "Crédits mis à jour avec succès.";
    } else {
        echo "Solde de crédits insuffisant.";
    }
}
?>