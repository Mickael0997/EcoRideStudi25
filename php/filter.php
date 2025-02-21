<?php
include 'database.php'; // Assurez-vous que le chemin est correct

$depart = isset($_POST['depart']) ? trim($_POST['depart']) : '';
$destination = isset($_POST['destination']) ? trim($_POST['destination']) : '';
$date = isset($_POST['date']) ? trim($_POST['date']) : '';
$passagers = isset($_POST['passagers']) ? intval($_POST['passagers']) : 1;
$tri = isset($_POST['tri']) ? (array)$_POST['tri'] : [];
$ecologique = isset($_POST['ecologique']) ? true : false;
$prix_max = isset($_POST['prix_max']) ? floatval($_POST['prix_max']) : '';
$duree_max = isset($_POST['duree_max']) ? intval($_POST['duree_max']) : '';
$note_min = isset($_POST['note_min']) ? intval($_POST['note_min']) : '';

$now_date = date("Y-m-d");
$now_time = date("H:i:s");

$query = "SELECT c.*, u.pseudo, u.photo, AVG(a.note) as note_moyenne, v.modele, v.energie 
            FROM Covoiturage c
            JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur
            JOIN Voiture v ON c.id_voiture = v.id_voiture
            LEFT JOIN Avis a ON u.id_utilisateur = a.id_utilisateur
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

// Filtrer les véhicules écologiques
if ($ecologique) {
    $query .= " AND (v.energie = 'électrique' OR v.energie = 'hybride')";
}

// Filtrer par prix maximum
if (!empty($prix_max)) {
    $query .= " AND c.prix_par_personne <= :prix_max";
    $params[':prix_max'] = $prix_max;
}

// Filtrer par durée maximale
if (!empty($duree_max)) {
    $query .= " AND TIMESTAMPDIFF(MINUTE, CONCAT(c.date_depart, ' ', c.heure_depart), CONCAT(c.date_arrivee, ' ', c.heure_arrivee)) <= :duree_max";
    $params[':duree_max'] = $duree_max;
}

// Ajout du GROUP BY avant le HAVING
$query .= " GROUP BY c.id_covoiturage";

// Filtrer par note minimale
if (!empty($note_min)) {
    $query .= " HAVING note_moyenne >= :note_min";
    $params[':note_min'] = $note_min;
}

// Gestion du tri des résultats
$orderBy = [];
if (in_array('prix', $tri)) {
    $orderBy[] = "c.prix_par_personne ASC";
}
if (in_array('heure', $tri)) {
    $orderBy[] = "c.date_depart ASC, c.heure_depart ASC";
}
if (!empty($orderBy)) {
    $query .= " ORDER BY " . implode(', ', $orderBy);
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);

$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($trajets);
?>