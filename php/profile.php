<?php
session_start();
include __DIR__ . '/database.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: ../index.php'); // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté
    exit;
}

$id_utilisateur = isset($_GET['id']) ? (int)$_GET['id'] : $_SESSION['id_utilisateur'];

// Récupérez les informations de l'utilisateur connecté
$stmt = $pdo->prepare("
    SELECT u.pseudo, u.photo, u.email, u.nom, u.prenom, u.telephone, u.adresse, u.date_naissance, r.libelle AS role, cr.solde AS credits
    FROM Utilisateur u
    JOIN role r ON u.id_role = r.id_role
    LEFT JOIN Credit cr ON u.id_utilisateur = cr.id_utilisateur
    WHERE u.id_utilisateur = :id_utilisateur
");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$utilisateur) {
    echo "Utilisateur non trouvé.";
    exit;
}

$pseudo = htmlspecialchars($utilisateur['pseudo']);
$email = htmlspecialchars($utilisateur['email']);
$nom = htmlspecialchars($utilisateur['nom']);
$prenom = htmlspecialchars($utilisateur['prenom']);
$telephone = htmlspecialchars($utilisateur['telephone']);
$adresse = htmlspecialchars($utilisateur['adresse']);
$date_naissance = htmlspecialchars($utilisateur['date_naissance']);
$role = htmlspecialchars($utilisateur['role']);
$credits = htmlspecialchars($utilisateur['credits']);
$photo = $utilisateur['photo'] ? '../assets/' . htmlspecialchars($utilisateur['photo']) : '../assets/user icon.jpg';

