<?php
include './database.php';

// Récupération des valeurs saisies ou initialisation par défaut
$depart = isset($_GET['depart']) ? trim($_GET['depart']) : '';
$destination = isset($_GET['destination']) ? trim($_GET['destination']) : '';
$date = isset($_GET['date']) ? trim($_GET['date']) : '';
$passagers = isset($_GET['passagers']) ? intval($_GET['passagers']) : 1;
$tri = isset($_GET['tri']) ? (array)$_GET['tri'] : [];

// Définition de la date et heure actuelles
$now_date = date("Y-m-d");
$now_time = date("H:i:s");

// Construction de la requête SQL
$query = "SELECT c.*, u.pseudo, u.photo, v.modele 
          FROM Covoiturage c
          JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur
          JOIN Voiture v ON c.id_voiture = v.id_voiture
          WHERE c.nb_place >= :passagers";

$params = [':passagers' => $passagers];

// Ajout des conditions de recherche dynamiques
if (!empty($depart)) {
    $query .= " AND c.lieu_depart = :lieu_depart";
    $params[':lieu_depart'] = $depart;
}
if (!empty($destination)) {
    $query .= " AND c.lieu_arrivee = :lieu_arrivee";
    $params[':lieu_arrivee'] = $destination;
}
if (!empty($date)) {
    $query .= " AND c.date_depart = :date_depart";
    $params[':date_depart'] = $date;
} else {
    // Si aucune date n'est fournie, afficher uniquement les trajets à partir de maintenant
    $query .= " AND (c.date_depart > :now_date OR (c.date_depart = :now_date AND c.heure_depart >= :now_time))";
    $params[':now_date'] = $now_date;
    $params[':now_time'] = $now_time;
}

// Gestion du tri des résultats
if (in_array('prix', $tri)) {
    $query .= " ORDER BY c.prix_par_personne ASC";
} elseif (in_array('heure', $tri)) {
    $query .= " ORDER BY c.date_depart ASC, c.heure_depart ASC";
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de Covoiturage</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/covoiturage.css">
    <style>
        .filters {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .filters label {
            margin-right: 10px;
        }
        .filters button {
            margin-left: auto;
        }
    </style>
</head>
<body class="covoiturage-body">
<?php include './header.php'; ?>
<main>
    <form id="searchForm" class="covoiturage-search-bar">
        <div class="search-item">
            <span class="icon-circle turquoise"></span>
            <input type="text" name="depart" placeholder="Départ" value="<?= htmlspecialchars($depart) ?>">
        </div>
        <div class="search-item">
            <span class="icon-circle green"></span>
            <input type="text" name="destination" placeholder="Destination" value="<?= htmlspecialchars($destination) ?>">
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
            <input type="date" name="date" value="<?= htmlspecialchars($date) ?>">
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
        <input type="number" name="passagers" min="1" max="8" value="<?= htmlspecialchars($passagers) ?>" required>
        <label for="passenger">passager</label>
    </div>
    <label><input type="checkbox" name="tri[]" value="heure" <?= in_array('heure', $tri) ? 'checked' : '' ?>> Départ le plus proche</label>
    <label><input type="checkbox" name="tri[]" value="prix" <?= in_array('prix', $tri) ? 'checked' : '' ?>> Prix le plus bas</label>
    <button class="search-button" type="submit">Rechercher</button>
    <button type="button" id="showAll">Tout afficher</button>
    <button type="button" id="resetFilters">Réinitialiser</button>
</form>

<div class="covoiturage-container">
    <ul class="covoiturage-results">
        <?php if (empty($results)): ?>
            <p>Aucun trajet trouvé.</p>
        <?php else: ?>
            <?php foreach ($results as $trajet): ?>
                <li class="covoiturage-result">
                    <div class="covoiturage-result-image">
                        <img src="../assets/<?= htmlspecialchars($trajet['photo']) ?>" alt="Conducteur">
                    </div>
                    <div class="covoiturage-result-details">
                        <p><strong><?= htmlspecialchars($trajet['pseudo']) ?></strong></p>
                        <p><strong><?= htmlspecialchars($trajet['lieu_depart']) ?></strong> → <strong><?= htmlspecialchars($trajet['lieu_arrivee']) ?></strong></p>
                        <p><u>Départ</u> : <?= htmlspecialchars(date('d/m/Y H:i', strtotime($trajet['date_depart'] . ' ' . $trajet['heure_depart']))) ?></p>
                        <p><u>Prix</u> : <?= htmlspecialchars($trajet['prix_par_personne']) ?>€</p>
                        <a href="details_voyage.php?id=<?= $trajet['id_covoiturage'] ?>">Détails</a>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
</main>
<?php include './footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchForm = document.getElementById("searchForm");
    const resultsContainer = document.querySelector(".covoiturage-results");
    const showAllBtn = document.getElementById("showAll");
    const resetFiltersBtn = document.getElementById("resetFilters");

    function renderResults(results) {
        resultsContainer.innerHTML = "";
        results.forEach(r => {
            const li = document.createElement("li");
            li.classList.add("covoiturage-result");
            const dateFormatted = new Date(r.date_depart).toLocaleDateString('fr-FR');
            const timeFormatted = new Date('1970-01-01T' + r.heure_depart + 'Z').toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
            li.innerHTML = `
                <div class="covoiturage-result-image">
                    <img src="../assets/${r.photo}" alt="Conducteur">
                </div>
                <div class="covoiturage-result-details">
                    <p><strong>${r.pseudo}</strong></p>
                    <p><strong>${r.lieu_depart}</strong> → <strong>${r.lieu_arrivee}</strong></p>
                    <p><u>Départ</u> : ${dateFormatted} à ${timeFormatted}</p>
                    <p><u>Prix</u> : ${r.prix_par_personne}€</p>
                    <a href="details_voyage.php?id=${r.id_covoiturage}">Détails</a>
                </div>
            `;
            resultsContainer.appendChild(li);
        });
    }

    function fetchResults(formData) {
        fetch('filter.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            renderResults(data);
        });
    }

    searchForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(searchForm);
        fetchResults(formData);
    });

    showAllBtn.addEventListener("click", function () {
        const formData = new FormData();
        formData.append('passagers', 1); // Valeur par défaut pour passagers
        fetchResults(formData);
    });

    resetFiltersBtn.addEventListener("click", function () {
        searchForm.reset();
        const formData = new FormData();
        formData.append('passagers', 1); // Valeur par défaut pour passagers
        fetchResults(formData);
    });

    // Initial fetch to display results on page load
    const initialFormData = new FormData();
    initialFormData.append('passagers', 1); // Valeur par défaut pour passagers
    fetchResults(initialFormData);
});
</script>
</body>
</html>