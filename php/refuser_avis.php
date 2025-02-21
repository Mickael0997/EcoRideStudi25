<?php
session_start();
include __DIR__ . '/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_avis = $data['id_avis'];

    $stmt = $pdo->prepare("UPDATE avis SET statut = 'refusé' WHERE id_avis = :id_avis");
    $stmt->execute(['id_avis' => $id_avis]);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
}