<?php
session_start();
include './database.php'; // Connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header('Location: auth.php');
    exit();
}

$user_id = $_SESSION['id_utilisateur'];
$id_covoiturage = isset($_POST['id_covoiturage']) ? intval($_POST['id_covoiturage']) : 0;

// Vérification de l'ID du trajet
if ($id_covoiturage <= 0) {
    die("Erreur : ID du trajet invalide.");
}

// Vérifier si le trajet existe
$stmt = $pdo->prepare("SELECT c.*, u.id_utilisateur AS conducteur_id, cr.solde AS credits 
                        FROM Covoiturage c
                        JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur
                        LEFT JOIN Credit cr ON cr.id_utilisateur = ?
                        WHERE c.id_covoiturage = ?");
$stmt->execute([$user_id, $id_covoiturage]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("Erreur : Trajet ou utilisateur introuvable.");
}

$prix_par_personne = 1; // Chaque passager utilise 1 crédit
$nb_place = $data['nb_place'];
$credits = $data['credits'] ?? 0;
$conducteur_id = $data['conducteur_id'];

// Vérifier la disponibilité des places
if ($nb_place <= 0) {
    die("Erreur : Aucune place disponible.");
}

// Vérifier le solde des crédits
if ($credits < $prix_par_personne) {
    die("Erreur : Crédits insuffisants.");
}

// Demande de confirmation si non validée
if (!isset($_POST['confirm'])) {
    echo "<div id='confirmation-modal' class='modal'>
            <div class='modal-content'>
                <p>Voulez-vous utiliser $prix_par_personne crédit pour ce covoiturage ?</p>
                <form method='post' action='participer.php'>
                    <input type='hidden' name='id_covoiturage' value='$id_covoiturage'>
                    <input type='hidden' name='confirm' value='1'>
                    <button type='submit' class='btn-oui'>Oui</button>
                    <button type='button' class='btn-non' onclick='closeModal()'>Non</button>
                </form>
            </div>
          </div>
          <script>
            function closeModal() {
                document.getElementById('confirmation-modal').style.display = 'none';
            }
          </script>
          <style>
            .modal {
                display: flex;
                justify-content: center;
                align-items: center;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
            }
            .modal-content {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                width: 300px;
                text-align: center;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            .btn-oui, .btn-non {
                padding: 10px 20px;
                margin: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .btn-oui {
                background-color: #38ddcc;
                color: #fff;
            }
            .btn-non {
                background-color: #f44336;
                color: #fff;
            }
            .btn-oui:hover {
                background-color: #32c7b5;
            }
            .btn-non:hover {
                background-color: #d32f2f;
            }
          </style>";
    exit();
}

// Mettre à jour les crédits de l'utilisateur et le nombre de places disponibles
$pdo->beginTransaction();
try {
    // Déduire le crédit du passager
    $updateCreditsPassager = "UPDATE Credit SET solde = solde - ? WHERE id_utilisateur = ?";
    $stmtCreditsPassager = $pdo->prepare($updateCreditsPassager);
    $stmtCreditsPassager->execute([$prix_par_personne, $user_id]);

    // Ajouter le crédit au conducteur
    $updateCreditsConducteur = "UPDATE Credit SET solde = solde + ? WHERE id_utilisateur = ?";
    $stmtCreditsConducteur = $pdo->prepare($updateCreditsConducteur);
    $stmtCreditsConducteur->execute([$prix_par_personne, $conducteur_id]);

    // Mettre à jour le nombre de places disponibles
    $updatePlaces = "UPDATE Covoiturage SET nb_place = nb_place - 1 WHERE id_covoiturage = ?";
    $stmtPlaces = $pdo->prepare($updatePlaces);
    $stmtPlaces->execute([$id_covoiturage]);

    // Enregistrer la participation
    $insertParticipation = "INSERT INTO Passager (id_utilisateur, id_covoiturage) VALUES (?, ?)";
    $stmtParticipation = $pdo->prepare($insertParticipation);
    $stmtParticipation->execute([$user_id, $id_covoiturage]);

    $pdo->commit();
    echo "<div id='confirmation-modal' class='modal'>
            <div class='modal-content'>
                <p>Participation confirmée.</p>
                <button onclick='closeModalAndRedirect()' class='btn-oui'>Retour à l'accueil</button>
            </div>
          </div>
          <script>
            function closeModalAndRedirect() {
                document.getElementById('confirmation-modal').style.display = 'none';
                window.location.href = '../index.php'; // Redirige vers la page d'accueil
            }
            document.getElementById('confirmation-modal').style.display = 'flex';
          </script>
          <style>
            .modal {
                display: flex;
                justify-content: center;
                align-items: center;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
            }
            .modal-content {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                width: 300px;
                text-align: center;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            .btn-oui {
                padding: 10px 20px;
                margin: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                background-color: #38ddcc;
                color: #fff;
            }
            .btn-oui:hover {
                background-color: #32c7b5;
            }
          </style>";
} catch (Exception $e) {
    $pdo->rollBack();
    die("Erreur lors de la participation : " . $e->getMessage());
}
?>