// Récupérer les avis concernant l'utilisateur
$stmt = $pdo->prepare("
    SELECT a.commentaire, a.note, a.statut 
    FROM avis a
    WHERE a.id_utilisateur = :id_utilisateur
");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculer la note globale de l'utilisateur
$stmt = $pdo->prepare("
    SELECT AVG(a.note) AS note_globale
    FROM avis a
    WHERE a.id_utilisateur = :id_utilisateur
");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$note_globale = $stmt->fetchColumn();
$note_globale = $note_globale ? number_format($note_globale, 1) : '0.0';

// Récupérer l'historique des voyages de l'utilisateur
$stmt = $pdo->prepare("
    SELECT h.depart, h.arrivee, h.duree 
    FROM historiquevoyages h
    WHERE h.id_utilisateur = :id_utilisateur
");
$stmt->execute(['id_utilisateur' => $id_utilisateur]);
$historique = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les marques disponibles
$stmtMarques = $pdo->query("SELECT id_marque, libelle FROM Marque");
$marques = $stmtMarques->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les voitures de l'utilisateur
$stmtVoitures = $pdo->prepare("SELECT * FROM Voiture WHERE id_utilisateur = :id_utilisateur");
$stmtVoitures->execute(['id_utilisateur' => $id_utilisateur]);
$voitures = $stmtVoitures->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les préférences de l'utilisateur
$stmtPreferences = $pdo->prepare("SELECT * FROM Preferences WHERE id_utilisateur = :id_utilisateur");
$stmtPreferences->execute(['id_utilisateur' => $id_utilisateur]);
$preferences = $stmtPreferences->fetch(PDO::FETCH_ASSOC);

// Récupérer les covoiturages de l'utilisateur
$stmtCovoiturages = $pdo->prepare("SELECT * FROM Covoiturage WHERE id_utilisateur = :id_utilisateur");
$stmtCovoiturages->execute(['id_utilisateur' => $id_utilisateur]);
$covoiturages = $stmtCovoiturages->fetchAll(PDO::FETCH_ASSOC);

// Gestion de l'ajout de véhicule
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'ajouter') {
    $modele = $_POST['modele'];
    $immatriculation = $_POST['immatriculation'];
    $energie = $_POST['energie'];
    $couleur = $_POST['couleur'];
    $date_premiere_immatriculation = $_POST['date_premiere_immatriculation'];
    $id_marque = isset($_POST['id_marque']) ? intval($_POST['id_marque']) : null;

    if ($id_marque === null) {
        die("Erreur : La marque du véhicule est requise.");
    }

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

    echo "<script>alert('Véhicule ajouté avec succès.'); window.location.href = 'profile.php';</script>";
    exit;
}

// Gestion de la modification de véhicule
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier') {
    $id_voiture = $_POST['id_voiture'];
    $modele = $_POST['modele'];
    $immatriculation = $_POST['immatriculation'];
    $energie = $_POST['energie'];
    $couleur = $_POST['couleur'];
    $date_premiere_immatriculation = $_POST['date_premiere_immatriculation'];
    $id_marque = isset($_POST['id_marque']) ? intval($_POST['id_marque']) : null;

    if ($id_marque === null) {
        die("Erreur : La marque du véhicule est requise.");
    }

    $stmt = $pdo->prepare("
        UPDATE Voiture 
        SET modele = :modele, immatriculation = :immatriculation, energie = :energie, couleur = :couleur, date_premiere_immatriculation = :date_premiere_immatriculation, id_marque = :id_marque
        WHERE id_voiture = :id_voiture AND id_utilisateur = :id_utilisateur
    ");
    $stmt->execute([
        'modele' => $modele,
        'immatriculation' => $immatriculation,
        'energie' => $energie,
        'couleur' => $couleur,
        'date_premiere_immatriculation' => $date_premiere_immatriculation,
        'id_marque' => $id_marque,
        'id_voiture' => $id_voiture,
        'id_utilisateur' => $id_utilisateur
    ]);

    echo "<script>alert('Véhicule modifié avec succès.'); window.location.href = 'profile.php';</script>";
    exit;
}

// Gestion de la suppression de véhicule
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'supprimer') {
    $id_voiture = $_POST['id_voiture'];

    $stmt = $pdo->prepare("DELETE FROM Voiture WHERE id_voiture = :id_voiture AND id_utilisateur = :id_utilisateur");
    $stmt->execute(['id_voiture' => $id_voiture, 'id_utilisateur' => $id_utilisateur]);

    echo "<script>alert('Véhicule supprimé avec succès.'); window.location.href = 'profile.php';</script>";
    exit;
}

// Gestion de la modification de covoiturage
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier_covoiturage') {
    $id_covoiturage = $_POST['id_covoiturage'];
    $date_depart = $_POST['date_depart'];
    $heure_depart = $_POST['heure_depart'];
    $lieu_depart = $_POST['lieu_depart'];
    $date_arrivee = $_POST['date_arrivee'];
    $heure_arrivee = $_POST['heure_arrivee'];
    $lieu_arrivee = $_POST['lieu_arrivee'];
    $statut = $_POST['statut'];
    $nb_place = $_POST['nb_place'];
    $prix_par_personne = $_POST['prix_par_personne'];
    $id_voiture = $_POST['id_voiture'];

    $stmt = $pdo->prepare("
        UPDATE Covoiturage 
        SET date_depart = :date_depart, heure_depart = :heure_depart, lieu_depart = :lieu_depart, date_arrivee = :date_arrivee, heure_arrivee = :heure_arrivee, lieu_arrivee = :lieu_arrivee, statut = :statut, nb_place = :nb_place, prix_par_personne = :prix_par_personne, id_voiture = :id_voiture
        WHERE id_covoiturage = :id_covoiturage AND id_utilisateur = :id_utilisateur
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
        'id_covoiturage' => $id_covoiturage,
        'id_utilisateur' => $id_utilisateur
    ]);

    echo "<script>alert('Covoiturage modifié avec succès.'); window.location.href = 'profile.php';</script>";
    exit;
}

