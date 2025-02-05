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
        $photo = $utilisateur['photo'] 
            ? 'data:image/jpeg;base64,' . base64_encode($utilisateur['photo']) 
            : '../assets/user icon.jpg';
    } else {
        $pseudo = 'Invité';
        $photo = '../assets/user icon.jpg';
    }
} else {
    $pseudo = 'Invité';
    $photo = '../assets/user icon.jpg';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Covoiturage écologique</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
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
            <li><a href="#">Trajet <span class="add-icon">+</span></a></li>
        </ul>
        <div class="profile-menu">
            <span class="profile-pseudo"><?= $pseudo ?></span>
            <span class="profile-icon">
                <img src="<?= $photo ?>" alt="Profile Icon" id="profile-image">
            </span>
            <div class="dropdown-content">
                <a href="../php/inscription.php">Inscription</a>
                <a href="#">Se connecter</a>
            </div>
        </div>
    </nav>
</header>
<?php ob_end_flush(); // Envoie tout le contenu tamponné ?>
</body>
</html>