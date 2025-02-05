<?php
include 'database.php'; // Assurez-vous que le chemin est correct

$filter = isset($_POST['filter']) ? $_POST['filter'] : 'heure';
$date_depart = isset($_POST['date_depart']) ? $_POST['date_depart'] : date("Y-m-d");

$query = "SELECT c.*, u.nom, u.prenom, u.photo, v.modele 
            FROM Covoiturage c
            JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur
            JOIN Voiture v ON c.id_voiture = v.id_voiture
            WHERE c.date_depart = :date_depart";

if ($filter == 'prix') {
    $query .= " ORDER BY c.prix_par_personne ASC";
} else {
    $query .= " ORDER BY c.heure_depart ASC";
}

$stmt = $pdo->prepare($query);
$stmt->execute([':date_depart' => $date_depart]);

$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($trajets);
?>