<?php
include './database.php';

$date = isset($_GET['date']) ? $_GET['date'] : '';

$query = "SELECT c.*, u.nom, u.prenom, u.photo, u.pseudo, c.nb_place, v.modele 
            FROM Covoiturage c
            JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur
            JOIN Voiture v ON c.id_voiture = v.id_voiture
            WHERE 1=1";

$params = [];

if (!empty($date)) {
    $query .= " AND c.date_depart = :date_depart";
    $params[':date_depart'] = $date;
}

$query .= " ORDER BY c.heure_depart ASC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
?>