<?php
require __DIR__ . '/../conn.php';

// Iniciar Serviços

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
        header('Location: ../../../pages/notStart?error=invalid_id');
        exit;
    }

    try {
        $stmt = $pdo->prepare('UPDATE services SET status = :status WHERE id = :id');
        $stmt->bindValue(':status', 2, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header('Location: ../../../pages/notStart');
        exit;
    } catch (PDOException $e) {
        echo "Erro ao iniciar serviço: " . $e->getMessage();
    }
}
