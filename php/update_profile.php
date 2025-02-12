<?php
session_start();
include __DIR__ . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $date_naissance = $_POST['date_naissance'];

    // Mise à jour de la photo si elle est téléchargée
    if (!empty($_FILES['photo']['tmp_name'])) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
        $stmt = $pdo->prepare("
            UPDATE Utilisateur 
            SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, adresse = :adresse, date_naissance = :date_naissance, photo = :photo 
            WHERE id_utilisateur = :id_utilisateur
        ");
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'telephone' => $telephone,
            'adresse' => $adresse,
            'date_naissance' => $date_naissance,
            'photo' => $photo,
            'id_utilisateur' => $id_utilisateur
        ]);
    } else {
        $stmt = $pdo->prepare("
            UPDATE Utilisateur 
            SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, adresse = :adresse, date_naissance = :date_naissance 
            WHERE id_utilisateur = :id_utilisateur
        ");
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'telephone' => $telephone,
            'adresse' => $adresse,
            'date_naissance' => $date_naissance,
            'id_utilisateur' => $id_utilisateur
        ]);
    }

    header('Location: profile.php');
    exit;
}
?>