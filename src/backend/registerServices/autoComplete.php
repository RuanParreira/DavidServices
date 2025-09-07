<?php
require __DIR__ . '/../conn.php';

$search = $_GET['q'] ?? '';

try {
    $stmt = $pdo->prepare('SELECT id, name, cpf_cnpj, number FROM clients WHERE name LIKE :search OR cpf_cnpj LIKE :search OR number LIKE :search');
    $stmt->execute(['search' => "%$search%"]);
    $resultClients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($resultClients);
} catch (PDOException $e) {
    echo json_encode([]);
}
