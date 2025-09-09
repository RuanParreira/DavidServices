<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

// Iniciar Serviços

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
        $_SESSION['error_message'] = 'ID de serviço inválido.';
        header('Location: ../../../pages/notStart');
        exit;
    }

    try {
        $stmt = $pdo->prepare('UPDATE services SET status = :status WHERE id = :id');
        $stmt->bindValue(':status', 2, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['success_message'] = 'Serviço iniciado com sucesso!';
        header('Location: ../../../pages/notStart');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erro ao iniciar serviço: ' . $e->getMessage();
        header('Location: ../../../pages/notStart');
        exit;
    }
}
