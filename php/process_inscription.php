<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecoride";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupération des données du formulaire
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Vérification des mots de passe
if ($password !== $confirm_password) {
    die("Les mots de passe ne correspondent pas.");
}

// Hachage du mot de passe
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertion des données dans la base de données
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Inscription réussie. <a href='login.php'>Se connecter</a>";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>