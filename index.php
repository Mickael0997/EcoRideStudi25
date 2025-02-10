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

<?php include './php/header.php'; ?>
<main>
<!--BANDEAU IMAGES-->
<div class="banner">
    <div class="image1">
        <img src="./assets/retroroad.jpg" alt="Route dans rétroviseur">
    </div>
    <div class="image2">
        <img src="./assets/roadtrip.jpg" alt="Road trip">
    </div>
    <div class="image3">
        <img src="./assets/zoeturquoise.jpg" alt="Zoé électrique turquoise">
    </div>
</div>

<!--NAV RECHERCHE-->
<form action="php/covoiturage.php" method="GET" class="search-bar">
    <div class="search-item">
        <span class="icon-circle turquoise"></span>
        <input type="text" name="depart" placeholder="Départ">
    </div>
    <div class="search-item">
        <span class="icon-circle green"></span>
        <input type="text" name="destination" placeholder="Destination">
    </div>
    <div class="search-item">
        <span class="icon-calendar">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" class="calendar-icon">
                <g color="neutralIconDefault">
                    <g color="currentColor">
                        <path fill="#38ddcc" fill-rule="evenodd" d="M3 7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4zm4-2.5h10A2.5 2.5 0 0 1 19.5 7v.75h-15V7A2.5 2.5 0 0 1 7 4.5m12.5 4.75V17a2.5 2.5 0 0 1-2.5 2.5H7A2.5 2.5 0 0 1 4.5 17V9.25z" clip-rule="evenodd"></path>
                        <path fill="currentColor" d="M8.5 12a1 1 0 1 1-2 0 1 1 0 0 1 2 0M8.5 16a1 1 0 1 1-2 0 1 1 0 0 1 2 0M13 12a1 1 0 1 1-2 0 1 1 0 0 1 2 0M17.5 12a1 1 0 1 1-2 0 1 1 0 0 1 2 0M13 16a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                    </g>
                </g>
            </svg>
        </span>
        <input type="date" name="date">
    </div>
    <div class="search-item">
        <span class="icon-passenger">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" class="passenger-icon">
                <g color="neutralIconDefault">
                    <g color="currentColor">
                        <path fill="#38ddcc" fill-rule="evenodd" d="M4.5 19v.5h15V19c0-.597-.354-1.421-1.545-2.166C16.76 16.089 14.81 15.5 12 15.5s-4.76.588-5.955 1.334C4.854 17.58 4.5 18.405 4.5 19M3 19v1a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-1c0-2.5-3-5-9-5s-9 2.5-9 5m9-6.5A4.5 4.5 0 0 0 16.5 8V7a4.5 4.5 0 1 0-9 0v1a4.5 4.5 0 0 0 4.5 4.5M15 8V7a3 3 0 1 0-6 0v1a3 3 0 1 0 6 0" clip-rule="evenodd"></path>
                    </g>
                </g>
            </svg>
        </span>
        <input type="number" name="passagers" min="1" max="8" value="1" required>
        <label for="passenger">passager</label>
    </div>
    <button class="search-button" type="submit">Rechercher</button>
</form>

<!--NOUVELLE SECTION TEXTE-->
<section class="text-section">
    <div class="text-block left">
        <h3>Vos trajets préférés à petits prix</h3>
        <p>Où que vous alliez, en covoiturage, trouvez le trajet idéal parmi notre large choix de destinations à petits prix.</p>
    </div>
    <div class="text-block right">
        <h3>Voyagez en toute confiance</h3>
        <p>Nous prenons le temps qu’il faut pour connaître nos membres. Nous vérifions les avis, les profils et les pièces d’identité. Vous savez donc avec qui vous allez voyager pour réserver en toute confiance sur notre plateforme sécurisée.</p>
    </div>
    <div class="text-block left">
        <h3>Recherchez, cliquez et réservez !</h3>
        <p>Réserver un trajet devient encore plus simple ! Facile d'utilisation et dotée de technologies avancées, notre appli vous permet de réserver un trajet à proximité en un rien de temps.</p>
    </div>
</section>
</main>
<?php include './php/footer.php'; ?>

<script src="./js/script.js"></script>
</body>
</html>