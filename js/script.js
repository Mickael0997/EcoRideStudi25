document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.querySelector('.search-button');
    const departureInput = document.querySelector('input[placeholder="Départ"]');
    const destinationInput = document.querySelector('input[placeholder="Destination"]');
    const dateInput = document.querySelector('input[type="date"]');
    const passengerInput = document.querySelector('input[type="number"]');

    searchButton.addEventListener('click', function() {
        const departure = departureInput.value;
        const destination = destinationInput.value;
        const date = dateInput.value;
        const passengers = passengerInput.value;

        if (departure && destination && date && passengers) {
            alert(`Recherche de trajet :\nDépart : ${departure}\nDestination : ${destination}\nDate : ${date}\nPassagers : ${passengers}`);
            // Ici, vous pouvez ajouter le code pour effectuer la recherche dans la base de données
        } else {
            alert('Veuillez remplir tous les champs.');
        }
    });
});