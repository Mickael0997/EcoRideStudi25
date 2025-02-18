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

        function redirectToAddTrip() {
            <?php if (isset($_SESSION['id_utilisateur'])): ?>
                window.location.href = "add_trip.php";
            <?php else: ?>
                openLoginModal();
            <?php endif; ?>
        }

        // Fonctions burger menu button open
        document.addEventListener("DOMContentLoaded", function() {
            const burgerMenuButton = document.querySelector('.burger-menu-button');
            const burgerMenuButtonIcon = document.querySelector('.burger-menu-button i');
            const burgerMenu = document.querySelector('.burger-menu');

            burgerMenuButton.onclick = function() {
                burgerMenu.classList.toggle('open');
                const isOpen = burgerMenu.classList.contains('open');
                burgerMenuButtonIcon.classList = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
            };
        });

        function closeBurgerMenu() {
            document.querySelector('.burger-menu').classList.remove('open');
            document.querySelector('.burger-menu-button i').classList = 'fa-solid fa-bars';
        }
    </script>
</head>
<body>
<header>
    <div class="header_title">
        <h1><a href="../index.php" style="text-decoration: none; color: inherit;">EcoRide</a></h1>
        <p>Covoiturer malin</p>
    </div>
    <nav class="header_navbar">
        <div class="header_close_burger"></div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>

        <ul class="header_navbar_list">
            <li><a href="../php/covoiturage.php">Covoiturage</a></li>
            <li><a href="#">Rechercher</a></li>
        </ul>
    </nav>

    <button class="add-trip-button" onclick="redirectToAddTrip()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="white">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-6H5v-2h6V5h2v6h6v2h-6v6z"/>
        </svg>
    </button>

    <div class="header_profile_menu">
        <span class="header_profile_pseudo"><?= $pseudo ?></span>
        <span class="header_profile_icon">
            <img src="<?= $photo ?>" alt="Profile Icon" id="profile-image">
        </span>
        <div class="dropdown-content">
            <?php if (isset($_SESSION['id_utilisateur'])): ?>
                <a href="../php/profile.php?id=<?= $id_utilisateur ?>">Mon profil</a>
                <a href="../php/logout.php">Se déconnecter</a>
            <?php else: ?>
                <a href="inscription.php">Inscription</a>
                <a href="#" onclick="openLoginModal()">Se connecter</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- Burger Menu -->
<div class="header_burger">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
</svg>
    <span class="close-burger" onclick="closeBurgerMenu()">&times;</span>
</div>

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

<?php ob_end_flush(); ?>
</body>
</html>