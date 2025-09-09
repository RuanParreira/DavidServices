<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

// Iniciar Serviços

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
        header('Location: ../../../pages/inProgress?error=invalid_id');
        exit;
    }

    try {
        $stmt = $pdo->prepare('UPDATE services SET status = :status WHERE id = :id');
        $stmt->bindValue(':status', 3, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['success_message'] = 'Serviço Finalizado Com Sucesso!';
        header('Location: ../../../pages/inProgress');
        exit;
    } catch (PDOException $e) {
        echo "Erro ao finalizar serviço: " . $e->getMessage();
    }
}
