<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Utilisateur</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
    // Exemple de données utilisateur dynamiques
    $utilisateur = [
        "nom" => "PERSONNA",
        "role" => "chauffeur",
        "note" => 5,
        "avis" => 200,
        "vehicule" => [
            "marque" => "Cadillac",
            "modele" => "ST-V",
            "couleur" => "Violet",
            "energie" => "Diesel",
            "controle" => "01/01/2025",
        ],
        "preferences" => [
            "fumeur" => "Non",
            "animaux" => "Non",
            "trajets" => "Long",
            "pause" => "Oui",
        ],
        "voyages" => [
            "nombre" => 27,
            "kilometres" => 3100,
        ],
        "historique" => [
            ["depart" => "Paris", "arrivee" => "Marseille", "duree" => "9h"],
            ["depart" => "Marseille", "arrivee" => "Montpellier", "duree" => "3h"],
            ["depart" => "Montpellier", "arrivee" => "Toulouse", "duree" => "3h"],
            ["depart" => "Toulouse", "arrivee" => "Paris", "duree" => "8h"],
            ["depart" => "Paris", "arrivee" => "Orleans", "duree" => "3h"],
        ],
        "avis_clients" => [
            ["nom" => "Tom", "note" => 5, "commentaire" => "Super voyage, je recommande sans modération !!"],
            ["nom" => "Laure", "note" => 5, "commentaire" => "Voyage très agréable, je recommande."],
            ["nom" => "Pierre", "note" => 5, "commentaire" => "Véhicule propre et silencieux, ça fait un bien fou."],
        ],
    ];
?>
    <div class="container">
        <div class="header">
            <img src="profile.jpg" alt="Photo de profil" class="profile-pic">
            <h1><?= $utilisateur["nom"] ?> est <?= $utilisateur["role"] ?></h1>
            <div class="rating">
                <?php for ($i = 0; $i < $utilisateur["note"]; $i++) { ?>
                    <span class="star">&#9733;</span>
                <?php } ?>
                <p><?= $utilisateur["avis"] ?> Avis</p>
            </div>
        </div>

        <div class="vehicle-info">
            <h2>Détails du véhicule</h2>
            <p>Marque : <?= $utilisateur["vehicule"]["marque"] ?></p>
            <p>Modèle : <?= $utilisateur["vehicule"]["modele"] ?></p>
            <p>Couleur : <?= $utilisateur["vehicule"]["couleur"] ?></p>
            <p>Énergie : <?= $utilisateur["vehicule"]["energie"] ?></p>
            <p>Contrôle : <?= $utilisateur["vehicule"]["controle"] ?></p>
        </div>

        <div class="preferences">
            <h2>Préférences</h2>
            <p>Fumeur : <?= $utilisateur["preferences"]["fumeur"] ?></p>
            <p>Animaux : <?= $utilisateur["preferences"]["animaux"] ?></p>
            <p>Trajets : <?= $utilisateur["preferences"]["trajets"] ?></p>
            <p>Pause : <?= $utilisateur["preferences"]["pause"] ?></p>
        </div>

        <div class="voyages">
            <h2>Voyages</h2>
            <p>Nombre : <?= $utilisateur["voyages"]["nombre"] ?></p>
            <p>Kilomètres : <?= $utilisateur["voyages"]["kilometres"] ?> km</p>
        </div>

        <div class="historique">
            <h2>Historique Voyages</h2>
            <ul>
                <?php foreach ($utilisateur["historique"] as $trajet) { ?>
                    <li><?= $trajet["depart"] ?> -> <?= $trajet["arrivee"] ?> : <?= $trajet["duree"] ?></li>
                <?php } ?>
            </ul>
        </div>

        <div class="avis">
            <h2>Avis clients</h2>
            <?php foreach ($utilisateur["avis_clients"] as $avis) { ?>
                <div class="avis-client">
                    <h3><?= $avis["nom"] ?></h3>
                    <p>Note : 
                        <?php for ($i = 0; $i < $avis["note"]; $i++) { ?>
                            <span class="star">&#9733;</span>
                        <?php } ?>
                    </p>
                    <p><?= $avis["commentaire"] ?></p>
                </div>
            <?php } ?>
        </div>
    </div>

    <footer>
        <p>Ceci est mon footer</p>
    </footer>
</body>
</html>
