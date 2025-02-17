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
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        function openLoginModal() {
            document.getElementById('login-modal').classList.remove('hidden');
        }

        function closeLoginModal() {
            document.getElementById('login-modal').classList.add('hidden');
        }

        function toggleMenu() {
            document.querySelector('.nav-list-one').classList.toggle('active');
        }

        // Fonctions burger menu button open
        document.addEventListener("DOMContentLoaded", function() {
            const burgerMenuButton = document.querySelector('.burger-menu-button');
            const burgerMenuButtonIcon = document.querySelector('.burger-menu-button i');
            const burgerMenu = document.querySelector('.burger-menu');

            // Ouverture au click
            burgerMenuButton.onclick = function() {
                burgerMenu.classList.toggle('open');
                const isOpen = burgerMenu.classList.contains('open');
                burgerMenuButtonIcon.classList = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
            };
        });
    </script>
</head>
<body>
<header>
    <!--NAV HEADER-->
    <div class="header-left">
        <h1><a href="../index.php" style="text-decoration: none; color: inherit;">EcoRide</a></h1>
        <p>Covoiturer malin</p>
    </div>
    <nav class="navbar">
        <ul class="nav-list-one">
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
    <div class="burger-menu-button">
        <i class="fas fa-bars"></i>
    </div>
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

<!-- Burger Menu -->
<div class="burger-menu">
    <ul class="links">
        <li><a href="../php/covoiturage.php">Covoiturage</a></li>
        <li><a href="#">Rechercher</a></li>
        <?php if (isset($_SESSION['id_utilisateur'])): ?>
            <li><a href="../php/add_trip.php">Ajouter un trajet <span class="add-icon">+</span></a></li>
        <?php endif; ?>
        <div class="burger-divider"></div>
        <div class="buttons-burger-menu">
            <a href="../HTML/contact.htm" class="action-button">Contacts/Avis</a>
            <a href="./login.php" class="action-button connexion" id="connexion">Connexion</a>
        </div>
    </ul>
</div>

<?php ob_end_flush(); // Envoie tout le contenu tamponné ?>
</body>
</html>