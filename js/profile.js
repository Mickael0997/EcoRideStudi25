function openEditModal(voiture) {
    document.getElementById('edit_id_voiture').value = voiture.id_voiture;
    document.getElementById('edit_id_marque').value = voiture.id_marque;
    document.getElementById('edit_modele').value = voiture.modele;
    document.getElementById('edit_immatriculation').value = voiture.immatriculation;
    document.getElementById('edit_energie').value = voiture.energie;
    document.getElementById('edit_couleur').value = voiture.couleur;
    document.getElementById('edit_date_premiere_immatriculation').value = voiture.date_premiere_immatriculation;
    document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function openDeleteModal(id_voiture) {
    document.getElementById('delete_id_voiture').value = id_voiture;
    document.getElementById('deleteModal').style.display = 'block';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

// Fermer les modales en cliquant en dehors de celles-ci
window.onclick = function(event) {
    if (event.target == document.getElementById('editModal')) {
        closeEditModal();
    }
    if (event.target == document.getElementById('deleteModal')) {
        closeDeleteModal();
    }
    if (event.target == document.getElementById('editCovoiturageModal')) {
        closeEditCovoiturageModal();
    }
    if (event.target == document.getElementById('deleteCovoiturageModal')) {
        closeDeleteCovoiturageModal();
    }
    if (event.target == document.getElementById('viewCovoiturageModal')) {
        closeViewCovoiturageModal();
    }
}

function openViewCovoiturageModal(covoiturage) {
    document.getElementById('view_id_covoiturage').value = covoiturage.id_covoiturage;
    document.getElementById('view_date_depart').innerText = 'Date de départ : ' + covoiturage.date_depart;
    document.getElementById('view_heure_depart').innerText = 'Heure de départ : ' + covoiturage.heure_depart;
    document.getElementById('view_lieu_depart').innerText = 'Lieu de départ : ' + covoiturage.lieu_depart;
    document.getElementById('view_date_arrivee').innerText = 'Date d\'arrivée : ' + covoiturage.date_arrivee;
    document.getElementById('view_heure_arrivee').innerText = 'Heure d\'arrivée : ' + covoiturage.heure_arrivee;
    document.getElementById('view_lieu_arrivee').innerText = 'Lieu d\'arrivée : ' + covoiturage.lieu_arrivee;
    document.getElementById('view_statut').innerText = 'Statut : ' + covoiturage.statut;
    document.getElementById('view_nb_place').innerText = 'Nombre de places : ' + covoiturage.nb_place;
    document.getElementById('view_prix_par_personne').innerText = 'Prix par personne : ' + covoiturage.prix_par_personne + ' €';
    document.getElementById('view_id_voiture').innerText = 'Véhicule : ' + covoiturage.id_voiture;

    // Vérification des valeurs récupérées
    console.log("Date départ:", covoiturage.date_depart);
    console.log("Heure départ:", covoiturage.heure_depart);

    // Correction du format des dates
    const now = new Date();
    const departTime = new Date(`${covoiturage.date_depart}T${covoiturage.heure_depart}`);
    const arriveeTime = new Date(`${covoiturage.date_arrivee}T${covoiturage.heure_arrivee}`);

    console.log("Heure actuelle:", now);
    console.log("Heure de départ:", departTime);
    console.log("Comparaison now < departTime :", now < departTime);

    // Cacher tous les boutons par défaut
    document.getElementById('modifyTripButton').style.display = 'none';
    document.getElementById('deleteTripButton').style.display = 'none';
    document.getElementById('startTripButton').style.display = 'none';
    document.getElementById('endTripButton').style.display = 'none';

    // Vérification et affichage correct des boutons
    if (now < departTime) {
        console.log("Affichage de Modifier et Supprimer");
        document.getElementById('modifyTripButton').style.display = 'block';
        document.getElementById('deleteTripButton').style.display = 'block';
    } else if (now >= departTime && now < arriveeTime) {
        console.log("Affichage de Démarrer");
        document.getElementById('startTripButton').style.display = 'block';
    } else if (now >= arriveeTime) {
        console.log("Affichage de Arrivée à destination");
        document.getElementById('endTripButton').style.display = 'block';
    }

    document.getElementById('viewCovoiturageModal').style.display = 'block';
}

function endTrip() {
    const id_covoiturage = document.getElementById('view_id_covoiturage').value;

    fetch('end_trip.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id_covoiturage: id_covoiturage })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Le trajet a été enregistré dans l\'historique.');
            window.location.reload();
        } else {
            alert('Erreur lors de l\'enregistrement du trajet.');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de l\'enregistrement du trajet.');
    });
}

function closeViewCovoiturageModal() {
    document.getElementById('viewCovoiturageModal').style.display = 'none';
}

function startTrip() {
    // Logique pour démarrer le covoiturage
}

function modifyTrip() {
    // Logique pour modifier le covoiturage
}

function deleteTrip() {
    // Logique pour supprimer le covoiturage
}

document.addEventListener('DOMContentLoaded', function() {
    var collapsibles = document.querySelectorAll('.collapsible');
    collapsibles.forEach(function(collapsible) {
        collapsible.addEventListener('click', function() {
            this.classList.toggle('active');
            var content = this.nextElementSibling;
            if (content.style.display === 'block') {
                content.style.display = 'none';
                this.querySelector('i').classList.remove('fa-chevron-up');
                this.querySelector('i').classList.add('fa-chevron-down');
            } else {
                content.style.display = 'block';
                this.querySelector('i').classList.remove('fa-chevron-down');
                this.querySelector('i').classList.add('fa-chevron-up');
            }
        });
    });
});

function openAvisModal(historique) {
    console.log("Ouverture de la fenêtre pour l'historique :", historique);

    document.getElementById('avis_id_historique').value = historique.id_historique;
    document.getElementById('modalDepart').innerText = historique.depart;
    document.getElementById('modalArrivee').innerText = historique.arrivee;
    document.getElementById('modalDuree').innerText = historique.duree;
    document.getElementById('avisModal').style.display = 'block';
}

function closeAvisModal() {
    document.getElementById('avisModal').style.display = 'none';
}
