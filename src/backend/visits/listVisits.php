<?php
require __DIR__ . '/../conn.php';

try {
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    if ($search !== '') {
        // Busca por data exata
        $stmt = $pdo->prepare('SELECT s.id, s.status, s.date, s.time, s.address, c.name, c.number
        FROM visits s JOIN clients c ON s.id_client = c.id
        WHERE s.date = :search
        ORDER BY s.time ASC');
        $stmt->execute([':search' => $search]);
    } else {
        $stmt = $pdo->prepare('SELECT s.id, s.status, s.date, s.time, s.address, c.name, c.number
        FROM visits s JOIN clients c ON s.id_client = c.id
        ORDER BY s.date DESC, s.time DESC');
        $stmt->execute();
    }
    $list_Visits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao Buscar Visitas: " . $e->getMessage();
}

// Verifica visita agendada
$dataSelecionada = $_POST['date'] ?? date('Y-m-d');

try {
    $stmt = $pdo->prepare('SELECT s.id, s.status, s.date, s.time, s.address, c.name, c.number
        FROM visits s
        JOIN clients c ON s.id_client = c.id
        WHERE s.status = 1 AND s.date = ?
        ORDER BY s.time DESC');
    $stmt->execute([$dataSelecionada]);
    $agendado = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao Buscar Visitas: " . $e->getMessage();
}
