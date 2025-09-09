<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

// Iniciar Serviços

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
        $_SESSION['error_message'] = 'ID de serviço inválido.';
        header('Location: ../../../pages/ready');
        exit;
    }

    try {
        $stmt = $pdo->prepare('UPDATE services SET status = :status WHERE id = :id');
        $stmt->bindValue(':status', 4, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['success_message'] = 'Equipamento Retirado Pelo Cliente!';
        header('Location: ../../../pages/ready');
        exit;
    } catch (PDOException $e) {
        echo "Erro ao finalizar serviço: " . $e->getMessage();
    }
}
