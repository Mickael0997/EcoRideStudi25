<?php
session_start();
include __DIR__ . '/database.php';

// Vérifiez si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['id_admin']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php'); // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté ou n'est pas un administrateur
    exit;
}

// Récupérer les données pour les graphiques
$stmt = $pdo->prepare("SELECT DATE(date_depart) AS date, COUNT(*) AS nombre_covoiturages FROM covoiturage GROUP BY DATE(date_depart)");
$stmt->execute();
$covoiturages_par_jour = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT DATE(date_depart) AS date, SUM(prix_par_personne * nb_place) AS total_gains FROM covoiturage GROUP BY DATE(date_depart)");
$stmt->execute();
$gains_par_jour = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT SUM(prix_par_personne * nb_place) AS total_gains FROM covoiturage");
$stmt->execute();
$total_gains = $stmt->fetch(PDO::FETCH_ASSOC)['total_gains'];

// Récupérer les utilisateurs et employés pour suspension
$stmt = $pdo->prepare("SELECT id_utilisateur, pseudo, role FROM utilisateur");
$stmt->execute();
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT id_employe, pseudo FROM employe");
$stmt->execute();
$employes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administrateur - EcoRide</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Bienvenue, Administrateur</h1>
            <nav>
                <ul>
                    <li><a href="admin.php">Accueil</a></li>
                    <li><a href="login.php">Déconnexion</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <h1>Espace Administrateur</h1>

    <h2>Créer un compte employé</h2>
    <form action="creer_employe.php" method="post">
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <button type="submit">Créer</button>
    </form>

    <h2>Graphiques</h2>
    <div>
        <canvas id="covoituragesChart"></canvas>
        <canvas id="gainsChart"></canvas>
    </div>

    <h2>Total des crédits gagnés : <?= htmlspecialchars($total_gains) ?> crédits</h2>

    <h2>Suspendre un compte</h2>
    <div class="suspendre-comptes">
        <h3>Utilisateurs</h3>
        <ul>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <li>
                    <?= htmlspecialchars($utilisateur['pseudo']) ?> (<?= htmlspecialchars($utilisateur['role']) ?>)
                    <button onclick="suspendreCompte('utilisateur', <?= $utilisateur['id_utilisateur'] ?>)">
                        Suspendre / Réactiver
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>

        <h3>Employés</h3>
        <ul>
            <?php foreach ($employes as $employe): ?>
                <li>
                    <?= htmlspecialchars($employe['pseudo']) ?>
                    <button onclick="suspendreCompte('employe', <?= $employe['id_employe'] ?>)">
                        Suspendre / Réactiver
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script>
        // Fonction pour suspendre ou réactiver un compte
        function suspendreCompte(type, id) {
            fetch('suspendre_compte.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ type: type, id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Opération réussie.');
                    window.location.reload();
                } else {
                    alert('Erreur lors de l\'opération.');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de l\'opération.');
            });
        }

        // Graphique des covoiturages par jour
        const covoituragesCtx = document.getElementById('covoituragesChart').getContext('2d');
        const covoituragesChart = new Chart(covoituragesCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($covoiturages_par_jour, 'date')) ?>,
                datasets: [{
                    label: 'Nombre de covoiturages par jour',
                    data: <?= json_encode(array_column($covoiturages_par_jour, 'nombre_covoiturages')) ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Graphique des gains par jour
        const gainsCtx = document.getElementById('gainsChart').getContext('2d');
        const gainsChart = new Chart(gainsCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($gains_par_jour, 'date')) ?>,
                datasets: [{
                    label: 'Gains de la plateforme par jour',
                    data: <?= json_encode(array_column($gains_par_jour, 'total_gains')) ?>,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>