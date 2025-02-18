<?php
ob_start(); // Démarre la mise en mémoire tampon de sortie

// Vérifie si la session n'est pas déjà démarrée avant de l'initialiser
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/database.php'; // Utilisez __DIR__ pour obtenir le chemin absolu

// Vérifiez si l'utilisateur est connecté
$isUserLoggedIn = isset($_SESSION['id_utilisateur']);
if ($isUserLoggedIn) {
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
</head>
<body>
<header>
    <div class="header_title">
        <h1><a href="../index.php">EcoRide</a></h1>
        <p>Covoiturer malin</p>
    </div>
    <nav class="header_navbar">
        <div class="header_close_burger" onclick="closeMenuBurger()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </div>
        <ul class="header_navbar_list">
            <li><a href="#" onclick="handleAddTripClick()">Ajoutez un trajet</a></li>
            <li><a href="../php/covoiturage.php">Covoiturage</a></li>
            <li><a href="#">Rechercher</a></li>
        </ul>
    </nav>
    <div class="header_profile_menu">
        <span class="header_profile_pseudo"><?= $pseudo ?></span>
        <span class="header_profile_icon">
            <img src="<?= $photo ?>" alt="Profile Icon" id="profile-image">
        </span>
        <div class="dropdown-content">
            <?php if ($isUserLoggedIn): ?>
                <a href="../php/profile.php?id=<?= $id_utilisateur ?>">Mon profil</a>
                <a href="../php/logout.php">Se déconnecter</a>
            <?php else: ?>
                <a href="inscription.php">Inscription</a>
                <a href="#" onclick="openLoginModal()">Se connecter</a>
            <?php endif; ?>
        </div>
    </div>
</header>
<div class="header_burger" onclick="openMenuBurger()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
    </svg>
</div>

<div class="overlay" onclick="closeMenuBurger()"></div>

<!-- Fenêtre modale pour la connexion -->
<div id="login-modal" class="hidden">
    <div class="modal-content">
        <span class="close" onclick="closeLoginModal()">&times;</span>
        <h2>Connexion</h2>
        <form id="login-form" action="./login.php" method="post">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Se connecter</button>
        </form>
        <p>Pas de compte ? <a href="./inscription.php">Inscrivez-vous ici</a></p>
    </div>
</div>

<?php ob_end_flush(); ?>

<script>
    // Vérifiez si l'utilisateur est connecté
    const isUserLoggedIn = <?= json_encode($isUserLoggedIn) ?>;

    // Fonction pour gérer le clic sur "Ajoutez un trajet"
    function handleAddTripClick() {
        if (isUserLoggedIn) {
            window.location.href = "./add_trip.php";
        } else {
            openLoginModal();
        }
    }

    // Fonctions pour fenêtre modal
    function openLoginModal() {
        document.getElementById('login-modal').classList.remove('hidden');
    }

    function closeLoginModal() {
        document.getElementById('login-modal').classList.add('hidden');
    }

    // Fonctions burger menu
    function openMenuBurger() {
        document.querySelector('.header_navbar').classList.add('open');
        document.querySelector('.overlay').classList.add('open');
        document.querySelector('.header_burger').style.display = 'none';
        document.querySelector('.header_close_burger').style.display = 'block';
    }

    function closeMenuBurger() {
        document.querySelector('.header_navbar').classList.remove('open');
        document.querySelector('.overlay').classList.remove('open');
        document.querySelector('.header_burger').style.display = 'block';
        document.querySelector('.header_close_burger').style.display = 'none';
    }

    // Fonction pour vérifier la largeur de l'écran et ajuster l'affichage des icônes burger
    function checkScreenWidth() {
        if (window.innerWidth > 750) {
            document.querySelector('.header_burger').style.display = 'none';
            document.querySelector('.header_close_burger').style.display = 'none';
        } else {
            document.querySelector('.header_burger').style.display = 'block';
        }
    }

    // Vérifiez la largeur de l'écran au chargement de la page
    window.addEventListener('load', checkScreenWidth);

    // Vérifiez la largeur de l'écran lors du redimensionnement de la fenêtre
    window.addEventListener('resize', checkScreenWidth);
</script>
</body>
</html>