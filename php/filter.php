<?php
include 'database.php'; // Assurez-vous que le chemin est correct

$depart = isset($_POST['depart']) ? $_POST['depart'] : '';
$destination = isset($_POST['destination']) ? $_POST['destination'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$passagers = isset($_POST['passagers']) ? intval($_POST['passagers']) : 1;
$tri = isset($_POST['tri']) ? (array)$_POST['tri'] : [];

$now_date = date("Y-m-d");
$now_time = date("H:i:s");

$query = "SELECT c.*, u.pseudo, u.photo, v.modele 
            FROM Covoiturage c
            JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur
            JOIN Voiture v ON c.id_voiture = v.id_voiture
            WHERE c.nb_place >= :passagers";

$params = [':passagers' => $passagers];

if (!empty($depart)) {
    $query .= " AND c.lieu_depart = :lieu_depart";
    $params[':lieu_depart'] = $depart;
}
if (!empty($destination)) {
    $query .= " AND c.lieu_arrivee = :lieu_arrivee";
    $params[':lieu_arrivee'] = $destination;
}
if (!empty($date)) {
    $query .= " AND c.date_depart = :date_depart";
    $params[':date_depart'] = $date;
} else {
    $query .= " AND (c.date_depart > :now_date OR (c.date_depart = :now_date AND c.heure_depart >= :now_time))";
    $params[':now_date'] = $now_date;
    $params[':now_time'] = $now_time;
}

if (in_array('prix', $tri)) {
    $query .= " ORDER BY c.prix_par_personne ASC";
} elseif (in_array('heure', $tri)) {
    $query .= " ORDER BY c.date_depart ASC, c.heure_depart ASC";
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);

$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($trajets);
?>