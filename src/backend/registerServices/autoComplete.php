<?php
require __DIR__ . '/../conn.php';
require_once __DIR__ . '/../functions/geral.php';

$search = $_POST['q'] ?? '';

try {
    $stmt = $pdo->prepare('SELECT id, name, cpf_cnpj, number FROM clients WHERE name LIKE :search OR cpf_cnpj LIKE :search OR number LIKE :search');
    $stmt->execute(['search' => "%$search%"]);
    $resultClients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultClients as &$client) {
        $client['cpf_cnpj'] = formatCpfCnpj($client['cpf_cnpj']);
        $client['number'] = formatNumber($client['number']);
    }
    unset($client);

    echo json_encode($resultClients);
} catch (PDOException $e) {
    echo json_encode([]);
}
