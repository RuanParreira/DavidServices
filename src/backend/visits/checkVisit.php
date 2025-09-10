<?php
require __DIR__ . '/../conn.php';

$date = $_POST['date'] ?? '';
$time = $_POST['time'] ?? '';

if (!$date || !$time) {
    echo json_encode(['agendado' => false]);
    exit;
}

$stmt = $pdo->prepare('SELECT id FROM visits WHERE status = 1 AND date = ? AND time = ?');
$stmt->execute([$date, $time]);
$agendado = $stmt->fetch();

echo json_encode(['agendado' => (bool)$agendado]);
