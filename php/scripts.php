<?php
include 'database.php'; // Assurez-vous que le chemin est correct

// Données fictives pour les trajets
$villes = ['Lille', 'Paris', 'Marseille', 'Lyon', 'Toulouse', 'Nice', 'Nantes', 'Strasbourg', 'Bordeaux', 'Montpellier', 'Orléans', 'Rouen', 'Perpignan', 'Toulon', 'Brest', 'Rennes'];
$statuts = ['Actif', 'Complet'];
$prix_min = 10;
$prix_max = 50;
$nb_places_min = 1;
$nb_places_max = 4;

// Date de début et de fin
$date_debut = new DateTime('2025-02-01');
$date_fin = new DateTime('2025-07-31');

// Récupérer les utilisateurs existants
$stmt = $pdo->query("SELECT id_utilisateur FROM Utilisateur");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Récupérer les voitures existantes
$stmt = $pdo->query("SELECT id_voiture FROM Voiture");
$voitures = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Générer des trajets tous les deux jours
$interval = new DateInterval('P2D');
$period = new DatePeriod($date_debut, $interval, $date_fin);

foreach ($period as $date) {
    $lieu_depart = $villes[array_rand($villes)];
    $lieu_arrivee = $villes[array_rand($villes)];
    while ($lieu_depart === $lieu_arrivee) {
        $lieu_arrivee = $villes[array_rand($villes)];
    }
    $date_depart = $date->format('Y-m-d');
    $heure_depart = rand(6, 20) . ':00:00';
    $date_arrivee = $date_depart;
    $heure_arrivee = (rand(6, 20) + 2) . ':00:00';
    $statut = $statuts[array_rand($statuts)];
    $nb_place = rand($nb_places_min, $nb_places_max);
    $prix_par_personne = rand($prix_min, $prix_max);
    $id_voiture = $voitures[array_rand($voitures)];
    $id_utilisateur = $utilisateurs[array_rand($utilisateurs)];

    // Insérer le trajet dans la table `Covoiturage`
    $query = "INSERT INTO Covoiturage (date_depart, heure_depart, lieu_depart, date_arrivee, heure_arrivee, lieu_arrivee, statut, nb_place, prix_par_personne, id_voiture, id_utilisateur) 
              VALUES (:date_depart, :heure_depart, :lieu_depart, :date_arrivee, :heure_arrivee, :lieu_arrivee, :statut, :nb_place, :prix_par_personne, :id_voiture, :id_utilisateur)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':date_depart' => $date_depart,
        ':heure_depart' => $heure_depart,
        ':lieu_depart' => $lieu_depart,
        ':date_arrivee' => $date_arrivee,
        ':heure_arrivee' => $heure_arrivee,
        ':lieu_arrivee' => $lieu_arrivee,
        ':statut' => $statut,
        ':nb_place' => $nb_place,
        ':prix_par_personne' => $prix_par_personne,
        ':id_voiture' => $id_voiture,
        ':id_utilisateur' => $id_utilisateur
    ]);
}

echo "Trajets générés avec succès jusqu'au 31 juillet 2025.";
?>