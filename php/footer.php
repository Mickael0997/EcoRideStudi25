<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Site</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/contact.css">
</head>
<body>
    <footer>
        <div class="footer-left">
            <p>Tous droits réservés.</p>
        </div>
        <div class="footer-center">
            <p>&copy; 2025 EcoRide.</p>
        </div>
        <div class="footer-right">
            <nav>
                <ul>
                    <li><a href="#" id="contact-link">Contactez-nous</a></li>
                    <li><a href="../php/mentions_legales.php">Mentions légales</a></li>
                </ul>
            </nav>
        </div>
    </footer>

    <!-- Formulaire de contact -->
    <div id="contact-form-container" class="hidden">
        <form id="contact-form" action="../php/contact_submit.php" method="POST">
            <h2>Contactez-nous</h2>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Message :</label>
            <textarea id="message" name="message" required></textarea>
            <button type="submit">Envoyer</button>
            <button type="button" id="close-contact-form">Fermer</button>
        </form>
    </div>

    <script src="../js/contact.js"></script>
</body>
</html>