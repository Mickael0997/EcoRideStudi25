<?php
session_start();
include __DIR__ . '/database.php';

$error = '';
$redirectTo = isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : 'profile.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = $_POST['identifier']; // Peut être un email ou un pseudo
    $password = $_POST['password'];

    // Requête pour vérifier les informations d'identification de l'utilisateur
    $stmt = $pdo->prepare("SELECT id_utilisateur, pseudo, mot_de_passe, role FROM utilisateur WHERE pseudo = :identifier OR email = :identifier");
    $stmt->execute(['identifier' => $identifier]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Requête pour vérifier les informations d'identification de l'employé
    $stmtEmploye = $pdo->prepare("SELECT id_employe, pseudo, mot_de_passe, 'employe' AS role FROM employe WHERE email = :identifier");
    $stmtEmploye->execute(['identifier' => $identifier]);
    $employe = $stmtEmploye->fetch(PDO::FETCH_ASSOC);

    // Requête pour vérifier les informations d'identification de l'administrateur
    $stmtAdmin = $pdo->prepare("SELECT id, nom, prenom, email, mot_de_passe FROM admin WHERE email = :identifier");
    $stmtAdmin->execute(['identifier' => $identifier]);
    $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur && $password === $utilisateur['mot_de_passe']) {
        // Les informations d'identification de l'utilisateur sont correctes, démarrez la session
        $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
        $_SESSION['pseudo'] = $utilisateur['pseudo'];
        $_SESSION['role'] = $utilisateur['role'];

        // Redirigez l'utilisateur vers la page appropriée
        header("Location: $redirectTo");
        exit;
    } elseif ($employe && $password === $employe['mot_de_passe']) {
        // Les informations d'identification de l'employé sont correctes, démarrez la session
        $_SESSION['id_employe'] = $employe['id_employe'];
        $_SESSION['pseudo'] = $employe['pseudo'];
        $_SESSION['role'] = $employe['role'];

        // Redirigez l'employé vers la page appropriée
        header("Location: espace_employe.php");
        exit;
    } elseif ($admin && $password === $admin['mot_de_passe']) {
        // Les informations d'identification de l'administrateur sont correctes, démarrez la session
        $_SESSION['id_admin'] = $admin['id'];
        $_SESSION['nom'] = $admin['nom'];
        $_SESSION['prenom'] = $admin['prenom'];
        $_SESSION['role'] = 'admin';

        // Redirigez l'administrateur vers la page appropriée
        header("Location: admin.php");
        exit;
    } else {
        // Les informations d'identification sont incorrectes, définissez un message d'erreur
        $error = 'Identifiant ou mot de passe incorrect';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/login.css">
    <script>
        // Fonctions pour fenêtre modale
        function openLoginModal() {
            document.getElementById('login-modal').classList.remove('hidden');
        }

        function closeLoginModal() {
            document.getElementById('login-modal').classList.add('hidden');
        }

        // Ouvrir la fenêtre modale automatiquement au chargement de la page
        window.onload = function() {
            openLoginModal();
        };
    </script>
</head>
<body>
    <!-- Fenêtre modale pour la connexion -->
    <div id="login-modal" class="hidden">
        <div class="modal-content">
            <span class="close" onclick="closeLoginModal()">&times;</span>
            <h2>Connexion</h2>
            <form id="login-form" action="auth.php" method="post">
                <label for="identifier">Nom d'utilisateur ou Email</label>
                <input type="text" id="identifier" name="identifier" required>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Se connecter</button>
            </form>
            <p>Pas de compte ? <a href="register.php">Inscrivez-vous ici</a></p>
            <?php if ($error): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>