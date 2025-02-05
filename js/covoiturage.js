document.addEventListener("DOMContentLoaded", function () {
    const searchForm = document.querySelector(".search-bar");
    const filterForm = document.querySelector(".filter-form");
    const showAllBtn = document.getElementById("showAll");
    const resultsContainer = document.querySelector(".results");
    const resetFiltersBtn = document.createElement("button");

    resetFiltersBtn.textContent = "Réinitialiser";
    resetFiltersBtn.id = "resetFilters";
    resetFiltersBtn.style.display = "none";
    filterForm.appendChild(resetFiltersBtn);

    let allResults = [];

    function fetchResults(params = {}) {
        // Simuler une récupération de données (remplacer par une requête AJAX si besoin)
        let results = [
            { id: 1, depart: "Lille", arrivee: "Paris", prix: 25, heure: "08:00" },
            { id: 2, depart: "Lyon", arrivee: "Marseille", prix: 15, heure: "10:30" },
            { id: 3, depart: "Lille", arrivee: "Paris", prix: 20, heure: "07:45" },
            { id: 4, depart: "Paris", arrivee: "Lyon", prix: 30, heure: "09:15" }
        ];
        
        if (params.depart) {
            results = results.filter(r => r.depart === params.depart);
        }
        if (params.arrivee) {
            results = results.filter(r => r.arrivee === params.arrivee);
        }
        allResults = results;
        renderResults(results);
    }

    function renderResults(results) {
        resultsContainer.innerHTML = "";
        results.forEach(r => {
            const div = document.createElement("div");
            div.classList.add("result");
            div.innerHTML = `<strong>${r.depart} → ${r.arrivee}</strong> - ${r.heure} - <span class="result-price">${r.prix}€</span>`;
            resultsContainer.appendChild(div);
        });
    }

    function applyFilters() {
        let filteredResults = [...allResults];
        const triPrix = document.querySelector("input[name='tri'][value='prix']").checked;
        const triHeure = document.querySelector("input[name='tri'][value='heure']").checked;
        
        if (triPrix) {
            filteredResults.sort((a, b) => a.prix - b.prix);
        }
        if (triHeure) {
            filteredResults.sort((a, b) => a.heure.localeCompare(b.heure));
        }
        renderResults(filteredResults);
        resetFiltersBtn.style.display = "block";
    }

    searchForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const depart = searchForm.elements["lieu_depart"].value;
        const arrivee = searchForm.elements["lieu_arrivee"].value;
        fetchResults({ depart, arrivee });
    });

    showAllBtn.addEventListener("click", function () {
        fetchResults();
    });

    filterForm.addEventListener("change", applyFilters);
    resetFiltersBtn.addEventListener("click", function () {
        document.querySelector("input[name='tri'][value='prix']").checked = false;
        document.querySelector("input[name='tri'][value='heure']").checked = false;
        renderResults(allResults);
        resetFiltersBtn.style.display = "none";
    });
});
