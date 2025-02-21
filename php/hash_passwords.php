<?php
include __DIR__ . '/database.php';

// Récupérer tous les utilisateurs
$stmt = $pdo->query("SELECT id_utilisateur, mot_de_passe FROM Utilisateur");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($utilisateurs as $utilisateur) {
    $id_utilisateur = $utilisateur['id_utilisateur'];
    $mot_de_passe = $utilisateur['mot_de_passe'];

    // Vérifiez si le mot de passe est déjà haché
    if (!password_get_info($mot_de_passe)['algo']) {
        // Hacher le mot de passe
        $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe haché dans la base de données
        $stmt = $pdo->prepare("UPDATE Utilisateur SET mot_de_passe = :mot_de_passe WHERE id_utilisateur = :id_utilisateur");
        $stmt->execute(['mot_de_passe' => $mot_de_passe_hache, 'id_utilisateur' => $id_utilisateur]);
    }
}

echo "Les mots de passe ont été hachés et mis à jour avec succès.";
?>