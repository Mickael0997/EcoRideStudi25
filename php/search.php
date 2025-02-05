<?php
include 'database.php'; // Assurez-vous que le chemin est correct

$lieu_depart = isset($_POST['lieu_depart']) ? $_POST['lieu_depart'] : '';
$lieu_arrivee = isset($_POST['lieu_arrivee']) ? $_POST['lieu_arrivee'] : '';
$date_depart = isset($_POST['date_depart']) ? $_POST['date_depart'] : date("Y-m-d");
$tri = isset($_POST['tri']) ? $_POST['tri'] : 'heure';
$show_all = isset($_POST['show_all']) ? $_POST['show_all'] : false;

$query = "SELECT c.*, u.nom, u.prenom, u.photo, c.nb_place, v.modele 
            FROM Covoiturage c
            JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur
            JOIN Voiture v ON c.id_voiture = v.id_voiture
            WHERE c.date_depart >= :date_depart";

$params = [':date_depart' => $date_depart];

if ($show_all) {
    if (!empty($lieu_depart)) {
        $query .= " AND c.lieu_depart = :lieu_depart";
        $params[':lieu_depart'] = $lieu_depart;
    }
    if (!empty($lieu_arrivee)) {
        $query .= " OR c.lieu_arrivee = :lieu_arrivee";
        $params[':lieu_arrivee'] = $lieu_arrivee;
    }
} else {
    if (!empty($lieu_depart)) {
        $query .= " AND c.lieu_depart = :lieu_depart";
        $params[':lieu_depart'] = $lieu_depart;
    }
    if (!empty($lieu_arrivee)) {
        $query .= " AND c.lieu_arrivee = :lieu_arrivee";
        $params[':lieu_arrivee'] = $lieu_arrivee;
    }
    if (!empty($date_depart)) {
        $query .= " AND c.date_depart = :date_depart";
        $params[':date_depart'] = $date_depart;
    }
}

if ($tri == 'prix') {
    $query .= " ORDER BY c.prix_par_personne ASC";
} else {
    $query .= " ORDER BY c.heure_depart ASC";
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);

$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($trajets);
?>