<?php
// Connexion à la base de données
include './database.php'; // Assurez-vous que le chemin est correct

// Requête pour récupérer tous les trajets
$query = "SELECT c.*, u.pseudo, u.photo, 
                    (SELECT AVG(a.note) FROM Avis a WHERE a.id_utilisateur = u.id_utilisateur) AS note_moyenne
            FROM Covoiturage c
            JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur";
$stmt = $pdo->prepare($query);
$stmt->execute();
$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérifier et corriger les incohérences
foreach ($trajets as &$trajet) {
    $dateDepart = $trajet['date_depart'];
    $heureDepart = $trajet['heure_depart'];
    $dateArrivee = $trajet['date_arrivee'];
    $heureArrivee = $trajet['heure_arrivee'];

    $depart = new DateTime("$dateDepart $heureDepart");
    $arrivee = new DateTime("$dateArrivee $heureArrivee");

    if ($arrivee < $depart) {
        // Corriger l'heure d'arrivée en ajoutant une durée fixe (par exemple, 2 heures)
        $arrivee = $depart->add(new DateInterval('PT2H'));
        $trajet['date_arrivee'] = $arrivee->format('Y-m-d');
        $trajet['heure_arrivee'] = $arrivee->format('H:i:s');
    }
}
unset($trajet);

// Requête pour récupérer les villes de départ et d'arrivée
$queryVilles = "SELECT DISTINCT lieu_depart, lieu_arrivee FROM Covoiturage";
$stmtVilles = $pdo->prepare($queryVilles);
$stmtVilles->execute();
$villes = $stmtVilles->fetchAll(PDO::FETCH_ASSOC);
$villes_depart = array_unique(array_column($villes, 'lieu_depart'));
$villes_arrivee = array_unique(array_column($villes, 'lieu_arrivee'));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/covoiturage.css">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchForm = document.querySelector(".covoiturage-search-bar");
            const showAllBtn = document.getElementById("showAll");
            const resultsContainer = document.querySelector(".covoiturage-results");
            const resetFiltersBtn = document.createElement("button");

            resetFiltersBtn.textContent = "Réinitialiser";
            resetFiltersBtn.id = "resetFilters";
            resetFiltersBtn.style.display = "none";
            searchForm.appendChild(resetFiltersBtn);

            let allResults = <?= json_encode($trajets) ?>;

            function renderResults(results) {
                resultsContainer.innerHTML = "";
                results.forEach(r => {
                    const li = document.createElement("li");
                    li.classList.add("covoiturage-result");
                    const dateFormatted = new Date(r.date_depart).toLocaleDateString('fr-FR');
                    const duree = calculateDuration(r.date_depart, r.heure_depart, r.date_arrivee, r.heure_arrivee);
                    li.innerHTML = `
                        <div class="covoiturage-result-left">
                            <img src="../assets/${r.photo}" alt="Conducteur">
                        </div>
                        <div class="covoiturage-result-details">
                            <a href="./users_fiche.php?user=${r.pseudo}"><strong>${r.pseudo}</strong></a>
                            <p><strong>${r.lieu_depart}</strong> - ${r.heure_depart}</p>
                            <p><strong>${r.lieu_arrivee}</strong> - ${r.heure_arrivee}</p>
                            <p>Durée : ${duree}</p>
                            <p>Date : ${dateFormatted}</p>
                            <p>Note : ${renderStars(r.note_moyenne)}</p>
                        </div>
                        <div class="covoiturage-result-price">
                            <span>${r.prix_par_personne}€</span>
                            <p>Places disponibles : ${r.nb_place}</p>
                        </div>
                        <div class="covoiturage-result-actions">
                            <a href="./details_voyage.php?id=${r.id}" target="_blank" class="details-button">Détails</a>
                            <a href="./details_voyage.php?id=${r.id}" target="_blank" class="reserve-button">Réserver</a>
                        </div>
                    `;
                    resultsContainer.appendChild(li);
                });
            }

            function calculateDuration(dateDepart, heureDepart, dateArrivee, heureArrivee) {
                if (!dateDepart || !heureDepart || !dateArrivee || !heureArrivee) {
                    return 'Inconnu';
                }
                const depart = new Date(`${dateDepart}T${heureDepart}`);
                const arrivee = new Date(`${dateArrivee}T${heureArrivee}`);
                if (isNaN(depart) || isNaN(arrivee) || arrivee < depart) {
                    return 'Incohérent';
                }
                const diffMs = arrivee - depart;
                const diffHrs = Math.floor(diffMs / 3600000); // heures
                const diffMins = Math.round((diffMs % 3600000) / 60000); // minutes
                return `${diffHrs}h ${diffMins}m`;
            }

            function renderStars(note) {
                const fullStar = '★';
                const emptyStar = '☆';
                let stars = '';
                for (let i = 1; i <= 5; i++) {
                    stars += i <= note ? fullStar : emptyStar;
                }
                return stars;
            }

            function applyFilters() {
                let filteredResults = [...allResults];
                const depart = searchForm.elements["lieu_depart"].value;
                const arrivee = searchForm.elements["lieu_arrivee"].value;
                const triPrix = document.querySelector("input[name='tri'][value='prix']").checked;
                const triHeure = document.querySelector("input[name='tri'][value='heure']").checked;

                if (depart) {
                    filteredResults = filteredResults.filter(r => r.lieu_depart === depart);
                }
                if (arrivee) {
                    filteredResults = filteredResults.filter(r => r.lieu_arrivee === arrivee);
                }
                if (triPrix) {
                    filteredResults.sort((a, b) => a.prix_par_personne - b.prix_par_personne);
                }
                if (triHeure) {
                    filteredResults.sort((a, b) => {
                        const dateTimeA = new Date(`${a.date_depart}T${a.heure_depart}`);
                        const dateTimeB = new Date(`${b.date_depart}T${b.heure_depart}`);
                        return dateTimeA - dateTimeB;
                    });
                }
                renderResults(filteredResults);
                resetFiltersBtn.style.display = "block";
            }

            searchForm.addEventListener("submit", function (e) {
                e.preventDefault();
                applyFilters();
            });

            showAllBtn.addEventListener("click", function () {
                renderResults(allResults);
                resetFiltersBtn.style.display = "none";
            });

            searchForm.addEventListener("change", applyFilters);
            resetFiltersBtn.addEventListener("click", function () {
                document.querySelector("input[name='tri'][value='prix']").checked = false;
                document.querySelector("input[name='tri'][value='heure']").checked = false;
                renderResults(allResults);
                resetFiltersBtn.style.display = "none";
            });

            renderResults(allResults);
        });
    </script>
