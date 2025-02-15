<?php
ob_start(); // Démarre la mise en mémoire tampon de sortie

// Vérifie si la session n'est pas déjà démarrée avant de l'initialiser
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/database.php'; // Utilisez __DIR__ pour obtenir le chemin absolu

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['id_utilisateur'])) {
    $id_utilisateur = $_SESSION['id_utilisateur'];

    // Récupérez les informations de l'utilisateur connecté
    $stmt = $pdo->prepare("SELECT pseudo, photo FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
    $stmt->execute(['id_utilisateur' => $id_utilisateur]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur) {
        $pseudo = htmlspecialchars($utilisateur['pseudo']);
        if ($utilisateur['photo']) {
            // Vérifiez si la photo est en base64 ou un chemin vers une image
            if (base64_encode(base64_decode($utilisateur['photo'], true)) === $utilisateur['photo']) {
                $photo = 'data:image/jpeg;base64,' . $utilisateur['photo'];
            } else {
                $photo = '../assets/' . htmlspecialchars($utilisateur['photo']);
            }
        } else {
            $photo = '../assets/user icon.jpg';
        }
    } else {
        $pseudo = '';
        $photo = '../assets/user icon.jpg';
    }
} else {
    $pseudo = 'Invité';
    $photo = '../assets/user icon.jpg';
}

// Récupérer les erreurs de connexion
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Covoiturage écologique</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <script>
        function openLoginModal() {
            document.getElementById('login-modal').classList.remove('hidden');
        }

        function closeLoginModal() {
            document.getElementById('login-modal').classList.add('hidden');
        }
    </script>
</head>
<body>
<header>
    <!--NAV HEADER-->
    <div class="header-left">
        <h1>EcoRide</h1>
        <p>Covoiturer malin</p>
    </div>
    <nav class="navbar">
        <div class="menu-icon">
            <span class="menu-icon-bar"></span>
            <span class="menu-icon-bar"></span>
            <span class="menu-icon-bar"></span>
        </div>
        <ul class="nav-list-one">
            <li><a href="../index.php">Accueil</a></li>
            <li><a href="../php/covoiturage.php">Covoiturage</a></li>
            <li><a href="#">Rechercher</a></li>
            <?php if (isset($_SESSION['id_utilisateur'])): ?>
                <li><a href="../php/add_trip.php">Ajouter un trajet <span class="add-icon">+</span></a></li>
            <?php endif; ?>
            </ul>
            <div class="profile-menu">
                <span class="profile-pseudo"><?= $pseudo ?></span>
                <span class="profile-icon">
                    <img src="<?= $photo ?>" alt="Profile Icon" id="profile-image">
                </span>
                <div class="dropdown-content">
                    <?php if (isset($_SESSION['id_utilisateur'])): ?>
                        <a href="../php/profile.php?id=<?= $id_utilisateur ?>">Mon profil</a>
                        <a href="logout.php">Se déconnecter</a>
                    <?php else: ?>
                        <a href="inscription.php">Inscription</a>
                        <a href="#" onclick="openLoginModal()">Se connecter</a>
                    <?php endif; ?>
                </div>
            </div>
    </nav>
</header>

<!-- Fenêtre modale de connexion -->
<div id="login-modal" class="hidden">
    <span class="close" onclick="closeLoginModal()">&times;</span>
    <h2>Connexion</h2>
    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form id="login-form" method="POST" action="/php/auth.php">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Se connecter</button>
    </form>
</div>

<?php ob_end_flush(); // Envoie tout le contenu tamponné ?>
</body>
</html>