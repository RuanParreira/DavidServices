<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
        $_SESSION['error_message'] = 'ID da visita inválido.';
        header('Location: ../../../pages/visits');
        exit;
    }

    try {
        $stmt = $pdo->prepare('UPDATE visits SET status = :status WHERE id = :id');
        $stmt->bindValue(':status', 2, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['success_message'] = 'Visita concluída com sucesso!';
        header('Location: ../../../pages/visits');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erro ao concluir visita: ' . $e->getMessage();
        header('Location: ../../../pages/visits');
        exit;
    }
}