</head>
<body class="covoiturage-body">
<?php include 'header.php'; ?>
<div class="covoiturage-container">
    <!-- Barre de recherche et filtres -->
    <form method="POST" class="covoiturage-search-bar">
        <label for="ville_depart">Ville de départ :</label>
        <select id="ville_depart" name="lieu_depart">
            <option value="">Toutes</option>
            <?php foreach ($villes_depart as $ville): ?>
                <option value="<?= htmlspecialchars($ville) ?>"><?= htmlspecialchars($ville) ?></option>
            <?php endforeach; ?>
        </select>
        <label for="ville_arrivee">Ville d'arrivée :</label>
        <select id="ville_arrivee" name="lieu_arrivee">
            <option value="">Toutes</option>
            <?php foreach ($villes_arrivee as $ville): ?>
                <option value="<?= htmlspecialchars($ville) ?>"><?= htmlspecialchars($ville) ?></option>
            <?php endforeach; ?>
        </select>

        <label><input type="checkbox" name="tri" value="prix"> Prix le plus bas</label>
        <label><input type="checkbox" name="tri" value="heure"> Départ le plus proche</label>

        <button type="submit" id="search">Rechercher</button>
        <button type="button" id="showAll">Tout afficher</button>
    </form>

    <!-- Résultats -->
    <ul class="covoiturage-results"></ul>
</div>
</body>
</html>