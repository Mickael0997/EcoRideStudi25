<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/database.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // Redirigez l'utilisateur vers la page actuelle avec une fenêtre modale de connexion
    $_SESSION['error'] = 'Vous devez être connecté pour ajouter un trajet.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Récupérer les voitures de l'utilisateur
$stmtVoitures = $pdo->prepare("SELECT id_voiture, modele, immatriculation FROM Voiture WHERE id_utilisateur = :id_utilisateur");
$stmtVoitures->execute(['id_utilisateur' => $id_utilisateur]);
$voitures = $stmtVoitures->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    $date_depart = $_POST['date_depart'];
    $heure_depart = $_POST['heure_depart'];
    $lieu_depart = $_POST['lieu_depart'];
    $date_arrivee = $_POST['date_arrivee'];
    $heure_arrivee = $_POST['heure_arrivee'];
    $lieu_arrivee = $_POST['lieu_arrivee'];
    $statut = 'en attente';
    $nb_place = $_POST['nb_place'];
    $prix_par_personne = $_POST['prix_par_personne'];
    $id_voiture = $_POST['id_voiture'];
    $id_utilisateur = $_SESSION['id_utilisateur'];

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

    // Mettre à jour le solde de crédits
    $stmt = $pdo->prepare("UPDATE Credit SET solde = solde - 2 WHERE id_utilisateur = :id_utilisateur");
    $stmt->execute(['id_utilisateur' => $id_utilisateur]);

    echo "<script>
            alert('Trajet ajouté avec succès et 2 crédits ont été déduits.');
            window.location.href = 'profile.php';
        </script>";
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
    <div class="container">
        <h2>Ajouter un trajet</h2>
        <form id="tripForm" method="POST">
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
            <input type="text" id="statut" name="statut" value="en attente" readonly>
            <label for="nb_place">Nombre de places :</label>
            <input type="number" id="nb_place" name="nb_place" required>
            <label for="prix_par_personne">Prix par personne :</label>
            <input type="number" step="0.01" id="prix_par_personne" name="prix_par_personne" required>
            
            <h3>Informations sur le véhicule</h3>
            <label for="id_voiture">Sélectionnez un véhicule :</label>
            <select id="id_voiture" name="id_voiture" required>
                <option value="">Sélectionnez un véhicule</option>
                <?php foreach ($voitures as $voiture): ?>
                    <option value="<?= htmlspecialchars($voiture['id_voiture']) ?>"><?= htmlspecialchars($voiture['modele']) ?> - <?= htmlspecialchars($voiture['immatriculation']) ?></option>
                <?php endforeach; ?>
            </select>
            
            <button type="button" onclick="openConfirmModal()">Ajouter</button>
        </form>
    </div>

    <!-- Fenêtre modale de confirmation -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Voulez-vous ajouter ce trajet contre 2 crédits ?</p>
            <form method="POST">
                <input type="hidden" name="confirm" value="yes">
                <input type="hidden" id="modal_date_depart" name="date_depart">
                <input type="hidden" id="modal_heure_depart" name="heure_depart">
                <input type="hidden" id="modal_lieu_depart" name="lieu_depart">
                <input type="hidden" id="modal_date_arrivee" name="date_arrivee">
                <input type="hidden" id="modal_heure_arrivee" name="heure_arrivee">
                <input type="hidden" id="modal_lieu_arrivee" name="lieu_arrivee">
                <input type="hidden" id="modal_statut" name="statut">
                <input type="hidden" id="modal_nb_place" name="nb_place">
                <input type="hidden" id="modal_prix_par_personne" name="prix_par_personne">
                <input type="hidden" id="modal_id_voiture" name="id_voiture">
                <button type="submit">Oui</button>
                <button type="button" onclick="closeModal()">Non</button>
            </form>
        </div>
    </div>

    <script>
        function openConfirmModal() {
            // Remplir les champs cachés de la fenêtre modale avec les valeurs du formulaire
            document.getElementById('modal_date_depart').value = document.getElementById('date_depart').value;
            document.getElementById('modal_heure_depart').value = document.getElementById('heure_depart').value;
            document.getElementById('modal_lieu_depart').value = document.getElementById('lieu_depart').value;
            document.getElementById('modal_date_arrivee').value = document.getElementById('date_arrivee').value;
            document.getElementById('modal_heure_arrivee').value = document.getElementById('heure_arrivee').value;
            document.getElementById('modal_lieu_arrivee').value = document.getElementById('lieu_arrivee').value;
            document.getElementById('modal_statut').value = document.getElementById('statut').value;
            document.getElementById('modal_nb_place').value = document.getElementById('nb_place').value;
            document.getElementById('modal_prix_par_personne').value = document.getElementById('prix_par_personne').value;
            document.getElementById('modal_id_voiture').value = document.getElementById('id_voiture').value;

            // Afficher la fenêtre modale
            document.getElementById('confirmModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('confirmModal').style.display = 'none';
        }
    </script>
</body>
</html>