// Gestion de la suppression de covoiturage
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'supprimer_covoiturage') {
    $id_covoiturage = $_POST['id_covoiturage'];

    $stmt = $pdo->prepare("DELETE FROM Covoiturage WHERE id_covoiturage = :id_covoiturage AND id_utilisateur = :id_utilisateur");
    $stmt->execute(['id_covoiturage' => $id_covoiturage, 'id_utilisateur' => $id_utilisateur]);

    echo "<script>alert('Covoiturage supprimé avec succès.'); window.location.href = 'profile.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - EcoRide</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="profile-container">
        <a href="../index.php" class="home-icon"><i class="fas fa-home"></i> Accueil</a>
        <h2>Profil de <?= $pseudo ?></h2>
        <div class="profile-pic-container">
            <img src="<?= $photo ?>" alt="Photo de profil">
            <div class="credits">Crédits : <?= $credits ?></div>
        </div>
        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?= $nom ?>" required>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?= $prenom ?>" required>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?= $email ?>" required>
            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" value="<?= $telephone ?>">
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?= $adresse ?>">
            <label for="date_naissance">Date de naissance :</label>
            <input type="date" id="date_naissance" name="date_naissance" value="<?= $date_naissance ?>">
            <label for="photo">Photo :</label>
            <input type="file" id="photo" name="photo">
            <button type="submit">Mettre à jour</button>
        </form>

        <h3 class="collapsible">Préférences <i class="fas fa-chevron-down"></i></h3>
        <div class="content">
            <form method="POST" action="update_preferences.php">
                <label for="role">Rôle :</label>
                <select id="role" name="role" required>
                    <option value="conducteur" <?= isset($preferences['role']) && $preferences['role'] == 'conducteur' ? 'selected' : '' ?>>Conducteur</option>
                    <option value="passager" <?= isset($preferences['role']) && $preferences['role'] == 'passager' ? 'selected' : '' ?>>Passager</option>
                    <option value="les deux" <?= isset($preferences['role']) && $preferences['role'] == 'les deux' ? 'selected' : '' ?>>Les deux</option>
                </select>
                <label for="fumeur">Fumeur :</label>
                <select id="fumeur" name="fumeur" required>
                    <option value="1" <?= isset($preferences['fumeur']) && $preferences['fumeur'] == 1 ? 'selected' : '' ?>>Oui</option>
                    <option value="0" <?= isset($preferences['fumeur']) && $preferences['fumeur'] == 0 ? 'selected' : '' ?>>Non</option>
                </select>
                <label for="animaux">Animaux :</label>
                <select id="animaux" name="animaux" required>
                    <option value="1" <?= isset($preferences['animaux']) && $preferences['animaux'] == 1 ? 'selected' : '' ?>>Oui</option>
                    <option value="0" <?= isset($preferences['animaux']) && $preferences['animaux'] == 0 ? 'selected' : '' ?>>Non</option>
                </select>
                <label for="trajets">Trajets :</label>
                <input type="text" id="trajets" name="trajets" value="<?= htmlspecialchars($preferences['trajets'] ?? '') ?>" required>
                <label for="pause">Pause :</label>
                <input type="text" id="pause" name="pause" value="<?= htmlspecialchars($preferences['pause'] ?? '') ?>" required>
                <button type="submit">Mettre à jour</button>
            </form>
        </div>

        <h3 class="collapsible">Véhicules <i class="fas fa-chevron-down"></i></h3>
        <div class="content">
            <?php include 'add_vehicle.php'; ?>

            <h3>Liste des véhicules</h3>
            <?php foreach ($voitures as $voiture): ?>
                <div class="voiture">
                    <p>Marque : <?= htmlspecialchars($voiture['id_marque']) ?></p>
                    <p>Modèle : <?= htmlspecialchars($voiture['modele']) ?></p>
                    <p>Immatriculation : <?= htmlspecialchars($voiture['immatriculation']) ?></p>
                    <p>Énergie : <?= htmlspecialchars($voiture['energie']) ?></p>
                    <p>Couleur : <?= htmlspecialchars($voiture['couleur']) ?></p>
                    <p>Date de première immatriculation : <?= htmlspecialchars($voiture['date_premiere_immatriculation']) ?></p>
                    <button onclick="openEditModal(<?= htmlspecialchars(json_encode($voiture)) ?>)">Modifier</button>
                    <button onclick="openDeleteModal(<?= $voiture['id_voiture'] ?>)">Supprimer</button>
                </div>
            <?php endforeach; ?>
        </div>

        <h3 class="collapsible">Mes trajets en cours <i class="fas fa-chevron-down"></i></h3>
        <div class="content">
            <?php foreach ($covoiturages as $covoiturage): ?>
                <div class="covoiturage">
                    <p>Départ : <?= htmlspecialchars($covoiturage['date_depart']) ?> à <?= htmlspecialchars($covoiturage['heure_depart']) ?> de <?= htmlspecialchars($covoiturage['lieu_depart']) ?></p>
                    <p>Arrivée : <?= htmlspecialchars($covoiturage['date_arrivee']) ?> à <?= htmlspecialchars($covoiturage['heure_arrivee']) ?> à <?= htmlspecialchars($covoiturage['lieu_arrivee']) ?></p>
                    <p>Statut : <?= htmlspecialchars($covoiturage['statut']) ?></p>
                    <p>Nombre de places : <?= htmlspecialchars($covoiturage['nb_place']) ?></p>
                    <p>Prix par personne : <?= htmlspecialchars($covoiturage['prix_par_personne']) ?> €</p>
                    <button onclick="openViewCovoiturageModal(<?= htmlspecialchars(json_encode($covoiturage)) ?>)">Visualiser</button>
                </div>
            <?php endforeach; ?>
        </div>

        <h3 class="collapsible">Avis <span class="note-globale">(<?= number_format($note_globale, 1) ?> / 5 <i class="fas fa-star"></i>)</span><i class="fas fa-chevron-down"></i> </h3>
        <div class="content">
            <?php include 'avis.php'; ?>
        </div>


        <h3 class="collapsible">Historique des voyages <i class="fas fa-chevron-down"></i></h3>
        <div class="content">
            <?php include 'historique_voyage.php'; ?>
        </div>



        <a href="delete_account.php">Supprimer mon compte</a>
    </div>

<!-- Fenêtre modale pour visualiser un covoiturage -->
<div id="viewCovoiturageModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeViewCovoiturageModal()">&times;</span>
        <h2>Visualiser le covoiturage</h2>
        <form id="viewCovoiturageForm" method="POST">
            <input type="hidden" name="action" value="visualiser_covoiturage">
            <input type="hidden" id="view_id_covoiturage" name="id_covoiturage">
            <p id="view_date_depart"></p>
            <p id="view_heure_depart"></p>
            <p id="view_lieu_depart"></p>
            <p id="view_date_arrivee"></p>
            <p id="view_heure_arrivee"></p>
            <p id="view_lieu_arrivee"></p>
            <p id="view_statut"></p>
            <p id="view_nb_place"></p>
            <p id="view_prix_par_personne"></p>
            <p id="view_id_voiture"></p>
            <div class="button-container">
                <button type="button" id="startTripButton" onclick="startTrip()">Démarrer</button>
                <button type="button" id="modifyTripButton" onclick="modifyTrip()">Modifier</button>
                <button type="button" id="deleteTripButton" onclick="deleteTrip()">Supprimer</button>
                <button type="button" id="endTripButton" onclick="endTrip()">Arrivée à destination</button>
            </div>
        </form>
    </div>
</div>

    <!-- Fenêtre modale pour donner un avis -->
    <div id="avisModal" class="modal hidden">
    <div class="modal-content">
        <span class="close" onclick="closeAvisModal()">&times;</span>
        <h2>Donner un avis</h2>
        <form id="avisForm" action="submit_avis.php" method="POST">
            <input type="hidden" id="avis_id_historique" name="id_historique">
            <p><strong>Départ :</strong> <span id="modalDepart"></span></p>
            <p><strong>Arrivée :</strong> <span id="modalArrivee"></span></p>
            <p><strong>Durée :</strong> <span id="modalDuree"></span></p>

            <label for="commentaire">Commentaire :</label>
            <textarea name="commentaire" id="commentaire" required></textarea>

            <label for="note">Note :</label>
            <select name="note" id="note" required>
                <option value="1">1 - Mauvais</option>
                <option value="2">2 - Passable</option>
                <option value="3">3 - Correct</option>
                <option value="4">4 - Bon</option>
                <option value="5">5 - Excellent</option>
            </select>

            <button type="submit">Envoyer</button>
        </form>
    </div>
</div>


    <script src="../js/profile.js"></script>
</body>
</html>