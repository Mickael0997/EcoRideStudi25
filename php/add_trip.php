<?php
session_start();
include __DIR__ . '/database.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_depart = $_POST['date_depart'];
    $heure_depart = $_POST['heure_depart'];
    $lieu_depart = $_POST['lieu_depart'];
    $date_arrivee = $_POST['date_arrivee'];
    $heure_arrivee = $_POST['heure_arrivee'];
    $lieu_arrivee = $_POST['lieu_arrivee'];
    $statut = $_POST['statut'];
    $nb_place = $_POST['nb_place'];
    $prix_par_personne = $_POST['prix_par_personne'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $immatriculation = $_POST['immatriculation'];
    $energie = $_POST['energie'];
    $couleur = $_POST['couleur'];
    $date_premiere_immatriculation = $_POST['date_premiere_immatriculation'];
    $id_utilisateur = $_SESSION['id_utilisateur'];

    // Vérifiez si la marque existe déjà
    $stmt = $pdo->prepare("SELECT id_marque FROM Marque WHERE libelle = :marque");
    $stmt->execute(['marque' => $marque]);
    $marque_existante = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($marque_existante) {
        $id_marque = $marque_existante['id_marque'];
    } else {
        // Ajoutez la nouvelle marque
        $stmt = $pdo->prepare("INSERT INTO Marque (libelle) VALUES (:marque)");
        $stmt->execute(['marque' => $marque]);
        $id_marque = $pdo->lastInsertId();
    }

    // Ajoutez le véhicule
    $stmt = $pdo->prepare("
        INSERT INTO Voiture (modele, immatriculation, energie, couleur, date_premiere_immatriculation, id_marque, id_utilisateur)
        VALUES (:modele, :immatriculation, :energie, :couleur, :date_premiere_immatriculation, :id_marque, :id_utilisateur)
    ");
    $stmt->execute([
        'modele' => $modele,
        'immatriculation' => $immatriculation,
        'energie' => $energie,
        'couleur' => $couleur,
        'date_premiere_immatriculation' => $date_premiere_immatriculation,
        'id_marque' => $id_marque,
        'id_utilisateur' => $id_utilisateur
    ]);

    $id_voiture = $pdo->lastInsertId();

    // Ajoutez le trajet
    $stmt = $pdo->prepare("
        INSERT INTO Covoiturage (date_depart, heure_depart, lieu_depart, date_arrivee, heure_arrivee, lieu_arrivee, statut, nb_place, prix_par_personne, id_voiture, id_utilisateur)
        VALUES (:date_depart, :heure_depart, :lieu_depart, :date_arrivee, :heure_arrivee, :lieu_arrivee, :statut, :nb_place, :prix_par_personne, :id_voiture, :id_utilisateur)
    ");
    $stmt->execute([
        'date_depart' => $date_depart,
        'heure_depart' => $heure_depart,
        'lieu_depart' => $lieu_depart,
        'date_arrivee' => $date_arrivee,
        'heure_arrivee' => $heure_arrivee,
        'lieu_arrivee' => $lieu_arrivee,
        'statut' => $statut,
        'nb_place' => $nb_place,
        'prix_par_personne' => $prix_par_personne,
        'id_voiture' => $id_voiture,
        'id_utilisateur' => $id_utilisateur
    ]);

    header('Location: profile.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un trajet</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/add_trip.css">
</head>
<body>
<?php include './header.php'; ?>
    <div class="container">
        <h2>Ajouter un trajet</h2>
        <form method="POST">
            <label for="date_depart">Date de départ :</label>
            <input type="date" id="date_depart" name="date_depart" required>
            <label for="heure_depart">Heure de départ :</label>
            <input type="time" id="heure_depart" name="heure_depart" required>
            <label for="lieu_depart">Lieu de départ :</label>
            <input type="text" id="lieu_depart" name="lieu_depart" required>
            <label for="date_arrivee">Date d'arrivée :</label>
            <input type="date" id="date_arrivee" name="date_arrivee" required>
            <label for="heure_arrivee">Heure d'arrivée :</label>
            <input type="time" id="heure_arrivee" name="heure_arrivee" required>
            <label for="lieu_arrivee">Lieu d'arrivée :</label>
            <input type="text" id="lieu_arrivee" name="lieu_arrivee" required>
            <label for="statut">Statut :</label>
            <input type="text" id="statut" name="statut" required>
            <label for="nb_place">Nombre de places :</label>
            <input type="number" id="nb_place" name="nb_place" required>
            <label for="prix_par_personne">Prix par personne :</label>
            <input type="number" step="0.01" id="prix_par_personne" name="prix_par_personne" required>
            
            <h3>Informations sur le véhicule</h3>
            <label for="marque">Marque :</label>
            <input type="text" id="marque" name="marque" required>
            <label for="modele">Modèle :</label>
            <input type="text" id="modele" name="modele" required>
            <label for="immatriculation">Immatriculation :</label>
            <input type="text" id="immatriculation" name="immatriculation" required>
            <label for="energie">Énergie :</label>
            <input type="text" id="energie" name="energie" required>
            <label for="couleur">Couleur :</label>
            <input type="text" id="couleur" name="couleur" required>
            <label for="date_premiere_immatriculation">Date de première immatriculation :</label>
            <input type="date" id="date_premiere_immatriculation" name="date_premiere_immatriculation" required>
            
            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>