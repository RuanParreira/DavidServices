<?php
require __DIR__ . '/../conn.php';

// Buscar Clients Registrados
try {
    $stmt = $pdo->prepare('SELECT id, name, cpf_cnpj, number FROM clients ORDER BY created_at DESC');
    $stmt->execute();
    $resultClients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erro ao Buscar Client: ";
    header('Location: ../../../pages/registerService');
    exit;
}

// Buscar Técnicos Registrados

try {
    $stmt = $pdo->prepare('SELECT id, name, cpf, number FROM technicians ORDER BY created_at DESC');
    $stmt->execute();
    $resultTechnicians = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erro ao Buscar Técnico: ";
    header('Location: ../../../pages/registerService');
    exit;
}
