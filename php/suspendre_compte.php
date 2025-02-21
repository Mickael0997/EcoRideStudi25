<?php
session_start();
include __DIR__ . '/database.php';

// Vérifiez si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['id_admin']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Accès refusé']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$type = $data['type'];
$id = $data['id'];

if ($type === 'utilisateur') {
    $stmt = $pdo->prepare("UPDATE utilisateur SET statut = IF(statut = 'actif', 'suspendu', 'actif') WHERE id_utilisateur = :id");
} elseif ($type === 'employe') {
    $stmt = $pdo->prepare("UPDATE employe SET statut = IF(statut = 'actif', 'suspendu', 'actif') WHERE id_employe = :id");
} else {
    echo json_encode(['success' => false, 'message' => 'Type de compte invalide']);
    exit;
}

$stmt->execute(['id' => $id]);
echo json_encode(['success' => true]);
?>