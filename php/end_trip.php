<?php
session_start();
include __DIR__ . '/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_covoiturage = $data['id_covoiturage'];

    // Récupérer les informations du covoiturage
    $stmt = $pdo->prepare("SELECT * FROM Covoiturage WHERE id_covoiturage = :id_covoiturage");
    $stmt->execute(['id_covoiturage' => $id_covoiturage]);
    $covoiturage = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($covoiturage) {
        // Calculer la durée du trajet
        $date_depart = new DateTime($covoiturage['date_depart'] . ' ' . $covoiturage['heure_depart']);
        $date_arrivee = new DateTime($covoiturage['date_arrivee'] . ' ' . $covoiturage['heure_arrivee']);
        $duree = $date_depart->diff($date_arrivee)->format('%h heures %i minutes');

        // Insérer le trajet dans l'historique
        $stmt = $pdo->prepare("
            INSERT INTO historiquevoyages (depart, arrivee, duree, id_utilisateur, statut, avis_donné)
            VALUES (:depart, :arrivee, :duree, :id_utilisateur, 'terminé', 0)
        ");
        $stmt->execute([
            'depart' => $covoiturage['lieu_depart'],
            'arrivee' => $covoiturage['lieu_arrivee'],
            'duree' => $duree,
            'id_utilisateur' => $covoiturage['id_utilisateur']
        ]);

        // Supprimer le covoiturage de la table covoiturage
        $stmt = $pdo->prepare("DELETE FROM Covoiturage WHERE id_covoiturage = :id_covoiturage");
        $stmt->execute(['id_covoiturage' => $id_covoiturage]);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Covoiturage non trouvé.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
}